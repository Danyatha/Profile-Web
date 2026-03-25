<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/achievement/edit/' . $achievement['id']) ?>"
                        class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="<?= base_url('admin/achievement') ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">

                <?php if (!empty($achievement['images_path'])): ?>
                    <div class="text-center mb-4">
                        <img src="<?= base_url('uploads/achievements/' . esc($achievement['images_path'])) ?>"
                            alt="Achievement image"
                            class="img-fluid rounded shadow-sm" style="max-height:280px;">
                    </div>
                <?php endif; ?>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%" class="table-light">Title</th>
                            <td><?= esc($achievement['title']) ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Event Name</th>
                            <td><?= esc($achievement['event_name']) ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Achievement</th>
                            <td><?= esc($achievement['achievement']) ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Description</th>
                            <td><?= $achievement['description'] ? nl2br(esc($achievement['description'])) : '<span class="text-muted">-</span>' ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Start Date</th>
                            <td><?= $achievement['start_date'] ? date('d M Y', strtotime($achievement['start_date'])) : '-' ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">End Date</th>
                            <td><?= $achievement['end_date'] ? date('d M Y', strtotime($achievement['end_date'])) : '-' ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Created At</th>
                            <td><?= $achievement['created_at'] ? date('d M Y, H:i', strtotime($achievement['created_at'])) : '-' ?></td>
                        </tr>
                        <tr>
                            <th class="table-light">Updated At</th>
                            <td><?= $achievement['updated_at'] ? date('d M Y, H:i', strtotime($achievement['updated_at'])) : '-' ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>