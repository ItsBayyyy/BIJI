<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/images/icon.png" type="image/x-icon" />

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" />

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{url('assets/css/user.css')}}" />
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <title>BIJI | Detail Buku</title>
</head>

<body>

    <div class="go-back container">
        <a href="{{url('/book/beranda')}}">
            <i class="ri-arrow-left-line"></i>
            Kembali ke beranda
        </a>
    </div>

    <!--==================== MAIN ====================-->
    <main class="main">
        <section class="section">
            <h2 class="section-title">Detail Buku</h2>
            <div class="new-container container">
                <div class="detail-book">
                    <article class="card-detail">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="new book"
                                class="new-img detail-img" />
                        @endif
                        <div>
                            <h2 class="new-title title-detail">{{ $book->title }}</h2>
                            <div class="new-prices">
                                <span class="new-discount">{{ $book->author }}</span>
                            </div>
                            <p>{!! $book->synopsis !!}</p>
                            <div class="genres">
                                <p class="genre-label">{{ $book->genre_1 }}</p>
                                @if($book->genre_2)
                                    <p class="genre-label">{{ $book->genre_2 }}</p>
                                @endif
                            </div>
                            <div class="btn">
                                <a href="#" class="button" id="pinjamBukuBtn">Pinjam Buku</a>
                            </div>  
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!--==================== NEW BOOKS ====================-->
        <section class="new section" id="new">
            <h2 class="section-title">Buku Lainnya</h2>
            <div class="new-container container">
                <div class="new-swiper">
                    <div class="new-book" id="books-list">
                        @foreach ($otherBooks as $other)
                            <div class="new-card">
                                <a class="flex" href="{{ route('book.detail', ['book_id' => $other->id]) }}"
                                    book-id="{{ $book->id }}">
                                    @if($other->cover_image)
                                        <img src="{{ asset('storage/' . $other->cover_image) }}" alt="new book" class="new-img">
                                    @endif
                                    <div>
                                        <h2 class="new-title">{{ $other->title }}</h2>
                                        <div class="new-prices">
                                            <span class="new-discount">{{ $other->author }}</span>
                                        </div>
                                        <div class="genres">
                                            <p class="genre-label">{{ $other->genre_1 }}</p>
                                            @if($other->genre_2)
                                                <p class="genre-label">{{ $other->genre_2 }}</p>
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
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer-container container grid">
            <div>
                <a href="#" class="footer-logo">
                    <i class="ri-book-3-line"></i> BIJI
                </a>
                <p class="footer-description">
                    Find and explore the best <br />
                    Books from all your <br />
                    favorite writers.
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
    <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const pinjamBukuBtn = document.getElementById('pinjamBukuBtn');

    pinjamBukuBtn.addEventListener('click', function(e) {
        e.preventDefault(); 

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Apakah Anda ingin meminjam buku ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, pinjam!',
            cancelButtonText: 'Tidak, batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Sukses!',
                    'Anda telah berhasil melakukan permintaan untuk meminjam buku.',
                    'success'
                );
            }
        });
    });
</script>

</body>

</html>