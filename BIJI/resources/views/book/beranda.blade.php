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
    <link rel="stylesheet" href="../assets/css/user.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <title>BIJI | Beranda</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav-logo"> <img src="../assets/images/icon.png" alt=""> BIJI </a>
            <div class="nav-menu">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{url('/book/beranda')}}" class="nav-link active-link">
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
                        <a href="{{url('/user/profile')}}" class="nav-link">
                            <i class="ri-user-3-line"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nav-actions">
                <i class="ri-search-2-line search-button" id="search-button"></i>
                <i class="ri-logout-box-r-line" id="logoutIcon"></i>
            </div>
        </nav>
    </header>

    <!--==================== SEARCH ====================-->
    <div class="search" id="search-content">
        <form action="{{ route('books.search') }}" method="GET" class="search-form">
            <i class="ri-search-2-line search-icon"></i>
            <input type="search" name="query" id="query" class="search-input" placeholder="Cari Buku" />
            <button type="submit" style="display: none;"></button>
        </form>
        <i class="ri-close-line close-icon" id="search-close"></i>
    </div>

    <!--==================== MAIN ====================-->
    <main class="main">

        <!--==================== NEW BOOKS ====================-->
        <section class="new section" id="new">
            @if(isset($searchQuery) && $searchQuery !== '')
                <h2 class="center-text">Hasil Pencarian untuk: "{{ $searchQuery }}"</h2>
            @endif

            @if($books->isEmpty())
                <p class="center-text">Tidak ada buku yang ditemukan.</p>
            @else
                <div class="new-container container">
                    <div class="new-swiper">
                        <div class="new-book">
                            @foreach($books as $book)
                                <div class="new-card">
                                    <a class="flex" href="{{ route('book.detail', ['book_id' => $book->id]) }}"
                                        book-id="{{ $book->id }}">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="new book" class="new-img">
                                        @endif
                                        <div>
                                            <h2 class="new-title">{{ $book->title }}</h2>
                                            <div class="new-prices">
                                                <span class="new-discount">{{ $book->author }}</span>
                                            </div>
                                            <div class="genres">
                                                <p class="genre-label">{{ $book->genre_1 }}</p>
                                                @if($book->genre_2)
                                                    <p class="genre-label">{{ $book->genre_2 }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <div class="loved">
                                        <button type="button" data-book-id="{{ $book->id }}">
                                            <i class="{{ $book->isFavorite ? 'ri-heart-3-fill' : 'ri-heart-3-line' }}"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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
        function openModal() {
            var chatbot = document.getElementById('chatbot');
            chatbot.classList.remove('hide');
            chatbot.classList.add('show');
        }

        function closeModal() {
            var chatbot = document.getElementById('chatbot');
            chatbot.classList.remove('show');
            chatbot.classList.add('hide');
        }

    </script>

    <script>
        $('#chat-form').on('submit', function (e) {
            e.preventDefault();
            var userMessage = $('#message').val();
            if (userMessage.trim() === '') return;
            $('#chat-body').append(
                `<div class="chat-message chat-user">${userMessage}</div>`
            );
            $('.chat-status').text('Typing...');
            console.log('Sending message:', userMessage);
            $('#send-button').prop('disabled', true);
            $('#message').val('');
            $.ajax({
                url: '/chat',
                type: 'POST',
                data: {
                    message: userMessage,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    setTimeout(function () {
                        $('#chat-body').append(
                            `<div class="chat-message chat-bot">${response.response}</div>`
                        );
                        $('.chat-status').text('Online');
                        $('#send-button').prop('disabled', false);
                    }, 3000);
                    $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
                },
                error: function () {
                    $('#send-button').prop('disabled', false);
                    $('.chat-status').text('Online');
                }
            });
        });
    </script>
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
    <script>
        $(document).ready(function () {
            $('.loved button').on('click', function () {
                let button = $(this);
                let bookId = button.data('book-id');

                $.ajax({
                    url: "{{ route('favorite.toggle') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        book_id: bookId,
                    },
                    success: function (response) {
                        if (response.status === 'added') {
                            button.find('i').removeClass('ri-heart-3-line').addClass('ri-heart-3-fill');
                        } else if (response.status === 'removed') {
                            button.find('i').removeClass('ri-heart-3-fill').addClass('ri-heart-3-line');
                        }
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr);
                    }
                });
            });
        });
    </script>

</body>

</html>