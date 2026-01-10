<style>
    :root {
        --color-dark: #0a0a0a;
        --color-charcoal: #1a1a1a;
        --color-slate: #2a2a2a;
        --color-smoke: #3a3a3a;
        --color-ash: #888888;
        --color-silver: #c0c0c0;
        --color-platinum: #e8e8e8;
        --color-white: #ffffff;
        --color-accent: #f5f5f5;
    }

    .hero-section {
        background: linear-gradient(180deg, var(--color-white) 0%, var(--color-accent) 100%);
        border-bottom: 1px solid var(--color-platinum);
        padding: 4rem 0 3rem;
        position: relative;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: var(--color-dark);
    }

    .hero-section .display-5 {
        font-size: 2.8rem;
        font-weight: 300;
        letter-spacing: -0.02em;
        color: var(--color-dark);
        margin-bottom: 0.75rem;
    }

    .hero-section .text-muted {
        font-size: 1rem;
        font-weight: 300;
        color: var(--color-ash);
        letter-spacing: 0.01em;
    }

    .achievement-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--color-platinum);
        background: var(--color-white);
        overflow: hidden;
        border-radius: 0;
    }

    .achievement-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
        border-color: var(--color-dark);
    }

    .achievement-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: var(--color-charcoal);
    }

    .achievement-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        filter: grayscale(100%) contrast(1.1);
        opacity: 0.85;
    }

    .achievement-card:hover .achievement-image {
        opacity: 1;
        transform: scale(1.03);
        filter: grayscale(0%) contrast(1.15);
    }

    .achievement-image-placeholder {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, var(--color-charcoal) 0%, var(--color-slate) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .achievement-image-placeholder i {
        font-size: 4.5rem;
        color: var(--color-silver);
        transition: all 0.4s ease;
    }

    .achievement-card:hover .achievement-image-placeholder {
        background: linear-gradient(135deg, var(--color-slate) 0%, var(--color-smoke) 100%);
        transform: scale(1.03);
    }

    .achievement-card:hover .achievement-image-placeholder i {
        transform: scale(1.1);
        color: var(--color-platinum);
    }

    .achievement-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .achievement-overlay i {
        color: var(--color-white);
        font-size: 2rem;
        transform: scale(0.8);
        transition: transform 0.4s ease;
    }

    .achievement-card:hover .achievement-overlay {
        opacity: 1;
    }

    .achievement-card:hover .achievement-overlay i {
        transform: scale(1);
    }

    .card-body {
        padding: 2rem 1.75rem;
        background: var(--color-white);
    }

    .badge {
        padding: 0.5rem 1.25rem;
        font-weight: 400;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        border-radius: 0;
    }

    .bg-primary {
        background: var(--color-dark) !important;
        color: var(--color-white) !important;
    }

    .bg-secondary {
        background: transparent !important;
        color: var(--color-ash) !important;
        border: 1px solid var(--color-platinum) !important;
    }

    .text-muted {
        color: var(--color-ash) !important;
    }

    .fw-semibold {
        font-weight: 400 !important;
        color: var(--color-ash) !important;
        font-size: 0.9rem;
    }

    .card-title {
        color: var(--color-dark);
        line-height: 1.4;
        font-weight: 400;
        font-size: 1.25rem;
        letter-spacing: -0.01em;
        margin-bottom: 1.25rem;
    }

    .card-body p {
        color: var(--color-ash);
        font-size: 0.9rem;
        font-weight: 300;
        line-height: 1.6;
    }

    .card-body p i {
        color: var(--color-silver);
        font-size: 0.85rem;
    }

    .card-footer {
        padding: 1.5rem 1.75rem;
        background: transparent !important;
        border-top: 1px solid var(--color-platinum) !important;
    }

    .view-detail-btn {
        transition: all 0.3s ease;
        border: 1px solid var(--color-dark) !important;
        color: var(--color-dark) !important;
        background: transparent !important;
        font-size: 0.85rem;
        font-weight: 400;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 0.75rem 1.5rem;
        border-radius: 0 !important;
    }

    .view-detail-btn:hover {
        background: var(--color-dark) !important;
        color: var(--color-white) !important;
        transform: translateY(-2px);
    }

    .view-detail-btn i {
        transition: transform 0.3s ease;
    }

    .view-detail-btn:hover i {
        transform: translateX(4px);
    }

    .modal-content {
        border: none;
        border-radius: 0;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        padding: 2rem 2.5rem 1.5rem;
        border-bottom: 1px solid var(--color-platinum) !important;
    }

    .modal-title {
        font-weight: 400;
        font-size: 1.5rem;
        letter-spacing: -0.01em;
        color: var(--color-dark);
    }

    .modal-body {
        padding: 2.5rem;
    }

    .modal-footer {
        padding: 1.5rem 2.5rem 2rem;
        border-top: 1px solid var(--color-platinum) !important;
    }

    .modal-image-placeholder {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, var(--color-charcoal) 0%, var(--color-slate) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0;
    }

    .modal-image-placeholder i {
        font-size: 5rem;
        color: var(--color-silver);
    }

    #modalImage {
        border-radius: 0;
        filter: grayscale(0%) contrast(1.1);
    }

    .modal-body h6 {
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--color-dark);
        margin-bottom: 0.75rem;
    }

    .modal-body h6 i {
        font-size: 0.85rem;
        color: var(--color-ash) !important;
    }

    .modal-body p {
        color: var(--color-smoke);
        font-weight: 300;
        line-height: 1.7;
    }

    .btn-secondary {
        background: var(--color-dark) !important;
        border: 1px solid var(--color-dark) !important;
        color: var(--color-white) !important;
        font-size: 0.85rem;
        font-weight: 400;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 0.75rem 2rem;
        border-radius: 0;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: var(--color-charcoal) !important;
        border-color: var(--color-charcoal) !important;
    }

    .btn-close {
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    .btn-close:hover {
        opacity: 1;
    }

    .alert-info {
        background: var(--color-accent);
        border: 1px solid var(--color-platinum);
        color: var(--color-ash);
        border-radius: 0;
        padding: 2rem;
        font-weight: 300;
    }

    hr {
        border-color: var(--color-platinum) !important;
        opacity: 1;
        margin: 2rem 0;
    }

    .shadow-sm {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .fw-bold {
        font-weight: 400 !important;
    }

    .fs-2 {
        font-size: 2.5rem !important;
        letter-spacing: -0.02em;
    }

    .fs-5 {
        font-size: 1.05rem !important;
        font-weight: 300;
    }

    .container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
</style>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold fs-2"><?= esc($title1) ?></h1>
            <p class="text-muted fs-5"><?= esc($subtitle1) ?></p>
            <hr class="my-4">
        </div>
    </div>

    <?php if (!empty($achievements)): ?>
        <div class="row g-4">
            <?php foreach ($achievements as $achievement): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm achievement-card">
                        <div class="achievement-image-wrapper">
                            <?php if (!empty($achievement['images_path'])): ?>
                                <img src="<?= base_url('uploads/achievements/' . esc($achievement['images_path'])) ?>"
                                    class="card-img-top achievement-image"
                                    alt="<?= esc($achievement['title']) ?>">
                            <?php else: ?>
                                <div class="card-img-top achievement-image-placeholder">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                            <?php endif; ?>
                            <div class="achievement-overlay">
                                <i class="bi bi-eye"></i>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary"><?= esc($achievement['achievement']) ?></span>
                                <?php if (!empty($achievement['start_date'])): ?>
                                    <small class="text-muted fw-semibold">
                                        <?= date('Y', strtotime($achievement['start_date'])) ?>
                                    </small>
                                <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold mb-2"><?= esc($achievement['title']) ?></h5>

                            <p class="text-muted mb-3">
                                <i class="bi bi-calendar-event me-1"></i>
                                <?= esc($achievement['event_name']) ?>
                            </p>
                        </div>

                        <div class="card-footer bg-transparent border-top-0">
                            <button class="btn btn-outline-primary btn-sm w-100 view-detail-btn"
                                data-achievement='<?= json_encode($achievement) ?>'>
                                More Detail <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    Data not found. No achievements to display.
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="achievementModal" tabindex="-1" aria-labelledby="achievementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="achievementModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img id="modalImage" src="" class="img-fluid rounded shadow-sm mb-3" alt="" loading="lazy">
                        <div id="modalImagePlaceholder" class="modal-image-placeholder rounded shadow-sm mb-3">
                            <i class="bi bi-award-fill"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="mb-3">
                            <span class="badge bg-primary me-2" id="modalAchievement"></span>
                            <span class="badge bg-secondary" id="modalYear"></span>
                        </div>

                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-calendar-event text-primary me-2"></i>
                            Event Name
                        </h6>
                        <p class="text-muted mb-3" id="modalEventName"></p>

                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-clock text-primary me-2"></i>
                            Period
                        </h6>
                        <p class="text-muted mb-3" id="modalPeriod"></p>

                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-file-text text-primary me-2"></i>
                            Description
                        </h6>
                        <p class="text-muted" id="modalDescription"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewDetailBtns = document.querySelectorAll('.view-detail-btn');
        const modal = new bootstrap.Modal(document.getElementById('achievementModal'));

        viewDetailBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const achievement = JSON.parse(this.getAttribute('data-achievement'));

                // Set modal title
                document.getElementById('achievementModalLabel').textContent = achievement.title;

                // Set badge
                document.getElementById('modalAchievement').textContent = achievement.achievement;

                // Set year
                if (achievement.start_date) {
                    const year = new Date(achievement.start_date).getFullYear();
                    document.getElementById('modalYear').textContent = year;
                } else {
                    document.getElementById('modalYear').textContent = '-';
                }

                // Set event name
                document.getElementById('modalEventName').textContent = achievement.event_name || '-';

                // Set period
                let period = '';
                if (achievement.start_date) {
                    period = formatDate(achievement.start_date);
                }
                if (achievement.end_date) {
                    period += ' - ' + formatDate(achievement.end_date);
                }
                document.getElementById('modalPeriod').textContent = period || '-';

                // Set description
                document.getElementById('modalDescription').textContent = achievement.description || 'Tidak ada deskripsi.';

                // Set image
                const modalImage = document.getElementById('modalImage');
                const modalImagePlaceholder = document.getElementById('modalImagePlaceholder');

                if (achievement.images_path) {
                    modalImage.src = '<?= base_url("uploads/achievements/") ?>' + achievement.images_path;
                    modalImage.style.display = 'block';
                    modalImagePlaceholder.style.display = 'none';
                } else {
                    modalImage.style.display = 'none';
                    modalImagePlaceholder.style.display = 'flex';
                }

                // Show modal
                modal.show();
            });
        });

        function formatDate(dateString) {
            const options = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', options);
        }
    });
</script>