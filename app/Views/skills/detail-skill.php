<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($skill['skill_name'][0]) ?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-5px);
        }

        .detail-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .image-gallery {
            width: 100%;
            background: #f5f5f5;
        }

        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .thumbnail-container {
            display: flex;
            gap: 10px;
            padding: 15px;
            background: #fff;
            overflow-x: auto;
            border-bottom: 2px solid #f0f0f0;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            flex-shrink: 0;
        }

        .thumbnail:hover {
            transform: scale(1.05);
        }

        .thumbnail.active {
            border-color: #667eea;
        }

        .content {
            padding: 40px;
        }

        .skill-header {
            margin-bottom: 30px;
        }

        .skill-names {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .skill-name-tag {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: 600;
        }

        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        .category-badge {
            background: #f0f0f0;
            color: #667eea;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
        }

        .section-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .description {
            color: #555;
            line-height: 1.8;
            font-size: 1.05em;
            background: #f9f9f9;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }

        .no-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5em;
        }

        @media (max-width: 768px) {
            .content {
                padding: 25px;
            }

            .main-image {
                height: 250px;
            }

            .skill-name-tag {
                font-size: 1em;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="<?= base_url('skills') ?>" class="back-button">
            ← Kembali ke Daftar
        </a>

        <div class="detail-card">
            <!-- Image Gallery -->
            <?php if (!empty($skill['image_path'])): ?>
                <div class="image-gallery">
                    <img src="<?= base_url('uploads/skills/' . esc($skill['image_path'])) ?>"
                        alt="<?= esc($skill['skill_name'][0]) ?>"
                        class="main-image"
                        id="mainImage">
                </div>
            <?php else: ?>
                <div class="no-image">Tidak ada gambar</div>
            <?php endif; ?>


            <!-- Content -->
            <div class="content">
                <div class="skill-header">
                    <!-- Skill Names -->
                    <?php if (!empty($skill['skill_name']) && is_array($skill['skill_name'])): ?>
                        <div class="skill-names">
                            <?php foreach ($skill['skill_name'] as $name): ?>
                                <span class="skill-name-tag"><?= esc(trim($name)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Categories -->
                    <?php if (!empty($skill['category']) && is_array($skill['category'])): ?>
                        <div class="categories">
                            <?php foreach ($skill['category'] as $category): ?>
                                <span class="category-badge"><?= esc(trim($category)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="section-title">📝 Deskripsi</h2>
                    <div class="description">
                        <?= $skill['description'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src, element) {
            // Update main image
            document.getElementById('mainImage').src = src;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            element.classList.add('active');
        }
    </script>
</body>

</html>