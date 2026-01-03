<!-- Hero Section - Minimalist -->
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-5 fw-light mb-2">Work Experience</h1>
                <p class="text-muted">My professional journey</p>
            </div>
        </div>
    </div>
</section>

<!-- Work Experience List -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php if (!empty($work_experiences)): ?>
                    <div class="experience-list">
                        <?php foreach ($work_experiences as $index => $experience): ?>
                            <div class="experience-card mb-5 pb-5 border-bottom" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                                <!-- Header -->
                                <div class="d-flex align-items-start mb-3">
                                    <?php if ($experience['company_logo']): ?>
                                        <img src="<?= base_url('uploads/company_logos/' . $experience['company_logo']) ?>"
                                            alt="<?= esc($experience['company_name']) ?>"
                                            class="rounded me-3"
                                            style="width: 48px; height: 48px; object-fit: contain;">
                                    <?php endif; ?>
                                    <div class="flex-grow-1">
                                        <h3 class="h5 mb-1 fw-semibold"><?= esc($experience['position']) ?></h3>
                                        <p class="text-muted mb-1"><?= esc($experience['company_name']) ?></p>
                                        <p class="text-muted small mb-0">
                                            <?= date('M Y', strtotime($experience['start_date'])) ?> -
                                            <?= $experience['end_date'] ? date('M Y', strtotime($experience['end_date'])) : 'Present' ?>
                                            <span class="mx-1">·</span>
                                            <?= esc($experience['period']) ?>
                                            <?php if ($experience['is_current']): ?>
                                                <span class="mx-1">·</span>
                                                <span class="text-success">Current</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Description -->
                                <?php if ($experience['description']): ?>
                                    <div class="mb-3">
                                        <p class="text-secondary mb-0" style="line-height: 1.7;"><?= nl2br(esc($experience['description'])) ?></p>
                                    </div>
                                <?php endif; ?>

                                <!-- Job Description -->
                                <?php if ($experience['job_description']): ?>
                                    <div class="mb-3">
                                        <p class="small text-uppercase text-muted mb-2 fw-semibold">Responsibilities</p>
                                        <div class="text-secondary small" style="line-height: 1.8;"><?= nl2br(esc($experience['job_description'])) ?></div>
                                    </div>
                                <?php endif; ?>

                                <!-- Achievements -->
                                <?php if ($experience['achievements']): ?>
                                    <div class="mb-3">
                                        <p class="small text-uppercase text-muted mb-2 fw-semibold">Achievements</p>
                                        <div class="text-secondary small" style="line-height: 1.8;"><?= nl2br(esc($experience['achievements'])) ?></div>
                                    </div>
                                <?php endif; ?>

                                <!-- Skills -->
                                <?php if (!empty($experience['skills_used'])): ?>
                                    <div class="mb-3">
                                        <p class="small text-uppercase text-muted mb-2 fw-semibold">Skills</p>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php foreach ($experience['skills_used'] as $skill): ?>
                                                <span class="badge bg-light text-dark border-0 px-3 py-2 fw-normal" style="font-size: 0.875rem;"><?= esc($skill) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Documentation Images -->
                                <?php if (!empty($experience['documentation_images'])): ?>
                                    <div class="mt-4">
                                        <p class="small text-uppercase text-muted mb-3 fw-semibold">Gallery</p>
                                        <div class="row g-2">
                                            <?php foreach ($experience['documentation_images'] as $imgIndex => $image): ?>
                                                <?php if ($imgIndex < 6): // Limit to 6 images 
                                                ?>
                                                    <div class="col-4 col-md-3">
                                                        <a href="<?= base_url('uploads/documentation/' . $image) ?>"
                                                            data-lightbox="experience-<?= $experience['id'] ?>"
                                                            data-title="<?= esc($experience['company_name']) ?>">
                                                            <img src="<?= base_url('uploads/documentation/' . $image) ?>"
                                                                alt="Documentation"
                                                                class="img-fluid rounded"
                                                                style="height: 120px; object-fit: cover; width: 100%; cursor: pointer; transition: opacity 0.2s;">
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php if (count($experience['documentation_images']) > 6): ?>
                                                <div class="col-12">
                                                    <p class="text-muted small mb-0">+<?= count($experience['documentation_images']) - 6 ?> more images</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-briefcase text-muted mb-3" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <h5 class="text-muted fw-light">No work experience yet</h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Simple Stats -->
<?php if (!empty($work_experiences)): ?>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="row text-center g-4">
                        <div class="col-3">
                            <h3 class="h2 fw-light mb-1"><?= count($work_experiences) ?></h3>
                            <p class="text-muted small mb-0">Roles</p>
                        </div>
                        <div class="col-3">
                            <h3 class="h2 fw-light mb-1"><?= count(array_unique(array_column($work_experiences, 'company_name'))) ?></h3>
                            <p class="text-muted small mb-0">Companies</p>
                        </div>
                        <div class="col-3">
                            <h3 class="h2 fw-light mb-1">
                                <?php
                                $totalYears = 0;
                                foreach ($work_experiences as $exp) {
                                    $start = new DateTime($exp['start_date']);
                                    $end = $exp['end_date'] ? new DateTime($exp['end_date']) : new DateTime();
                                    $totalYears += $start->diff($end)->y;
                                }
                                echo $totalYears > 0 ? $totalYears . '+' : '<1';
                                ?>
                            </h3>
                            <p class="text-muted small mb-0">Years</p>
                        </div>
                        <div class="col-3">
                            <h3 class="h2 fw-light mb-1">
                                <?php
                                $allSkills = [];
                                foreach ($work_experiences as $exp) {
                                    $allSkills = array_merge($allSkills, $exp['skills_used']);
                                }
                                echo count(array_unique($allSkills));
                                ?>
                            </h3>
                            <p class="text-muted small mb-0">Skills</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<style>
    .experience-card {
        position: relative;
    }

    .experience-card:last-child {
        border-bottom: none !important;
    }

    .experience-card img[alt="Documentation"]:hover {
        opacity: 0.85;
    }

    .badge {
        background-color: #f8f9fa !important;
        color: #6c757d !important;
    }

    @media (max-width: 768px) {
        .experience-card img[alt*="company"] {
            width: 40px !important;
            height: 40px !important;
        }

        .display-5 {
            font-size: 2rem;
        }
    }

    /* Smooth hover effect for images */
    a img {
        transition: all 0.2s ease;
    }

    a:hover img {
        opacity: 0.85;
    }

    /* Clean border style */
    .border-bottom {
        border-color: #e9ecef !important;
    }
</style>

<!-- Lightbox CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- AOS Animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 600,
        once: true,
        easing: 'ease-out'
    });

    // Lightbox options
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': 'Image %1 of %2'
    });
</script>