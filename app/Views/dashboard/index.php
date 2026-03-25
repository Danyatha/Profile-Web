<?php helper('text'); ?>
<?= $this->extend('layout/default'); ?>
<?= $this->section('content'); ?>

<div id="imgModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
</div>

<section class="main-content">
    <div class="container">
        <section class="welcome-text text-center py-5">
            <h1 class="fw-bold">
                Welcome!
                <span class="d-block fs-4 fw-normal text-muted">
                    Glad to see you here
                </span>
            </h1>
            <p class="mt-3 mx-auto text-secondary" style="max-width: 600px;">
                Hi! Welcome to my space. Here, I share a bit about who I am, what I do, and what I'm currently working on.
            </p>
        </section>

        <div class="menu-grid">
            <div class="container">
                <div class="row g-4">
                    <!-- About Me Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('profile') ?>" class="menu-card d-block text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                <img src="images/about-me.webp" alt="About Me" class="card-img-top" style="height:200px; object-fit:cover;" loading="lazy">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 fw-bold">About Me</h3>
                                    <p class="card-text text-muted flex-grow-1">This is where I share my journey, my passions, and what I'm currently focused on.</p>
                                    <div class="btn btn-primary mt-3">See My Profile</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Portfolio Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('portfolio') ?>" class="menu-card d-block text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                <img src="<?= base_url('images/trolling-one.webp') ?>" alt="Portfolio" class="card-img-top" style="height:200px; object-fit:cover; object-position:50% 35%;" loading="lazy">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 fw-bold">Portfolio</h3>
                                    <p class="card-text text-muted flex-grow-1">This is where I showcase my projects, work, and things I've built along the way.</p>
                                    <div class="btn btn-primary mt-3">See My Portfolio</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Skills Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('skills') ?>" class="menu-card d-block text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                <img src="<?= base_url('images/skills.webp') ?>" alt="Skills" class="card-img-top" style="height:200px; object-fit:cover; object-position:50% 60%;" loading="lazy">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 fw-bold">Skills</h3>
                                    <p class="card-text text-muted flex-grow-1">This is where I share what I can do and how I develop myself through my passions.</p>
                                    <div class="btn btn-primary mt-3">See My Skills</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Work Experiences Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('work-experiences') ?>" class="menu-card d-block text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                <img src="<?= base_url('images/serious-one.webp') ?>" alt="Work Experience" class="card-img-top" style="height:200px; object-fit:cover;" loading="lazy">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 fw-bold">Work Experiences</h3>
                                    <p class="card-text text-muted flex-grow-1">Here's a look at my work experience and what I've learned along the way.</p>
                                    <div class="btn btn-primary mt-3">See My Work Experiences</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Certifications Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('achievement') ?>" class="menu-card d-block text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                <img src="<?= base_url('images/work-experience.webp') ?>" alt="Certifications" class="card-img-top" style="height:200px; object-fit:cover; object-position:50% 60%;" loading="lazy">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 fw-bold">Certifications & Achievements</h3>
                                    <p class="card-text text-muted flex-grow-1">Recognitions and certifications that highlight my growth and expertise.</p>
                                    <div class="btn btn-primary mt-3">See My Achievements</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Contact Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('social-media') ?>" class="menu-card d-block text-decoration-none">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                <img src="<?= base_url('images/call-me.webp') ?>" alt="Contact" class="card-img-top" style="height:200px; object-fit:cover; object-position:50% 60%;" loading="lazy">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title h5 fw-bold">Let's Connect</h3>
                                    <p class="card-text text-muted flex-grow-1">Let's connect and talk about ideas, projects, or anything interesting.</p>
                                    <div class="btn btn-primary mt-3">Get in Touch</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Features Section -->
<section class="features" id="skills">
    <div class="container">
        <div class="section-title">
            <h1 style="color: var(--navy-blue);">What I'm <span style="color: orange; font-family:'Abril Fatface'; font-weight: 400px;">Interested In</span></h1>
        </div>
        <div class="features-grid">
            <!-- Lingkungan -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C5.878 0 4 1.79 4 4c0 2.473 2.121 5.412 3.324 6.91a.86.86 0 0 0 1.352 0C9.879 9.412 12 6.473 12 4c0-2.21-1.878-4-4-4z" />
                        <path d="M2 14s1-1 6-1 6 1 6 1-1 2-6 2-6-2-6-2z" />
                    </svg>
                </div>
                <h3 class="card-title h5 fw-bold">Environmental Engineering & Sustainability</h3>
                <p class="card-text text-muted flex-grow-1">
                    Passionate about planning and managing sustainable environmental infrastructure,
                    with a focus on water systems, waste management, and the development of efficient,
                    safe, and eco-friendly environments.
                </p>
            </div>
            <!-- IT -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 2h12v8H2V2zm0 9h12v1H2v-1zm4 2h4v1H6v-1z" />
                    </svg>
                </div>
                <h3 class="card-title h5 fw-bold">Information Technology & Digital Systems</h3>
                <p class="card-text text-muted flex-grow-1">
                    Passionate about information technology, with a focus on digital systems,
                    software development, automation, and data processing to enhance efficiency
                    and performance.
                </p>
            </div>
            <!-- Integrasi -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3 3h10v10H3V3zm1 1v8h8V4H4z" />
                        <path d="M8 5v6M5 8h6" stroke="currentColor" stroke-width="1" />
                    </svg>
                </div>
                <h3 class="card-title h5 fw-bold">Integration of Engineering and Technology</h3>
                <p class="card-text text-muted flex-grow-1">
                    Focused on applying information technology to support engineering solutions,
                    such as monitoring systems, data analysis, and the development of smart infrastructure
                    based on data.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ======================================================== -->
<!-- DAILY JOURNAL / NEWS SECTION                             -->
<!-- ======================================================== -->
<section class="journal-section py-5" id="journal">
    <div class="container">

        <!-- Section Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--navy-blue);">
                    Daily Journal
                    <span style="color: orange; font-family:'Abril Fatface'; font-weight: 400;">& Notes</span>
                </h2>
                <p class="text-muted mb-0">Thoughts, updates, and things I'm currently working on.</p>
            </div>
            <a href="<?= base_url('journal') ?>" class="btn btn-outline-warning px-4">
                View All &rarr;
            </a>
        </div>

        <!-- Journal Cards Grid -->
        <?php if (!empty($journals)): ?>
            <div class="row g-4">
                <?php foreach ($journals as $index => $journal): ?>

                    <!-- Featured (first entry): wide card -->
                    <?php if ($index === 0): ?>
                        <div class="col-12">
                            <a href="<?= base_url('journal/' . $journal['slug']) ?>" class="text-decoration-none">
                                <div class="card shadow-sm border-0 journal-card-featured overflow-hidden">
                                    <div class="row g-0 align-items-stretch">
                                        <?php if (!empty($journal['cover_image'])): ?>
                                            <div class="col-md-5">
                                                <img src="<?= base_url($journal['cover_image']) ?>"
                                                    alt="<?= esc($journal['title']) ?>"
                                                    class="img-fluid h-100 w-100"
                                                    style="object-fit:cover; min-height:260px;"
                                                    loading="lazy">
                                            </div>
                                            <div class="col-md-7 d-flex flex-column p-4">
                                            <?php else: ?>
                                                <div class="col-12 d-flex flex-column p-4">
                                                <?php endif; ?>
                                                <!-- Tag / Category -->
                                                <?php if (!empty($journal['category'])): ?>
                                                    <span class="journal-tag mb-2"><?= esc($journal['category']) ?></span>
                                                <?php endif; ?>

                                                <h3 class="fw-bold mb-2" style="color: var(--navy-blue);">
                                                    <?= esc($journal['title']) ?>
                                                </h3>
                                                <p class="text-muted flex-grow-1">
                                                    <?= character_limiter(strip_tags($journal['content']), 200) ?>
                                                </p>
                                                <div class="d-flex align-items-center gap-3 mt-3">
                                                    <small class="text-muted">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z" />
                                                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                                        </svg>
                                                        <?= date('d M Y', strtotime($journal['created_at'])) ?>
                                                    </small>
                                                    <span class="btn btn-sm btn-primary ms-auto">Read More</span>
                                                </div>
                                                </div>
                                            </div>
                                    </div>
                            </a>
                        </div>

                    <?php else: ?>
                        <!-- Regular cards (index >= 1) — max 3 shown -->
                        <?php if ($index <= 3): ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="<?= base_url('journal/' . $journal['slug']) ?>" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 journal-card overflow-hidden">
                                        <?php if (!empty($journal['cover_image'])): ?>
                                            <img src="<?= base_url($journal['cover_image']) ?>"
                                                alt="<?= esc($journal['title']) ?>"
                                                class="card-img-top"
                                                style="height:180px; object-fit:cover;"
                                                loading="lazy">
                                        <?php else: ?>
                                            <!-- Placeholder if no image -->
                                            <div class="journal-no-img d-flex align-items-center justify-content-center" style="height:180px; background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#b0bcd4" viewBox="0 0 16 16">
                                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
                                                </svg>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-body d-flex flex-column">
                                            <?php if (!empty($journal['category'])): ?>
                                                <span class="journal-tag mb-2"><?= esc($journal['category']) ?></span>
                                            <?php endif; ?>
                                            <h5 class="fw-bold mb-2" style="color: var(--navy-blue);">
                                                <?= esc($journal['title']) ?>
                                            </h5>
                                            <p class="card-text text-muted flex-grow-1 small">
                                                <?= character_limiter(strip_tags($journal['content']), 120) ?>
                                            </p>
                                            <small class="text-muted mt-2">
                                                <?= date('d M Y', strtotime($journal['created_at'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <!-- Empty state -->
            <div class="text-center py-5">
                <div class="mb-3" style="opacity:.35;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#1a2e4a" viewBox="0 0 16 16">
                        <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
                    </svg>
                </div>
                <p class="text-muted">No journal entries yet. Check back soon!</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
    /* ---- Journal Section Styles ---- */
    .journal-section {
        background-color: #f8f9fb;
        border-top: 1px solid #eaecf0;
        border-bottom: 1px solid #eaecf0;
    }

    .journal-tag {
        display: inline-block;
        background-color: rgba(255, 165, 0, 0.12);
        color: #b07800;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: .05em;
        text-transform: uppercase;
        padding: 2px 10px;
        border-radius: 20px;
        width: fit-content;
    }

    .journal-card {
        border-radius: 12px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .journal-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, .1) !important;
    }

    .journal-card-featured {
        border-radius: 14px;
        transition: box-shadow .2s ease;
    }

    .journal-card-featured:hover {
        box-shadow: 0 10px 32px rgba(0, 0, 0, .12) !important;
    }
</style>
<!-- ======================================================== -->
<!-- END DAILY JOURNAL SECTION                               -->
<!-- ======================================================== -->


<!-- About Section -->
<section class="about" id="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>Brief Profile</h2>
                <p style="text-align: justify;"> A final-year student of Environmental Infrastructure Engineering at Universitas
                    Gadjah Mada (UGM), with a strong interest in information technology (IT) and its
                    integration with environmental issues. Experienced in reconstructing complex
                    systems or research through structured and systematic approaches, supported by
                    critical thinking, an optimistic vision, and strategic execution. Adaptable,
                    responsive to change, and capable of working effectively both independently and
                    as part of a team, including in leadership roles.</p>
                <a href="<?= base_url('profile') ?>" class="btn btn-outline-warning px-4 py-2">
                    More Details
                </a>

            </div>
            <div class="about-image">
                <img src="<?= base_url('images/nice-hero.webp') ?>" alt="About Me"
                    style="max-height:400px; width:100%; object-fit:contain;" loading="lazy">
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>