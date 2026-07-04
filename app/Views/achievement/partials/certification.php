<style>
    :root {
        --gradient-primary: linear-gradient(135deg, #f8f9ff 0%, #f1f3ff 100%);
        --gradient-secondary: linear-gradient(135deg, #444 0%, #111 100%);
    }

    .hero-section {
        background: var(--gradient-primary);
        border-bottom: 1px solid #e3e6f0;
        padding: 3rem 0;
    }

    .certification-card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .certification-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 0.8rem 1.5rem rgba(0, 0, 0, 0.15) !important;
    }

    .certification-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .certification-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: all 0.4s ease;
        filter: brightness(0.7);
    }

    .certification-card:hover .certification-image {
        filter: brightness(1);
        transform: scale(1.05);
    }

    .certification-image-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        filter: brightness(0.7);
    }

    .certification-image-placeholder i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .certification-card:hover .certification-image-placeholder {
        filter: brightness(1);
        transform: scale(1.05);
    }

    .certification-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .certification-overlay i {
        color: white;
        font-size: 2.5rem;
        transform: scale(0.5);
        transition: transform 0.3s ease;
    }

    .certification-card:hover .certification-overlay {
        opacity: 1;
    }

    .certification-card:hover .certification-overlay i {
        transform: scale(1);
    }

    .modal-image-placeholder {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-image-placeholder i {
        font-size: 5rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .modal-content {
        border: none;
        border-radius: 15px;
    }
</style>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold fs-2"><?= esc($title2 ?? 'Sertifikasi') ?></h1>
            <p class="text-muted fs-5"><?= esc($subtitle2 ?? '') ?></p>
            <hr class="my-4">
        </div>
    </div>

    <?php if (! empty($certifications)): ?>
        <div class="row g-4">
            <?php foreach ($certifications as $certification): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm certification-card">
                        <div class="certification-image-wrapper">
                            <?php if (! empty($certification['images_path'][0])): ?>
                                <img src="<?= base_url($certification['images_path'][0]) ?>"
                                    class="card-img-top certification-image"
                                    alt="<?= esc($certification['name']) ?>">
                            <?php else: ?>
                                <div class="card-img-top certification-image-placeholder">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                            <?php endif; ?>
                            <div class="certification-overlay">
                                <i class="bi bi-eye"></i>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary"><?= esc($certification['issuer'] ?? '-') ?></span>
                                <?php if (! empty($certification['issue_year'])): ?>
                                    <small class="text-muted fw-semibold"><?= esc($certification['issue_year']) ?></small>
                                <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold mb-2"><?= esc($certification['name']) ?></h5>

                            <p class="text-muted mb-3">
                                <?= esc(mb_strimwidth($certification['description'] ?? '', 0, 100, '...')) ?>
                            </p>
                        </div>

                        <div class="card-footer bg-transparent border-top-0">
                            <button class="btn btn-outline-primary btn-sm w-100 view-detail-btn"
                                data-certification='<?= json_encode($certification) ?>'>
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
                    Belum ada data sertifikasi.
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="certificationModal" tabindex="-1" aria-labelledby="certificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="certificationModalLabel"></h5>
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
                            <span class="badge bg-primary me-2" id="modalIssuer"></span>
                            <span class="badge bg-secondary" id="modalYear"></span>
                        </div>

                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-file-text text-primary me-2"></i>
                            Deskripsi
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
    document.addEventListener('DOMContentLoaded', function () {
        const viewDetailBtns = document.querySelectorAll('.view-detail-btn');
        const modalEl = document.getElementById('certificationModal');
        const modal = new bootstrap.Modal(modalEl);

        viewDetailBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const cert = JSON.parse(this.getAttribute('data-certification'));

                document.getElementById('certificationModalLabel').textContent = cert.name || '-';
                document.getElementById('modalIssuer').textContent = cert.issuer || '-';
                document.getElementById('modalYear').textContent = cert.issue_year || '-';
                document.getElementById('modalDescription').textContent = cert.description || 'Tidak ada deskripsi.';

                const modalImage = document.getElementById('modalImage');
                const modalImagePlaceholder = document.getElementById('modalImagePlaceholder');

                if (cert.images_path && cert.images_path.length > 0) {
                    modalImage.src = '<?= base_url() ?>' + cert.images_path[0];
                    modalImage.style.display = 'block';
                    modalImagePlaceholder.style.display = 'none';
                } else {
                    modalImage.style.display = 'none';
                    modalImagePlaceholder.style.display = 'flex';
                }

                modal.show();
            });
        });
    });
</script>