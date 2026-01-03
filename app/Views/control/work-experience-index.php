<?= $this->extend('control/layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><?= esc($title) ?></h2>
                <a href="<?= base_url('admin/experiences/create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Pengalaman Kerja
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Work Experience Cards -->
    <div class="row">
        <?php if (!empty($work_experiences)): ?>
            <?php foreach ($work_experiences as $experience): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($experience['company_logo'])): ?>
                            <img src="<?= base_url('uploads/company_logos/' . esc($experience['company_logo'])) ?>"
                                class="card-img-top"
                                alt="<?= esc($experience['company_name']) ?>"
                                style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="fas fa-building fa-4x text-muted"></i>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?= esc($experience['position']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-building me-1"></i>
                                <?= esc($experience['company_name']) ?>
                            </h6>

                            <p class="text-muted small mb-2">
                                <i class="fas fa-calendar me-1"></i>
                                <?= date('M Y', strtotime($experience['start_date'])) ?> -
                                <?= $experience['is_current'] ? 'Sekarang' : date('M Y', strtotime($experience['end_date'])) ?>
                                <?php if ($experience['is_current']): ?>
                                    <span class="badge bg-success ms-2">Aktif</span>
                                <?php endif; ?>
                            </p>

                            <?php if (!empty($experience['description'])): ?>
                                <p class="card-text text-truncate-3">
                                    <?= esc($experience['description']) ?>
                                </p>
                            <?php endif; ?>

                            <?php if (!empty($experience['skills_used'])): ?>
                                <div class="mb-3">
                                    <?php
                                    $skills = is_array($experience['skills_used'])
                                        ? $experience['skills_used']
                                        : json_decode($experience['skills_used'], true);
                                    ?>
                                    <?php if (!empty($skills)): ?>
                                        <?php foreach (array_slice($skills, 0, 3) as $skill): ?>
                                            <span class="badge bg-secondary me-1"><?= esc($skill) ?></span>
                                        <?php endforeach; ?>
                                        <?php if (count($skills) > 3): ?>
                                            <span class="badge bg-light text-dark">+<?= count($skills) - 3 ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('admin/experiences/show/' . $experience['id']) ?>"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                                <div>
                                    <a href="<?= base_url('admin/experiences/edit/' . $experience['id']) ?>"
                                        class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="confirmDelete(<?= $experience['id'] ?>, '<?= esc($experience['company_name']) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada pengalaman kerja</h5>
                        <p class="text-muted">Mulai tambahkan pengalaman kerja Anda</p>
                        <a href="<?= base_url('admin/experiences/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Pengalaman Kerja
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengalaman kerja di <strong id="companyName"></strong>?</p>
                <p class="text-danger small mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan akan menghapus semua file terkait.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .text-truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>

<script>
    function confirmDelete(id, companyName) {
        document.getElementById('companyName').textContent = companyName;
        document.getElementById('deleteForm').action = '<?= base_url('admin/experiences/delete/') ?>' + id;

        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    // Auto hide alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>

<?= $this->endSection() ?>