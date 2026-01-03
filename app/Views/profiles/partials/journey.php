<style>
    .roadmap-container {
        background-color: #b0b0b021;
        padding: 60px 20px;

        position: relative;
    }

    .roadmap-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(0deg,
                rgba(255, 255, 255, 0.02) 0px,
                transparent 2px,
                transparent 60px);
        pointer-events: none;
    }

    .roadmap-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .roadmap-header h1 {
        font-size: 3rem;
        font-weight: bold;
        background: linear-gradient(to right, #0e0d0dff, #a0a0a0, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
    }

    .roadmap-header .subtitle {
        font-size: 1.2rem;
        color: #b0b0b0;
        font-weight: 300;
    }

    .roadmap-header .instruction {
        font-size: 0.9rem;
        color: #808080;
        margin-top: 10px;
        font-style: italic;
    }

    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom,
                #606060 0%,
                #c0c0c0 25%,
                #505050 50%,
                #d0d0d0 75%,
                #606060 100%);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    }

    .timeline-item {
        position: relative;
        display: flex;
        align-items: center;
    }

    .timeline-item:nth-child(odd) {
        flex-direction: row;
    }

    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline-item:hover .timeline-dot {
        transform: translateX(-50%) scale(1.2);
    }

    .timeline-content {
        width: 50%;
        padding: 25px;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-right: auto;
    }

    .timeline-item:nth-child(even) .timeline-content {
        margin-left: auto;
    }

    .timeline-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s;
    }

    .timeline-content:hover::before {
        left: 100%;
    }

    .timeline-content:hover {
        transform: translateX(10px) scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
    }

    .timeline-item:nth-child(even) .timeline-content:hover {
        transform: translateX(-10px) scale(1.02);
    }

    .timeline-content.year1 {
        background: linear-gradient(135deg, #404040, #505050);
        border: 2px solid #606060;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        color: #e0e0e0;
    }

    .timeline-content.year2 {
        background: linear-gradient(135deg, #c0c0c0, #d0d0d0);
        border: 2px solid #e0e0e0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        color: #1a1a1a;
    }

    .timeline-content.year3 {
        background: linear-gradient(135deg, #505050, #606060);
        border: 2px solid #707070;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        color: #e0e0e0;
    }

    .timeline-content.year4 {
        background: linear-gradient(135deg, #d0d0d0, #e0e0e0);
        border: 2px solid #f0f0f0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        color: #1a1a1a;
    }

    .year-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .timeline-content.year2 .year-badge,
    .timeline-content.year4 .year-badge {
        background: rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    .content-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .content-description {
        opacity: 0.8;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .content-details {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
    }

    .timeline-content.active .content-details {
        max-height: 500px;
    }

    .highlights-title {
        font-weight: 600;
        margin: 15px 0 10px 0;
        font-size: 1.1rem;
    }

    .highlights-list {
        list-style: none;
        padding: 0;
        margin-bottom: 15px;
    }

    .highlights-list li {
        margin-bottom: 8px;
        padding-left: 20px;
        position: relative;
        opacity: 0.9;
    }

    .highlights-list li::before {
        content: '▪';
        position: absolute;
        left: 0;
        font-size: 1.2rem;
        opacity: 0.6;
    }

    /* Year 1 - Dark Silver */
    .year1 .achievement-box {
        background: linear-gradient(135deg, rgba(80, 80, 80, 0.6), rgba(100, 100, 100, 0.6));
        border: 2px solid rgba(120, 120, 120, 0.8);
        box-shadow:
            0 4px 15px rgba(100, 100, 100, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        color: #e0e0e0;
    }

    .year1 .achievement-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
        transition: left 0.5s;
    }

    .year1 .achievement-box:hover::before {
        left: 100%;
    }

    .year1 .achievement-box:hover {
        transform: translateY(-5px);
        box-shadow:
            0 8px 25px rgba(120, 120, 120, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Year 2 - Light Gray */
    .year2 .achievement-box {
        background: linear-gradient(135deg, rgba(180, 180, 180, 0.7), rgba(200, 200, 200, 0.7));
        border: 2px solid rgba(220, 220, 220, 0.9);
        box-shadow:
            0 4px 15px rgba(160, 160, 160, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.5);
        position: relative;
        overflow: hidden;
        color: #1a1a1a;
    }

    .year2 .achievement-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .year2 .achievement-box:hover::before {
        left: 100%;
    }

    .year2 .achievement-box:hover {
        transform: translateY(-5px);
        box-shadow:
            0 8px 25px rgba(180, 180, 180, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }

    /* Year 3 - Medium Gray */
    .year3 .achievement-box {
        background: linear-gradient(135deg, rgba(90, 90, 90, 0.6), rgba(110, 110, 110, 0.6));
        border: 2px solid rgba(130, 130, 130, 0.8);
        box-shadow:
            0 4px 15px rgba(110, 110, 110, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        color: #e0e0e0;
    }

    .year3 .achievement-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
        transition: left 0.5s;
    }

    .year3 .achievement-box:hover::before {
        left: 100%;
    }

    .year3 .achievement-box:hover {
        transform: translateY(-5px);
        box-shadow:
            0 8px 25px rgba(130, 130, 130, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Year 4 - Bright Silver */
    .year4 .achievement-box {
        background: linear-gradient(135deg, rgba(190, 190, 190, 0.7), rgba(210, 210, 210, 0.7));
        border: 2px solid rgba(230, 230, 230, 0.9);
        box-shadow:
            0 4px 15px rgba(170, 170, 170, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.5);
        position: relative;
        overflow: hidden;
        color: #1a1a1a;
    }

    .year4 .achievement-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .year4 .achievement-box:hover::before {
        left: 100%;
    }

    .year4 .achievement-box:hover {
        transform: translateY(-5px);
        box-shadow:
            0 8px 25px rgba(190, 190, 190, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }

    /* Base styling untuk semua achievement box */
    .achievement-box {
        transition: all 0.3s ease;
        border-radius: 10px;
        padding: 20px;
        margin-top: 15px;
    }

    .achievement-box p {
        font-weight: 500;
        font-size: 0.95rem;
        margin: 0;
        line-height: 1.6;
    }

    .summary-section {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        max-width: 800px;
        background: linear-gradient(135deg, #2d2d2d, #404040);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        margin-top: 60px;
    }



    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .summary-section h2 {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #e0e0e0;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .summary-section p {
        text-align: center;
        font-size: 1.1rem;
        color: #b0b0b0;
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .roadmap-header h1 {
            font-size: 2rem;
        }

        .timeline-line {
            display: none;
        }

        .timeline-item {
            flex-direction: column !important;
            margin-bottom: 40px;
        }

        .timeline-dot {
            position: relative;
            left: 0;
            transform: none;
            margin-bottom: 20px;
        }

        .timeline-item:hover .timeline-dot {
            transform: scale(1.2);
        }

        .timeline-content {
            width: 100% !important;
            padding: 20px !important;
            margin: 0 !important;
        }

        .timeline-content:hover {
            transform: scale(1.02) !important;
        }
    }
</style>

<div class="roadmap-container">
    <div class="roadmap-header">
        <h1>My Career Journey</h1>
        <p class="subtitle">Environmental Engineering at Gadjah Mada University</p>
        <p class="instruction">Click on any year to explore the journey details</p>
    </div>

    <div class="timeline">
        <div class="timeline-line"></div>

        <!-- Year 1 -->
        <div class="timeline-item">
            <div class="timeline-content year1" onclick="toggleDetails(this)">
                <span class="year-badge">2021-2022</span>
                <h3 class="content-title year1">First Year: Foundation</h3>
                <p class="content-description year1">Adapting to university life at Gadjah Mada University and Yogyakarta</p>
                <div class="content-details">
                    <h4 class="highlights-title year1">Key Highlights:</h4>
                    <ul class="highlights-list year1">
                        <li>Adjusted to new academic environment</li>
                        <li>Explored Environmental Engineering fundamentals</li>
                        <li>Developed self-improvement strategies</li>
                        <li>Created initial career planning framework</li>
                    </ul>
                    <div class="achievement-box year1">
                        <p>Successfully transitioned to university life and established academic foundation</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Year 2 -->
        <div class="timeline-item">
            <div class="timeline-content year2" onclick="toggleDetails(this)">
                <span class="year-badge">2022-2023</span>
                <h3 class="content-title year2">Second Year: Exploration</h3>
                <p class="content-description year2">Beginning of organizational involvement and leadership development</p>
                <div class="content-details">
                    <h4 class="highlights-title year2">Key Highlights:</h4>
                    <ul class="highlights-list year2">
                        <li>Joined multiple student organizations</li>
                        <li>Participated in study community activities</li>
                        <li>Engaged with law executive organization</li>
                        <li>Developed leadership and teamwork skills</li>
                    </ul>
                    <div class="achievement-box year2">
                        <p>Built strong foundation in organizational leadership and collaboration</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Year 3 -->
        <div class="timeline-item">
            <div class="timeline-content year3" onclick="toggleDetails(this)">
                <span class="year-badge">2023-2024</span>
                <h3 class="content-title year3">Third Year: Transformation</h3>
                <p class="content-description year3">Career-defining project work in sustainable waste management</p>
                <div class="content-details">
                    <h4 class="highlights-title year3">Key Highlights:</h4>
                    <ul class="highlights-list year3">
                        <li>Led sustainable waste management project in urban areas</li>
                        <li>Enhanced technical engineering skills</li>
                        <li>Discovered passion for environmental advocacy</li>
                        <li>Recognized importance of social impact</li>
                    </ul>
                    <div class="achievement-box year3">
                        <p>Pivotal moment: Found true calling in environmental advocacy and social impact</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Year 4 -->
        <div class="timeline-item">
            <div class="timeline-content year4" onclick="toggleDetails(this)">
                <span class="year-badge">2024-2025</span>
                <h3 class="content-title year4">Fourth Year: Specialization</h3>
                <p class="content-description year4">Deep dive into environmental policy and law</p>
                <div class="content-details">
                    <h4 class="highlights-title year4">Key Highlights:</h4>
                    <ul class="highlights-list year4">
                        <li>Studied environmental policies and implementation</li>
                        <li>Attended workshops on pressing environmental issues</li>
                        <li>Participated in environmental law seminars</li>
                        <li>Solidified career direction in environmental law and policy</li>
                    </ul>
                    <div class="achievement-box year4">
                        <p>Committed to pursuing career in environmental law and policy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="summary-section">
        <h2>Journey Summary</h2>
        <p>"From adapting to university life to discovering my passion for environmental advocacy,
            my journey at Gadjah Mada University has been transformative.
            Through organizational involvement, hands-on projects, and deep exploration of environmental policy,
            I've found my calling in environmental law and policy, ready to make a positive impact on society."</p>
    </div>
</div>

<script>
    function toggleDetails(element) {
        // Remove active class from all items
        const allItems = document.querySelectorAll('.timeline-content');
        allItems.forEach(item => {
            if (item !== element) {
                item.classList.remove('active');
            }
        });

        // Toggle active class on clicked item
        element.classList.toggle('active');
    }
</script>