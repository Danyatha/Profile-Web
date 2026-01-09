<?= $this->extend('control/layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <a href="<?= base_url('admin/achievement/create') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Achievement
    </a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Event Name</th>
                    <th>Achievement</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($achievements): ?>
                    <?php $no = 1;
                    foreach ($achievements as $achievement): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($achievement['title']) ?></td>
                            <td><?= esc($achievement['event_name']) ?></td>
                            <td><?= esc($achievement['achievement']) ?></td>
                            <td><?= $achievement['start_date'] ?? '-' ?></td>
                            <td><?= $achievement['end_date'] ?? '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/achievement/show/' . $achievement['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="<?= base_url('admin/achievement/edit/' . $achievement['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= base_url('admin/achievement/delete/' . $achievement['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->endSection() ?>