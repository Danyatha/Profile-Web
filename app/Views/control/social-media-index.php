<?= $this->extend('control/layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0"><?= esc($title) ?></h5>
                            <p class="text-sm mb-0"><?= esc($subtitle) ?></p>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i> Add Social Media
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center mb-0" id="socialMediaTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Icon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Platform</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Profile URL</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($socialMediaLinks)): ?>
                                    <?php foreach ($socialMediaLinks as $index => $social): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0"><?= $index + 1 ?></p>
                                            </td>
                                            <td>
                                                <?php if (!empty($social['icon_class'])): ?>
                                                    <img src="<?= base_url('upload/icon_class/' . $social['icon_class']) ?>"
                                                        alt="<?= esc($social['platform_name']) ?>"
                                                        class="avatar avatar-sm me-3" style="width: 50px; height: auto; object-fit: contain;">
                                                <?php else: ?>
                                                    <i class="fas fa-image text-secondary"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= esc($social['platform_name']) ?></p>
                                            </td>
                                            <td>
                                                <a href="<?= esc($social['profile_url']) ?>" target="_blank" class="text-xs text-primary">
                                                    <?= esc($social['profile_url']) ?>
                                                </a>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= date('d M Y', strtotime($social['created_at'])) ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button type="button" class="btn btn-link text-warning px-2 mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?= $social['id'] ?>">
                                                    <i class="fas fa-pen text-warning me-2"></i>Edit
                                                </button>
                                                <button type="button" class="btn btn-link text-danger px-2 mb-0"
                                                    onclick="confirmDelete(<?= $social['id'] ?>)">
                                                    <i class="fas fa-trash text-danger me-2"></i>Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?= $social['id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Social Media</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url('admin/social-media/update/' . $social['id']) ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="platform_name_<?= $social['id'] ?>" class="form-label">Platform Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="platform_name_<?= $social['id'] ?>"
                                                                    name="platform_name"
                                                                    value="<?= esc($social['platform_name']) ?>"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="profile_url_<?= $social['id'] ?>" class="form-label">Profile URL</label>
                                                                <input type="url" class="form-control"
                                                                    id="profile_url_<?= $social['id'] ?>"
                                                                    name="profile_url"
                                                                    value="<?= esc($social['profile_url']) ?>"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <p class="text-sm text-secondary mb-0">No social media data yet</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Social Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/social-media/create') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="platform_name" class="form-label">Platform Name</label>
                        <input type="text" class="form-control" id="platform_name" name="platform_name"
                            placeholder="e.g., Facebook, Instagram, Twitter" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_url" class="form-label">Profile URL</label>
                        <input type="url" class="form-control" id="profile_url" name="profile_url"
                            placeholder="https://example.com/profile" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon_class" class="form-label">Icon/Logo</label>
                        <input type="file" class="form-control" id="icon_class" name="icon_class"
                            accept="image/*">
                        <small class="text-muted">Upload icon atau logo platform (opsional)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="post" style="display: none;">
    <?= csrf_field() ?>
</form>

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this data?')) {
            const form = document.getElementById('deleteForm');
            form.action = '<?= base_url('admin/social-media/delete/') ?>' + id;
            form.submit();
        }
    }
</script>

<?= $this->endSection() ?>