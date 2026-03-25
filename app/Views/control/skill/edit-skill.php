<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <a href="<?= base_url('admin/skills') ?>" class="btn btn-secondary btn-sm">
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

                <!-- Fixed: was 'skill/update/...' → 'admin/skills/update/...' -->
                <form action="<?= base_url('admin/skills/update/' . $skill['id']) ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="skill_name" class="form-label">Nama Skill <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control <?= isset($validation) && $validation->hasError('skill_name') ? 'is-invalid' : '' ?>"
                            id="skill_name" name="skill_name"
                            value="<?= old('skill_name', $skill['skill_name']) ?>" required>
                        <?php if (isset($validation) && $validation->hasError('skill_name')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('skill_name') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control <?= isset($validation) && $validation->hasError('category') ? 'is-invalid' : '' ?>"
                            id="category" name="category"
                            value="<?= old('category', $skill['category']) ?>" required>
                        <?php if (isset($validation) && $validation->hasError('category')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('category') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control"
                            id="description" name="description"
                            rows="3"><?= old('description', $skill['description']) ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image_path" class="form-label">Ganti Gambar / Icon</label>
                        <?php if (!empty($skill['image_path'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/skills/' . esc($skill['image_path'])) ?>"
                                    alt="Icon saat ini"
                                    class="img-thumbnail" style="max-width:120px;" id="currentImg">
                                <div class="form-text">Icon saat ini. Upload baru untuk mengganti.</div>
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="image_path" name="image_path"
                            accept="image/*" onchange="previewImg(this)">
                        <div id="preview" class="mt-2"></div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('admin/skills') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Update
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
        const current = document.getElementById('currentImg');
        preview.innerHTML = '';
        if (current) current.style.opacity = '.4';
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width:150px;">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>