<!-- app/Views/skills/create.php -->
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

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('skill/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="skill_name" class="form-label">Nama Skill</label>
                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('skill_name')) ? 'is-invalid' : '' ?>"
                    id="skill_name" name="skill_name" value="<?= old('skill_name') ?>" required>
                <?php if (isset($validation) && $validation->hasError('skill_name')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('skill_name') ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('category')) ? 'is-invalid' : '' ?>"
                    id="category" name="category" value="<?= old('category') ?>" required>
                <?php if (isset($validation) && $validation->hasError('category')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('category') ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control <?= (isset($validation) && $validation->hasError('description')) ? 'is-invalid' : '' ?>"
                    id="description" name="description" rows="3"><?= old('description') ?></textarea>
                <?php if (isset($validation) && $validation->hasError('description')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('description') ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('skill') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>