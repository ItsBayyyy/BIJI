<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="../assets/images/icon.png" type="image/x-icon" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" />

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../assets/css/user.min.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
        <title>BIJI | Profile</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav-logo"> <img src="../assets/images/icon.png" alt=""> BIJI </a>
            <div class="nav-menu">
            <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{url('/book/beranda')}}" class="nav-link">
                            <i class="ri-home-4-line"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/book/favorite')}}" class="nav-link">
                            <i class="ri-heart-3-line"></i>
                            <span>Favorit</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/user/profile')}}" class="nav-link active-link">
                            <i class="ri-user-3-line"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nav-actions">
                <i class="ri-logout-box-r-line" id="logoutIcon"></i>
            </div>
        </nav>
    </header>

    <!--==================== SEARCH ====================-->
    <div class="search" id="search-content">
        <form action="" class="search-form">
            <i class="ri-search-2-line search-icon"></i>
            <input type="search" name="" id="" class="search-input" placeholder="Cari Buku" />
        </form>
        <i class="ri-close-line close-icon" id="search-close"></i>
    </div>

    <!--==================== MAIN ====================-->
    <main class="main">
        <section class="profile section">
            <h2 class="section-title">Profil</h2>
            <div class="profile-container container grid">
                <a href="{{url('/user/username')}}" class="profile-list">
                    <span class="icon-profile">
                        <i class="ri-user-settings-line"></i>
                    </span>
                    <h3>Ubah Profil</h3>
                </a>
                <!-- <a href="{{url('/user/username')}}" class="profile-list">
                    <span class="icon-profile">
                        <i class="ri-lock-2-line"></i>
                    </span>
                    <h3>Ubah Password</h3>
                </a> -->
                <a href="{{url('/user/email')}}" class="profile-list">
                    <span class="icon-profile">
                        <i class="ri-mail-settings-line"></i>
                    </span>
                    <h3>Ubah Email</h3>
                </a>
                <a href="{{url('/user/riwayat')}}" class="profile-list">
                    <span class="icon-profile">
                        <i class="ri-history-line"></i>
                    </span>
                    <h3>Riwayat Peminjaman</h3>
                </a>
                <a href="{{url('/chat')}}" class="profile-list">
            <span class="icon-profile">
              <i class="ri-customer-service-2-line"></i>
            </span>
            <h3>Customer Service</h3>
          </a>
            </div>
        </section> 
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer-container container grid">
            <div>
                <a href="#" class="footer-logo"> <img src="../assets/images/icon.png" alt=""> BIJI </a>
                <p class="footer-description">
                    Temukan dan jelajahi yang terbaik <br />
Buku dari semua Anda <br />
penulis favorit.
                </p>
            </div>
            <div class="footer-data grid">
                <div>
                    <h3 class="footer-title">Lainnya</h3>
                    <ul class="footer-links">
                        <li>
                            <a href="#" class="footer-link">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">FAQs</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">Kebijakan Privasi</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">Ketentuan Layanan</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Perusahaan</h3>
                    <ul class="footer-links">
                        <li>
                            <a href="#" class="footer-link">Blogs</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">Komunitas</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">Tim Kami</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">Pusat Bantuan</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Kontak</h3>
                    <ul class="footer-links">
                        <li>
                            <address class="footer-info">
                                SMK TI, <br />
                                Bali, Indonesia
                            </address>
                            <address class="footer-info">
                                biji@email.com <br />
                                0987-654-321
                            </address>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Sosial Media</h3>
                    <a href="#" target="_blank" class="footer-social-link">
                        <i class="ri-facebook-circle-line"></i>
                    </a>
                    <a href="#" target="_blank" class="footer-social-link">
                        <i class="ri-instagram-line"></i>
                    </a>
                    <a href="#" target="_blank" class="footer-social-link">
                        <i class="ri-twitter-x-line"></i>
                    </a>
                    <a href="#" target="_blank" class="footer-social-link">
                        <i class="ri-tiktok-line"></i>
                    </a>
                </div>
            </div>
        </div>
        <span class="footer-copy"> &copy; All rights reserved by BIJI </span>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-s-line"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="../assets/js/scrollreveal.min.js"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="../assets/js/swiper-bundle.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="../assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#logoutIcon').on('click', function () {
                $.ajax({
                    url: '/logout',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        window.location.href = '/login';
                    },
                    error: function (xhr, status, error) {
                        console.error('Logout failed:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>