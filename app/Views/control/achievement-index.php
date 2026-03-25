<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><?= esc($title) ?></h4>
    <a href="<?= base_url('admin/achievement/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Achievement
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" style="width:50px">No</th>
                        <th>Title</th>
                        <th>Event Name</th>
                        <th>Achievement</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th class="text-center" style="width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($achievements)): ?>
                        <?php foreach ($achievements as $i => $achievement): ?>
                            <tr>
                                <td class="ps-3"><?= $i + 1 ?></td>
                                <td><?= esc($achievement['title']) ?></td>
                                <td><?= esc($achievement['event_name']) ?></td>
                                <td><?= esc($achievement['achievement']) ?></td>
                                <td><?= $achievement['start_date'] ? date('d M Y', strtotime($achievement['start_date'])) : '-' ?></td>
                                <td><?= $achievement['end_date']   ? date('d M Y', strtotime($achievement['end_date']))   : '-' ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/achievement/show/' . $achievement['id']) ?>"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('admin/achievement/edit/' . $achievement['id']) ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/achievement/delete/' . $achievement['id']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-trophy fa-2x mb-2 d-block"></i>
                                Belum ada data achievement
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>