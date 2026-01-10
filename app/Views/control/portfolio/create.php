<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header">
                    <h4><?= esc($title) ?></h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/portfolio/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="project_name" class="form-label">Nama Project <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control <?= $validation->hasError('project_name') ? 'is-invalid' : '' ?>"
                                id="project_name"
                                name="project_name"
                                value="<?= old('project_name') ?>"
                                required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('project_name') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control <?= $validation->hasError('description') ? 'is-invalid' : '' ?>"
                                id="description"
                                name="description"
                                rows="5"><?= old('description') ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('description') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="technologies_used" class="form-label">Teknologi yang Digunakan</label>
                            <input type="text"
                                class="form-control <?= $validation->hasError('technologies_used') ? 'is-invalid' : '' ?>"
                                id="technologies_used"
                                name="technologies_used"
                                value="<?= old('technologies_used') ?>"
                                placeholder="Contoh: PHP, CodeIgniter, MySQL, Bootstrap">
                            <div class="invalid-feedback">
                                <?= $validation->getError('technologies_used') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="project_url" class="form-label">URL Project</label>
                            <input type="url"
                                class="form-control <?= $validation->hasError('project_url') ? 'is-invalid' : '' ?>"
                                id="project_url"
                                name="project_url"
                                value="<?= old('project_url') ?>"
                                placeholder="https://example.com">
                            <div class="invalid-feedback">
                                <?= $validation->getError('project_url') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Gambar Project</label>
                            <input type="file"
                                class="form-control <?= $validation->hasError('images') ? 'is-invalid' : '' ?>"
                                id="images"
                                name="images"
                                accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                            <div class="invalid-feedback">
                                <?= $validation->getError('images') ?>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>