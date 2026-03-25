<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><?= esc($title) ?></h4>
    <a href="<?= base_url('admin/experiences/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Pengalaman Kerja
    </a>
</div>

<?php if (!empty($work_experiences)): ?>
    <div class="row g-4">
        <?php foreach ($work_experiences as $experience): ?>
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 card-lift">

                    <?php if (!empty($experience['company_logo'])): ?>
                        <img src="<?= base_url('uploads/company_logos/' . esc($experience['company_logo'])) ?>"
                            class="card-img-top"
                            alt="<?= esc($experience['company_name']) ?>"
                            style="height:180px;object-fit:cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                            style="height:180px;">
                            <i class="fas fa-building fa-3x text-muted"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title mb-1"><?= esc($experience['position']) ?></h5>
                        <h6 class="card-subtitle text-muted mb-2">
                            <i class="fas fa-building me-1"></i><?= esc($experience['company_name']) ?>
                        </h6>

                        <p class="text-muted small mb-2">
                            <i class="fas fa-calendar me-1"></i>
                            <?= date('M Y', strtotime($experience['start_date'])) ?> –
                            <?php if ($experience['is_current']): ?>
                                <span class="text-success fw-semibold">Sekarang</span>
                                <span class="badge bg-success ms-1">Aktif</span>
                            <?php else: ?>
                                <?= $experience['end_date'] ? date('M Y', strtotime($experience['end_date'])) : '-' ?>
                            <?php endif; ?>
                        </p>

                        <?php if (!empty($experience['period'])): ?>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-clock me-1"></i><?= esc($experience['period']) ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($experience['description'])): ?>
                            <p class="card-text small text-truncate-3">
                                <?= esc($experience['description']) ?>
                            </p>
                        <?php endif; ?>

                        <?php
                        $skills = is_array($experience['skills_used'])
                            ? $experience['skills_used']
                            : (json_decode($experience['skills_used'] ?? '[]', true) ?? []);
                        if (!empty($skills)):
                        ?>
                            <div class="mt-2">
                                <?php foreach (array_slice($skills, 0, 3) as $skill): ?>
                                    <span class="badge bg-secondary me-1 mb-1"><?= esc($skill) ?></span>
                                <?php endforeach; ?>
                                <?php if (count($skills) > 3): ?>
                                    <span class="badge bg-light text-dark">+<?= count($skills) - 3 ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/experiences/show/' . $experience['id']) ?>"
                                class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <div class="d-flex gap-1">
                                <a href="<?= base_url('admin/experiences/edit/' . $experience['id']) ?>"
                                    class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="confirmDelete(<?= $experience['id'] ?>, '<?= esc($experience['company_name']) ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="fas fa-briefcase fa-3x mb-3 d-block"></i>
            <h5>Belum ada pengalaman kerja</h5>
            <a href="<?= base_url('admin/experiences/create') ?>" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-1"></i>Tambah Sekarang
            </a>
        </div>
    </div>
<?php endif; ?>

<!-- Delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Hapus pengalaman kerja di <strong id="companyName"></strong>?</p>
                <p class="text-danger small mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan akan menghapus semua file terkait.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    function confirmDelete(id, company) {
        document.getElementById('companyName').textContent = company;
        document.getElementById('deleteForm').action = '<?= base_url('admin/experiences/delete/') ?>' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>