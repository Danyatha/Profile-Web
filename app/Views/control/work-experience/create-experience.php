<?= $this->extend('control/layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><?= esc($title) ?></h2>
                <a href="<?= base_url('admin/experiences') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
            <div class="card shadow">
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/experiences/store') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Company Information -->
                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-building me-2"></i>Informasi Perusahaan
                        </h5>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">
                                Nama Perusahaan <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control <?= $validation->hasError('company_name') ? 'is-invalid' : '' ?>"
                                id="company_name"
                                name="company_name"
                                value="<?= old('company_name') ?>"
                                placeholder="PT. Example Company"
                                required>
                            <?php if ($validation->hasError('company_name')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('company_name') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="company_logo" class="form-label">Logo Perusahaan</label>
                            <input type="file"
                                class="form-control <?= $validation->hasError('company_logo') ? 'is-invalid' : '' ?>"
                                id="company_logo"
                                name="company_logo"
                                accept="image/*"
                                onchange="previewImage(this, 'logoPreview')">
                            <small class="text-muted">Max 2MB, Format: JPG, PNG, GIF</small>
                            <?php if ($validation->hasError('company_logo')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('company_logo') ?></div>
                            <?php endif; ?>
                            <div id="logoPreview" class="mt-2"></div>
                        </div>

                        <hr class="my-4">

                        <!-- Position Information -->
                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-user-tie me-2"></i>Informasi Posisi
                        </h5>

                        <div class="mb-3">
                            <label for="position" class="form-label">
                                Posisi/Jabatan <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control <?= $validation->hasError('position') ? 'is-invalid' : '' ?>"
                                id="position"
                                name="position"
                                value="<?= old('position') ?>"
                                placeholder="Senior Software Engineer"
                                required>
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
                                    id="start_date"
                                    name="start_date"
                                    value="<?= old('start_date') ?>"
                                    required>
                                <?php if ($validation->hasError('start_date')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('start_date') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Tanggal Selesai</label>
                                <input type="date"
                                    class="form-control <?= $validation->hasError('end_date') ? 'is-invalid' : '' ?>"
                                    id="end_date"
                                    name="end_date"
                                    value="<?= old('end_date') ?>"
                                    disabled>
                                <?php if ($validation->hasError('end_date')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('end_date') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox"
                                class="form-check-input"
                                id="is_current"
                                name="is_current"
                                value="1"
                                <?= old('is_current') ? 'checked' : '' ?>
                                onchange="toggleEndDate(this)">
                            <label class="form-check-label" for="is_current">
                                Saya masih bekerja di posisi ini
                            </label>
                        </div>

                        <hr class="my-4">

                        <!-- Job Details -->
                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-clipboard-list me-2"></i>Detail Pekerjaan
                        </h5>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Singkat</label>
                            <textarea class="form-control <?= $validation->hasError('description') ? 'is-invalid' : '' ?>"
                                id="description"
                                name="description"
                                rows="3"
                                placeholder="Ringkasan singkat tentang pekerjaan Anda..."><?= old('description') ?></textarea>
                            <small class="text-muted">Max 1000 karakter</small>
                            <?php if ($validation->hasError('description')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('description') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="job_description" class="form-label">Deskripsi Pekerjaan Detail</label>
                            <textarea class="form-control <?= $validation->hasError('job_description') ? 'is-invalid' : '' ?>"
                                id="job_description"
                                name="job_description"
                                rows="5"
                                placeholder="- Mengembangkan aplikasi web&#10;- Melakukan code review&#10;- Berkolaborasi dengan tim"><?= old('job_description') ?></textarea>
                            <?php if ($validation->hasError('job_description')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('job_description') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="achievements" class="form-label">Pencapaian</label>
                            <textarea class="form-control <?= $validation->hasError('achievements') ? 'is-invalid' : '' ?>"
                                id="achievements"
                                name="achievements"
                                rows="4"
                                placeholder="- Meningkatkan performa aplikasi 50%&#10;- Memimpin proyek sukses senilai $1M"><?= old('achievements') ?></textarea>
                            <?php if ($validation->hasError('achievements')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('achievements') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="skills_used" class="form-label">Keahlian yang Digunakan</label>
                            <input type="text"
                                class="form-control"
                                id="skills_used"
                                name="skills_used"
                                value="<?= old('skills_used') ?>"
                                placeholder="PHP, JavaScript, MySQL, Git">
                            <small class="text-muted">Pisahkan dengan koma (,)</small>
                        </div>

                        <div class="mb-3">
                            <label for="documentation_images" class="form-label">Gambar Dokumentasi</label>
                            <input type="file"
                                class="form-control <?= $validation->hasError('documentation_images.*') ? 'is-invalid' : '' ?>"
                                id="documentation_images"
                                name="documentation_images[]"
                                accept="image/*"
                                multiple
                                onchange="previewMultipleImages(this, 'imagesPreview')">
                            <small class="text-muted">Max 2MB per file, Format: JPG, PNG, GIF. Bisa upload multiple files.</small>
                            <?php if ($validation->hasError('documentation_images.*')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('documentation_images.*') ?></div>
                            <?php endif; ?>
                            <div id="imagesPreview" class="row mt-2"></div>
                        </div>

                        <hr class="my-4">

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/experiences') ?>" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle end date field
    function toggleEndDate(checkbox) {
        const endDateInput = document.getElementById('end_date');
        if (checkbox.checked) {
            endDateInput.disabled = true;
            endDateInput.value = '';
            endDateInput.removeAttribute('required');
        } else {
            endDateInput.disabled = false;
            endDateInput.setAttribute('required', 'required');
        }
    }

    // Preview single image
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                <img src="${e.target.result}" 
                     class="img-thumbnail" 
                     style="max-width: 200px; max-height: 200px;">
            `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Preview multiple images
    function previewMultipleImages(input, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 col-sm-4 col-6 mb-2';
                    col.innerHTML = `
                    <img src="${e.target.result}" 
                         class="img-thumbnail" 
                         style="width: 100%; height: 150px; object-fit: cover;">
                `;
                    preview.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const isCurrentCheckbox = document.getElementById('is_current');
        if (isCurrentCheckbox.checked) {
            toggleEndDate(isCurrentCheckbox);
        }
    });
</script>

<?= $this->endSection() ?>