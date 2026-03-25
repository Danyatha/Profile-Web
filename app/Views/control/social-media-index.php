<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0"><?= esc($title) ?></h5>
            <p class="text-muted small mb-0"><?= esc($subtitle) ?></p>
        </div>
        <button type="button" class="btn btn-primary btn-sm"
            data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-1"></i> Add Social Media
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" style="width:50px">No</th>
                        <th style="width:70px">Icon</th>
                        <th>Platform</th>
                        <th>Profile URL</th>
                        <th>Dibuat</th>
                        <th class="text-center" style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($socialMediaLinks)): ?>
                        <?php foreach ($socialMediaLinks as $i => $social): ?>
                            <tr>
                                <td class="ps-3"><?= $i + 1 ?></td>
                                <td>
                                    <?php if (!empty($social['icon_class'])): ?>
                                        <img src="<?= base_url('uploads/icons/' . esc($social['icon_class'])) ?>"
                                            alt="<?= esc($social['platform_name']) ?>"
                                            style="width:40px;height:40px;object-fit:contain;">
                                    <?php else: ?>
                                        <i class="fas fa-share-alt text-muted"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-semibold"><?= esc($social['platform_name']) ?></td>
                                <td>
                                    <a href="<?= esc($social['profile_url']) ?>"
                                        target="_blank" rel="noopener"
                                        class="text-primary small">
                                        <?= esc(mb_substr($social['profile_url'], 0, 50)) ?>
                                        <?= strlen($social['profile_url']) > 50 ? '…' : '' ?>
                                    </a>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M Y', strtotime($social['created_at'])) ?>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= $social['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?= $social['id'] ?>, '<?= esc($social['platform_name']) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $social['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Social Media</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="<?= base_url('admin/social-media/update/' . $social['id']) ?>"
                                            method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Platform Name</label>
                                                    <input type="text" class="form-control"
                                                        name="platform_name"
                                                        value="<?= esc($social['platform_name']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Profile URL</label>
                                                    <input type="url" class="form-control"
                                                        name="profile_url"
                                                        value="<?= esc($social['profile_url']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-share-alt fa-2x mb-2 d-block"></i>
                                Belum ada data social media
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ── Create Modal ─────────────────────────────── -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Social Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/social-media/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Platform Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="platform_name"
                            placeholder="Facebook, Instagram, Twitter…" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="profile_url"
                            placeholder="https://example.com/profile" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon / Logo</label>
                        <input type="file" class="form-control" name="icon_class" accept="image/*">
                        <div class="form-text">Opsional. JPG, PNG, WebP. Maks 2MB.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hidden delete form -->
<form id="deleteForm" method="post" style="display:none;">
    <?= csrf_field() ?>
</form>

<!-- Delete confirm modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus <strong id="deleteName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    function confirmDelete(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('confirmDeleteBtn').onclick = () => {
            const form = document.getElementById('deleteForm');
            form.action = '<?= base_url('admin/social-media/delete/') ?>' + id;
            form.submit();
        };
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>