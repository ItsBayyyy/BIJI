<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIJI | Lupa Kata Sandi</title>
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
                        <figure><img src="../assets/images/search.svg" alt="sing up image"></figure>
                        <a href="/register" class="signup-image-link">Kembali</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Cari Akun</h2>
                        <form id="search-account" class="register-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email material-icons-name"></i></label>
                                <input type="text" name="email" id="email" placeholder="Email" />
                            </div>

                            <div class="form-group form-button">
                                <button type="submit" name="signin" id="change-btn" class="form-submit">Cari</button>
                                <button id="change-load-btn" type="submit" class="form-submit" disabled
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
            $('#search-account').on('submit', function (e) {
                e.preventDefault()
                $('#change-btn').prop('disabled', true);
                $('#change-btn').hide();
                $('#change-load-btn').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/forgot-password',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function () {
                        $("div[id$='-error']").empty()
                    },
                    success: function (data) {
                        if (data.error == true) {
                            var hasOtherErrors = false;
                            $.each(data.message, function (field, error) {
                                $('#' + field + '-error').html(error);
                            });
                            if (grecaptcha.getResponse() == "") {
                                $('#captcha-error').html(
                                    'Lengkapi Captcha agar Anda dapat melanjutkan.');
                            }
                            if (hasOtherErrors) {
                                grecaptcha.reset();
                            }
                            $('#change-btn').prop('disabled', false);
                            $('#change-btn').show();
                            $('#change-load-btn').hide();
                        } else {
                            setTimeout(function () {
                                window.location.href = data.redirect_url;
                            }, 1000);
                        }
                    },
                    complete: function () {
                        $('#change-load-btn').hide();
                        $('#change-btn').show();
                    }
                });
            });
        });
    </script>
</body>

</html>