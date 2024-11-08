<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIJI | Auth</title>
    <link
      rel="shortcut icon"
      href="../assets/images/icon.png"
      type="image/x-icon"
    />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/auth.css" />
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form id="login" class="sign-in-form">
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username or Email" name="login_identifier" />
                        <div id="login_identifier-error" class="error-message"></div>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" />
                        <div id="password-error" class="error-message"></div>
                    </div>
                    <div class="forgot">
                    <a href="/forgot-password" id="forgot-password-link" class="forgot-password-link">Lupa Kata Sandi?</a>
                    </div>
                    <button id="login-btn" type="submit" class="btn solid">Login</button>
                    <button id="login-load-btn" type="submit" class="btn solid" disabled style="display: none;">
                        Memuat
                        <div class="loader"></div>
                    </button>
                </form>
                <form id="register" class="sign-up-form">
                    <h2 class="title">Register</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" />
                        <div id="username-error" class="error-message"></div>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" />
                        <div id="email-error" class="error-message"></div>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password_register" />
                        <div id="password_register-error" class="error-message"></div>
                    </div>
                    <button id="register-btn" type="submit" class="btn solid">Register</button>
                    <button id="register-load-btn" type="submit" class="btn solid" disabled style="display: none;">
                        Memuat
                        <div class="loader"></div>
                    </button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Baru di sini?</h3>
                    <p>
                        Selamat datang di perpustakaan kami! Jelajahi berbagai koleksi buku menarik dan mulai
                        petualangan membaca Anda.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Register
                    </button>
                </div>
                <img src="../assets/images/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Salah satu dari kami?</h3>
                    <p>
                        Selamat datang kembali! Lanjutkan membaca dan temukan buku-buku baru yang mungkin Anda sukai.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Login
                    </button>
                </div>
                <img src="../assets/images/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
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