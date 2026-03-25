<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <a href="<?= base_url('admin/achievement') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body">

                <?php if (!empty(session()->getFlashdata('errors'))): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- enctype needed if image upload is ever added back -->
                <form action="<?= base_url('admin/achievement/update/' . $achievement['id']) ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?= old('title', $achievement['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="event_name" name="event_name"
                            value="<?= old('event_name', $achievement['event_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="achievement" class="form-label">Achievement <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="achievement" name="achievement"
                            value="<?= old('achievement', $achievement['achievement']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"
                            rows="4"><?= old('description', $achievement['description']) ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="<?= old('start_date', $achievement['start_date']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="<?= old('end_date', $achievement['end_date']) ?>">
                        </div>
                    </div>

                    <!-- Image field -->
                    <div class="mb-4">
                        <label for="images_path" class="form-label">Ganti Gambar</label>
                        <?php if (!empty($achievement['images_path'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/achievements/' . esc($achievement['images_path'])) ?>"
                                    alt="Current" class="img-thumbnail" style="max-width:180px;">
                                <div class="form-text">Gambar saat ini. Upload baru untuk mengganti.</div>
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="images_path" name="images_path" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('admin/achievement') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>