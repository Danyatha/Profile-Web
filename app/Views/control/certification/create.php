<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-semibold">
        <i class="bi bi-plus-circle me-2 text-primary"></i><?= $title ?? 'Buat Sertifikasi' ?>
    </h4>
    <a href="<?= base_url('admin/certificates') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div id="form-alert" class="alert alert-danger d-none" role="alert"></div>

        <form id="cert-create-form" novalidate>
            <?= csrf_field() ?>

            <!-- Nama Sertifikasi -->
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">
                    Nama Sertifikasi <span class="text-danger">*</span>
                </label>
                <input type="text" id="name" name="name"
                       class="form-control" maxlength="150"
                       placeholder="Contoh: AWS Certified Solutions Architect" required>
                <div class="invalid-feedback">Nama sertifikasi harus diisi.</div>
            </div>

            <div class="row">
                <!-- Penerbit -->
                <div class="col-md-6 mb-3">
                    <label for="issuer" class="form-label fw-medium">Penerbit</label>
                    <input type="text" id="issuer" name="issuer"
                           class="form-control" maxlength="150"
                           placeholder="Contoh: Amazon Web Services">
                </div>
                <!-- Tahun Terbit -->
                <div class="col-md-6 mb-3">
                    <label for="issue_year" class="form-label fw-medium">Tahun Terbit</label>
                    <input type="number" id="issue_year" name="issue_year"
                           class="form-control" min="1900" max="2100"
                           placeholder="<?= date('Y') ?>">
                    <div class="invalid-feedback">Tahun tidak valid (1900 – 2100).</div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="description" class="form-label fw-medium">Deskripsi</label>
                <textarea id="description" name="description"
                          class="form-control" rows="4"
                          placeholder="Uraian singkat tentang sertifikasi ini…"></textarea>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-4">
                <label class="form-label fw-medium">
                    Gambar Sertifikasi
                    <small class="text-muted fw-normal">(bisa lebih dari satu, maks 2 MB/file)</small>
                </label>

                <div id="drop-zone"
                     class="border border-2 border-dashed rounded p-4 text-center text-muted"
                     style="cursor:pointer;border-style:dashed!important">
                    <i class="bi bi-cloud-arrow-up fs-2 d-block mb-2"></i>
                    <span>Seret & lepas gambar ke sini, atau</span>
                    <label for="images" class="btn btn-outline-primary btn-sm ms-2 mb-0" style="cursor:pointer">
                        Pilih File
                    </label>
                    <input type="file" id="images" name="images[]"
                           class="d-none" multiple accept="image/*">
                </div>

                <div id="image-preview" class="d-flex flex-wrap gap-2 mt-3"></div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4" id="btn-submit">
                    <span class="spinner-border spinner-border-sm d-none me-1" id="btn-spinner"></span>
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="<?= base_url('admin/certificates') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
(function () {
    const dropZone   = document.getElementById('drop-zone');
    const fileInput  = document.getElementById('images');
    const preview    = document.getElementById('image-preview');
    const form       = document.getElementById('cert-create-form');
    const btnSubmit  = document.getElementById('btn-submit');
    const spinner    = document.getElementById('btn-spinner');
    const alertEl    = document.getElementById('form-alert');

    let selectedFiles = []; // DataTransfer polyfill accumulator

    // ── Drag & drop ────────────────────────────────────────────────────────────
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('bg-light'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('bg-light'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('bg-light');
        addFiles(Array.from(e.dataTransfer.files));
    });
    dropZone.addEventListener('click', e => { if (e.target !== fileInput && !e.target.closest('label')) fileInput.click(); });

    // ── File input ─────────────────────────────────────────────────────────────
    fileInput.addEventListener('change', function () {
        addFiles(Array.from(this.files));
        this.value = ''; // reset so same file can be re-added after removal
    });

    function addFiles(files) {
        files.forEach(file => {
            if (! file.type.startsWith('image/')) return;
            if (file.size > 2 * 1024 * 1024) {
                showAlert(`File "${file.name}" melebihi batas 2 MB.`);
                return;
            }
            // Avoid duplicates by name+size
            if (selectedFiles.some(f => f.name === file.name && f.size === file.size)) return;
            selectedFiles.push(file);
        });
        renderPreview();
    }

    function renderPreview() {
        preview.innerHTML = '';
        selectedFiles.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.createElement('div');
                wrap.className = 'position-relative';
                wrap.style.cssText = 'width:80px;height:80px';

                const img = document.createElement('img');
                img.src   = e.target.result;
                img.style.cssText = 'width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6';

                const btn = document.createElement('button');
                btn.type  = 'button';
                btn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 p-0 d-flex align-items-center justify-content-center';
                btn.style.cssText = 'width:20px;height:20px;border-radius:50%;font-size:10px;transform:translate(40%,-40%)';
                btn.innerHTML = '<i class="bi bi-x"></i>';
                btn.addEventListener('click', () => {
                    selectedFiles.splice(idx, 1);
                    renderPreview();
                });

                wrap.appendChild(img);
                wrap.appendChild(btn);
                preview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
    }

    // ── Submit ─────────────────────────────────────────────────────────────────
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (! form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        alertEl.classList.add('d-none');
        btnSubmit.disabled = true;
        spinner.classList.remove('d-none');

        const fd = new FormData(this);
        // Attach accumulated files
        fd.delete('images[]');
        selectedFiles.forEach(f => fd.append('images[]', f));

        fetch('<?= base_url('admin/certificates/store') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            body: fd
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '<?= base_url('admin/certificates') ?>';
            } else {
                showAlert(data.message || JSON.stringify(data.messages || data));
                btnSubmit.disabled = false;
                spinner.classList.add('d-none');
            }
        })
        .catch(() => {
            showAlert('Terjadi kesalahan saat menyimpan data.');
            btnSubmit.disabled = false;
            spinner.classList.add('d-none');
        });
    });

    function showAlert(msg) {
        alertEl.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>' + msg;
        alertEl.classList.remove('d-none');
        alertEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
})();
</script>

<?= $this->endSection() ?>