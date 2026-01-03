<style>
    /* Hero Section */
    :root {
        --gradient-primary: linear-gradient(135deg, #f8f9ff 0%, #f1f3ff 100%);
        --gradient-secondary: linear-gradient(135deg, #444 0%, #111 100%);
    }

    .hero-section {
        background: var(--gradient-primary);
        border-bottom: 1px solid #e3e6f0;
        padding: 3rem 0;
    }

    .hero-section .display-5 {
        font-size: 2.5rem;
        font-weight: 300;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .hero-section .text-muted {
        font-size: 1.1rem;
        color: #6c757d;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 2rem 0;
        border-bottom: 1px solid #e3e6f0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .filter-pills {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .filter-pill {
        padding: 0.6rem 1.5rem;
        border: 2px solid #e3e6f0;
        border-radius: 25px;
        background: white;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .filter-pill:hover {
        border-color: #555;
        color: #222;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .filter-pill.active {
        background: linear-gradient(135deg, #444 0%, #111 100%);
        border-color: #333;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    /* Experience Card - 2 Column Layout */
    .experience-card {
        background: white;
        border-radius: 20px;
        padding: 0;
        margin-bottom: 2.5rem;
        box-shadow:
            0 2px 6px rgba(0, 0, 0, 0.2),
            0 12px 24px rgba(0, 0, 0, 0.35);

        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        overflow: hidden;
    }

    .experience-card:hover {
        transform:
            translateY(-5px),
            scale(2);
        box-shadow: 0 8px 35px rgba(0, 0, 0, 0.5);
    }

    .experience-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    /* Left Column - Content */
    .experience-left {
        padding: 2.5rem;
        border-right: 1px solid #f0f0f0;
        position: relative;
    }

    .experience-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--gradient-primary);
    }

    /* Right Column - Gallery Carousel */
    .experience-right {
        padding: 2.5rem;
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Company Header */
    .company-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .company-logo-wrapper {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
        margin-right: 1rem;
    }

    .company-logo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: white;
        padding: 8px;
    }

    .position-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #313233ff;
        margin-bottom: 0.25rem;
        font-family: 'Segoe UI', sans-serif;
    }

    .company-name {
        font-size: 1.1rem;
        color: black;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .period-info {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .period-info .current-badge {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }

    /* Section Labels */
    .section-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: black;
        margin-bottom: 0.75rem;
        margin-top: 1.5rem;
    }

    /* Description Text */
    .description-text {
        color: #495057;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    /* Skills Badges */
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }

    .skill-badge {
        background: var(--gradient-primary);
        color: black;

        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .skill-badge:hover {
        background: var(--gradient-secondary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 34, 34, 0.3);
    }

    /* Carousel Styling */
    .gallery-carousel {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .gallery-carousel .carousel-item {
        height: 400px;
    }

    .gallery-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .gallery-carousel .carousel-control-prev,
    .gallery-carousel .carousel-control-next {
        width: 50px;
        height: 50px;
        background: rgba(27, 27, 27, 0.9);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .gallery-carousel:hover .carousel-control-prev,
    .gallery-carousel:hover .carousel-control-next {
        opacity: 1;
    }

    .gallery-carousel .carousel-control-prev {
        left: 15px;
    }

    .gallery-carousel .carousel-control-next {
        right: 15px;
    }

    .gallery-carousel .carousel-indicators {
        bottom: 15px;
    }

    .gallery-carousel .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.6);
    }

    .gallery-carousel .carousel-indicators button.active {
        background-color: #19191aff;
        opacity: 20%;
    }

    .no-gallery {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }

    .no-gallery svg {
        opacity: 0.3;
        margin-bottom: 1rem;
    }

    /* Action Button */
    .btn-detail {
        background: var(--gradient-secondary);
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        margin-top: 1.5rem;
        box-shadow:
            0 2px 6px rgba(0, 0, 0, 0.2),
            0 12px 24px rgba(0, 0, 0, 0.35);

    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(41, 41, 41, 0.7);
        color: white;
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        padding: 3rem 0;
        border-top: 1px solid #e3e6f0;
    }

    .stat-card {
        text-align: center;
        padding: 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 300;
        color: #202020ff;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(135deg, #f8f9ff 0%, #f1f3ff 100%);
        border-radius: 20px;
    }

    .empty-state svg {
        color: #2a2a2bff;
        opacity: 0.5;
        margin-bottom: 1.5rem;
    }

    .empty-state h5 {
        color: #6c757d;
        font-weight: 400;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .experience-content-wrapper {
            grid-template-columns: 1fr;
        }

        .experience-left {
            border-right: none;
            border-bottom: 1px solid #f0f0f0;
        }

        .gallery-carousel .carousel-item {
            height: 300px;
        }
    }

    @media (max-width: 768px) {
        .hero-section .display-5 {
            font-size: 2rem;
        }

        .experience-left,
        .experience-right {
            padding: 1.5rem;
        }

        .position-title {
            font-size: 1.3rem;
        }

        .company-logo-wrapper {
            width: 48px;
            height: 48px;
        }

        .filter-pills {
            gap: 0.5rem;
        }

        .filter-pill {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .gallery-carousel .carousel-item {
            height: 250px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-5">Work Experience</h1>
                <p class="text-muted">My professional journey and achievements</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<?php if (!empty($available_years)): ?>
    <section class="filter-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter-pills">
                        <a href="<?= base_url('work-experiences') ?>"
                            class="filter-pill <?= empty($selected_year) ? 'active' : '' ?>">
                            All Years
                        </a>
                        <?php foreach ($available_years as $year): ?>
                            <a href="<?= base_url('work-experiences?year=' . $year) ?>"
                                class="filter-pill <?= $selected_year == $year ? 'active' : '' ?>">
                                <?= $year ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Work Experience List -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($work_experiences)): ?>
                    <div class="experience-list">
                        <?php foreach ($work_experiences as $index => $experience): ?>
                            <div class="experience-card" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                                <div class="experience-content-wrapper">
                                    <!-- Left Column - Content -->
                                    <div class="experience-left">
                                        <!-- Company Header -->
                                        <div class="company-header">
                                            <?php if ($experience['company_logo']): ?>
                                                <div class="company-logo-wrapper">
                                                    <img src="<?= base_url('uploads/company_logos/' . $experience['company_logo']) ?>"
                                                        alt="<?= esc($experience['company_name']) ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <h3 class="position-title"><?= esc($experience['position']) ?></h3>
                                                <p class="company-name mb-1"><?= esc($experience['company_name']) ?></p>
                                                <p class="period-info mb-0">
                                                    <?= date('M Y', strtotime($experience['start_date'])) ?> -
                                                    <?= $experience['end_date'] ? date('M Y', strtotime($experience['end_date'])) : 'Present' ?>
                                                    <span class="mx-1">•</span>
                                                    <?= esc($experience['period']) ?>
                                                    <?php if ($experience['is_current']): ?>
                                                        <span class="current-badge">Current</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <?php if ($experience['description']): ?>
                                            <div class="mb-3">
                                                <p class="description-text mb-0"><?= nl2br(esc($experience['description'])) ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Job Description -->
                                        <?php if ($experience['job_description']): ?>
                                            <div>
                                                <h4 class="section-label">Responsibilities</h4>
                                                <div class="description-text"><?= nl2br(esc($experience['job_description'])) ?></div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Achievements -->
                                        <?php if ($experience['achievements']): ?>
                                            <div>
                                                <h4 class="section-label">Achievements</h4>
                                                <div class="description-text"><?= nl2br(esc($experience['achievements'])) ?></div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Skills -->
                                        <?php if (!empty($experience['skills_used'])): ?>
                                            <div>
                                                <h4 class="section-label">Skills & Technologies</h4>
                                                <div class="skills-container">
                                                    <?php foreach ($experience['skills_used'] as $skill): ?>
                                                        <span class="skill-badge"><?= esc($skill) ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Action Button -->
                                        <a href="<?= base_url('work-experiences/' . $experience['id']) ?>" class="btn-detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View Full Details
                                        </a>
                                    </div>

                                    <!-- Right Column - Gallery Carousel -->
                                    <div class="experience-right">
                                        <?php if (!empty($experience['documentation_images'])): ?>
                                            <div id="carousel-<?= $experience['id'] ?>" class="carousel slide gallery-carousel" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <?php foreach ($experience['documentation_images'] as $imgIndex => $image): ?>
                                                        <button type="button"
                                                            data-bs-target="#carousel-<?= $experience['id'] ?>"
                                                            data-bs-slide-to="<?= $imgIndex ?>"
                                                            <?= $imgIndex === 0 ? 'class="active" aria-current="true"' : '' ?>
                                                            aria-label="Slide <?= $imgIndex + 1 ?>"></button>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="carousel-inner">
                                                    <?php foreach ($experience['documentation_images'] as $imgIndex => $image): ?>
                                                        <div class="carousel-item <?= $imgIndex === 0 ? 'active' : '' ?>">
                                                            <img src="<?= base_url('uploads/documentation/' . $image) ?>"
                                                                class="d-block w-100"
                                                                alt="<?= esc($experience['company_name']) ?> - Image <?= $imgIndex + 1 ?>">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $experience['id'] ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $experience['id'] ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        <?php else: ?>
                                            <div class="no-gallery">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                                                </svg>
                                                <p class="mb-0">No documentation available</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <h5>No work experience found for <?= $selected_year ? 'year ' . $selected_year : 'selected filter' ?></h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<?php if (!empty($work_experiences)): ?>
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number"><?= count($work_experiences) ?></div>
                        <div class="stat-label">Roles</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number"><?= count(array_unique(array_column($work_experiences, 'company_name'))) ?></div>
                        <div class="stat-label">Companies</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php
                            $totalYears = 0;
                            foreach ($work_experiences as $exp) {
                                $start = new DateTime($exp['start_date']);
                                $end = $exp['end_date'] ? new DateTime($exp['end_date']) : new DateTime();
                                $totalYears += $start->diff($end)->y;
                            }
                            echo $totalYears > 0 ? $totalYears . '+' : '<1';
                            ?>
                        </div>
                        <div class="stat-label">Years</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php
                            $allSkills = [];
                            foreach ($work_experiences as $exp) {
                                $allSkills = array_merge($allSkills, $exp['skills_used']);
                            }
                            echo count(array_unique($allSkills));
                            ?>
                        </div>
                        <div class="stat-label">Skills</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- AOS Animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 600,
        once: true,
        easing: 'ease-out'
    });
</script>