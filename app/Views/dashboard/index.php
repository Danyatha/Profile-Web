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

<!-- CTA Section -->
<!-- <section class="cta" id="contact">
    <div class="container">
        <h2>Mari Berkolaborasi!</h2>
        <p>Punya proyek menarik atau ingin sekadar ngobrol tentang teknologi? Saya selalu terbuka untuk peluang kolaborasi baru.</p>
        <a href="#" class="btn">Hubungi Saya</a>
    </div>
</section> -->

<?php $this->endSection(); ?>