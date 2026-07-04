<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<!-- Flash messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i><?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-semibold">
        <i class="bi bi-award me-2 text-primary"></i><?= esc($title) ?>
    </h4>
    <a href="<?= base_url('admin/certificates/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Sertifikasi
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" style="width:50px">No</th>
                        <th style="width:72px">Gambar</th>
                        <th>Nama Sertifikasi</th>
                        <th>Penerbit</th>
                        <th style="width:90px" class="text-center">Tahun</th>
                        <th style="width:80px" class="text-center">Foto</th>
                        <th class="text-center" style="width:180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($certifications)): ?>
                        <?php foreach ($certifications as $i => $cert): ?>
                            <tr id="cert-row-<?= $cert['id'] ?>">
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td>
                                    <?php if (! empty($cert['images_path'][0])): ?>
                                        <img src="<?= base_url($cert['images_path'][0]) ?>"
                                             alt="<?= esc($cert['name']) ?>"
                                             class="rounded"
                                             style="width:48px;height:48px;object-fit:cover;cursor:pointer"
                                             onclick="openGallery(<?= $cert['id'] ?>, <?= htmlspecialchars(json_encode($cert['images_path']), ENT_QUOTES) ?>)">
                                    <?php else: ?>
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                             style="width:48px;height:48px">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-medium"><?= esc($cert['name']) ?></td>
                                <td class="text-muted"><?= esc($cert['issuer'] ?? '-') ?></td>
                                <td class="text-center"><?= esc($cert['issue_year'] ?? '-') ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">
                                        <?= count($cert['images_path'] ?? []) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/certificates/show/' . $cert['id']) ?>"
                                       class="btn btn-outline-info btn-sm" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/certificates/edit/' . $cert['id']) ?>"
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm btn-delete-cert"
                                            data-id="<?= $cert['id'] ?>"
                                            data-name="<?= esc($cert['name'], 'attr') ?>"
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-award display-6 d-block mb-2 opacity-50"></i>
                                Belum ada data sertifikasi.<br>
                                <a href="<?= base_url('admin/certificates/create') ?>" class="btn btn-primary btn-sm mt-3">
                                    Tambah Sekarang
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Galeri Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="gallery-container" class="d-flex flex-wrap gap-3 justify-content-center"></div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus sertifikasi <strong id="delete-cert-name"></strong>?
                Semua gambar terkait juga akan dihapus dan tindakan ini tidak dapat dibatalkan.
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
const CSRF_HEADER = '<?= csrf_header() ?>';
const CSRF_HASH   = '<?= csrf_hash() ?>';

let pendingDeleteId = null;

// ── Delete flow ────────────────────────────────────────────────────────────────
document.querySelectorAll('.btn-delete-cert').forEach(btn => {
    btn.addEventListener('click', function () {
        pendingDeleteId = this.dataset.id;
        document.getElementById('delete-cert-name').textContent = this.dataset.name;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
});

document.getElementById('btn-confirm-delete').addEventListener('click', function () {
    if (! pendingDeleteId) return;

    const spinner = document.getElementById('delete-spinner');
    this.disabled = true;
    spinner.classList.remove('d-none');

    fetch(`<?= base_url('admin/certificates/delete') ?>/${pendingDeleteId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            [CSRF_HEADER]: CSRF_HASH
        }
    })
    .then(r => r.json())
    .then(data => {
        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
        if (data.status === 'success') {
            const row = document.getElementById('cert-row-' + pendingDeleteId);
            if (row) row.remove();
        } else {
            alert(data.message || 'Gagal menghapus data.');
        }
    })
    .catch(() => alert('Terjadi kesalahan saat menghapus data.'))
    .finally(() => {
        this.disabled = false;
        spinner.classList.add('d-none');
        pendingDeleteId = null;
    });
});

// ── Gallery modal ──────────────────────────────────────────────────────────────
function openGallery(id, paths) {
    const container = document.getElementById('gallery-container');
    container.innerHTML = '';

    paths.forEach(path => {
        const img = document.createElement('img');
        img.src   = '<?= base_url() ?>' + path;
        img.style.cssText = 'max-width:280px;max-height:280px;object-fit:contain;border-radius:8px;border:1px solid #dee2e6';
        container.appendChild(img);
    });

    new bootstrap.Modal(document.getElementById('galleryModal')).show();
}
</script>

<?= $this->endSection() ?>