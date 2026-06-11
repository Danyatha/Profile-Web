<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');

    :root {
        --bg-dark: #0f0f0f;
        --surface-1: #1a1a1a;
        --surface-2: #242424;
        --surface-3: #2e2e2e;
        --border-subtle: rgba(255, 255, 255, 0.08);
        --border-medium: rgba(255, 255, 255, 0.15);
        --text-primary: #f0f0f0;
        --text-secondary: #a0a0a0;
        --text-muted: #707070;
        --accent-silver: #c0c0c0;
        --accent-light: #e8e8e8;
        --glow: rgba(255, 255, 255, 0.12);
        --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .roadmap-container {
        padding: 80px 20px;
        position: relative;
        color: var(--text-primary);
        overflow: hidden;
    }

    .roadmap-container::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 80% 50% at 50% 0%, rgba(255, 255, 255, 0.03) 0%, transparent 60%),
            repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.015) 0px, transparent 1px, transparent 80px);
        pointer-events: none;
    }

    /* ─── Header ─── */
    .roadmap-header {
        text-align: center;
        margin-bottom: 70px;
        position: relative;
    }

    .roadmap-header h1 {
        font-size: clamp(2.2rem, 5vw, 3.8rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        background: linear-gradient(135deg, #ffffff 0%, #909090 50%, #ffffff 100%);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
        animation: shimmer 6s ease-in-out infinite;
    }

    @keyframes shimmer {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .roadmap-header .subtitle {
        font-size: 1.15rem;
        color: var(--text-secondary);
        font-weight: 300;
        letter-spacing: 0.02em;
    }

    .roadmap-header .instruction {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 12px;
        font-style: italic;
    }

    /* ─── Timeline ─── */
    .timeline {
        position: relative;
        padding: 20px 0;
        max-width: 1100px;
        margin: 0 auto;
    }

    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom,
                transparent 0%,
                rgba(255, 255, 255, 0.12) 10%,
                rgba(255, 255, 255, 0.12) 90%,
                transparent 100%);
        overflow: hidden;
    }

    .timeline-line .timeline-progress {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 0%;
        background: linear-gradient(to bottom, var(--accent-silver), #ffffff);
        box-shadow: 0 0 12px var(--glow);
        transition: height 0.15s linear;
    }

    .timeline-item {
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 50px;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .timeline-item.revealed {
        opacity: 1;
        transform: translateY(0);
    }

    .timeline-item:nth-child(odd).revealed {
        transition-delay: 0.05s;
    }

    .timeline-item:nth-child(even).revealed {
        transition-delay: 0.15s;
    }

    .timeline-item:nth-child(odd) {
        flex-direction: row;
    }

    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline-dot {
        position: absolute;
        transform: translateX(-50%);
        width: 16px;
        height: 16px;
        background: var(--accent-silver);
        border: 3px solid var(--bg-dark);
        border-radius: 50%;
        box-shadow: 0 0 0 3px var(--border-subtle), 0 0 20px var(--glow);
        z-index: 10;
        transition: var(--transition-fast);
    }

    .timeline-item:hover .timeline-dot {
        transform: translateX(-50%) scale(1.4);
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2), 0 0 30px rgba(255, 255, 255, 0.25);
        background: #fff;
    }

    /* ─── Cards ─── */
    .timeline-content {
        padding: 28px;
        border-radius: 16px;
        cursor: pointer;
        transition: var(--transition-smooth);
        position: relative;
        overflow: visible;
        backdrop-filter: blur(10px);
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-right: auto;
    }

    .timeline-item:nth-child(even) .timeline-content {
        margin-left: auto;
    }

    /* Konektor kartu → garis tengah: garis tipis, bukan kotak */
    .timeline-content::before {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 36px;
        height: 2px;
        border-radius: 2px;
        pointer-events: none;
    }

    .timeline-item:nth-child(odd) .timeline-content::before {
        right: -44px;
        background: linear-gradient(to right, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.3));
    }

    .timeline-item:nth-child(even) .timeline-content::before {
        left: -44px;
        background: linear-gradient(to left, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.3));
    }

    .timeline-content::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, transparent 50%);
        pointer-events: none;
        border-radius: inherit;
    }

    .timeline-content:hover {
        transform: translateY(-4px) scale(1.01);
    }

    .timeline-item:nth-child(even) .timeline-content:hover {
        transform: translateY(-4px) scale(1.01);
    }

    .timeline-content.year1 {
        background: linear-gradient(145deg, #1e1e1e, #282828);
        border: 1px solid var(--border-subtle);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
    }

    .timeline-content.year1:hover {
        border-color: var(--border-medium);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px var(--border-medium);
    }

    .timeline-content.year2 {
        background: linear-gradient(145deg, #d8d8d8, #e8e8e8);
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.15);
        color: #1a1a1a;
    }

    .timeline-content.year2:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.12);
    }

    .timeline-content.year3 {
        background: linear-gradient(145deg, #222222, #2c2c2c);
        border: 1px solid var(--border-subtle);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
    }

    .timeline-content.year3:hover {
        border-color: var(--border-medium);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px var(--border-medium);
    }

    .timeline-content.year4 {
        background: linear-gradient(145deg, #e0e0e0, #efefef);
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.15);
        color: #1a1a1a;
    }

    .timeline-content.year4:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.12);
    }

    .year-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        margin-bottom: 12px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .timeline-content.year2 .year-badge,
    .timeline-content.year4 .year-badge {
        background: rgba(0, 0, 0, 0.07);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .content-title {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: -0.01em;
        line-height: 1.3;
    }

    .content-description {
        opacity: 0.7;
        margin-bottom: 14px;
        font-size: 0.9rem;
        line-height: 1.5;
        font-weight: 300;
    }

    .activity-count {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .count-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: var(--transition-fast);
        border: 1px solid transparent;
    }

    .count-badge:hover {
        background: rgba(255, 255, 255, 0.14);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .timeline-content.year2 .count-badge,
    .timeline-content.year4 .count-badge {
        background: rgba(0, 0, 0, 0.06);
    }

    .timeline-content.year2 .count-badge:hover,
    .timeline-content.year4 .count-badge:hover {
        background: rgba(0, 0, 0, 0.1);
    }

    .view-details-btn {
        margin-top: 20px;
        padding: 10px 24px;
        background: transparent;
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: inherit;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition-fast);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.02em;
    }

    .view-details-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.35);
        transform: translateY(-1px);
    }

    .timeline-content.year2 .view-details-btn,
    .timeline-content.year4 .view-details-btn {
        border-color: rgba(0, 0, 0, 0.2);
    }

    .timeline-content.year2 .view-details-btn:hover,
    .timeline-content.year4 .view-details-btn:hover {
        background: rgba(0, 0, 0, 0.08);
        border-color: rgba(0, 0, 0, 0.35);
    }

    /* ─── Modal ─── */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        backdrop-filter: blur(8px);
        z-index: 1000;
        overflow-y: auto;
    }

    .modal.active {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 40px 20px;
        animation: fadeIn 0.25s ease;
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
        background: var(--surface-1);
        border-radius: 20px;
        max-width: 960px;
        width: 100%;
        max-height: none;
        position: relative;
        box-shadow: 0 24px 80px rgba(0, 0, 0, 0.6);
        border: 1px solid var(--border-subtle);
        animation: slideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        margin: auto;
    }

    @keyframes slideUp {
        from {
            transform: translateY(40px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .close-modal {
        position: fixed;
        top: 24px;
        right: 24px;
        width: 44px;
        height: 44px;
        background: rgba(0, 0, 0, 0.7);
        border: 1px solid var(--border-subtle);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-fast);
        font-size: 1.6rem;
        color: var(--text-secondary);
        z-index: 1001;
        backdrop-filter: blur(10px);
    }

    .close-modal:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        transform: scale(1.05);
    }

    /* ─── Activity Card ─── */
    .activity-card {
        background: var(--surface-2);
        border-radius: 16px;
        margin: 16px;
        overflow: hidden;
        transition: var(--transition-fast);
        border: 1px solid var(--border-subtle);
    }

    .activity-card:hover {
        border-color: var(--border-medium);
    }

    /* ─── Carousel antar kegiatan (dalam modal) ─── */
    .modal-content {
        overflow: hidden;
    }

    .activity-track {
        display: flex;
        align-items: flex-start;
        transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .activity-track .activity-card {
        min-width: calc(100% - 32px);
        width: calc(100% - 32px);
    }

    .activity-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 2px 16px 16px;
    }

    .activity-nav-btn {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid var(--border-subtle);
        color: var(--text-primary);
        padding: 9px 18px;
        border-radius: 10px;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        transition: var(--transition-fast);
        white-space: nowrap;
    }

    .activity-nav-btn:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.12);
        border-color: var(--border-medium);
        transform: translateY(-1px);
    }

    .activity-nav-btn:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .activity-dots-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .activity-dots {
        display: flex;
        gap: 8px;
    }

    .activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.25);
        border: none;
        padding: 0;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .activity-dot.active {
        background: #fff;
        width: 24px;
    }

    .activity-counter {
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 0.04em;
    }

    /* ─── Carousel ─── */
    .photo-carousel {
        position: relative;
        width: 100%;
        background: #000;
    }

    .carousel-container {
        position: relative;
        width: 100%;
        height: 380px;
        overflow: hidden;
    }

    .carousel-slides {
        display: flex;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .carousel-slide {
        min-width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-slide.placeholder {
        background: linear-gradient(145deg, var(--surface-2), var(--surface-3));
        color: var(--text-muted);
        font-size: 0.9rem;
        text-align: center;
        padding: 40px;
    }

    .carousel-slide.placeholder small {
        opacity: 0.6;
    }

    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.1);
        width: 42px;
        height: 42px;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        transition: var(--transition-fast);
        z-index: 10;
    }

    .carousel-nav:hover {
        background: rgba(0, 0, 0, 0.7);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .carousel-nav.prev {
        left: 12px;
    }

    .carousel-nav.next {
        right: 12px;
    }

    .carousel-nav:disabled {
        opacity: 0.25;
        cursor: not-allowed;
    }

    .carousel-indicators {
        position: absolute;
        bottom: 14px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 10;
    }

    .carousel-indicator {
        width: 8px;
        height: 8px;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.35);
        cursor: pointer;
        transition: var(--transition-fast);
        border: none;
        padding: 0;
    }

    .carousel-indicator.active {
        background: #fff;
        width: 24px;
    }

    .photo-count {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        color: #fff;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        z-index: 10;
        font-weight: 500;
    }

    /* ─── Activity Info Overlay ─── */
    .activity-info-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.6) 60%, transparent 100%);
        padding: 50px 24px 20px;
        z-index: 11;
    }

    .activity-title-overlay {
        font-size: 1.3rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 6px;
        letter-spacing: -0.01em;
    }

    .activity-meta {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .activity-role-overlay,
    .activity-date-overlay {
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 400;
    }

    .expand-description-btn {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #fff;
        padding: 7px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.82rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: var(--transition-fast);
        display: inline-block;
        margin-top: 8px;
    }

    .expand-description-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.25);
    }

    /* ─── Description Section ─── */
    .activity-description-section {
        padding: 0 24px;
        background: rgba(0, 0, 0, 0.15);
        max-height: 0;
        overflow: hidden;
        transition: max-height var(--transition-smooth), padding var(--transition-smooth);
    }

    .activity-description-section.expanded {
        max-height: 800px;
        padding: 24px;
    }

    .activity-description-text {
        color: var(--text-secondary);
        line-height: 1.75;
        font-size: 0.92rem;
        font-weight: 300;
    }

    .achievement-badge {
        display: inline-block;
        background: linear-gradient(135deg, #505050, #707070);
        color: #fff;
        padding: 5px 14px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 14px;
        letter-spacing: 0.03em;
    }

    /* ─── Summary ─── */
    .summary-section {
        position: relative;
        left: 50%;
        transform: translateX(-50%) translateY(30px);
        opacity: 0;
        transition: opacity 0.6s ease, transform 0.6s ease;
        max-width: 760px;
        background: var(--surface-1);
        padding: 44px;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
        border: 1px solid var(--border-subtle);
        margin-top: 70px;
    }

    .summary-section.revealed {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    .summary-section h2 {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 18px;
        letter-spacing: -0.02em;
    }

    .summary-section p {
        text-align: center;
        font-size: 1rem;
        color: var(--text-secondary);
        line-height: 1.8;
        font-weight: 300;
    }

    /* ─── Scrollbar ─── */
    .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 3px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* ─── Responsive ─── */
    @media (max-width: 768px) {
        .roadmap-container {
            padding: 50px 16px;
        }

        .timeline-line {
            left: 14px;
            transform: none;
        }

        .timeline-item {
            flex-direction: row !important;
            margin-bottom: 28px;
            padding-left: 44px;
        }

        .timeline-dot {
            left: 14px;
            top: 26px;
            transform: translateX(-50%);
            margin-bottom: 0;
        }

        .timeline-item:hover .timeline-dot {
            transform: translateX(-50%) scale(1.3);
        }

        .timeline-content {
            width: 100% !important;
            padding: 22px !important;
            margin: 0 !important;
        }

        .timeline-content::before {
            left: -28px !important;
            right: auto !important;
            top: 26px;
            transform: none;
            width: 24px;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05)) !important;
        }

        .timeline-content:hover {
            transform: translateY(-2px) scale(1.005) !important;
        }

        .modal.active {
            padding: 12px;
        }

        .modal-content {
            margin: 8px;
        }

        .carousel-container {
            height: 280px;
        }

        .close-modal {
            top: 12px;
            right: 12px;
            width: 38px;
            height: 38px;
            font-size: 1.3rem;
        }

        .activity-title-overlay {
            font-size: 1.05rem;
        }

        .carousel-nav {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }

        .activity-card {
            margin: 10px;
        }

        .activity-track .activity-card {
            min-width: calc(100% - 20px);
            width: calc(100% - 20px);
        }

        .activity-nav {
            padding: 0 10px 12px;
            gap: 8px;
        }

        .activity-nav-btn {
            padding: 8px 12px;
            font-size: 0.78rem;
        }

        .summary-section {
            padding: 28px 22px;
        }
    }
</style>

<div class="roadmap-container">
    <div class="roadmap-header">
        <h1>My Career Journey</h1>
        <p class="subtitle">Environmental Engineering at Gadjah Mada University</p>
        <p class="instruction">Click on any year to explore the visual journey</p>
    </div>

    <div class="timeline">
        <div class="timeline-line">
            <div class="timeline-progress"></div>
        </div>

        <!-- Year 1: 2021-2022 -->
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-content year1" onclick="openModal('year1')">
                <span class="year-badge">2021-2022</span>
                <h3 class="content-title">First Year: Foundation & Exploration</h3>
                <p class="content-description">Building the foundation while starting organizational journey</p>
                <div class="activity-count">
                    <div class="count-badge"><span>1 Work Experience</span></div>
                    <div class="count-badge"><span>2 Organizations</span></div>
                    <div class="count-badge"><span>1 Leadership</span></div>
                </div>
                <button class="view-details-btn">View Details →</button>
            </div>
        </div>

        <!-- Year 2: 2022-2023 -->
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-content year2" onclick="openModal('year2')">
                <span class="year-badge">2022-2023</span>
                <h3 class="content-title">Second Year: Active Engagement</h3>
                <p class="content-description">Deep organizational involvement and first project experiences</p>
                <div class="activity-count">
                    <div class="count-badge"><span>1 Work Experience</span></div>
                    <div class="count-badge"><span>2 Organizations</span></div>
                </div>
                <button class="view-details-btn">View Details →</button>
            </div>
        </div>

        <!-- Year 3: 2023-2024 -->
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-content year3" onclick="openModal('year3')">
                <span class="year-badge">2023-2024</span>
                <h3 class="content-title">Third Year: Leadership & Innovation</h3>
                <p class="content-description">Taking leadership roles and winning competitions</p>
                <div class="activity-count">
                    <div class="count-badge"><span>2 Work Experiences</span></div>
                    <div class="count-badge"><span>1 Organization</span></div>
                    <div class="count-badge"><span>3 Competitions</span></div>
                    <div class="count-badge"><span>1 Leadership</span></div>
                </div>
                <button class="view-details-btn">View Details →</button>
            </div>
        </div>

        <!-- Year 4: 2024-2025 -->
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-content year4" onclick="openModal('year4')">
                <span class="year-badge">2024-2025</span>
                <h3 class="content-title">Fourth Year: Professional Growth</h3>
                <p class="content-description">Intensive professional experiences and specialization</p>
                <div class="activity-count">
                    <div class="count-badge"><span>7 Work Experiences</span></div>
                    <div class="count-badge"><span>2 Organizations</span></div>
                    <div class="count-badge"><span>1 Competition</span></div>
                </div>
                <button class="view-details-btn">View Details →</button>
            </div>
        </div>
    </div>

    <div class="summary-section">
        <h2>Journey Summary</h2>
        <p>From building foundations in environmental engineering to becoming a professional in sustainable infrastructure planning,
            my journey has been marked by continuous growth, leadership development, and innovative project implementations.
            Through diverse work experiences, organizational engagement, and competition victories,
            I've developed a comprehensive skill set in environmental policy, water and waste management,
            and sustainable development—ready to create meaningful impact in Indonesia's environmental sector.</p>
    </div>
</div>

<!-- Modal Year 1 -->
<div id="modal-year1" class="modal">
    <div class="close-modal" onclick="closeModal('year1')">×</div>
    <div class="modal-content">

        <!-- Inventarisasi IPAL -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="ipal">
                        <div class="carousel-slide placeholder">
                            <div>Dokumentasi survei IPAL<br><small>Upload foto kegiatan di lapangan</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim surveyor<br><small>Upload foto tim kerja</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Instalasi IPAL<br><small>Upload foto instalasi yang disurvei</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('ipal', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('ipal', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('ipal', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('ipal', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('ipal', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">Inventarisasi IPAL Komunal Kab. Bantul</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Surveyor | PT Adare Multiservices</span>
                            <span class="activity-date-overlay">Okt - Des 2022</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Pengalaman pertama saya dalam dunia profesional dimulai dengan turun langsung ke lapangan untuk mencatat dan mendokumentasikan seluruh instalasi pengolahan air limbah (IPAL) komunal yang tersebar di Kabupaten Bantul, Yogyakarta. Dalam proyek ini, saya bertanggung jawab melakukan inventarisasi menyeluruh terhadap kondisi aktual setiap IPAL melalui wawancara mendalam dengan penanggung jawab di tiap wilayah. Saya juga mengumpulkan berbagai dokumen penting seperti jumlah pengguna, Shop Drawing, dan Surat Keputusan (SK) yang menjadi dasar data untuk evaluasi kinerja sistem pengelolaan air limbah di daerah tersebut.
                </p>
            </div>
        </div>

        <!-- MPM KMTSL -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="mpm1">
                        <div class="carousel-slide placeholder">
                            <div>Kegiatan organisasi MPM KMTSL<br><small>Upload foto kegiatan</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim PSDM<br><small>Upload foto tim</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Malam keakraban<br><small>Upload foto acara</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('mpm1', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('mpm1', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('mpm1', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('mpm1', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('mpm1', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">MPM KMTSL UGM</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Staff Divisi PSDM</span>
                            <span class="activity-date-overlay">Mei 2022 - Nov 2023</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Sebagai Staff Divisi Pemberdayaan Sumber Daya Manusia di Majelis Permusyawaratan Mahasiswa KMTSL UGM, saya berkontribusi aktif dalam membangun harmonisasi internal organisasi melalui berbagai kegiatan seperti malam keakraban dan program pengembangan anggota. Peran ini mengajarkan saya pentingnya membangun koneksi antar anggota organisasi serta bagaimana merancang program yang efektif untuk meningkatkan kapasitas sumber daya manusia. Saya juga terlibat dalam proses brainstorming ide-ide inovatif dan membantu menyusun laporan pertanggungjawaban setiap program kerja yang telah dilaksanakan.
                </p>
            </div>
        </div>

        <!-- Civil Study Club -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="csc1">
                        <div class="carousel-slide placeholder">
                            <div>Kegiatan Civil Study Club<br><small>Upload foto kegiatan</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Konten artikel<br><small>Upload screenshot artikel</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim riset<br><small>Upload foto tim</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('csc1', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('csc1', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('csc1', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('csc1', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('csc1', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">Civil Study Club DTSL UGM</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Staff Divisi Ide & Riset</span>
                            <span class="activity-date-overlay">Mei 2022 - Nov 2023</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Di Civil Study Club, saya mengasah kemampuan riset dan menulis dengan rutin memproduksi artikel bertema inovasi teknik sipil yang dipublikasikan di media sosial. Kegiatan ini tidak hanya meningkatkan pemahaman saya tentang perkembangan teknologi dan inovasi di bidang teknik sipil, tetapi juga melatih kemampuan komunikasi sains untuk audiens yang lebih luas. Setiap artikel yang saya tulis dirancang untuk memberikan wawasan baru bagi mahasiswa Departemen Teknik Sipil dan Lingkungan serta masyarakat umum yang tertarik dengan isu-isu infrastruktur dan lingkungan.
                </p>
            </div>
        </div>

        <!-- Tim Voli -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="voli">
                        <div class="carousel-slide placeholder">
                            <div>Pertandingan Teknisiade<br><small>Upload foto pertandingan</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim voli FT UGM<br><small>Upload foto tim</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Latihan tim<br><small>Upload foto latihan</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('voli', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('voli', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('voli', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('voli', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('voli', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">Tim Voli Teknisiade FT UGM</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Manajer Tim</span>
                            <span class="activity-date-overlay">Agu - Sep 2022</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Pengalaman pertama saya dalam kepemimpinan tim olahraga dimulai saat menjadi manajer Tim Voli pada ajang Teknisiade Fakultas Teknik UGM. Saya bertanggung jawab penuh mulai dari menyeleksi dan merekrut calon atlet, mengatur jadwal latihan, hingga mengkoordinasikan seluruh aspek administrasi dan logistik pertandingan. Peran ini mengajarkan saya pentingnya manajemen waktu, komunikasi efektif antara berbagai pihak (pelatih, pemain, dan panitia), serta bagaimana memastikan kesiapan tim dalam setiap pertandingan. Pengalaman ini menjadi fondasi penting dalam mengembangkan kemampuan kepemimpinan dan manajemen tim saya.
                </p>
            </div>
        </div>

    </div>
</div>

<!-- Modal Year 2 -->
<div id="modal-year2" class="modal">
    <div class="close-modal" onclick="closeModal('year2')">×</div>
    <div class="modal-content">

        <!-- FS SPAM Kamijoro -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="spam">
                        <div class="carousel-slide placeholder">
                            <div>Survei lapangan Kamijoro<br><small>Upload foto kegiatan survei</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Wawancara masyarakat<br><small>Upload foto wawancara</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Area SPAM<br><small>Upload foto lokasi</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('spam', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('spam', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('spam', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('spam', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('spam', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">Feasibility Study SPAM Kamijoro</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Surveyor</span>
                            <span class="activity-date-overlay">Okt - Des 2023</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Dalam proyek studi kelayakan Sistem Penyediaan Air Minum (SPAM) Kamijoro di Kabupaten Kulonprogo, saya turun langsung ke lapangan untuk mengumpulkan data primer melalui kuisioner yang komprehensif. Fokus utama saya adalah mengumpulkan data sosial dan ekonomi dari berbagai narasumber di sektor industri dan domestik untuk menilai kebutuhan dan kelayakan pembangunan infrastruktur air bersih di wilayah tersebut. Pengalaman ini memberikan pemahaman mendalam tentang pentingnya pendekatan partisipatif dalam perencanaan infrastruktur dan bagaimana data lapangan menjadi kunci dalam pengambilan keputusan pembangunan yang tepat sasaran.
                </p>
            </div>
        </div>

    </div>
</div>

<!-- Modal Year 3 -->
<div id="modal-year3" class="modal">
    <div class="close-modal" onclick="closeModal('year3')">×</div>
    <div class="modal-content">

        <!-- RISPAL Sikka -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="sikka">
                        <div class="carousel-slide placeholder">
                            <div>Survei Kabupaten Sikka, NTT<br><small>Upload foto lokasi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Pengumpulan data masyarakat<br><small>Upload foto kegiatan</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim surveyor<br><small>Upload foto tim</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('sikka', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('sikka', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('sikka', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('sikka', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('sikka', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">RISPAL Kabupaten Sikka</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Surveyor</span>
                            <span class="activity-date-overlay">Mei - Jul 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Pengalaman survei di Kabupaten Sikka, Nusa Tenggara Timur untuk penyusunan Rencana Induk Sistem Pengelolaan Air Limbah (RISPAL) membawa saya ke wilayah dengan tantangan geografis dan sosial yang unik. Saya mengumpulkan data primer dan aspirasi masyarakat berdasarkan aspek sosial-ekonomi dari berbagai narasumber di sektor industri dan domestik. Proyek ini mengajarkan saya pentingnya memahami konteks lokal dalam merancang sistem pengelolaan air limbah yang berkelanjutan dan sesuai dengan kebutuhan masyarakat setempat.
                </p>
            </div>
        </div>

        <!-- RIDRAIN Tiakur -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="tiakur">
                        <div class="carousel-slide placeholder">
                            <div>Analisis GIS drainase<br><small>Upload screenshot peta</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Survei lapangan Tiakur<br><small>Upload foto lokasi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Penyusunan dokumen<br><small>Upload foto tim kerja</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('tiakur', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('tiakur', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('tiakur', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('tiakur', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('tiakur', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">RIDRAIN Kota Tiakur</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Asisten Tenaga Ahli</span>
                            <span class="activity-date-overlay">Nov - Des 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Sebagai Asisten Tenaga Ahli dalam penyusunan Rencana Induk Sistem Drainase (RIDRAIN) Kota Tiakur, saya bertanggung jawab membantu analisis hidrologi khususnya dalam aspek runoff direction menggunakan software GIS. Pengalaman ini memberikan pemahaman teknis yang mendalam tentang pemodelan hidrologi dan perencanaan sistem drainase perkotaan. Bersama tenaga ahli, saya turut menyusun dokumen RIDRAIN sesuai dengan pedoman peraturan perundang-undangan yang berlaku, memastikan bahwa setiap aspek teknis memenuhi standar nasional untuk pembangunan infrastruktur drainase yang efektif dan berkelanjutan.
                </p>
            </div>
        </div>

        <!-- MPM KMTSL Kepala Divisi -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="mpmkepala">
                        <div class="carousel-slide placeholder">
                            <div>Kegiatan divisi PSDM<br><small>Upload foto program</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Rapat koordinasi<br><small>Upload foto rapat</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim PSDM<br><small>Upload foto tim lengkap</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('mpmkepala', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('mpmkepala', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('mpmkepala', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('mpmkepala', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('mpmkepala', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">MPM KMTSL UGM</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Kepala Divisi PSDM</span>
                            <span class="activity-date-overlay">Mei 2023 - Nov 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Promosi menjadi Kepala Divisi Pemberdayaan Sumber Daya Manusia membawa tanggung jawab yang lebih besar dalam mengkoordinasikan seluruh staf untuk merancang dan menjalankan program kerja divisi. Saya memimpin perencanaan dan evaluasi kegiatan pengembangan anggota, menjaga motivasi serta keharmonisan kerja tim, dan menyusun laporan pertanggungjawaban yang komprehensif. Posisi ini mengasah kemampuan kepemimpinan strategis saya dalam mengelola tim, mengambil keputusan, dan memastikan setiap program berjalan sesuai visi organisasi untuk mengembangkan kualitas sumber daya manusia di lingkungan KMTSL.
                </p>
            </div>
        </div>

        <!-- KKN PPM -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="kkn">
                        <div class="carousel-slide placeholder">
                            <div>Program KKN di desa<br><small>Upload foto kegiatan</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim sub-unit KKN<br><small>Upload foto tim</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Interaksi dengan masyarakat<br><small>Upload foto kegiatan</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('kkn', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('kkn', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('kkn', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('kkn', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('kkn', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">KKN PPM UGM</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Koordinator Mahasiswa Sub-Unit</span>
                            <span class="activity-date-overlay">Jul - Aug 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Sebagai Koordinator Mahasiswa Sub-Unit dalam program Kuliah Kerja Nyata Pemberdayaan Masyarakat (KKN PPM) UGM, saya mengkoordinir seluruh kegiatan program kerja mahasiswa di lapangan, menyusun jadwal kegiatan, dan mengontrol implementasi rencana kerja berdasarkan hasil identifikasi saat survei lapangan. Peran ini menuntut saya untuk menjadi penghubung efektif antara mahasiswa, dosen pembimbing lapangan (DPL), dan pihak desa, mengidentifikasi kendala di lapangan, serta mencari solusi bersama tim. Pengalaman ini memperkuat kemampuan kepemimpinan lapangan dan manajemen proyek berbasis masyarakat saya.
                </p>
            </div>
        </div>

        <!-- Innovillage -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="innovillage">
                        <div class="carousel-slide placeholder">
                            <div>SMART PERMAVILLAGE Project<br><small>Upload foto implementasi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Waste-to-energy system<br><small>Upload foto teknologi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Community engagement<br><small>Upload foto kegiatan</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('innovillage', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('innovillage', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('innovillage', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('innovillage', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('innovillage', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">Innovillage 2023 - Telkom Indonesia</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Top 163</span>
                            <span class="activity-date-overlay">Okt 2023 - Feb 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Proyek SMART PERMAVILLAGE yang saya kembangkan berhasil lolos pendanaan di kompetisi Innovillage 2023 yang diselenggarakan Telkom Indonesia. Ini adalah program sistematis yang mengombinasikan konsep waste-to-energy dan efficient energy for food untuk memperkuat prinsip keberlanjutan di komunitas. Program ini tidak hanya berfokus pada implementasi teknologi, tetapi juga pada peningkatan kapasitas individu dan komunitas agar prinsip sustainability dapat benar-benar tertanam kuat di wilayah sasaran. Keberhasilan proyek ini menjadi bukti bahwa solusi berkelanjutan dapat dicapai melalui pendekatan holistik yang menggabungkan teknologi dan pemberdayaan masyarakat.
                </p>
                <div class="achievement-badge">Funded Project</div>
            </div>
        </div>

        <!-- SPACE UP -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="spaceup">
                        <div class="carousel-slide placeholder">
                            <div>Presentasi Soakaway Crates<br><small>Upload foto presentasi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Konsep teknologi<br><small>Upload diagram/foto prototype</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Penyerahan piala juara<br><small>Upload foto pemenang</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('spaceup', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('spaceup', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('spaceup', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('spaceup', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('spaceup', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">SPACE UP 6.0 - Pertamina University</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">First Winner</span>
                            <span class="activity-date-overlay">Feb - Mar 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Meraih juara pertama di kompetisi SPACE UP 6.0 yang diselenggarakan Pertamina University menjadi salah satu pencapaian membanggakan dalam perjalanan akademik saya. Kompetisi ini bertema teknologi inovatif untuk keberlanjutan, dan saya mengajukan ide Soakaway Crates sebagai teknologi konservasi banjir yang berbasis pada prinsip Pro-Air. Teknologi ini dirancang untuk mengatasi permasalahan banjir perkotaan sambil meningkatkan resapan air tanah, menunjukkan bahwa solusi infrastruktur hijau dapat menjadi alternatif efektif untuk manajemen air perkotaan yang berkelanjutan.
                </p>
                <div class="achievement-badge">1st Place Winner</div>
            </div>
        </div>

        <!-- REVEAL -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="reveal">
                        <div class="carousel-slide placeholder">
                            <div>Riset bioetanol kakao<br><small>Upload foto penelitian</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Presentasi NZE concept<br><small>Upload foto presentasi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Tim kompetisi<br><small>Upload foto tim</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('reveal', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('reveal', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('reveal', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('reveal', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('reveal', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">REVEAL 2024 - Brawijaya University</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Participant</span>
                            <span class="activity-date-overlay">Mar - Jun 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Partisipasi saya dalam REVEAL 2024 (Renewable Energy Innovation Festival) yang diselenggarakan Universitas Brawijaya menandai eksplorasi mendalam saya di bidang energi terbarukan. Saya mengusung konsep Net Zero Emission (NZE) melalui pemanfaatan limbah kulit kakao sebagai sumber energi berbasis bioetanol. Ide ini lahir dari pemahaman bahwa Indonesia sebagai salah satu produsen kakao terbesar di dunia memiliki potensi besar untuk mengubah limbah menjadi sumber energi alternatif, sekaligus menjawab tantangan kebutuhan energi nasional dan komitmen konservasi lingkungan global.
                </p>
            </div>
        </div>

    </div>
</div>

<!-- Modal Year 4 -->
<div id="modal-year4" class="modal">
    <div class="close-modal" onclick="closeModal('year4')">×</div>
    <div class="modal-content">

        <!-- Padjadjaran -->
        <div class="activity-card">
            <div class="photo-carousel">
                <div class="carousel-container">
                    <div class="photo-count">1 / 3</div>
                    <div class="carousel-slides" data-carousel="padjadjaran">
                        <div class="carousel-slide placeholder">
                            <div>Padjadjaran Green Innovation Summit<br><small>Upload foto acara</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Paper presentation<br><small>Upload foto presentasi</small></div>
                        </div>
                        <div class="carousel-slide placeholder">
                            <div>Award ceremony<br><small>Upload foto penghargaan</small></div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="moveCarousel('padjadjaran', -1)">‹</button>
                    <button class="carousel-nav next" onclick="moveCarousel('padjadjaran', 1)">›</button>
                    <div class="carousel-indicators">
                        <button class="carousel-indicator active" onclick="goToSlide('padjadjaran', 0)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('padjadjaran', 1)"></button>
                        <button class="carousel-indicator" onclick="goToSlide('padjadjaran', 2)"></button>
                    </div>
                    <div class="activity-info-overlay">
                        <h3 class="activity-title-overlay">Padjadjaran Green Innovation Summit 2024</h3>
                        <div class="activity-meta">
                            <span class="activity-role-overlay">Best Paper Nominee</span>
                            <span class="activity-date-overlay">Okt - Nov 2024</span>
                        </div>
                        <button class="expand-description-btn" onclick="toggleDescription(this)">Lihat Deskripsi ↓</button>
                    </div>
                </div>
            </div>
            <div class="activity-description-section collapsed">
                <p class="activity-description-text">
                    Terpilih sebagai Best Paper / First Winner Nominee pada Padjadjaran Green Innovation Summit 2024 yang diselenggarakan Universitas Padjadjaran merupakan validasi akademik dari konsep SMART PERMAVILLAGE yang telah saya kembangkan. Dalam summit ini, saya mempresentasikan bagaimana program sistematis yang mengombinasikan waste-to-energy dan efficient energy for food dapat secara nyata memperkuat keberlanjutan di tingkat komunitas. Pengakuan ini menunjukkan bahwa pendekatan holistik dalam mengatasi isu lingkungan melalui inovasi teknologi dan pemberdayaan masyarakat mendapat apresiasi tinggi di tingkat akademik nasional.
                </p>
                <div class="achievement-badge">Best Paper Nominee</div>
            </div>
        </div>

    </div>
</div>

<script>
    // Carousel state management
    const carouselState = {};

    function initCarousel(id) {
        if (!carouselState[id]) carouselState[id] = {
            currentSlide: 0
        };
    }

    function moveCarousel(id, dir) {
        initCarousel(id);
        const slides = document.querySelector(`[data-carousel="${id}"]`);
        if (!slides) return;
        const total = slides.children.length;
        let cur = carouselState[id].currentSlide + dir;
        carouselState[id].currentSlide = Math.max(0, Math.min(cur, total - 1));
        updateCarousel(id);
    }

    function goToSlide(id, idx) {
        initCarousel(id);
        carouselState[id].currentSlide = idx;
        updateCarousel(id);
    }

    function updateCarousel(id) {
        const slides = document.querySelector(`[data-carousel="${id}"]`);
        if (!slides) return;
        const cur = carouselState[id].currentSlide;
        const total = slides.children.length;

        slides.style.transform = `translateX(-${cur * 100}%)`;

        const container = slides.closest('.carousel-container');
        container.querySelectorAll('.carousel-indicator').forEach((ind, i) => {
            ind.classList.toggle('active', i === cur);
        });

        const count = container.querySelector('.photo-count');
        if (count) count.textContent = `${cur + 1} / ${total}`;

        const prev = container.querySelector('.carousel-nav.prev');
        const next = container.querySelector('.carousel-nav.next');
        if (prev) prev.disabled = cur === 0;
        if (next) next.disabled = cur === total - 1;
    }

    function initAllCarousels() {
        document.querySelectorAll('[data-carousel]').forEach(el => {
            const id = el.getAttribute('data-carousel');
            initCarousel(id);
            updateCarousel(id);
        });
    }

    // Toggle description
    function toggleDescription(btn) {
        const section = btn.closest('.activity-card').querySelector('.activity-description-section');
        const expanded = section.classList.toggle('expanded');
        section.classList.toggle('collapsed', !expanded);
        btn.textContent = expanded ? 'Sembunyikan ↑' : 'Lihat Deskripsi ↓';
    }

    // ─── Carousel antar kegiatan (dalam modal) ───
    const activityState = {};

    function setupActivityCarousel(year) {
        const modal = document.getElementById('modal-' + year);
        const content = modal.querySelector('.modal-content');
        if (content.dataset.carouselReady) return;

        const cards = Array.from(content.children).filter(el => el.classList.contains('activity-card'));
        if (cards.length === 0) {
            content.dataset.carouselReady = '1';
            return;
        }

        const track = document.createElement('div');
        track.className = 'activity-track';
        cards.forEach(c => track.appendChild(c));
        content.appendChild(track);

        activityState[year] = { index: 0, total: cards.length };

        if (cards.length > 1) {
            const nav = document.createElement('div');
            nav.className = 'activity-nav';
            nav.innerHTML = `
                <button class="activity-nav-btn" data-dir="-1">‹ Sebelumnya</button>
                <div class="activity-dots-wrap">
                    <div class="activity-dots">
                        ${cards.map((_, i) =>
                            `<button class="activity-dot${i === 0 ? ' active' : ''}" data-idx="${i}" aria-label="Kegiatan ${i + 1}"></button>`
                        ).join('')}
                    </div>
                    <span class="activity-counter">1 / ${cards.length}</span>
                </div>
                <button class="activity-nav-btn" data-dir="1">Berikutnya ›</button>
            `;
            content.appendChild(nav);

            nav.querySelectorAll('.activity-nav-btn').forEach(btn =>
                btn.addEventListener('click', () => moveActivity(year, parseInt(btn.dataset.dir, 10)))
            );
            nav.querySelectorAll('.activity-dot').forEach(dot =>
                dot.addEventListener('click', () => goToActivity(year, parseInt(dot.dataset.idx, 10)))
            );

            // Swipe di layar sentuh
            let startX = null;
            track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
            track.addEventListener('touchend', e => {
                if (startX === null) return;
                const dx = e.changedTouches[0].clientX - startX;
                if (Math.abs(dx) > 50) moveActivity(year, dx < 0 ? 1 : -1);
                startX = null;
            }, { passive: true });
        }

        content.dataset.carouselReady = '1';
        updateActivity(year);
    }

    function collapseDescriptions(year) {
        const modal = document.getElementById('modal-' + year);
        modal.querySelectorAll('.activity-description-section.expanded').forEach(sec => {
            sec.classList.remove('expanded');
            sec.classList.add('collapsed');
            const btn = sec.closest('.activity-card').querySelector('.expand-description-btn');
            if (btn) btn.textContent = 'Lihat Deskripsi ↓';
        });
    }

    function moveActivity(year, dir) {
        const st = activityState[year];
        if (!st) return;
        const next = Math.max(0, Math.min(st.index + dir, st.total - 1));
        if (next === st.index) return;
        st.index = next;
        collapseDescriptions(year);
        updateActivity(year);
    }

    function goToActivity(year, idx) {
        const st = activityState[year];
        if (!st || idx === st.index) return;
        st.index = idx;
        collapseDescriptions(year);
        updateActivity(year);
    }

    function updateActivity(year) {
        const modal = document.getElementById('modal-' + year);
        const st = activityState[year];
        if (!modal || !st) return;

        const track = modal.querySelector('.activity-track');
        if (track) track.style.transform = `translateX(-${st.index * 100}%)`;

        modal.querySelectorAll('.activity-dot').forEach((d, i) =>
            d.classList.toggle('active', i === st.index)
        );

        const counter = modal.querySelector('.activity-counter');
        if (counter) counter.textContent = `${st.index + 1} / ${st.total}`;

        const btns = modal.querySelectorAll('.activity-nav-btn');
        if (btns.length === 2) {
            btns[0].disabled = st.index === 0;
            btns[1].disabled = st.index === st.total - 1;
        }

        modal.scrollTop = 0;
    }

    // Modal
    function openModal(year) {
        document.getElementById('modal-' + year).classList.add('active');
        document.body.style.overflow = 'hidden';
        setupActivityCarousel(year);
        if (activityState[year]) {
            activityState[year].index = 0;
            collapseDescriptions(year);
            updateActivity(year);
        }
        setTimeout(initAllCarousels, 100);
    }

    function closeModal(year) {
        document.getElementById('modal-' + year).classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close on backdrop click or Escape
    document.addEventListener('click', e => {
        if (e.target.classList.contains('modal')) {
            e.target.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    document.addEventListener('keydown', e => {
        const active = document.querySelector('.modal.active');

        if (e.key === 'Escape' && active) {
            active.classList.remove('active');
            document.body.style.overflow = '';
            return;
        }

        if (active && (e.key === 'ArrowLeft' || e.key === 'ArrowRight')) {
            const year = active.id.replace('modal-', '');
            moveActivity(year, e.key === 'ArrowRight' ? 1 : -1);
        }
    });

    // ─── Scroll reveal untuk timeline items ───
    (function() {
        const items = document.querySelectorAll('.timeline-item, .summary-section');

        if (!('IntersectionObserver' in window)) {
            items.forEach(el => el.classList.add('revealed'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px'
        });

        items.forEach(el => observer.observe(el));
    })();

    // ─── Progress line mengikuti scroll ───
    (function() {
        const timeline = document.querySelector('.timeline');
        const progress = document.querySelector('.timeline-progress');
        if (!timeline || !progress) return;

        function updateProgress() {
            const rect = timeline.getBoundingClientRect();
            const viewportMid = window.innerHeight * 0.6;
            const total = rect.height;
            const passed = Math.min(Math.max(viewportMid - rect.top, 0), total);
            progress.style.height = (passed / total * 100) + '%';
        }

        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    updateProgress();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        updateProgress();
    })();
</script>