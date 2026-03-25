<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Panel') ?> - Portfolio</title>

    <!-- Bootstrap CSS (satu saja, tidak duplikat) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #4e73df;
            --primary-dark: #2653d4;
            --sidebar-bg: #212529;
            --sidebar-hover: #2c3034;
            --topbar-h: 4.375rem;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        /* ── Sidebar ─────────────────────────────────── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary) 10%, #224abe 100%);
            z-index: 1000;
            transition: transform .3s;
            overflow-y: auto;
        }

        .sidebar-brand {
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: 0 1rem;
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: .05rem;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, .15);
        }

        .sidebar-brand:hover {
            color: #fff;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, .15);
            margin: .5rem 1rem;
        }

        .sidebar-heading {
            color: rgba(255, 255, 255, .4);
            font-size: .65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .1rem;
            padding: .5rem 1rem .25rem;
        }

        .nav-item .nav-link {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .85rem 1rem;
            color: rgba(255, 255, 255, .75);
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all .2s;
        }

        .nav-item .nav-link i {
            width: 1.25rem;
            text-align: center;
        }

        .nav-item .nav-link:hover,
        .nav-item .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .1);
            border-left-color: #fff;
        }

        /* ── Main content ────────────────────────────── */
        .content-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin .3s;
        }

        .topbar {
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .06);
        }

        .main-content {
            padding: 1.5rem;
        }

        /* ── Cards ───────────────────────────────────── */
        .card {
            box-shadow: 0 .15rem 1.75rem rgba(58, 59, 69, .1);
            border: none;
            border-radius: .5rem;
        }

        .card-header {
            background: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        /* ── Stat cards (dashboard) ──────────────────── */
        .stat-card {
            background: #fff;
            border-radius: .5rem;
            padding: 1.25rem;
            box-shadow: 0 .15rem 1.75rem rgba(58, 59, 69, .1);
            transition: transform .25s, box-shadow .25s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 .5rem 1.5rem rgba(58, 59, 69, .18);
        }

        .stat-card .icon {
            width: 56px;
            height: 56px;
            border-radius: .5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        .stat-card h3 {
            font-size: 1.9rem;
            font-weight: 700;
            margin: .25rem 0;
        }

        .stat-card p {
            color: #6c757d;
            margin: 0;
        }

        /* ── Hover lift on cards ─────────────────────── */
        .card-lift {
            transition: transform .2s, box-shadow .2s;
        }

        .card-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .12) !important;
        }

        /* ── Misc ────────────────────────────────────── */
        .text-truncate-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e3e6f0;
            padding: .75rem 1.5rem;
            text-align: center;
            font-size: .85rem;
            color: #858796;
        }

        /* ── Scrollbar ───────────────────────────────── */
        ::-webkit-scrollbar {
            width: .4rem;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: .25rem;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* ── Mobile ──────────────────────────────────── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0;
            }
        }

        @media (min-width: 769px) {
            .btn-sidebar-toggle {
                display: none !important;
            }
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>

<body>

    <!-- ════════════════════ Sidebar ════════════════════ -->
    <nav class="sidebar" id="sidebar">

        <a class="sidebar-brand" href="<?= base_url('/') ?>">
            <i class="fas fa-briefcase"></i>
            <span>Portfolio</span>
        </a>

        <ul class="list-unstyled mb-0">
            <li class="sidebar-heading mt-2">Main</li>

            <li class="nav-item">
                <a class="nav-link <?= uri_string() === 'admin/dashboard' ? 'active' : '' ?>"
                    href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= uri_string() === 'admin/profile' ? 'active' : '' ?>"
                    href="<?= base_url('admin/profile') ?>">
                    <i class="fas fa-fw fa-user"></i><span>Profile</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <li class="sidebar-heading">Content</li>

            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/portfolio') ? 'active' : '' ?>"
                    href="<?= base_url('admin/portfolio') ?>">
                    <i class="fas fa-fw fa-briefcase"></i><span>Portfolio</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/skills') ? 'active' : '' ?>"
                    href="<?= base_url('admin/skills') ?>">
                    <i class="fas fa-fw fa-star"></i><span>Skills</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/experiences') ? 'active' : '' ?>"
                    href="<?= base_url('admin/experiences') ?>">
                    <i class="fas fa-fw fa-building"></i><span>Work Experiences</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/achievement') ? 'active' : '' ?>"
                    href="<?= base_url('admin/achievement') ?>">
                    <i class="fas fa-fw fa-trophy"></i><span>Achievements</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/certificates') ? 'active' : '' ?>"
                    href="<?= base_url('admin/certificates') ?>">
                    <i class="fas fa-fw fa-award"></i><span>Certificates</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/social-media') ? 'active' : '' ?>"
                    href="<?= base_url('admin/social-media') ?>">
                    <i class="fas fa-fw fa-share-alt"></i><span>Social Media</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'admin/journals') ? 'active' : '' ?>"
                    href="<?= base_url('admin/journals') ?>">
                    <i class="fas fa-fw fa-book"></i><span>Journal</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item mt-2">
                <a class="nav-link text-warning"
                    href="<?= base_url('admin/logout') ?>"
                    onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- ════════════════ End Sidebar ════════════════════ -->

    <!-- ════════════════ Content Wrapper ════════════════ -->
    <div class="content-wrapper" id="contentWrapper">

        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <!-- Mobile toggle -->
                <button class="btn btn-link p-0 btn-sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars fa-lg text-secondary"></i>
                </button>
                <h6 class="mb-0 fw-bold text-secondary"><?= esc($title ?? 'Dashboard') ?></h6>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="d-none d-sm-inline text-secondary small">
                    Welcome, <strong><?= esc(session()->get('admin_username') ?? 'Admin') ?></strong>
                </span>
                <img src="<?= base_url('images/nice-hero.webp') ?>"
                    alt="Admin"
                    style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
            </div>
        </div>
        <!-- /Topbar -->

        <!-- Flash Messages (global) -->
        <div class="main-content">
            <?php foreach (['success' => 'success', 'error' => 'danger', 'info' => 'info'] as $key => $cls): ?>
                <?php if ($msg = session()->getFlashdata($key)): ?>
                    <div class="alert alert-<?= $cls ?> alert-dismissible fade show" role="alert">
                        <?= esc($msg) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?= $this->renderSection('content') ?>
        </div>
        <!-- /Main Content -->

        <footer>
            &copy; <?= date('Y') ?> Portfolio Management
        </footer>

    </div>
    <!-- ════════════════ End Content Wrapper ════════════ -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                if (!sidebar.contains(e.target) && !e.target.closest('#sidebarToggle')) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Auto-hide flash alerts after 5 s
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                bootstrap.Alert.getOrCreateInstance(el)?.close();
            });
        }, 5000);
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>