<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= esc($skill['skill_name']) ?></h5>
            <p class="card-text"><strong>Kategori:</strong> <?= esc($skill['category']) ?></p>
            <p class="card-text"><strong>Deskripsi:</strong> <?= esc($skill['description']) ?></p>
            <p class="card-text"><small class="text-muted">Dibuat: <?= $skill['created_at'] ?></small></p>
            <p class="card-text"><small class="text-muted">Diupdate: <?= $skill['updated_at'] ?></small></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?= base_url('admin/skills/edit/' . $skill['id']) ?>" class="btn btn-warning">Edit</a>
        <a href="<?= base_url('admin/skills') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>