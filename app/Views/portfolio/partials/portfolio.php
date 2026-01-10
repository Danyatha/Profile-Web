<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-5"><?= esc($title) ?></h1>
                <p class="text-muted"><?= esc($subtitle) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 filter-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-3 mb-md-0 filter-title">
                    <i class="fas fa-filter"></i> Filter Technology
                </h5>
            </div>
            <div class="btn-group flex-wrap" role="group" style="max-width: 300px;">

                <a href="<?= base_url('portfolio') ?>"
                    class="btn btn-filter <?= empty($tech_filter) ? 'active' : '' ?>">
                    All
                </a>

                <?php foreach ($technologies as $tech): ?>
                    <a href="<?= base_url('portfolio-filter?tech=' . urlencode($tech)) ?>"
                        class="btn btn-filter <?= ($tech_filter === $tech) ? 'active' : '' ?>">
                        <?= esc($tech) ?>
                    </a>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="py-5" id="portfolio">
    <div class="container">
        <?php if (isset($tech_filter)): ?>
            <div class="alert alert-custom">
                Showing portfolio with technology: <strong><?= esc($tech_filter) ?></strong>
            </div>
        <?php endif; ?>

        <?php if (empty($portfolios)): ?>
            <div class="text-center py-5 empty-state">
                <i class="fas fa-folder-open fa-5x mb-4"></i>
                <h3>No Portfolio Yet</h3>
                <p>Portfolio items will be displayed here soon.</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($portfolios as $index => $portfolio): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 portfolio-card">
                            <?php if ($portfolio['images_path']): ?>
                                <div class="portfolio-image-wrapper">
                                    <img src="<?= base_url($portfolio['images_path']) ?>"
                                        class="card-img-top portfolio-image"
                                        alt="<?= esc($portfolio['project_name']) ?>">
                                    <div class="portfolio-overlay">
                                        <button class="btn btn-overlay"
                                            onclick="showPortfolioDetail(<?= $portfolio['id'] ?>)">
                                            <i class="fas fa-eye"></i> View Details
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="portfolio-image-wrapper">
                                    <div class="card-img-top portfolio-placeholder d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image fa-4x"></i>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= esc($portfolio['project_name']) ?></h5>
                                <p class="card-text">
                                    <?= strlen($portfolio['description']) > 100
                                        ? esc(substr($portfolio['description'], 0, 100)) . '...'
                                        : esc($portfolio['description']); ?>
                                </p>

                                <?php if ($portfolio['technologies_used']): ?>
                                    <div class="mb-3">
                                        <?php
                                        $techs = explode(',', $portfolio['technologies_used']);
                                        foreach ($techs as $tech):
                                        ?>
                                            <span class="badge-tech me-1 mb-1">
                                                <?= trim(esc($tech)) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-footer bg-transparent border-0 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-dark btn-sm"
                                        onclick="showPortfolioDetail(<?= $portfolio['id'] ?>)">
                                        <i class="fas fa-info-circle"></i> Details
                                    </button>

                                    <?php if ($portfolio['project_url']): ?>
                                        <a href="<?= esc($portfolio['project_url']) ?>"
                                            target="_blank"
                                            class="btn btn-dark btn-sm">
                                            <i class="fas fa-external-link-alt"></i> Live Demo
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Modal Portfolio Detail -->
<div class="modal fade" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="portfolioModalLabel">Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="portfolioModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --color-black: #000000;
        --color-dark-gray: #1a1a1a;
        --color-medium-gray: #333333;
        --color-light-gray: #666666;
        --color-border: #e0e0e0;
        --color-bg-light: #f8f8f8;
        --color-white: #ffffff;
        --shadow-subtle: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-medium: 0 4px 16px rgba(0, 0, 0, 0.12);
        --shadow-strong: 0 8px 24px rgba(0, 0, 0, 0.16);
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

    .filter-section {
        background: var(--color-bg-light);
        border-bottom: 1px solid var(--color-border);
    }

    .filter-title {
        color: var(--color-dark-gray);
        font-weight: 400;
        letter-spacing: 0.3px;
    }

    .btn-filter {
        background: var(--color-white);
        color: var(--color-medium-gray);
        border: 1px solid var(--color-border);
        padding: 0.5rem 1.25rem;
        font-weight: 400;
        letter-spacing: 0.3px;
        transition: all 0.2s ease;
    }

    .btn-filter:hover {
        background: var(--color-dark-gray);
        color: var(--color-white);
        border-color: var(--color-dark-gray);
    }

    .btn-filter.active {
        background: var(--color-black);
        color: var(--color-white);
        border-color: var(--color-black);
    }

    .alert-custom {
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-left: 3px solid var(--color-black);
        color: var(--color-dark-gray);
        padding: 1rem 1.5rem;
    }

    .empty-state {
        color: var(--color-light-gray);
    }

    .empty-state i {
        color: var(--color-border);
    }

    .portfolio-card {
        border: 1px solid var(--color-border);
        background: var(--color-white);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .portfolio-card:hover {
        box-shadow: var(--shadow-strong);
    }

    .portfolio-image-wrapper {
        position: relative;
        overflow: hidden;
        background: var(--color-bg-light);
    }

    .portfolio-image {
        height: 280px;
        object-fit: cover;
        width: 100%;
        display: block;
    }

    .portfolio-placeholder {
        height: 280px;
        background: linear-gradient(135deg, var(--color-dark-gray) 0%, var(--color-black) 100%);
        color: rgba(255, 255, 255, 0.2);
    }

    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }

    .btn-overlay {
        background: var(--color-white);
        color: var(--color-black);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .btn-overlay:hover {
        background: var(--color-bg-light);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-weight: 500;
        color: var(--color-black);
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        letter-spacing: 0.3px;
    }

    .card-text {
        color: var(--color-light-gray);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .badge-tech {
        display: inline-block;
        background: var(--color-dark-gray);
        color: var(--color-white);
        padding: 0.35rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 400;
        letter-spacing: 0.5px;
        border-radius: 2px;
    }

    .card-footer .btn {
        letter-spacing: 0.3px;
        font-weight: 400;
    }

    .modal-content {
        border: 1px solid var(--color-border);
        border-radius: 0;
    }

    .modal-header {
        background: var(--color-white);
        border-bottom: 1px solid var(--color-border);
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 400;
        color: var(--color-black);
        letter-spacing: 0.3px;
    }

    .modal-body {
        padding: 2rem;
        background: var(--color-white);
    }

    .modal-footer {
        background: var(--color-bg-light);
        border-top: 1px solid var(--color-border);
        padding: 1rem 1.5rem;
    }

    #portfolioModalBody img {
        border: 1px solid var(--color-border);
        border-radius: 0;
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }

    #portfolioModalBody h3 {
        font-weight: 400;
        color: var(--color-black);
        letter-spacing: 0.3px;
    }

    #portfolioModalBody h6 {
        font-weight: 500;
        color: var(--color-medium-gray);
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.75rem;
    }

    #portfolioModalBody .text-secondary {
        color: var(--color-light-gray) !important;
        line-height: 1.7;
    }

    #portfolioModalBody .btn-primary {
        background: var(--color-black);
        border-color: var(--color-black);
        color: var(--color-white);
        padding: 0.5rem 1.25rem;
        font-weight: 400;
    }

    #portfolioModalBody .btn-primary:hover {
        background: var(--color-dark-gray);
        border-color: var(--color-dark-gray);
    }

    #portfolioModalBody .btn-outline-primary,
    #portfolioModalBody .btn-outline-info,
    #portfolioModalBody .btn-outline-success {
        border-color: var(--color-border);
        color: var(--color-medium-gray);
    }

    #portfolioModalBody .btn-outline-primary:hover,
    #portfolioModalBody .btn-outline-info:hover,
    #portfolioModalBody .btn-outline-success:hover {
        background: var(--color-black);
        border-color: var(--color-black);
        color: var(--color-white);
    }

    .spinner-border {
        color: var(--color-black);
    }
</style>

<script>
    // Portfolio data for modal
    const portfolioData = <?= json_encode($portfolios) ?>;

    function showPortfolioDetail(id) {
        // Find portfolio data by ID
        const portfolio = portfolioData.find(p => p.id == id);

        if (!portfolio) {
            alert('Portfolio not found');
            return;
        }

        // Generate technology badges
        let techBadges = '';
        if (portfolio.technologies_used) {
            const techs = portfolio.technologies_used.split(',');
            techs.forEach(tech => {
                techBadges += `<span class="badge-tech me-1 mb-1">${tech.trim()}</span>`;
            });
        }

        // Generate social share buttons
        const currentUrl = window.location.href;
        const shareText = encodeURIComponent(portfolio.project_name);

        // Build modal content
        const modalContent = `
        <div class="row g-4">
            <div class="col-12">
                ${portfolio.images_path ? `
                    <img src="${portfolio.images_path.startsWith('http') ? portfolio.images_path : '<?= base_url() ?>/' + portfolio.images_path}" 
                         alt="${portfolio.project_name}" 
                         class="img-fluid mb-3">
                ` : `
                    <div class="portfolio-placeholder rounded d-flex align-items-center justify-content-center mb-3" 
                         style="height: 300px;">
                        <i class="fas fa-image fa-5x"></i>
                    </div>
                `}
            </div>
            
            <div class="col-12">
                <h3 class="mb-4">${portfolio.project_name}</h3>
                
                ${portfolio.description ? `
                    <div class="mb-4">
                        <h6 class="mb-2"><i class="fas fa-align-left"></i> Description</h6>
                        <p class="text-secondary">${portfolio.description.replace(/\n/g, '<br>')}</p>
                    </div>
                ` : ''}
                
                ${portfolio.technologies_used ? `
                    <div class="mb-4">
                        <h6 class="mb-2"><i class="fas fa-code"></i> Technologies</h6>
                        <div>${techBadges}</div>
                    </div>
                ` : ''}
                
                ${portfolio.project_url ? `
                    <div class="mb-4">
                        <h6 class="mb-2"><i class="fas fa-link"></i> Project Link</h6>
                        <a href="${portfolio.project_url}" 
                           target="_blank" 
                           class="btn btn-primary">
                            <i class="fas fa-external-link-alt"></i> Visit Website
                        </a>
                    </div>
                ` : ''}
                
                <div class="mb-3">
                    <h6 class="mb-2"><i class="fas fa-calendar"></i> Date</h6>
                    <p class="mb-0 text-secondary">${new Date(portfolio.created_at).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })}</p>
                </div>
                
                <div class="mt-4 pt-3 border-top">
                    <h6 class="mb-2"><i class="fas fa-share-alt"></i> Share</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=${currentUrl}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=${currentUrl}&text=${shareText}" 
                           target="_blank" 
                           class="btn btn-outline-info btn-sm">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                        <a href="https://wa.me/?text=${shareText}%20${currentUrl}" 
                           target="_blank" 
                           class="btn btn-outline-success btn-sm">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    `;

        // Update modal content
        document.getElementById('portfolioModalBody').innerHTML = modalContent;
        document.getElementById('portfolioModalLabel').textContent = portfolio.project_name;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('portfolioModal'));
        modal.show();
    }
</script>