<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<?php
// Deteksi mode: edit atau create
$isEdit  = isset($journal);
$action  = $isEdit
    ? base_url('admin/journals/update/' . $journal['id'])
    : base_url('admin/journals/store');
?>

<!-- Header -->
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="<?= base_url('admin/journals') ?>" class="btn btn-sm btn-outline-secondary">← Kembali</a>
    <h2 class="fw-bold mb-0" style="color:var(--navy-blue);">
        <?= $isEdit ? 'Edit Journal' : 'Tambah Journal' ?>
    </h2>
</div>

<!-- Validation Errors -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Form -->
<form action="<?= $action ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-4">

        <!-- Kolom Kiri: Konten -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm p-4">

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                    <input type="text"
                        id="title"
                        name="title"
                        class="form-control <?= (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '' ?>"
                        value="<?= old('title', $journal['title'] ?? '') ?>"
                        placeholder="Judul jurnal..."
                        required>
                    <?php if (isset($validation) && $validation->hasError('title')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('title') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label fw-semibold">Kategori</label>
                    <div class="input-group">
                        <input type="text"
                            id="category"
                            name="category"
                            class="form-control"
                            value="<?= old('category', $journal['category'] ?? '') ?>"
                            placeholder="Ketik atau pilih kategori..."
                            list="category-list">
                        <datalist id="category-list">
                            <?php foreach ($categories as $cat): ?>
                                <?php if (!empty($cat['category'])): ?>
                                    <option value="<?= esc($cat['category']) ?>">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="form-text">Kosongkan jika tidak perlu kategori.</div>
                </div>

                <!-- Content -->
                <div class="mb-1">
                    <label for="content" class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                    <textarea id="content"
                        name="content"
                        class="form-control <?= (isset($validation) && $validation->hasError('content')) ? 'is-invalid' : '' ?>"
                        rows="16"
                        placeholder="Tulis jurnal kamu di sini..."
                        required><?= old('content', $journal['content'] ?? '') ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('content')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('content') ?></div>
                    <?php endif; ?>
                    <div class="form-text">Kamu bisa menggunakan HTML biasa. Atau integrasikan TinyMCE/CKEditor jika perlu rich text editor.</div>
                </div>

            </div>
        </div>

        <!-- Kolom Kanan: Sidebar -->
        <div class="col-12 col-lg-4">

            <!-- Publish Settings -->
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h6 class="fw-bold mb-3">Pengaturan Publish</h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_published"
                                id="status_published" value="1"
                                <?= (old('is_published', $journal['is_published'] ?? 1) == 1) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_published">Published</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_published"
                                id="status_draft" value="0"
                                <?= (old('is_published', $journal['is_published'] ?? 1) == 0) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_draft">Draft</label>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary w-100">
                    <?= $isEdit ? '💾 Simpan Perubahan' : '🚀 Publikasikan' ?>
                </button>
            </div>

            <!-- Cover Image -->
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Cover Image</h6>

                <!-- Preview gambar lama -->
                <?php if ($isEdit && !empty($journal['cover_image'])): ?>
                    <div class="mb-3" id="current-cover-wrapper">
                        <p class="text-muted small mb-1">Cover saat ini:</p>
                        <img src="<?= base_url($journal['cover_image']) ?>"
                            id="cover-preview"
                            alt="Cover"
                            class="img-fluid rounded mb-2"
                            style="max-height:180px; width:100%; object-fit:cover;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_cover"
                                id="remove_cover" value="1">
                            <label class="form-check-label text-danger small" for="remove_cover">
                                Hapus cover ini
                            </label>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Preview untuk upload baru -->
                    <img id="cover-preview"
                        src=""
                        alt=""
                        class="img-fluid rounded mb-2 d-none"
                        style="max-height:180px; width:100%; object-fit:cover;">
                <?php endif; ?>

                <label for="cover_image" class="form-label fw-semibold small">
                    <?= ($isEdit && !empty($journal['cover_image'])) ? 'Ganti Cover' : 'Upload Cover' ?>
                </label>
                <input type="file"
                    id="cover_image"
                    name="cover_image"
                    class="form-control form-control-sm"
                    accept="image/jpeg,image/png,image/webp"
                    onchange="previewCover(this)">
                <div class="form-text">JPG / PNG / WEBP, maks. 2MB.</div>
            </div>

        </div>
    </div>

</form>

<script>
    function previewCover(input) {
        const preview = document.getElementById('cover-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>