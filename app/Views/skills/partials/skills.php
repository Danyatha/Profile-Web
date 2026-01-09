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

    /* Category Section */
    .category-section {
        margin-top: 80px;
        margin-bottom: 50px;
    }

    .category-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.65);
    }

    .category-title {
        font-size: 2em;
        color: var(--gradient-secondary);
        font-weight: 600;
        letter-spacing: -0.5px;
        text-transform: uppercase;
    }

    .category-count {
        background: rgba(255, 255, 255, 0.1);
        color: #2e2c2c9a;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 600;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    /* Skills Grid */
    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .skill-card {
        position: relative;
        aspect-ratio: 1;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .skill-card:hover {
        transform: scale(1.08);
        z-index: 10;
    }

    /* Image Layer */
    .skill-image-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #1a1a1a;
    }

    .skill-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(80%) brightness(0.6);
        transition: all 0.5s ease;
    }

    .skill-card:hover .skill-image {
        filter: grayscale(0%) brightness(0.4);
        transform: scale(1.1);
    }

    /* Content Overlay - Hidden by default */
    .skill-content-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.95) 100%);
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .skill-card:hover .skill-content-overlay {
        opacity: 1;
    }

    .skill-title {
        font-size: 1.4em;
        color: #ffffff;
        margin-bottom: 12px;
        font-weight: 700;
        letter-spacing: -0.5px;
        line-height: 1.2;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.1s;
    }

    .skill-card:hover .skill-title {
        transform: translateY(0);
    }

    .skill-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 12px;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.15s;
    }

    .skill-card:hover .skill-categories {
        transform: translateY(0);
    }

    .category-tag {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.7em;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .skill-description {
        color: #c0c0c0;
        line-height: 1.5;
        margin-bottom: 16px;
        font-size: 0.85em;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.2s;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .skill-card:hover .skill-description {
        transform: translateY(0);
    }

    .view-detail-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #ffffff;
        color: #000000;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85em;
        transition: all 0.3s ease;
        border: 2px solid #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.25s, background 0.3s ease, color 0.3s ease;
    }

    .skill-card:hover .view-detail-btn {
        transform: translateY(0);
    }

    .view-detail-btn:hover {
        background: transparent;
        color: #ffffff;
    }

    /* Modal Popup */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        z-index: 1000;
        padding: 40px 20px;
        overflow-y: auto;
        animation: fadeIn 0.3s ease;
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .modal-content {
        background: var(--gradient-primary);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        max-width: 900px;
        width: 100%;
        overflow: hidden;
        animation: slideUp 0.4s ease;
        position: relative;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(197, 195, 195, 0.91);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: #0c0c0cff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.5em;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .modal-close:hover {
        background: rgba(19, 18, 18, 0.2);
        transform: rotate(90deg);
    }

    .modal-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        filter: grayscale(50%);
    }

    .modal-body {
        padding: 40px;
    }

    .modal-title {
        font-size: 2.5em;
        color: #1b1b1bff;
        margin-bottom: 20px;
        font-weight: 700;
        letter-spacing: -1px;
    }

    .modal-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .modal-category-tag {
        background: rgba(255, 255, 255, 0.1);
        color: #414040ff;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9em;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-description {
        color: #b0b0b0;
        line-height: 1.8;
        font-size: 1.05em;
    }

    .no-skills {
        text-align: center;
        color: #666666;
        font-size: 1.3em;
        margin-top: 100px;
        padding: 80px 40px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
    }

    @media (max-width: 768px) {
        body {
            padding: 40px 20px;
        }

        .header h1 {
            font-size: 2.5em;
        }

        .category-title {
            font-size: 1.5em;
        }

        .skills-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .skill-card:hover {
            transform: scale(1.05);
        }

        .modal-content {
            margin: 20px;
        }

        .modal-image {
            height: 250px;
        }

        .modal-body {
            padding: 30px 24px;
        }

        .modal-title {
            font-size: 1.8em;
        }
    }
</style>
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
<div class="container">

    <?php if (!empty($skills)): ?>
        <?php
        // Group skills by category
        $skillsByCategory = [];
        foreach ($skills as $skill) {
            $categories = array_map('trim', explode(',', $skill['category']));
            $mainCategory = $categories[0];
            if (!isset($skillsByCategory[$mainCategory])) {
                $skillsByCategory[$mainCategory] = [];
            }
            $skillsByCategory[$mainCategory][] = $skill;
        }
        ?>

        <?php foreach ($skillsByCategory as $categoryName => $categorySkills): ?>
            <div class="category-section">
                <div class="category-header">
                    <h2 class="category-title"><?= esc($categoryName) ?></h2>
                    <span class="category-count"><?= count($categorySkills) ?> Skills</span>
                </div>

                <div class="skills-grid">
                    <?php foreach ($categorySkills as $skill): ?>
                        <div class="skill-card" onclick="openModal(<?= $skill['id'] ?>)">
                            <div class="skill-image-wrapper">
                                <?php if (!empty($skill['image_path'])): ?>
                                    <img src="<?= base_url('uploads/skills/' . esc($skill['image_path'])) ?>"
                                        alt="<?= esc($skill['skill_name']) ?>"
                                        class="skill-image">
                                <?php else: ?>
                                    <div class="skill-image" style="background: linear-gradient(135deg, #333 0%, #1a1a1a 100%);"></div>
                                <?php endif; ?>
                            </div>

                            <div class="skill-content-overlay">
                                <h3 class="skill-title"><?= esc($skill['skill_name']) ?></h3>

                                <div class="skill-categories">
                                    <?php
                                    $categories = explode(',', $skill['category']);
                                    foreach ($categories as $category):
                                    ?>
                                        <span class="category-tag"><?= esc(trim($category)) ?></span>
                                    <?php endforeach; ?>
                                </div>

                                <p class="skill-description">
                                    <?= esc(substr(strip_tags($skill['description']), 0, 100)) ?>...
                                </p>

                                <button class="view-detail-btn" onclick="event.stopPropagation(); openModal(<?= $skill['id'] ?>)">
                                    View Details →
                                </button>
                            </div>
                        </div>

                        <!-- Modal for each skill -->
                        <div id="modal-<?= $skill['id'] ?>" class="modal" onclick="closeModal(<?= $skill['id'] ?>)">
                            <div class="modal-content" onclick="event.stopPropagation()">
                                <div class="modal-close" onclick="closeModal(<?= $skill['id'] ?>)">×</div>

                                <?php if (!empty($skill['image_path'])): ?>
                                    <img src="<?= base_url('uploads/skills/' . esc($skill['image_path'])) ?>"
                                        alt="<?= esc($skill['skill_name']) ?>"
                                        class="modal-image">
                                <?php endif; ?>

                                <div class="modal-body">
                                    <h2 class="modal-title"><?= esc($skill['skill_name']) ?></h2>

                                    <div class="modal-categories">
                                        <?php
                                        $categories = explode(',', $skill['category']);
                                        foreach ($categories as $category):
                                        ?>
                                            <span class="modal-category-tag"><?= esc(trim($category)) ?></span>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="modal-description">
                                        <?= $skill['description'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="no-skills">
            <p>No skills added yet.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById('modal-' + id);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById('modal-' + id);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal.active');
            if (activeModal) {
                activeModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }
    });
</script>