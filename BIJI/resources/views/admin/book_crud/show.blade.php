<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <!-- Link untuk Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Judul Halaman -->
        <h2 class="text-center mb-4">Detail Buku</h2>

        <div class="row">
            <!-- Gambar Sampul Buku -->
            <div class="col-md-4 text-center">
                <img id="cover_image" src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image"
                    class="img-fluid" style="max-width: 200px; max-height: 300px;">
            </div>

            <!-- Informasi Buku -->
            <div class="col-md-8">
                <div class="mb-3">
                    <strong>Judul:</strong>
                    <p id="title">{{$book->title}}</p>
                </div>

                <div class="mb-3">
                    <strong>Pengarang:</strong>
                    <p id="author">{{$book->author}}</p>
                </div>

                <div class="mb-3">
                    <strong>Sinopsis:</strong>
                    <p id="synopsis">{!!$book->synopsis!!}</p>
                </div>

                <div class="mb-3">
                    <strong>Genre 1:</strong>
                    <p id="genre_1">{{$book->genre_1}}</p>
                </div>

                <div class="mb-3">
                    <strong>Genre 2:</strong>
                    @if($book->genre_2)
                        <p id="genre_2">{{$book->genre_2}}</p>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Jumlah Tersedia:</strong>
                    <p id="available_copies">{{$book->available_copies}}</p>
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-4">
                    <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link untuk Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>

</html>