<section class="education-section">
    <div class="container">
        <h2 class="section-title">Education</h2>

        <div class="education-list">

            <!-- University -->
            <div class="edu-item">
                <div class="edu-image">
                    <img src="<?= base_url('images/ugm.webp'); ?>" alt="University" loading="lazy">
                    <div class="edu-overlay">
                        <span class="edu-level">University</span>
                    </div>
                </div>
                <div class="edu-content">
                    <div class="edu-header">
                        <h3>Environmental & Infrastructure Engineering</h3>
                        <span class="edu-year">2021 - Present</span>
                    </div>
                    <h4>Universitas Gadjah Mada</h4>
                    <p class="edu-location">Yogyakarta, Indonesia</p>
                </div>
            </div>

            <!-- Senior High School -->
            <div class="edu-item">
                <div class="edu-image">
                    <img src="<?= base_url('images/sago.jpg'); ?>" alt="High School" loading="lazy">
                    <div class="edu-overlay">
                        <span class="edu-level">Senior High School</span>
                    </div>
                </div>
                <div class="edu-content">
                    <div class="edu-header">
                        <h3>Science Major</h3>
                        <span class="edu-year">2017 - 2020</span>
                    </div>
                    <h4>SMA Negeri 1 Gombong</h4>
                    <p class="edu-location">Kebumen, Central Java</p>
                </div>
            </div>

            <!-- Junior High School -->
            <div class="edu-item">
                <div class="edu-image">
                    <img src="<?= base_url('images/spenzaka.png'); ?>" alt="Junior High" loading="lazy">
                    <div class="edu-overlay">
                        <span class="edu-level">Junior High School</span>
                    </div>
                </div>
                <div class="edu-content">
                    <div class="edu-header">
                        <h3>Junior High School</h3>
                        <span class="edu-year">2014 - 2017</span>
                    </div>
                    <h4>SMP Negeri 1 Karanganyar</h4>
                    <p class="edu-location">Kebumen, Central Java</p>
                </div>
            </div>

            <!-- Elementary School -->
            <div class="edu-item">
                <div class="edu-image">
                    <img src="<?= base_url('images/sd5.webp'); ?>" alt="Elementary" loading="lazy">
                    <div class="edu-overlay">
                        <span class="edu-level">Elementary School</span>
                    </div>
                </div>
                <div class="edu-content">
                    <div class="edu-header">
                        <h3>Elementary School</h3>
                        <span class="edu-year">2008 - 2014</span>
                    </div>
                    <h4>SD Negeri 5 Karanganyar</h4>
                    <p class="edu-location">Kebumen, Central Java</p>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .education-section {
        padding: 80px 0;
        background: #ffffff;
    }

    .education-section .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 60px;
        font-family: 'Abril Fatface', cursive;
        letter-spacing: 1px;
        position: relative;
    }

    .education-section .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: #1a1a1a;
    }

    .education-list {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .edu-item {
        display: flex;
        gap: 30px;
        background: #fafafa;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .edu-item:hover {
        background: #ffffff;
        border-color: #1a1a1a;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .edu-image {
        width: 280px;
        height: 200px;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        background: #e0e0e0;
    }

    .edu-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.4s ease;
    }

    .edu-item:hover .edu-image img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }

    .edu-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        padding: 15px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .edu-item:hover .edu-overlay {
        transform: translateY(0);
    }

    .edu-level {
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .edu-content {
        padding: 25px 30px 25px 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .edu-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
        gap: 20px;
    }

    .edu-content h3 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        line-height: 1.3;
    }

    .edu-year {
        font-size: 0.9rem;
        color: #666;
        font-weight: 500;
        white-space: nowrap;
        padding: 4px 12px;
        background: #f0f0f0;
        border-left: 3px solid #1a1a1a;
    }

    .edu-content h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #4a4a4a;
        margin: 0 0 5px 0;
    }

    .edu-location {
        font-size: 0.9rem;
        color: #888;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .edu-location::before {
        content: '●';
        margin-right: 6px;
        font-size: 0.6rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .education-section {
            padding: 50px 0;
        }

        .education-section .section-title {
            font-size: 2rem;
            margin-bottom: 40px;
        }

        .education-list {
            gap: 25px;
        }

        .edu-item {
            flex-direction: column;
            gap: 0;
        }

        .edu-image {
            width: 100%;
            height: 220px;
        }

        .edu-overlay {
            transform: translateY(0);
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.3));
        }

        .edu-content {
            padding: 20px;
        }

        .edu-header {
            flex-direction: column;
            gap: 8px;
        }

        .edu-year {
            align-self: flex-start;
        }

        .edu-content h3 {
            font-size: 1.2rem;
        }

        .edu-content h4 {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .education-section .section-title {
            font-size: 1.8rem;
        }

        .edu-image {
            height: 180px;
        }

        .edu-content {
            padding: 15px;
        }

        .edu-content h3 {
            font-size: 1.1rem;
        }

        .edu-location {
            font-size: 0.85rem;
        }
    }
</style>