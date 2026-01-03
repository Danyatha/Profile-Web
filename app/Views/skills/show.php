<!-- app/Views/skills/show.php -->
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
            <a href="<?= base_url('skill/edit/' . $skill['id']) ?>" class="btn btn-warning">Edit</a>
            <a href="<?= base_url('skill') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>