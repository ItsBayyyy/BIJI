<!-- Modal for Adding Book -->
<div
    class="modal fade"
    id="addBookModal"
    tabindex="-1"
    aria-labelledby="addBookModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">
                    Tambah Buku Baru
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="addBookForm">
                    <!-- Title Field -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            required
                        />
                    </div>

                    <!-- Author Field -->
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input
                            type="text"
                            class="form-control"
                            id="author"
                            name="author"
                            required
                        />
                    </div>

                    <!-- Synopsis Field -->
                    <div class="mb-3">
                        <label for="synopsis" class="form-label"
                            >Synopsis</label
                        >
                        <textarea
                            class="form-control"
                            id="synopsis"
                            name="synopsis"
                        ></textarea>
                    </div>

                    <!-- Genre 1 Field -->
                    <div class="mb-3">
                        <label for="genre_1" class="form-label">Genre 1</label>
                        <input
                            type="text"
                            class="form-control"
                            id="genre_1"
                            name="genre_1"
                            required
                        />
                    </div>

                    <!-- Genre 2 Field (Optional) -->
                    <div class="mb-3">
                        <label for="genre_2" class="form-label"
                            >Genre 2 (Optional)</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="genre_2"
                            name="genre_2"
                        />
                    </div>

                    <!-- Cover Image Field -->
                    <div class="mb-3">
                        <label for="cover_image" class="form-label"
                            >Cover Image</label
                        >
                        <input
                            type="file"
                            class="form-control"
                            id="cover_image"
                            name="cover_image"
                            accept="image/*"
                        />
                    </div>

                    <!-- Available Copies Field -->
                    <div class="mb-3">
                        <label for="available_copies" class="form-label"
                            >Available Copies</label
                        >
                        <input
                            type="number"
                            class="form-control"
                            id="available_copies"
                            name="available_copies"
                            min="0"
                            required
                        />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">
                        Tambah Buku
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("synopsis", {
        allowedContent: true,
    });
</script>
<script>

</script>