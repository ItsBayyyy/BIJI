<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIJI | Daftar</title>
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

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Daftar</h2>
                        <form id="register" class="register-form">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label for="password_register"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_register" id="password_register" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <button type="submit" name="signup" id="register-btn" class="form-submit">Daftar</button>
                                <button id="register-load-btn" type="submit" class="form-submit" disabled
                                    style="display: none;">
                                    Memuat
                                    <div class="loader"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../assets/images/register.svg" alt="sing up image"></figure>
                        <a href="/login" class="signup-image-link">Saya sudah punya akun</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#register').on('submit', function (e) {
                e.preventDefault()
                $('#register-btn').prop('disabled', true);
                $('#register-btn').hide();
                $('#register-load-btn').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/register',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function () {
                        $("div[id$='-error']").empty()
                    },
                    success: function (data) {
                        if (data.error == true) {
                            $.each(data.message, function (field, error) {
                                $('#' + field + '-error').html(error);
                            });
                            $('#register-btn').prop('disabled', false);
                            $('#register-btn').show();
                            $('#register-load-btn').hide();
                        } else {
                            setTimeout(function () {
                                window.location.href = data.redirect_url;
                            }, 1000);
                        }
                    },
                    complete: function () {
                        $('#register-load-btn').hide();
                        $('#register-btn').show();
                    }
                });
            });
        });
    </script>
</body>
</html>