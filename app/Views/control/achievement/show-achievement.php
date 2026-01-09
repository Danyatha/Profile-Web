<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3><?= esc($title) ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Title</th>
                            <td><?= esc($achievement['title']) ?></td>
                        </tr>
                        <tr>
                            <th>Event Name</th>
                            <td><?= esc($achievement['event_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Achievement</th>
                            <td><?= esc($achievement['achievement']) ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= $achievement['description'] ? esc($achievement['description']) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td><?= $achievement['start_date'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td><?= $achievement['end_date'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?= $achievement['created_at'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td><?= $achievement['updated_at'] ?? '-' ?></td>
                        </tr>
                    </table>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('admin/achievement') ?>" class="btn btn-secondary">Kembali</a>
                        <a href="<?= base_url('admin/achievement/edit/' . $achievement['id']) ?>" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>