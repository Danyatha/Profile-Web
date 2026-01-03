<?= $this->extend('control/layout/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background-color: #e7f3ff; color: #0d6efd;">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <h3><?= $total_portfolio ?></h3>
            <p>Total Portfolio</p>
            <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-sm btn-outline-primary mt-2">
                Manage <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background-color: #fff3e0; color: #ff9800;">
                <i class="bi bi-star-fill"></i>
            </div>
            <h3><?= $total_skills ?></h3>
            <p>Total Skills</p>
            <a href="<?= base_url('admin/skills') ?>" class="btn btn-sm btn-outline-warning mt-2">
                Manage <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background-color: #e8f5e9; color: #4caf50;">
                <i class="bi bi-award-fill"></i>
            </div>
            <h3><?= $total_certificates ?></h3>
            <p>Total Certificates</p>
            <a href="<?= base_url('admin/certificates') ?>" class="btn btn-sm btn-outline-success mt-2">
                Manage <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background-color: #f3e5f5; color: #9c27b0;">
                <i class="bi bi-building"></i>
            </div>
            <h3><?= $total_experiences ?></h3>
            <p>Work Experiences</p>
            <a href="<?= base_url('admin/experiences') ?>" class="btn btn-sm btn-outline-primary mt-2">
                Manage <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-lightning-fill text-warning"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-primary w-100 py-3">
                            <i class="bi bi-plus-circle me-2"></i>Add Portfolio
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('admin/skills') ?>" class="btn btn-warning w-100 py-3">
                            <i class="bi bi-plus-circle me-2"></i>Add Skill
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('admin/certificates') ?>" class="btn btn-success w-100 py-3">
                            <i class="bi bi-plus-circle me-2"></i>Add Certificate
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('admin/experiences') ?>" class="btn btn-info w-100 py-3">
                            <i class="bi bi-plus-circle me-2"></i>Add Experience
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clock-history text-primary"></i> Recent Activity</h5>
                <span class="badge bg-primary">Live</span>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex align-items-center">
                        <div class="icon me-3" style="width: 40px; height: 40px; background-color: #e7f3ff; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-briefcase text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">New portfolio added</h6>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <div class="icon me-3" style="width: 40px; height: 40px; background-color: #fff3e0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-star text-warning"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Skill updated</h6>
                            <small class="text-muted">5 hours ago</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <div class="icon me-3" style="width: 40px; height: 40px; background-color: #e8f5e9; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-award text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Certificate uploaded</h6>
                            <small class="text-muted">1 day ago</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <div class="icon me-3" style="width: 40px; height: 40px; background-color: #f3e5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person text-purple"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Profile information updated</h6>
                            <small class="text-muted">2 days ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-info-circle text-info"></i> System Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Version</small>
                    <h6>1.0.0</h6>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Last Login</small>
                    <h6><?= date('d M Y, H:i') ?></h6>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Framework</small>
                    <h6>CodeIgniter 4</h6>
                </div>
                <hr>
                <div class="d-grid">
                    <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-2"></i>View Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>