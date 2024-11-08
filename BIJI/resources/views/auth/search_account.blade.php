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
                <form id="search-account" class="sign-in-form">
                    <h2 class="title">Search Account</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username or Email" name="email" />
                        <div id="email-error" class="error-message"></div>
                    </div>
                    <button id="change-btn" type="submit" class="btn solid">Search</button>
                    <button id="change-load-btn" type="submit" class="btn solid" disabled style="display: none;">
                        Memuat
                        <div class="loader"></div>
                    </button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <img src="../assets/images/search.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
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