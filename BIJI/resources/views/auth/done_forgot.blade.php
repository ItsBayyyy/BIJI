<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIJI | Aktivasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <link
      rel="shortcut icon"
      href="../assets/images/icon.png"
      type="image/x-icon"
    />
    <style>
        .auth-page-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .auth-page-content .card {
            border: none;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        .text-primary {
            color: #0ab39c !important;
        }
    </style>
</head>

<body>

    <div class="auth-page-wrapper">

        <!-- Auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-8">
                        <div class="card mt-4">

                            <div class="card-body p-4 text-center">
                                <div class="mt-2">
                                    <h2 class="text-dark">Ganti Kata Sandi</h2>
                                    <lord-icon src="https://cdn.lordicon.com/kvuyljqb.json" trigger="loop"
                                        colors="primary:#e6b872,secondary:#e6b872" class="avatar-xl my-3"
                                        style="width: 150px; height: 150px"></lord-icon>
                                        <p class="text-muted">Kata sandi Anda telah diperbarui. Silakan klik tombol di bawah untuk masuk dengan kata sandi baru Anda.</p>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Silahkan login kembali? <a href="/login" class="fw-semibold  text-decoration-none"
                                    style="color: #e6b872;">Login</a></p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End container -->
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        setTimeout(function() {
            window.location.href = "/login";
        }, 2000); 
    </script>
</body>

</html>