<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-semibold">
        <i class="bi bi-award me-2 text-info"></i><?= esc($title) ?>
    </h4>
    <div class="d-flex gap-2">
        <a href="<?= base_url('admin/certificates/edit/' . $certification['id']) ?>"
           class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="<?= base_url('admin/certificates') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Info Card -->
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3">
                    <i class="bi bi-info-circle me-2"></i>Informasi Sertifikasi
                </h5>

                <dl class="row mb-0" style="row-gap:.75rem">
                    <dt class="col-5 text-muted fw-normal">Nama</dt>
                    <dd class="col-7 fw-medium mb-0"><?= esc($certification['name']) ?></dd>

                    <dt class="col-5 text-muted fw-normal">Penerbit</dt>
                    <dd class="col-7 mb-0"><?= esc($certification['issuer'] ?? '-') ?></dd>

                    <dt class="col-5 text-muted fw-normal">Tahun Terbit</dt>
                    <dd class="col-7 mb-0">
                        <?php if ($certification['issue_year']): ?>
                            <span class="badge bg-primary"><?= esc($certification['issue_year']) ?></span>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </dd>

                    <dt class="col-5 text-muted fw-normal">Jumlah Gambar</dt>
                    <dd class="col-7 mb-0">
                        <span class="badge bg-secondary">
                            <?= count($certification['images_path'] ?? []) ?> file
                        </span>
                    </dd>

                    <dt class="col-5 text-muted fw-normal">Dibuat</dt>
                    <dd class="col-7 mb-0 small text-muted">
                        <?= date('d M Y, H:i', strtotime($certification['created_at'])) ?>
                    </dd>

                    <dt class="col-5 text-muted fw-normal">Diperbarui</dt>
                    <dd class="col-7 mb-0 small text-muted">
                        <?= date('d M Y, H:i', strtotime($certification['updated_at'])) ?>
                    </dd>
                </dl>
            </div>

            <!-- Danger zone -->
            <div class="card-footer bg-transparent border-top pt-3">
                <button type="button" class="btn btn-outline-danger btn-sm w-100" id="btn-delete">
                    <i class="bi bi-trash me-1"></i> Hapus Sertifikasi Ini
                </button>
            </div>
        </div>
    </div>

    <!-- Right column -->
    <div class="col-md-7 col-lg-8 d-flex flex-column gap-4">

        <!-- Deskripsi -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2"><i class="bi bi-text-paragraph me-2"></i>Deskripsi</h6>
                <?php if (! empty($certification['description'])): ?>
                    <p class="mb-0"><?= nl2br(esc($certification['description'])) ?></p>
                <?php else: ?>
                    <p class="text-muted fst-italic mb-0">Tidak ada deskripsi.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Galeri Gambar -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-3">
                    <i class="bi bi-images me-2"></i>Galeri Gambar
                </h6>

                <?php if (! empty($certification['images_path'])): ?>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach ($certification['images_path'] as $idx => $imgPath): ?>
                            <div class="position-relative" style="width:110px">
                                <a href="<?= base_url($imgPath) ?>"
                                   target="_blank"
                                   title="Buka di tab baru">
                                    <img src="<?= base_url($imgPath) ?>"
                                         alt="Certificate image <?= $idx + 1 ?>"
                                         class="rounded border shadow-sm"
                                         style="width:110px;height:110px;object-fit:cover">
                                </a>
                                <span class="badge bg-dark position-absolute bottom-0 start-50 translate-middle-x mb-1 opacity-75">
                                    <?= $idx + 1 ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <small class="text-muted mt-3 d-block">
                        <i class="bi bi-hand-index me-1"></i>Klik gambar untuk membuka ukuran penuh di tab baru.
                    </small>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-image display-6 d-block mb-2 opacity-40"></i>
                        Belum ada gambar.
                        <a href="<?= base_url('admin/certificates/edit/' . $certification['id']) ?>"
                           class="d-block mt-2">Tambah gambar →</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div><!-- /col -->
</div><!-- /row -->

<!-- Delete Confirm Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus sertifikasi
                <strong><?= esc($certification['name']) ?></strong>?<br>
                Semua gambar terkait juga akan dihapus secara permanen.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="btn-confirm-delete">
                    <span class="spinner-border spinner-border-sm d-none me-1" id="delete-spinner"></span>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('btn-delete').addEventListener('click', () =>
    new bootstrap.Modal(document.getElementById('deleteModal')).show()
);

document.getElementById('btn-confirm-delete').addEventListener('click', function () {
    const spinner = document.getElementById('delete-spinner');
    this.disabled = true;
    spinner.classList.remove('d-none');

    fetch('<?= base_url('admin/certificates/delete/' . $certification['id']) ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = '<?= base_url('admin/certificates') ?>';
        } else {
            alert(data.message || 'Gagal menghapus.');
            this.disabled = false;
            spinner.classList.add('d-none');
        }
    })
    .catch(() => {
        alert('Terjadi kesalahan.');
        this.disabled = false;
        spinner.classList.add('d-none');
    });
});
</script>

<?= $this->endSection() ?>