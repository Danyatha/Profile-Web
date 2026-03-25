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

                <form action="<?= base_url('admin/experiences/store') ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- ── Company Info ─────────────────────────── -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-building me-2"></i>Informasi Perusahaan
                    </h6>

                    <div class="mb-3">
                        <label for="company_name" class="form-label">
                            Nama Perusahaan <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control <?= $validation->hasError('company_name') ? 'is-invalid' : '' ?>"
                            id="company_name" name="company_name"
                            value="<?= old('company_name') ?>"
                            placeholder="PT. Example Company" required>
                        <?php if ($validation->hasError('company_name')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('company_name') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="company_logo" class="form-label">Logo Perusahaan</label>
                        <input type="file" class="form-control"
                            id="company_logo" name="company_logo"
                            accept="image/*"
                            onchange="previewImg(this, 'logoPreview')">
                        <div class="form-text">Maks 2MB. JPG, PNG, WebP.</div>
                        <div id="logoPreview" class="mt-2"></div>
                    </div>

                    <hr class="my-4">

                    <!-- ── Position Info ────────────────────────── -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-user-tie me-2"></i>Informasi Posisi
                    </h6>

                    <div class="mb-3">
                        <label for="position" class="form-label">
                            Posisi / Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control <?= $validation->hasError('position') ? 'is-invalid' : '' ?>"
                            id="position" name="position"
                            value="<?= old('position') ?>"
                            placeholder="Senior Software Engineer" required>
                        <?php if ($validation->hasError('position')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('position') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">
                                Tanggal Mulai <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                class="form-control <?= $validation->hasError('start_date') ? 'is-invalid' : '' ?>"
                                id="start_date" name="start_date"
                                value="<?= old('start_date') ?>" required>
                            <?php if ($validation->hasError('start_date')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('start_date') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date"
                                class="form-control <?= $validation->hasError('end_date') ? 'is-invalid' : '' ?>"
                                id="end_date" name="end_date"
                                value="<?= old('end_date') ?>">
                            <?php if ($validation->hasError('end_date')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('end_date') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input"
                            id="is_current" name="is_current" value="1"
                            <?= old('is_current') ? 'checked' : '' ?>
                            onchange="toggleEndDate(this)">
                        <label class="form-check-label" for="is_current">
                            Saya masih bekerja di posisi ini
                        </label>
                    </div>

                    <hr class="my-4">

                    <!-- ── Job Details ──────────────────────────── -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-clipboard-list me-2"></i>Detail Pekerjaan
                    </h6>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control" id="description" name="description"
                            rows="3" placeholder="Ringkasan singkat pekerjaan Anda…"><?= old('description') ?></textarea>
                        <div class="form-text">Maks 1000 karakter.</div>
                    </div>

                    <div class="mb-3">
                        <label for="job_description" class="form-label">Deskripsi Pekerjaan Detail</label>
                        <textarea class="form-control" id="job_description" name="job_description"
                            rows="5" placeholder="- Mengembangkan aplikasi web&#10;- Melakukan code review"><?= old('job_description') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="achievements" class="form-label">Pencapaian</label>
                        <textarea class="form-control" id="achievements" name="achievements"
                            rows="4" placeholder="- Meningkatkan performa 50%&#10;- Memimpin proyek senilai $1M"><?= old('achievements') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="skills_used" class="form-label">Keahlian yang Digunakan</label>
                        <input type="text" class="form-control" id="skills_used" name="skills_used"
                            value="<?= old('skills_used') ?>"
                            placeholder="PHP, JavaScript, MySQL, Git">
                        <div class="form-text">Pisahkan dengan koma.</div>
                    </div>

                    <div class="mb-4">
                        <label for="documentation_images" class="form-label">Gambar Dokumentasi</label>
                        <input type="file" class="form-control"
                            id="documentation_images" name="documentation_images[]"
                            accept="image/*" multiple
                            onchange="previewMultiple(this, 'docsPreview')">
                        <div class="form-text">Maks 2MB per file. Bisa pilih beberapa file.</div>
                        <div id="docsPreview" class="row g-2 mt-1"></div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('admin/experiences') ?>" class="btn btn-secondary">Batal</a>
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
    function toggleEndDate(cb) {
        const end = document.getElementById('end_date');
        end.disabled = cb.checked;
        if (cb.checked) end.value = '';
    }

    function previewImg(input, previewId) {
        const el = document.getElementById(previewId);
        el.innerHTML = '';
        if (input.files && input.files[0]) {
            const r = new FileReader();
            r.onload = e => el.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width:180px;">`;
            r.readAsDataURL(input.files[0]);
        }
    }

    function previewMultiple(input, previewId) {
        const el = document.getElementById(previewId);
        el.innerHTML = '';
        Array.from(input.files).forEach(file => {
            const r = new FileReader();
            r.onload = e => {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3';
                col.innerHTML = `<img src="${e.target.result}" class="img-thumbnail w-100" style="height:120px;object-fit:cover;">`;
                el.appendChild(col);
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