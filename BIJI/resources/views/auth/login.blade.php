<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIJI | Masuk</title>
    <link
      rel="shortcut icon"
      href="../assets/images/icon.png"
      type="image/x-icon"
    />

    <!-- Font Icon -->
    <link rel="stylesheet" href="../assets/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="../assets/images/log.svg" alt="sing up image"></figure>
                        <a href="/register" class="signup-image-link">Buat Akun</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Masuk</h2>
                        <form id="login" class="register-form">
                            <div class="form-group">
                                <label for="login_identifier"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="login_identifier" id="login_identifier" placeholder="Username or Email" />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" />
                            </div>
                            <div class="form-group remember">
                                <a href="/forgot-password">Lupa kata sandi?</a>
                            </div>

                            <div class="form-group form-button">
                                <button type="submit" name="signin" id="login-btn" class="form-submit">Masuk</button>
                                <button id="login-load-btn" type="submit" class="form-submit" disabled
                                    style="display: none;">
                                    Memuat
                                    <div class="loader"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#login').on('submit', function (e) {
                e.preventDefault()
                $('#login-btn').prop('disabled', true);
                $('#login-btn').hide();
                $('#login-load-btn').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/login',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function () {
                        $("div[id$='-error']").empty();
                    },
                    success: function (data) {
                        if (data.error == true) {
                            $.each(data.message, function (field, error) {
                                $('#' + field + '-error').html(error);
                            });
                            $('#login-btn').prop('disabled', false);
                            $('#login-btn').show();
                            $('#login-load-btn').hide();
                        } else {
                            setTimeout(function () {
                                window.location.href = data.redirect_url;
                            }, 1000);
                        }
                    },
                    complete: function () {
                        $('#login-load-btn').hide();
                        $('#login-btn').show();
                    }
                });
            });
        });
    </script>
</body>

</html>