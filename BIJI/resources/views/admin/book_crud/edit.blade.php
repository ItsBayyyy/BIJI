<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/icon.png" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIJI | Edit</title>
    <!-- Link untuk Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body></body>
<div class="container">
    <h2>Edit Buku</h2>
    <form id="editBookForm" enctype="multipart/form-data">
        <!-- Hidden Book ID -->
        <input type="hidden" id="bookId" name="bookId" value="{{$book->id}}" />


        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ $book->title }}" />
        </div>

        <!-- Author Field -->
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required value="{{ $book->author }}" />
        </div>

        <!-- Synopsis Field -->
        <div class="mb-3">
            <label for="synopsis" class="form-label">Synopsis</label>
            <textarea class="form-control" id="synopsis" name="synopsis">{{ $book->synopsis }}</textarea>
        </div>

        <!-- Genre 1 Field -->
        <div class="mb-3">
            <label for="genre_1" class="form-label">Genre 1</label>
            <input type="text" class="form-control" id="genre_1" name="genre_1" required value="{{ $book->genre_1 }}" />
        </div>

        <!-- Genre 2 Field -->
        <div class="mb-3">
            <label for="genre_2" class="form-label">Genre 2</label>
            @if ($book->genre_2)
                <input type="text" class="form-control" id="genre_2" name="genre_2" value="{{ $book->genre_2 }}" />
            @else
                <input type="text" class="form-control" id="genre_2" name="genre_2" />
            @endif
        </div>

        <!-- Cover Image Field -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" />
        </div>

        <!-- Available Copies Field -->
        <div class="mb-3">
            <label for="available_copies" class="form-label">Available Copies</label>
            <input type="number" class="form-control" id="available_copies" name="available_copies" min="0" required
                value="{{ $book->available_copies }}" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">
            Update Buku
        </button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("synopsis", {
        allowedContent: true,
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#editBookForm').on('submit', function (e) {
            e.preventDefault();

            var bookId = $('#bookId').val();
            var formData = new FormData(this);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'POST');
            $.ajax({
                url: '/book/edit/' + bookId,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.success || 'Book updated successfully!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/admin/book';
                    });
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error updating book. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>


</body>

</html>