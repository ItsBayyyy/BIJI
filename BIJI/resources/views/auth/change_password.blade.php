<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIJI | Daftar</title>
    <link rel="shortcut icon" href="../assets/images/icon.png" type="image/x-icon" />

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
                        <h2 class="form-title">Ganti sandi</h2>
                        <form id="reset-password" class="register-form">
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="password" />
                            </div>
                            <div class="form-group form-button">
                                <button type="submit" name="signup" id="reset-btn" class="form-submit">Ganti</button>
                                <button id="reset-load-btn" type="submit" class="form-submit" disabled
                                    style="display: none;">
                                    Memuat
                                    <div class="loader"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../assets/images/register.svg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#reset-password').on('submit', function (e) {
                e.preventDefault()
                $('#reset-btn').prop('disabled', true);
                $('#reset-btn').hide();
                $('#reset-load-btn').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('reset.password', ['token' => $token])}}',
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
                            $('#reset-btn').prop('disabled', false);
                            $('#reset-btn').show();
                            $('#reset-load-btn').hide();
                        } else {
                            setTimeout(function () {
                                window.location.href = data.redirect_url;
                            }, 1000);
                        }
                    },
                    complete: function () {
                        $('#reset-load-btn').hide();
                        $('#reset-btn').show();
                    }
                });
            });
        });
    </script>
</body>

</html>