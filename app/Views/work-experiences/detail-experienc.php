<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                <div>
                    <a href="<?= base_url('work-experience') ?>" class="btn btn-outline-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="<?= base_url('work-experience/edit/' . $work_experience['id']) ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Company Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <?php if ($work_experience['company_logo']): ?>
                            <img src="<?= base_url('uploads/company_logos/' . $work_experience['company_logo']) ?>"
                                alt="<?= esc($work_experience['company_name']) ?>"
                                class="rounded-circle me-3 bg-white p-2"
                                style="width: 60px; height: 60px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;">
                                <i class="fas fa-building text-primary fa-lg"></i>
                            </div>
                        <?php endif; ?>
                        <div class="flex-grow-1">
                            <h4 class="mb-1"><?= esc($work_experience['company_name']) ?></h4>
                            <h6 class="mb-0 text-light"><?= esc($work_experience['position']) ?></h6>
                        </div>
                        <?php if ($work_experience['is_current']): ?>
                            <span class="badge badge-success badge-lg">Saat Ini</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Period -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Periode Kerja</h6>
                            <p class="mb-0">
                                <i class="fas fa-calendar-alt text-primary"></i>
                                <?= date('d F Y', strtotime($work_experience['start_date'])) ?> -
                                <?= $work_experience['end_date'] ? date('d F Y', strtotime($work_experience['end_date'])) : 'Sekarang' ?>
                            </p>
                            <small class="text-muted">Durasi: <?= $work_experience['period'] ?></small>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Status</h6>
                            <p class="mb-0">
                                <?php if ($work_experience['is_current']): ?>
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Masih Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-history"></i> Selesai
                                    </span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <?php if ($work_experience['description']): ?>
                        <div class="mb-4">
                            <h6 class="text-muted">Deskripsi</h6>
                            <p class="text-justify"><?= nl2br(esc($work_experience['description'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Job Description -->
                    <?php if ($work_experience['job_description']): ?>
                        <div class="mb-4">
                            <h6 class="text-muted">Job Description</h6>
                            <div class="bg-light p-3 rounded">
                                <p class="mb-0 text-justify"><?= nl2br(esc($work_experience['job_description'])) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Achievements -->
                    <?php if ($work_experience['achievements']): ?>
                        <div class="mb-4">
                            <h6 class="text-muted">Pencapaian</h6>
                            <div class="bg-success bg-opacity-10 p-3 rounded border-left border-success">
                                <p class="mb-0 text-justify"><?= nl2br(esc($work_experience['achievements'])) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Skills Used -->
                    <?php if (!empty($work_experience['skills_used'])): ?>
                        <div class="mb-4">
                            <h6 class="text-muted">Skills yang Digunakan</h6>
                            <div class="d-flex flex-wrap">
                                <?php foreach ($work_experience['skills_used'] as $skill): ?>
                                    <span class="badge badge-primary mr-2 mb-2 px-3 py-1">
                                        <i class="fas fa-code"></i> <?= esc($skill) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Documentation Images -->
            <?php if (!empty($work_experience['documentation_images'])): ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-images"></i> Dokumentasi Pekerjaan
                            <span class="badge badge-secondary ml-2"><?= count($work_experience['documentation_images']) ?> Gambar</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($work_experience['documentation_images'] as $index => $image): ?>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="card">
                                        <img src="<?= base_url('uploads/documentation/' . $image) ?>"
                                            alt="Dokumentasi <?= $index + 1 ?>"
                                            class="card-img-top"
                                            style="height: 200px; object-fit: cover; cursor: pointer;"
                                            onclick="showImageModal('<?= base_url('uploads/documentation/' . $image) ?>', 'Dokumentasi <?= $index + 1 ?>')">
                                        <div class="card-body p-2">
                                            <small class="text-muted">Dokumentasi <?= $index + 1 ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('work-experience/edit/' . $work_experience['id']) ?>"
                            class="btn btn-primary btn-block">
                            <i class="fas fa-edit"></i> Edit Pengalaman Kerja
                        </a>
                        <button type="button"
                            class="btn btn-outline-danger btn-block"
                            onclick="confirmDelete(<?= $work_experience['id'] ?>, '<?= esc($work_experience['company_name']) ?>')">
                            <i class="fas fa-trash"></i> Hapus Pengalaman Kerja
                        </button>
                        <a href="<?= base_url('work-experience/create') ?>"
                            class="btn btn-outline-success btn-block">
                            <i class="fas fa-plus"></i> Tambah Pengalaman Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Summary Info -->
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-right">
                                <div class="h5 font-weight-bold text-primary">
                                    <?= count($work_experience['skills_used']) ?>
                                </div>
                                <small class="text-muted">Skills</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="h5 font-weight-bold text-success">
                                <?= count($work_experience['documentation_images']) ?>
                            </div>
                            <small class="text-muted">Dokumentasi</small>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <div class="h6 font-weight-bold text-info">
                            <?= $work_experience['period'] ?>
                        </div>
                        <small class="text-muted">Total Durasi</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Dokumentasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengalaman kerja di <strong id="companyName"></strong>?</p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="post" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showImageModal(imageSrc, imageTitle) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModalLabel').textContent = imageTitle;
        $('#imageModal').modal('show');
    }

    function confirmDelete(id, companyName) {
        document.getElementById('companyName').textContent = companyName;
        document.getElementById('deleteForm').action = '<?= base_url('work-experience/delete/') ?>' + id;
        $('#deleteModal').modal('show');
    }
</script>
<?= $this->endSection() ?>