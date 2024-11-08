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
                <form id="reset-password" class="sign-in-form">
                    <h2 class="title">Reset Password</h2>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" />
                        <div id="password-error" class="error-message"></div>
                    </div>
                    <button id="reset-btn" type="submit" class="btn solid">Reset</button>
                    <button id="reset-load-btn" type="submit" class="btn solid" disabled style="display: none;">
                        Memuat
                        <div class="loader"></div>
                    </button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <img src="../assets/images/forgot.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
    <script src="https://www.recaptcha.net/recaptcha/api.js"></script>
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