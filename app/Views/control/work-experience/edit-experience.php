<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <a href="<?= base_url('admin/experiences') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card-body p-4">

                <?php if (!empty(session()->getFlashdata('errors'))): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                                <li><?= esc($e) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/experiences/update/' . $experience['id']) ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- COMPANY -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-building me-2"></i>Informasi Perusahaan
                    </h6>

                    <div class="mb-3">
                        <label class="form-label">Nama Perusahaan</label>
                        <input type="text" name="company_name" class="form-control"
                            value="<?= old('company_name', $experience['company_name'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo Perusahaan</label>

                        <?php if (!empty($experience['company_logo'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/experiences/' . $experience['company_logo']) ?>"
                                    class="img-thumbnail" style="max-width:120px;">
                            </div>
                        <?php endif; ?>

                        <input type="file" name="company_logo" class="form-control"
                            accept="image/*" onchange="previewImg(this, 'logoPreview')">

                        <div id="logoPreview" class="mt-2"></div>
                    </div>

                    <hr class="my-4">

                    <!-- POSITION -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-user-tie me-2"></i>Informasi Posisi
                    </h6>

                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <input type="text" name="position" class="form-control"
                            value="<?= old('position', $experience['position'] ?? '') ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control"
                                value="<?= old('start_date', $experience['start_date'] ?? '') ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="<?= old('end_date', $experience['end_date'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_current" value="1"
                            class="form-check-input"
                            id="is_current"
                            <?= old('is_current', $experience['is_current'] ?? false) ? 'checked' : '' ?>
                            onchange="toggleEndDate(this)">
                        <label class="form-check-label">Masih bekerja di sini</label>
                    </div>

                    <hr class="my-4">

                    <!-- DETAILS -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-clipboard-list me-2"></i>Detail Pekerjaan
                    </h6>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control" rows="3"><?= old('description', $experience['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Detail</label>
                        <textarea name="job_description" class="form-control" rows="5"><?= old('job_description', $experience['job_description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pencapaian</label>
                        <textarea name="achievements" class="form-control" rows="4"><?= old('achievements', $experience['achievements'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Skills</label>
                        <input type="text" name="skills_used" class="form-control"
                            value="<?= old('skills_used', is_array($experience['skills_used'] ?? null) ? implode(',', $experience['skills_used']) : ($experience['skills_used'] ?? '')) ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Dokumentasi</label>

                        <input type="file" name="documentation_images[]" multiple
                            class="form-control"
                            accept="image/*"
                            onchange="previewMultiple(this, 'docsPreview')">

                        <div id="docsPreview" class="row mt-2"></div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('admin/experiences') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    function toggleEndDate(cb) {
        const end = document.getElementById('end_date');
        end.disabled = cb.checked;
        if (cb.checked) end.value = '';
    }

    function previewImg(input, id) {
        const el = document.getElementById(id);
        el.innerHTML = '';
        if (input.files && input.files[0]) {
            const r = new FileReader();
            r.onload = e => el.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width:150px;">`;
            r.readAsDataURL(input.files[0]);
        }
    }

    function previewMultiple(input, id) {
        const el = document.getElementById(id);
        el.innerHTML = '';
        Array.from(input.files).forEach(file => {
            const r = new FileReader();
            r.onload = e => {
                const div = document.createElement('div');
                div.className = 'col-4';
                div.innerHTML = `<img src="${e.target.result}" class="img-thumbnail w-100">`;
                el.appendChild(div);
            };
            r.readAsDataURL(file);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        toggleEndDate(document.getElementById('is_current'));
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>