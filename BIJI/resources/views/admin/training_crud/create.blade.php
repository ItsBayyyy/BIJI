<!-- Modal for Adding Book -->
<div
    class="modal fade"
    id="addDataModal"
    tabindex="-1"
    aria-labelledby="addBookModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">
                    Tambah Data Baru
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
                        <label for="question" class="form-label">Pertanyaan</label>
                        <input
                            type="text"
                            class="form-control"
                            id="question"
                            name="question"
                            required
                        />
                    </div>

                    <!-- Author Field -->
                    <div class="mb-3">
                        <label for="answer" class="form-label">Jawaban</label>
                        <input
                            type="text"
                            class="form-control"
                            id="answer"
                            name="answer"
                            required
                        />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">
                        Tambah Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

</script>