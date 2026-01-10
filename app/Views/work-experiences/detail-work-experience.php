<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($work_experience['position']) ?> - <?= esc($work_experience['company_name']) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/experience-style.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body>
    <style>
        /* Detail Page Specific Styles */
        :root {
            --gradient-primary: linear-gradient(135deg, #f8f9ff 0%, #f1f3ff 100%);
            --gradient-secondary: linear-gradient(135deg, #444 0%, #111 100%);
        }

        .detail-hero {
            background: linear-gradient(135deg, rgba(180, 180, 180, 0.7), rgba(200, 200, 200, 0.7));
            color: white;
            padding: 4rem 0 3rem;
            position: relative;
            overflow: hidden;
        }

        .detail-hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: 100px;
            opacity: 0.3;
        }

        .back-button-detail {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-button-detail:hover {
            color: #ffd700;
            transform: translateX(-5px);
        }

        .back-button-detail svg {
            width: 20px;
            height: 20px;
        }

        .company-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .company-logo-large {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .company-logo-large img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .company-info h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-family: 'Abril Fatface', serif;
        }

        .company-info .company-name-detail {
            font-size: 1.3rem;
            opacity: 0.95;
            margin-bottom: 1rem;
        }

        .meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .meta-info>* {
            background: #fff;
            color: #111;
            padding: 0.45rem 0.9rem;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow:
                0 2px 6px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }


        .meta-info>*:hover {
            background: #111;
            color: #fff;
            border-color: #111;
            box-shadow:
                0 0 0 2px rgba(0, 0, 0, 0.9),
                0 8px 20px rgba(0, 0, 0, 0.35);
            transform: translateY(-2px) scale(1.03);
        }



        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item svg {
            width: 20px;
            height: 20px;
            opacity: 0.9;
        }

        .current-badge-large {
            background: rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        /* Content Sections */
        .detail-content {
            background: #f8f9fc;
            padding: 3rem 0;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .content-card:hover {
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.12);
        }

        .content-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .content-card-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-secondary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .content-card-icon svg {
            width: 24px;
            height: 24px;
        }

        .content-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            font-family: 'Abril Fatface', serif;
        }

        .content-text {
            color: #495057;
            line-height: 1.8;
            font-size: 1rem;
            white-space: pre-line;
        }

        .content-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .content-list li {
            padding: 0.75rem 0;
            padding-left: 2rem;
            position: relative;
            color: #495057;
            line-height: 1.7;
        }

        .content-list li::before {
            content: '→';
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Skills Section */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .skill-item {
            background: var(--gradient-primary);
            border: 1px solid rgba(255, 255, 255, 0.6);
            padding: 1.1rem 1.6rem;
            border-radius: 14px;
            text-align: center;
            font-weight: 600;
            color: #1f1f1f;
            letter-spacing: 0.3px;
            box-shadow:
                0 6px 12px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
        }

        .skill-item:hover {
            transform: translateY(-4px);
            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }


        /* Gallery Section */
        .gallery-detail {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-detail-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-detail-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .gallery-detail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-detail-item:hover img {
            transform: scale(1.05);
        }

        .gallery-detail-item::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.8),
                    rgba(0, 0, 0, 0));
            transform: translateY(100%);
            transition: transform 0.35s ease;
        }

        .gallery-detail-item:hover::after {
            transform: translateY(0);
        }

        /* Timeline */
        .timeline-section {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-section::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--gradient-secondary);
        }

        .timeline-item-detail {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-item-detail::before {
            content: '';
            position: absolute;
            left: -2.5rem;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            background: #272727ff;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #181818ff;
        }

        /* Sidebar */
        .sidebar-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 2rem;
        }

        .sidebar-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-family: 'Abril Fatface', serif;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
        }

        .info-value {
            color: #2c3e50;
            font-weight: 600;
            text-align: right;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-hero {
                padding: 3rem 0 2rem;
            }

            .company-header {
                flex-direction: column;
                text-align: center;
            }

            .company-logo-large {
                width: 100px;
                height: 100px;
            }

            .company-info h1 {
                font-size: 2rem;
            }

            .meta-info {
                justify-content: center;
                gap: 1rem;
            }

            .content-card {
                padding: 1.5rem;
            }

            .gallery-detail {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .sidebar-card {
                position: static;
                margin-top: 2rem;
            }

            .detail-actions {
                flex-direction: column;
            }

            .skills-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="detail-hero">
        <div>
            <a href="<?= base_url('/work-experiences'); ?>" class="back-button">&#8592; Back to Experiences</a>
        </div>
        <img src="<?= base_url('images/serious-one.webp') ?>" class="bg-profile-image" alt="bg-profile-image" loading="lazy"
            style="object-fit: cover; 
                object-position: 10% 30%; 
                min-height: 300px; 
                max-height: 500px; 
                width: 100%; 
                position: absolute; 
                z-index: 0; 
                opacity: 0.3;">
        <div class="container">
            <div class="company-header" data-aos="fade-up">
                <?php if ($work_experience['company_logo']): ?>
                    <div class="company-logo-large">
                        <img src="<?= base_url('uploads/company_logos/' . $work_experience['company_logo']) ?>"
                            alt="<?= esc($work_experience['company_name']) ?>">
                    </div>
                <?php endif; ?>
                <div class="company-info">
                    <h1><?= esc($work_experience['position']) ?></h1>
                    <p class="company-name-detail"><?= esc($work_experience['company_name']) ?></p>

                    <div class="meta-info">
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span><?= date('M Y', strtotime($work_experience['start_date'])) ?> -
                                <?= $work_experience['end_date'] ? date('M Y', strtotime($work_experience['end_date'])) : 'Present' ?>
                            </span>
                        </div>
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><?= esc($work_experience['period']) ?></span>
                        </div>
                        <?php if ($work_experience['is_current']): ?>
                            <span class="current-badge-large">Currently Working</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="detail-content">
        <div class="container">
            <div class="row">
                <!-- Main Column -->
                <div class="col-lg-8">
                    <!-- Description -->
                    <?php if ($work_experience['description']): ?>
                        <div class="content-card" data-aos="fade-up">
                            <div class="content-card-header">
                                <div class="content-card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h2 class="content-card-title">Overview</h2>
                            </div>
                            <p class="content-text"><?= nl2br(esc($work_experience['description'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Responsibilities -->
                    <?php if ($work_experience['job_description']): ?>
                        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="content-card-header">
                                <div class="content-card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <h2 class="content-card-title">Key Responsibilities</h2>
                            </div>
                            <div class="timeline-section">
                                <?php
                                $responsibilities = explode("\n", $work_experience['job_description']);
                                foreach ($responsibilities as $resp):
                                    if (trim($resp)):
                                ?>
                                        <div class="timeline-item-detail">
                                            <p class="content-text mb-2"><?= esc(trim($resp)) ?></p>
                                        </div>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Achievements -->
                    <?php if ($work_experience['achievements']): ?>
                        <div class="content-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="content-card-header">
                                <div class="content-card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <h2 class="content-card-title">Achievements</h2>
                            </div>
                            <div class="timeline-section">
                                <?php
                                $achievements = explode("\n", $work_experience['achievements']);
                                foreach ($achievements as $achievement):
                                    if (trim($achievement)):
                                ?>
                                        <div class="timeline-item-detail">
                                            <p class="content-text mb-2"><?= esc(trim($achievement)) ?></p>
                                        </div>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Skills -->
                    <?php if (!empty($work_experience['skills_used'])): ?>
                        <div class="content-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="content-card-header">
                                <div class="content-card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <h2 class="content-card-title">Skills & Technologies</h2>
                            </div>
                            <div class="skills-grid">
                                <?php foreach ($work_experience['skills_used'] as $skill): ?>
                                    <div class="skill-item"><?= esc($skill) ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Gallery -->
                    <?php if (!empty($work_experience['documentation_images'])): ?>
                        <div class="content-card" data-aos="fade-up" data-aos-delay="400">
                            <div class="content-card-header">
                                <div class="content-card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h2 class="content-card-title">Documentation Gallery</h2>
                            </div>
                            <div class="gallery-detail">
                                <?php foreach ($work_experience['documentation_images'] as $image): ?>
                                    <a href="<?= base_url('uploads/documentation/' . $image) ?>"
                                        data-lightbox="experience-gallery"
                                        data-title="<?= esc($work_experience['company_name']) ?>"
                                        class="gallery-detail-item">
                                        <img src="<?= base_url('uploads/documentation/' . $image) ?>"
                                            alt="<?= esc($work_experience['company_name']) ?>">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar-card" data-aos="fade-left">
                        <h3 class="sidebar-title">Experience Details</h3>

                        <div class="info-item">
                            <span class="info-label">Company</span>
                            <span class="info-value"><?= esc($work_experience['company_name']) ?></span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Position</span>
                            <span class="info-value"><?= esc($work_experience['position']) ?></span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Start Date</span>
                            <span class="info-value"><?= date('d M Y', strtotime($work_experience['start_date'])) ?></span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">End Date</span>
                            <span class="info-value">
                                <?= $work_experience['end_date'] ? date('d M Y', strtotime($work_experience['end_date'])) : 'Present' ?>
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Duration</span>
                            <span class="info-value"><?= esc($work_experience['period']) ?></span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="info-value">
                                <?= $work_experience['is_current'] ? '<span style="color: #28a745;">Active</span>' : '<span style="color: #6c757d;">Completed</span>' ?>
                            </span>
                        </div>

                        <?php if (!empty($work_experience['skills_used'])): ?>
                            <div class="info-item">
                                <span class="info-label">Skills Used</span>
                                <span class="info-value"><?= count($work_experience['skills_used']) ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($work_experience['documentation_images'])): ?>
                            <div class="info-item">
                                <span class="info-label">Documentation</span>
                                <span class="info-value"><?= count($work_experience['documentation_images']) ?> images</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true,
            easing: 'ease-out'
        });

        // Lightbox configuration
        lightbox.option({
            'resizeDuration': 300,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2',
            'fadeDuration': 300,
            'imageFadeDuration': 300
        });
        // Smooth scroll for back button
        document.querySelector('.back-button-detail').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = this.href;
        });
    </script>
</body>

</html>