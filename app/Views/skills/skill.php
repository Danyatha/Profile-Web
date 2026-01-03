<!-- app/Views/skills/index.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1><?= $title ?></h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <a href="<?= base_url('skill/create') ?>" class="btn btn-primary mb-3">Tambah Skill</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Skill</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($skills)): ?>
                    <?php foreach ($skills as $key => $skill): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= esc($skill['skill_name']) ?></td>
                            <td><?= esc($skill['category']) ?></td>
                            <td><?= esc($skill['description']) ?></td>
                            <td>
                                <a href="<?= base_url('skill/show/' . $skill['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="<?= base_url('skill/edit/' . $skill['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= base_url('skill/delete/' . $skill['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data skill</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>