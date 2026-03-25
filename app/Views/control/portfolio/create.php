<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body">

                <?php if (!empty(session()->getFlashdata('errors'))): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                                <li><?= esc($e) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/portfolio/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="project_name" class="form-label">Nama Project <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control <?= isset($validation) && $validation->hasError('project_name') ? 'is-invalid' : '' ?>"
                            id="project_name" name="project_name"
                            value="<?= old('project_name') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('project_name')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('project_name') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control <?= isset($validation) && $validation->hasError('description') ? 'is-invalid' : '' ?>"
                            id="description" name="description" rows="5"><?= old('description') ?></textarea>
                        <?php if (isset($validation) && $validation->hasError('description')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('description') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="technologies_used" class="form-label">Teknologi yang Digunakan</label>
                        <input type="text"
                            class="form-control"
                            id="technologies_used" name="technologies_used"
                            value="<?= old('technologies_used') ?>"
                            placeholder="PHP, CodeIgniter, MySQL, Bootstrap">
                    </div>

                    <div class="mb-3">
                        <label for="project_url" class="form-label">URL Project</label>
                        <input type="url"
                            class="form-control <?= isset($validation) && $validation->hasError('project_url') ? 'is-invalid' : '' ?>"
                            id="project_url" name="project_url"
                            value="<?= old('project_url') ?>"
                            placeholder="https://example.com">
                        <?php if (isset($validation) && $validation->hasError('project_url')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('project_url') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="images" class="form-label">Gambar Project</label>
                        <input type="file" class="form-control" id="images" name="images" accept="image/*"
                            onchange="previewImg(this)">
                        <div class="form-text">JPG, PNG, WebP. Maks 2MB.</div>
                        <div id="preview" class="mt-2"></div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    function previewImg(input) {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width:200px;">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>