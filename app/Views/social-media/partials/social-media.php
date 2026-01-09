<section class="social-media-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title mb-3">Let's Connect</h2>
                <p class="section-subtitle">Follow my journey across social platforms and stay updated with my latest work</p>
            </div>
        </div>

        <?php if (!empty($socialMediaLinks)): ?>
            <div class="row justify-content-center g-4">
                <?php foreach ($socialMediaLinks as $social): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="<?= esc($social['profile_url']) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-card text-decoration-none">
                            <div class="card h-100 border-0 hover-lift">
                                <div class="card-shine"></div>
                                <div class="card-body text-center p-4">
                                    <?php if (!empty($social['icon_class'])): ?>
                                        <div class="social-icon-wrapper mb-3">
                                            <div class="icon-glow"></div>
                                            <img src="<?= base_url('upload/icon_class/' . $social['icon_class']) ?>"
                                                alt="<?= esc($social['platform_name']) ?>"
                                                class="social-icon-img">
                                        </div>
                                    <?php else: ?>
                                        <div class="social-icon-wrapper mb-3">
                                            <div class="icon-glow"></div>
                                            <i class="fas fa-link social-icon-fallback"></i>
                                        </div>
                                    <?php endif; ?>
                                    <h5 class="card-title mb-2"><?= esc($social['platform_name']) ?></h5>
                                    <div class="card-divider"></div>
                                    <p class="card-text mb-0">
                                        <span class="visit-text">Visit Profile</span>
                                        <i class="fas fa-arrow-right visit-arrow"></i>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="empty-state">
                        <i class="fas fa-info-circle mb-3"></i>
                        <p class="mb-0">No social media links available at the moment.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    /* Social Media Section - Clean Minimalist Theme */
    .social-media-section {
        background: #ffffff;
        position: relative;
        overflow: hidden;
        padding: 5rem 0;
    }

    .social-media-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: -50%;
        width: 200%;
        height: 100%;
        background:
            radial-gradient(ellipse at 30% 20%, rgba(0, 0, 0, 0.015) 0%, transparent 50%),
            radial-gradient(ellipse at 70% 80%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        pointer-events: none;
        animation: subtleMove 20s ease-in-out infinite;
    }

    @keyframes subtleMove {

        0%,
        100% {
            transform: translateX(0) translateY(0);
        }

        50% {
            transform: translateX(2%) translateY(1%);
        }
    }

    .section-title {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #1a1a1a 0%, #4a4a4a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        display: inline-block;
        letter-spacing: -2px;
        font-family: 'Playfair Display', 'Georgia', serif;
        line-height: 1.2;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #1a1a1a 20%, #1a1a1a 80%, transparent 100%);
    }

    .section-subtitle {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #666666;
        font-weight: 400;
        letter-spacing: 0.3px;
        max-width: 600px;
        margin: 0 auto;
    }

    .social-card {
        display: block;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .social-card:hover {
        transform: translateY(-12px);
    }

    .social-card .card {
        background: #ffffff;
        border: 1px solid #e8e8e8;
        border-radius: 20px;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow:
            0 4px 20px rgba(0, 0, 0, 0.04),
            0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .card-shine {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg,
                transparent 30%,
                rgba(255, 255, 255, 0.8) 50%,
                transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
        z-index: 1;
    }

    .social-card:hover .card {
        border-color: #d0d0d0;
        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 8px 20px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        transform: scale(1.02);
    }

    .social-card:hover .card-shine {
        opacity: 1;
        animation: shine 1.5s ease;
    }

    @keyframes shine {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }

        100% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
    }

    .hover-lift {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .social-icon-wrapper {
        position: relative;
        width: 90px;
        height: 90px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-glow {
        position: absolute;
        width: 120%;
        height: 120%;
        background: radial-gradient(circle, rgba(0, 0, 0, 0.05) 0%, transparent 70%);
        border-radius: 50%;
        opacity: 0;
        transition: all 0.5s ease;
    }

    .social-card:hover .icon-glow {
        opacity: 1;
        transform: scale(1.3);
    }

    .social-icon-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        position: relative;
        z-index: 2;
        filter: grayscale(0%) contrast(1.1);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .social-card:hover .social-icon-img {
        filter: brightness(1.1) contrast(1.15);
        transform: scale(1.1);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .social-icon-fallback {
        font-size: 2.5rem;
        color: #999999;
        position: relative;
        z-index: 2;
        transition: all 0.5s ease;
        width: 90px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        border-radius: 50%;
    }

    .social-card:hover .social-icon-fallback {
        color: #1a1a1a;
        transform: scale(1.1);
        background: linear-gradient(135deg, #e8e8e8 0%, #d0d0d0 100%);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 1.25rem;
        letter-spacing: 0.3px;
        transition: all 0.4s ease;
        font-family: 'Inter', 'Helvetica Neue', sans-serif;
        position: relative;
    }

    .social-card:hover .card-title {
        letter-spacing: 1.5px;
        color: #000000;
    }

    .card-divider {
        width: 35px;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #d0d0d0 50%, transparent 100%);
        margin: 15px auto;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 2px;
    }

    .social-card:hover .card-divider {
        width: 70px;
        background: linear-gradient(90deg, transparent 0%, #1a1a1a 50%, transparent 100%);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-text {
        font-size: 0.9rem;
        color: #888888;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.4s ease;
        font-weight: 500;
    }

    .visit-text {
        transition: all 0.4s ease;
        letter-spacing: 0.5px;
    }

    .visit-arrow {
        font-size: 0.8rem;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        transform: translateX(-15px);
    }

    .social-card:hover .card-text {
        color: #1a1a1a;
    }

    .social-card:hover .visit-text {
        letter-spacing: 1px;
    }

    .social-card:hover .visit-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    .empty-state {
        background: linear-gradient(145deg, #fafafa 0%, #ffffff 100%);
        border: 2px solid #e8e8e8;
        border-radius: 20px;
        padding: 4rem 2rem;
        color: #888888;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #cccccc;
        display: block;
    }

    .empty-state p {
        font-size: 1.05rem;
        letter-spacing: 0.3px;
        color: #666666;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .social-media-section {
            padding: 3rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            letter-spacing: -1px;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .social-icon-wrapper {
            width: 70px;
            height: 70px;
        }

        .social-icon-img,
        .social-icon-fallback {
            width: 70px;
            height: 70px;
        }

        .card-title {
            font-size: 1.1rem;
        }
    }

    /* Premium animation for reduced motion preference */
    @media (prefers-reduced-motion: no-preference) {

        .social-card,
        .social-card .card,
        .social-icon-img {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
    }

    /* Hover state for entire section */
    .social-media-section:hover .section-title::after {
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }
</style>

<script>
    // Premium interaction effects
    document.querySelectorAll('.social-card').forEach(card => {
        card.addEventListener('click', function(e) {
            const platform = this.querySelector('.card-title').textContent;
            console.log(`User clicked on ${platform}`);

            // Sophisticated click feedback
            this.style.transform = 'translateY(-10px) scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });

        // Elegant 3D tilt effect on mouse move
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 15;
            const rotateY = (centerX - x) / 15;

            this.querySelector('.card').style.transform =
                `perspective(1200px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
        });

        card.addEventListener('mouseleave', function() {
            this.querySelector('.card').style.transform = '';
        });
    });

    // Add subtle parallax scroll effect
    window.addEventListener('scroll', function() {
        const section = document.querySelector('.social-media-section');
        const scrolled = window.pageYOffset;
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;

        if (scrolled > sectionTop - window.innerHeight && scrolled < sectionTop + sectionHeight) {
            const parallax = (scrolled - sectionTop) * 0.05;
            section.querySelector('.section-title').style.transform = `translateY(${parallax}px)`;
        }
    });
</script>