<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/skills/edit/' . $skill['id']) ?>"
                        class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="<?= base_url('admin/skills') ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">

                <?php if (!empty($skill['image_path'])): ?>
                    <div class="text-center mb-4">
                        <img src="<?= base_url('uploads/skills/' . esc($skill['image_path'])) ?>"
                            alt="<?= esc($skill['skill_name']) ?>"
                            class="img-thumbnail" style="max-width:150px;">
                    </div>
                <?php endif; ?>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="35%" class="table-light">Nama Skill</th>
                            <td class="fw-semibold"><?= esc($skill['skill_name']) ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Kategori</th>
                            <td><span class="badge bg-secondary"><?= esc($skill['category']) ?></span></td>
                        </tr>
                        <tr>
                            <th class="table-light">Deskripsi</th>
                            <td>
                                <?= $skill['description']
                                    ? nl2br(esc($skill['description']))
                                    : '<span class="text-muted">-</span>' ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-light">Dibuat</th>
                            <td class="text-muted small"><?= date('d M Y, H:i', strtotime($skill['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Diupdate</th>
                            <td class="text-muted small"><?= date('d M Y, H:i', strtotime($skill['updated_at'])) ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>