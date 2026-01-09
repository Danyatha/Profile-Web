<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Panel') ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #0d6efd;
            --sidebar-bg: #212529;
            --sidebar-hover: #2c3034;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            padding: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            color: white;
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover {
            background-color: var(--sidebar-hover);
            color: white;
            border-left-color: var(--primary-color);
        }

        .sidebar-menu a.active {
            background-color: var(--sidebar-hover);
            color: white;
            border-left-color: var(--primary-color);
        }

        .sidebar-menu a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-wrapper {
            padding: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card p {
            color: #6c757d;
            margin: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="bi bi-speedometer2"></i> Admin Panel</h4>
        </div>
        <div class="sidebar-menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="<?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?= base_url('admin/profile') ?>" class="<?= uri_string() == 'admin/profile' ? 'active' : '' ?>">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
            <a href="<?= base_url('admin/portfolio') ?>" class="<?= uri_string() == 'admin/portfolio' ? 'active' : '' ?>">
                <i class="bi bi-briefcase"></i>
                <span>Portfolio</span>
            </a>
            <a href="<?= base_url('admin/skills') ?>" class="<?= uri_string() == 'admin/skills' ? 'active' : '' ?>">
                <i class="bi bi-star"></i>
                <span>Skills</span>
            </a>
            <a href="<?= base_url('admin/experiences') ?>" class="<?= uri_string() == 'admin/experiences' ? 'active' : '' ?>">
                <i class="bi bi-building"></i>
                <span>Work Experiences</span>
            </a>
            <a href="<?= base_url('admin/achievement') ?>" class="<?= uri_string() == 'admin/achievements' ? 'active' : '' ?>">
                <i class="bi bi-trophy"></i>
                <span>Achievements</span>
            </a>
            <a href="<?= base_url('admin/certificates') ?>" class="<?= uri_string() == 'admin/certificates' ? 'active' : '' ?>">
                <i class="bi bi-award"></i>
                <span>Certificates</span>
            </a>
            <a href="<?= base_url('admin/social-media') ?>" class="<?= uri_string() == 'admin/social-media' ? 'active' : '' ?>">
                <i class="bi bi-share"></i>
                <span>Social Media</span>
            </a>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 20px;">

            <a href="<?= base_url('admin/logout') ?>" onclick="return confirm('Are you sure you want to logout?')">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div>
                <h5 class="mb-0"><?= esc($title ?? 'Dashboard') ?></h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3">Welcome, <strong><?= session()->get('admin_username') ?></strong></span>
                <img src="<?= base_url('images/nice-hero.webp') ?>" alt="Admin"
                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>