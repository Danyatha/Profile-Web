<?php helper('text'); ?>
<?= $this->extend('layout/default'); ?>
<?= $this->section('content'); ?>

<div id="imgModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --brown:     #9c6f3e;
    --brown-d:   #7a5430;
    --brown-l:   #c5a37d;
    --brown-xl:  #e8d5bc;
    --navy:      #0d1f35;
    --navy-mid:  #1a3352;
    --accent:    #9c6f3e;
    --soft:      #f4f2ee;
    --page-bg:   #f5f3ef;
    --card-bg:   #ffffff;
    --border:    #ddd9d3;
    --text:      #1c1814;
    --muted:     #8a8480;
    --sans:      'Sora', system-ui, sans-serif;
    --serif:     'Playfair Display', Georgia, serif;
}

body {
    font-family: var(--sans);
    background: var(--page-bg);
    color: var(--text);
    overflow-x: hidden;
}

/* ─── UTILITIES ─────────────────────────────────────── */
.section-label {
    font-size: 13px;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: var(--brown);
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}
.section-heading {
    font-family: var(--serif);
    font-size: clamp(26px, 3vw, 40px);
    color: var(--navy);
    line-height: 1.2;
    font-weight: 700;
}
.section-heading em {
    font-style: italic;
    color: var(--brown);
}

/* ─── BG LAYERS ──────────────────────────────────────── */
.bg-campus {
    position: fixed; inset: 0;
    background: url('<?= base_url('images/GSP.webp') ?>') center 20% / cover no-repeat;
    opacity: .06;
    filter: grayscale(100%);
    z-index: 0;
    pointer-events: none;
}
.bg-noise {
    position: fixed; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    opacity: .35;
    z-index: 0;
    pointer-events: none;
}

/* ─── HERO ───────────────────────────────────────────── */
.hero {
    position: relative; z-index: 1;
    min-height: calc(100vh - 72px);
    padding: 0 5%;
    display: grid;
    grid-template-columns: 4fr 1fr 1fr;
    align-items: center;
    overflow: hidden;
}

.deco-wedge {
    position: absolute;
    left: 40%; top: 40%;
    width: 72%; height: 80%;
    background: linear-gradient(120deg, #ffffff 55%, #f0ebe3 100%);
    box-shadow: 10px 12px 32px rgba(0,0,0,.12);
    clip-path: polygon(50% 0%, 97% 35%, 79% 91%, 21% 91%, 3% 35%);
    filter: drop-shadow(0 12px 50px rgba(0,0,0,.18));
    z-index: 0; opacity: .9;
    pointer-events: none;
}

.deco-hex-large {
    position: absolute; right: -180px; top: 30px;
    width: 420px; opacity: .08;
    pointer-events: none; z-index: -1;
}
.deco-hex-large img {
    display: block; width: 100%; height: auto;
    animation: gearSpin 40s linear infinite;
}
@keyframes gearSpin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}
.deco-hex-medium {
    position: absolute; right: 12%; top: 36%;
    width: 100px; pointer-events: none; z-index: 2;
}
.deco-hex-medium img {
    display: block; width: 100%; height: auto;
    opacity: .15;
    animation: gearSpinReverse 25s linear infinite;
}
@keyframes gearSpinReverse {
    from { transform: rotate(360deg); }
    to   { transform: rotate(0deg); }
}
.deco-hex-small {
    position: absolute; right: 33%; bottom: 18%;
    width: 38px; height: 38px;
    border: 1.5px solid var(--brown-l);
    clip-path: polygon(25% 6.7%, 75% 6.7%, 100% 50%, 75% 93.3%, 25% 93.3%, 0 50%);
    opacity: .55; z-index: 2; pointer-events: none;
}

.deco-dots {
    position: absolute; pointer-events: none; z-index: 1;
    display: grid; gap: 14px;
}
.deco-dots-tl { left: 1%; top: 8%; grid-template-columns: repeat(4,1fr); }
.deco-dots span {
    width: 4px; height: 4px; border-radius: 50%;
    background: var(--brown); opacity: .35; display: block;
}

.deco-lines { position: absolute; pointer-events: none; z-index: 0; overflow: hidden; }
.deco-lines svg { display: block; }

.deco-float-badge {
    position: absolute; z-index: 6;
    left: 37%; bottom: 25%;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 50px;
    padding: 8px 14px;
    display: flex; align-items: center; gap: 8px;
    box-shadow: 0 6px 20px rgba(0,0,0,.09);
    font-size: 11.5px; font-weight: 600; color: var(--text);
    animation: floatBadge 3s ease-in-out infinite;
    white-space: nowrap;
}
.deco-float-badge .dot-pulse {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--brown);
    animation: pulse 1.5s ease-in-out infinite;
}
@keyframes floatBadge {
    0%,100% { transform: translateY(0); }
    50%      { transform: translateY(-8px); }
}
@keyframes pulse {
    0%,100% { box-shadow: 0 0 0 0 rgba(156,111,62,.4); }
    50%      { box-shadow: 0 0 0 6px rgba(156,111,62,0); }
}

.deco-scroll {
    position: absolute; left: 5%; bottom: 28px; z-index: 6;
    display: flex; align-items: center; gap: 10px;
    font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase;
    color: var(--muted);
}
.deco-scroll .scroll-line { width: 40px; height: 1px; background: var(--muted); opacity: .5; }
.deco-scroll .scroll-dot {
    width: 6px; height: 6px; border-radius: 50%;
    border: 1.5px solid var(--muted);
    animation: scrollBounce 2s ease-in-out infinite;
}
@keyframes scrollBounce {
    0%,100% { transform: translateY(0); }
    50%      { transform: translateY(3px); }
}

/* ── Floating cards ── */
.float-card {
    position: absolute;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: 0 8px 28px rgba(0,0,0,.08);
    z-index: 6; pointer-events: none;
}
.fc-project {
    top: 8%; right: 3%;
    padding: 13px 16px;
    display: flex; align-items: center; gap: 11px;
    min-width: 210px;
    animation: floatA 4s ease-in-out infinite;
}
.fc-project .fc-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: rgba(156,111,62,.1);
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.fc-project .fc-text strong { display: block; font-size: 12px; font-weight: 700; color: var(--text); }
.fc-project .fc-text span  { display: block; font-size: 10.5px; color: var(--muted); margin-top: 2px; }

.fc-research {
    top: 24%; right: 3%;
    padding: 13px 16px;
    display: flex; align-items: center; gap: 11px;
    min-width: 230px;
    animation: floatB 3.5s ease-in-out infinite;
}
.fc-research .fc-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: rgba(156,111,62,.1);
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; color: var(--brown); flex-shrink: 0;
}
.fc-research .fc-text strong { display: block; font-size: 12px; font-weight: 700; color: var(--text); }
.fc-research .fc-text span   { display: block; font-size: 10.5px; color: var(--muted); margin-top: 2px; }

.fc-verified {
    top: 42%; right: 3%;
    padding: 11px 15px;
    display: flex; align-items: center; gap: 9px;
    animation: floatC 5s ease-in-out infinite;
}
.fc-verified .check {
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--brown);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 13px; flex-shrink: 0;
}
.fc-verified .fc-text strong { display: block; font-size: 11.5px; font-weight: 700; color: var(--text); }
.fc-verified .fc-text span   { font-size: 10px; color: var(--muted); }

@keyframes floatA { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
@keyframes floatB { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-7px); } }
@keyframes floatC { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

/* ── Hero columns ── */
.col-left {
    position: relative; z-index: 5;
    grid-column: 1;
    padding-right: 2%;
    animation: fadeUp .7s ease both;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0); }
    
}

.col-left h1 {
    font-size: clamp(32px, 3.6vw, 60px);
    line-height: 1.07; font-weight: 500;
    letter-spacing: -.025em;
    width: max-content;
}
.col-left h1 span { color: var(--brown);font-weight: 800; }

.tagline {
    margin-top: 18px; max-width: 520px;
    font-size: 20px; line-height: 1.85;
}

.cta-row { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 28px; }

.btn-fill {
    background: var(--brown); color: #fff;
    padding: 14px 30px; border-radius: 50px;
    text-decoration: none; font-weight: 700; font-size: 14px;
    box-shadow: 0 8px 22px rgba(156,111,62,.28);
    transition: all .22s;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-fill:hover { background: var(--brown-d); transform: translateY(-2px); box-shadow: 0 12px 28px rgba(156,111,62,.35); color: #fff; }

.btn-outline-hero {
    border: 1.5px solid var(--border); color: var(--text);
    text-decoration: none; padding: 14px 30px; border-radius: 50px;
    font-weight: 600; font-size: 14px; background: var(--card-bg);
    transition: all .22s;
}
.btn-outline-hero:hover { border-color: var(--brown); color: var(--brown); transform: translateY(-2px); }

/* ── Stats ── */
.stats {
    margin-top: 36px;
    display: inline-flex; flex-direction: column; align-items: center;
    min-width: 340px; padding: 24px 28px;
    background: rgba(255,255,255,.18);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(156,111,62,.18);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.04);
}
.stat-big { text-align: center; }
.stat-big strong { display: block; font-size: 52px; line-height: 1; font-weight: 800; color: var(--brown); }
.stat-big span   { display: block; margin-top: 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); }
.stat-divider-h  { width: 100%; height: 1px; margin: 18px 0; background: linear-gradient(to right, transparent, rgba(156,111,62,.22), transparent); }
.stat-small-row  { width: 100%; display: flex; align-items: center; justify-content: center; }
.stat-small      { flex: 1; text-align: center; }
.stat-small strong { display: block; font-size: 30px; line-height: 1; font-weight: 800; color: var(--brown); }
.stat-small span   { display: block; margin-top: 5px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); }
.stat-divider-v    { width: 1px; height: 42px; margin: 0 24px; background: rgba(156,111,62,.18); }

/* ── Center photo ── */
.col-center {
    position: relative; z-index: 4;
    grid-column: 2;
    display: flex; justify-content: center; align-items: flex-end;
    height: 100%; min-height: calc(100vh - 72px);
}
.hero-photo {
    position: relative; z-index: 6;
    width: auto; max-width: none;
    height: calc(88vh - 40px);
    left: -20%; transform: translate(-50%, 2%);
    transform-origin: center bottom;
    filter: drop-shadow(0 32px 64px rgba(0,0,0,.18)) drop-shadow(0 8px 24px rgba(156,111,62,.15));
    pointer-events: none; user-select: none;
    animation: fadeUp .9s .2s ease both;
}

/* ── Right carousel column ── */
.col-right {
    position: absolute; z-index: 3;
    bottom: 80px; right: 2%; width: 42%;
    display: flex; flex-direction: column; gap: 14px; align-items: flex-end;
    animation: fadeUp .7s .35s ease both;
}
.cards-viewport { width: 100%; overflow: hidden; border-radius: 18px; }
.cards-track {
    display: flex; gap: 12px;
    transition: transform .55s cubic-bezier(.4,0,.2,1);
    will-change: transform;
}
.pcard {
    min-width: calc(50% - 6px); flex-shrink: 0;
    position: relative; border-radius: 18px; overflow: hidden;
    background: #ddd; box-shadow: 0 8px 28px rgba(0,0,0,.13);
    cursor: pointer; transition: transform .2s;
}
.pcard:hover { transform: scale(1.02); }
.pcard img { width: 100%; height: 220px; object-fit: cover; display: block; }
.pcard-overlay {
    position: absolute; inset: 0; top: auto;
    padding: 14px 16px;
    background: linear-gradient(transparent, rgba(0,0,0,.72));
    color: #fff;
}
.pcard-overlay h4 { font-size: 12px; font-weight: 700; margin-bottom: 2px; }
.pcard-overlay p  { font-size: 10px; opacity: .82; }
.play-btn {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(255,255,255,.90);
    display: flex; align-items: center; justify-content: center;
    color: var(--brown); font-size: 15px;
    opacity: 0; transition: opacity .2s;
}
.pcard:hover .play-btn { opacity: 1; }

.indicator { display: flex; align-items: center; gap: 12px; width: 100%; padding: 0 2px; }
.ind-cur { font-size: 18px; font-weight: 800; color: var(--brown); min-width: 24px; }
.ind-tot { font-size: 14px; font-weight: 600; color: var(--muted); min-width: 24px; }
.ind-bar { flex: 1; height: 2px; background: var(--border); border-radius: 2px; overflow: hidden; }
.ind-fill { height: 100%; background: var(--brown); border-radius: 2px; transition: width .55s cubic-bezier(.4,0,.2,1); }

/* ─── MENU SECTION ───────────────────────────────────── */
.menu-section { padding: 90px 7vw; background: var(--page-bg); position: relative; z-index: 1; }
.menu-section-top { margin-bottom: 48px; }
.cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}
@media (max-width: 900px) { .cards-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .cards-grid { grid-template-columns: 1fr; } }

.menu-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden; text-decoration: none; display: block;
    transition: box-shadow .25s, transform .25s;
}
.menu-card:hover { box-shadow: 0 18px 52px rgba(28,24,20,.1); transform: translateY(-5px); }
.menu-card:hover .card-img-inner { transform: scale(1.05); }
.menu-card:hover .card-arrow { transform: translateX(4px); }

.card-img-wrap { height: 175px; overflow: hidden; }
.card-img-inner { width: 100%; height: 100%; transition: transform .5s ease; }
.card-img-inner img { width: 100%; height: 100%; object-fit: cover; display: block; }

.card-body-inner { padding: 22px 22px 20px; }
.card-num { font-size: 12px; letter-spacing: .18em; color: var(--brown); text-transform: uppercase; margin-bottom: 8px; font-weight: 600; }
.card-title-text { font-family: var(--serif); font-size: 19px; color: var(--navy); font-weight: 700; margin-bottom: 8px; line-height: 1.3; }
.card-desc { font-size: 15px; color: var(--muted); line-height: 1.75; margin-bottom: 18px; }
.card-arrow { font-size: 14px; color: var(--brown); letter-spacing: .06em; transition: transform .2s; display: inline-block; font-weight: 600; }

/* ─── INTERESTS ──────────────────────────────────────── */
.interests-section {
    background: var(--page-bg);
    opacity: 1;
    padding: 90px 7vw;
    position: relative; overflow: hidden; z-index: 1;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}
.interests-section::before {
    content: '';
    position: absolute; right: -80px; top: 50%; transform: translateY(-50%);
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(156,111,62,.07), transparent 70%);
    pointer-events: none;
}

.interests-section .section-heading { color: var(--text); }

.interests-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px; margin-top: 42px;
}
@media (max-width: 860px) { .interests-grid { grid-template-columns: 1fr; } }

.interest-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 30px 26px;
    transition: border-color .25s, box-shadow .25s, transform .25s;
}
.interest-card:hover {
    border-color: var(--brown-l);
    box-shadow: 0 12px 36px rgba(156,111,62,.1);
    transform: translateY(-4px);
}
.int-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: rgba(156,111,62,.1);
    border: 1px solid rgba(156,111,62,.2);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px; color: var(--brown);
}
.int-title {
    font-family: var(--serif);
    font-size: 18px; color: var(--text);
    margin-bottom: 12px; font-weight: 700;
}
.int-text { font-size: 15px; color: var(--muted); line-height: 1.8; }

/* ─── JOURNAL ────────────────────────────────────────── */
.journal-section {
    background-color: var(--card-bg);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 90px 7vw;
    position: relative; z-index: 1;
}
.journal-top {
    display: flex; align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 42px; gap: 20px; flex-wrap: wrap;
}
.journal-section .section-heading { margin-bottom: 0; }
.view-all {
    font-size: 11px; letter-spacing: .12em; text-transform: uppercase;
    color: var(--navy); border-bottom: 1px solid var(--navy);
    text-decoration: none; padding-bottom: 3px;
    transition: color .2s, border-color .2s; white-space: nowrap;
    font-weight: 600;
}
.view-all:hover { color: var(--brown); border-color: var(--brown); }

.journal-grid { display: flex; flex-direction: column; gap: 20px; }

.j-featured {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
    text-decoration: none;
    transition: box-shadow .25s, transform .25s;
}
.j-featured:hover { box-shadow: 0 10px 32px rgba(28,24,20,.09); transform: translateY(-3px); }
.j-featured:hover .j-img-inner { transform: scale(1.03); }
.j-feat-inner { display: flex; flex-direction: row; align-items: stretch; }
.j-feat-img-wrap { width: 420px; flex-shrink: 0; overflow: hidden; min-height: 260px; }
.j-feat-body { padding: 28px 28px 24px; flex: 1; display: flex; flex-direction: column; }

.j-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
@media (max-width: 860px) { .j-row { grid-template-columns: 1fr; } }

.j-card {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
    text-decoration: none; display: flex; flex-direction: column;
    transition: box-shadow .25s, transform .25s;
}
.j-card:hover { box-shadow: 0 8px 24px rgba(28,24,20,.08); transform: translateY(-3px); }
.j-card:hover .j-img-inner { transform: scale(1.04); }
.j-card-img-wrap { height: 180px; overflow: hidden; flex-shrink: 0; }
.j-card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }

.j-img-inner { width: 100%; height: 100%; max-height: 300px; transition: transform .5s ease; }
.j-img-inner img { width: 100%; height: 100%; object-fit: cover; display: block; }
.j-no-img {
    width: 100%; height: 100%;
    background: linear-gradient(135deg, #f0ece4 0%, #e8e0d0 100%);
    display: flex; align-items: center; justify-content: center;
}

.j-tag {
    display: inline-block;
    background-color: rgba(156,111,62,.12);
    color: #7a5430;
    font-size: 9px; letter-spacing: .13em; text-transform: uppercase;
    font-weight: 700; padding: 3px 10px; border-radius: 20px;
    margin-bottom: 10px; width: fit-content;
}
.j-title {
    font-family: var(--serif);
    font-size: 18px; color: var(--navy);
    font-weight: 700; line-height: 1.35; margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.j-feat-body .j-title { font-size: 24px; -webkit-line-clamp: 3; }
.j-excerpt {
    font-size: 13px; color: var(--muted); line-height: 1.75; flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.j-date { font-size: 11px; color: var(--muted); letter-spacing: .04em; margin-top: 14px; font-weight: 500; }

/* ─── ABOUT STRIP ─────────────────────────────────────── */
.about-section {
    padding: 90px 7vw;
    background: var(--card-bg);
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 64px;
    position: relative; z-index: 1;
}
@media (max-width: 768px) {
    .about-section { grid-template-columns: 1fr; gap: 40px; }
    .about-visual { order: -1; }
}
.about-section .section-heading { margin-bottom: 20px; }
.about-p { font-size: 17px; color: var(--muted); line-height: 1.9; margin-bottom: 30px; text-align: justify; max-width: max-content; }

.btn-outline-navy {
    display: inline-block;
    border: 1.5px solid var(--navy); color: var(--navy);
    padding: 12px 28px; border-radius: 50px;
    font-size: 14px; letter-spacing: .07em;
    text-decoration: none; font-family: var(--sans); font-weight: 600;
    transition: background .2s, color .2s;
}
.btn-outline-navy:hover { background: var(--navy); color: #fff; }

.about-visual {
    position: relative; border-radius: 20px; overflow: hidden;
    height: 380px; background: var(--soft);
    border: 1px solid var(--border);
}
.about-visual img { width: 100%; height: 100%; object-fit: contain; }
.about-visual-acc {
    position: absolute; bottom: 20px; right: 20px;
    background: var(--navy); color: var(--brown-xl);
    font-size: 13px; letter-spacing: .12em; text-transform: uppercase;
    padding: 8px 16px; border-radius: 50px; font-weight: 600;
}

/* ─── RESPONSIVE HERO ────────────────────────────────── */
@media (max-width: 1100px) {
    .hero {
        min-height: auto;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto auto;
        padding: 30px 5% 60px;
        gap: 30px 20px; align-items: start;
    }
    .col-left  { grid-column: 1; grid-row: 1; }
    .col-center{ grid-column: 2; grid-row: 1/3; min-height: unset; align-items: flex-start; padding-top: 20px; }
    .col-right {
        position: relative; bottom: auto; right: auto;
        width: 100%; grid-column: 1; grid-row: 2;
        align-items: flex-start;
    }
    .deco-wedge { display: none; }
    .hero-photo { width: 100%; height: auto; transform: none; left: 0; }
    .float-card { display: none; }
    .deco-scroll { display: none; }
}

@media (max-width: 768px) {
    .hero {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto auto;
        text-align: center; gap: 24px;
    }
    .col-left  { grid-column: 1; grid-row: 2; }
    .col-center{ grid-column: 1; grid-row: 1; min-height: unset; justify-content: center; padding-top: 0; }
    .col-right { grid-column: 1; grid-row: 3; align-items: center; padding-left: 0; }
    .hero-photo { width: 70%; max-width: 280px; height: auto; }
    .tagline { margin-inline: auto; font-size: 14px; }
    .cta-row { justify-content: center; }
    .stats { min-width: unset; width: 100%; max-width: 320px; margin-inline: auto; }
    .pcard { min-width: calc(50% - 6px); }
    .deco-hex-large,.deco-hex-medium,.deco-hex-small,
    .deco-dots,.deco-lines,.deco-float-badge { display: none; }
}

@media (max-width: 480px) {
    .col-left h1 { font-size: 30px; width: auto; }
    .hero-photo { width: 80%; }
    .btn-fill, .btn-outline-hero { padding: 11px 20px; font-size: 13px; }
    .pcard { min-width: 80%; }
    .pcard img { height: 160px; }
    .stats { min-width: unset; width: 100%; }
}
</style>

<!-- BG layers -->
<div class="bg-campus"></div>
<div class="bg-noise"></div>


<!-- ═══════════════════════════════════════════════════ -->
<!-- HERO SECTION                                        -->
<!-- ═══════════════════════════════════════════════════ -->
<section class="hero">

    <!-- Decorative elements -->
    <div class="deco-wedge"></div>

    <div class="deco-hex-large">
        <img src="<?= base_url('images/logo-teknik.png') ?>" alt="">
    </div>
    <div class="deco-hex-medium">
        <img src="<?= base_url('images/logo-teknik.png') ?>" alt="">
    </div>
    <div class="deco-hex-small"></div>

    <div class="deco-dots deco-dots-tl">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
    </div>

    <div class="deco-lines" style="left:34%;top:0;width:4px;height:100%;z-index:1;opacity:.04;">
        <svg width="4" height="800"><line x1="0" y1="0" x2="4" y2="800" stroke="#9c6f3e" stroke-width="1.5"/></svg>
    </div>

    <div class="deco-float-badge">
        <div class="dot-pulse"></div>
        Available for projects
    </div>

    <div class="deco-scroll">
        <div class="scroll-dot"></div>
        <div class="scroll-line"></div>
        <span>Scroll</span>
    </div>

    <!-- Floating mini cards -->
    <div class="float-card fc-project">
        <div class="fc-icon">💧</div>
        <div class="fc-text">
            <strong>Latest Project</strong>
            <span>Business Plan PDAM Tirtamarta</span>
        </div>
    </div>

    <div class="float-card fc-research">
        <div class="fc-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5H1.5a.5.5 0 0 1-.5-.5v-9A.5.5 0 0 1 1.5 3h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </div>
        <div class="fc-text">
            <strong>On Going Research</strong>
            <span>Bio-Reactor Clay Pipe Filter (BRCPF)</span>
        </div>
    </div>

    <div class="float-card fc-verified">
        <div class="check">✓</div>
        <div class="fc-text">
            <strong>Certified Engineer</strong>
            <span>UGM Environmental Eng.</span>
        </div>
    </div>

    <!-- LEFT: Text -->
    <div class="col-left">
    
        <h1>Building Solutions<br>that Makes <span>IMPACT</span></h1>

        <p class="tagline">
            Hi! This is where I share a bit about who I am, what I do,
            and what I'm currently working on — from environmental systems
            to digital tools and everything in between.
        </p>

        <div class="cta-row">
            <a href="<?= base_url('profile') ?>" class="btn-fill">See My Profile →</a>
            <a href="<?= base_url('work-experiences') ?>" class="btn-outline-hero">View Experience</a>
        </div>

        <div class="stats">
            <div class="stat-big">
                <strong>9+</strong>
                <span>Work Experiences</span>
            </div>
            <div class="stat-divider-h"></div>
            <div class="stat-small-row">
                <div class="stat-small">
                    <strong>3+</strong>
                    <span>Years Organization</span>
                </div>
                <div class="stat-divider-v"></div>
                <div class="stat-small">
                    <strong>5+</strong>
                    <span>Achievements</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CENTER: Photo -->
    <div class="col-center">
        <img src="<?= base_url('images/hero-image-update.png') ?>" alt="Dany Atha Najib" class="hero-photo">
    </div>

    <!-- RIGHT: Carousel -->
    <div class="col-right">
        <div class="cards-viewport">
            <div class="cards-track" id="carouselTrack">

                <div class="pcard">
                    <img src="<?= base_url('images/image-1.webp') ?>" alt="Wastewater Planning Project">
                    <div class="play-btn">▶</div>
                    <div class="pcard-overlay">
                        <h4>Wastewater Planning Project – Banggai</h4>
                        <p>Technical Assistant</p>
                    </div>
                </div>

                <div class="pcard">
                    <img src="<?= base_url('images/image-2.webp') ?>" alt="Digital Innovation KKN">
                    <div class="play-btn">▶</div>
                    <div class="pcard-overlay">
                        <h4>Digital Innovation for KKN Thematic Waste Management</h4>
                        <p>Developer</p>
                    </div>
                </div>

                <div class="pcard">
                    <img src="<?= base_url('images/image-3.webp') ?>" alt="Wastewater Treatment Sikka">
                    <div class="play-btn">▶</div>
                    <div class="pcard-overlay">
                        <h4>Wastewater Treatment Project – Sikka</h4>
                        <p>Field Surveyor</p>
                    </div>
                </div>

                <div class="pcard">
                    <img src="<?= base_url('images/image-4.webp') ?>" alt="Infrastructure Inventory">
                    <div class="play-btn">▶</div>
                    <div class="pcard-overlay">
                        <h4>Wastewater Infrastructure Inventory Survey</h4>
                        <p>Field Surveyor</p>
                    </div>
                </div>

                <div class="pcard">
                    <img src="<?= base_url('images/image-5.webp') ?>" alt="Business Plan PDAM">
                    <div class="play-btn">▶</div>
                    <div class="pcard-overlay">
                        <h4>Business Plan Development for PDAM Tirtamarta</h4>
                        <p>Technical Assistant</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="indicator">
            <span class="ind-cur" id="currentSlide">01</span>
            <div class="ind-bar"><div class="ind-fill" id="indicatorFill"></div></div>
            <span class="ind-tot">05</span>
        </div>
    </div>

</section>


<!-- ═══════════════════════════════════════════════════ -->
<!-- MENU CARDS SECTION                                  -->
<!-- ═══════════════════════════════════════════════════ -->
<section class="menu-section">
    <div class="menu-section-top">
        <span class="section-label">Explore</span>
        <h2 class="section-heading">What You Can<br>Find Here</h2>
    </div>

    <div class="cards-grid">

        <a href="<?= base_url('profile') ?>" class="menu-card">
            <div class="card-img-wrap">
                <div class="card-img-inner">
                    <img src="<?= base_url('images/about-me.webp') ?>" alt="About Me" loading="lazy">
                </div>
            </div>
            <div class="card-body-inner">
                <p class="card-num">01</p>
                <h3 class="card-title-text">About Me</h3>
                <p class="card-desc">My journey, passions, and what I'm currently focused on.</p>
                <span class="card-arrow">See Profile &rarr;</span>
            </div>
        </a>

        <a href="<?= base_url('portfolio') ?>" class="menu-card">
            <div class="card-img-wrap">
                <div class="card-img-inner">
                    <img src="<?= base_url('images/trolling-one.webp') ?>" alt="Portfolio" style="object-position:50% 35%;" loading="lazy">
                </div>
            </div>
            <div class="card-body-inner">
                <p class="card-num">02</p>
                <h3 class="card-title-text">Portfolio</h3>
                <p class="card-desc">Projects, works, and things I've built along the way.</p>
                <span class="card-arrow">See Portfolio &rarr;</span>
            </div>
        </a>

        <a href="<?= base_url('skills') ?>" class="menu-card">
            <div class="card-img-wrap">
                <div class="card-img-inner">
                    <img src="<?= base_url('images/skills.webp') ?>" alt="Skills" style="object-position:50% 60%;" loading="lazy">
                </div>
            </div>
            <div class="card-body-inner">
                <p class="card-num">03</p>
                <h3 class="card-title-text">Skills</h3>
                <p class="card-desc">What I can do and how I develop myself through my passions.</p>
                <span class="card-arrow">See Skills &rarr;</span>
            </div>
        </a>

        <a href="<?= base_url('work-experiences') ?>" class="menu-card">
            <div class="card-img-wrap">
                <div class="card-img-inner">
                    <img src="<?= base_url('images/serious-one.webp') ?>" alt="Work Experience" loading="lazy">
                </div>
            </div>
            <div class="card-body-inner">
                <p class="card-num">04</p>
                <h3 class="card-title-text">Work Experiences</h3>
                <p class="card-desc">A look at my work experience and what I've learned along the way.</p>
                <span class="card-arrow">See Experiences &rarr;</span>
            </div>
        </a>

        <a href="<?= base_url('achievement') ?>" class="menu-card">
            <div class="card-img-wrap">
                <div class="card-img-inner">
                    <img src="<?= base_url('images/work-experience.webp') ?>" alt="Certifications" style="object-position:50% 60%;" loading="lazy">
                </div>
            </div>
            <div class="card-body-inner">
                <p class="card-num">05</p>
                <h3 class="card-title-text">Certifications &amp; Achievements</h3>
                <p class="card-desc">Recognitions and certifications that highlight my growth.</p>
                <span class="card-arrow">See Achievements &rarr;</span>
            </div>
        </a>

        <a href="<?= base_url('social-media') ?>" class="menu-card">
            <div class="card-img-wrap">
                <div class="card-img-inner">
                    <img src="<?= base_url('images/call-me.webp') ?>" alt="Contact" style="object-position:50% 60%;" loading="lazy">
                </div>
            </div>
            <div class="card-body-inner">
                <p class="card-num">06</p>
                <h3 class="card-title-text">Let's Connect</h3>
                <p class="card-desc">Let's talk about ideas, projects, or anything interesting.</p>
                <span class="card-arrow">Get in Touch &rarr;</span>
            </div>
        </a>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════ -->
<!-- ABOUT SECTION                                       -->
<!-- ═══════════════════════════════════════════════════ -->
<section class="about-section" id="about">

    <div class="about-text">
        <span class="section-label">Brief Profile</span>
        <h2 class="section-heading">A Student Who<br><em>Builds Things</em></h2>
        <p class="about-p">
            A final-year student of Environmental Infrastructure Engineering at Universitas
            Gadjah Mada (UGM), with a strong interest in information technology (IT) and its
            integration with environmental issues. Experienced in reconstructing complex
            systems or research through structured and systematic approaches, supported by
            critical thinking, an optimistic vision, and strategic execution. Adaptable,
            responsive to change, and capable of working effectively both independently and
            as part of a team, including in leadership roles.
        </p>
        <a href="<?= base_url('profile') ?>" class="btn-outline-navy">More Details</a>
    </div>

    <div class="about-visual">
        <img src="<?= base_url('images/nice-hero.webp') ?>" alt="About Me" loading="lazy">
        <span class="about-visual-acc">Env. Eng. · UGM</span>
    </div>

</section>

<!-- ═══════════════════════════════════════════════════ -->
<!-- INTERESTS SECTION                                   -->
<!-- ═══════════════════════════════════════════════════ -->
<section class="interests-section" id="skills">
    <span class="section-label">Focus Areas</span>
    <h2 class="section-heading">What I'm <em>Interested In</em></h2>

    <div class="interests-grid">

        <div class="interest-card">
            <div class="int-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 0C5.878 0 4 1.79 4 4c0 2.473 2.121 5.412 3.324 6.91a.86.86 0 0 0 1.352 0C9.879 9.412 12 6.473 12 4c0-2.21-1.878-4-4-4z"/>
                    <path d="M2 14s1-1 6-1 6 1 6 1-1 2-6 2-6-2-6-2z"/>
                </svg>
            </div>
            <p class="int-title">Environmental Engineering &amp; Sustainability</p>
            <p class="int-text">Passionate about planning and managing sustainable environmental infrastructure, with a focus on water systems, waste management, and eco-friendly environments.</p>
        </div>

        <div class="interest-card">
            <div class="int-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4v6c0 .255.036.494.144.695.106.197.27.371.54.465L15 10.81a.5.5 0 0 1-.214.132l-1.786.45L13 11.5v.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-.5l-.214-.018-1.786-.45A.5.5 0 0 1 1 10.5V4c0-.255.036-.494.144-.695a.758.758 0 0 1 .254-.302L2 2.5l-.602.645z"/>
                </svg>
            </div>
            <p class="int-title">Information Technology &amp; Digital Systems</p>
            <p class="int-text">Passionate about digital systems, software development, automation, and data processing to enhance efficiency and performance.</p>
        </div>

        <div class="interest-card">
            <div class="int-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.134Z"/>
                    <path d="M8 1a2.965 2.965 0 0 0-2.116.879 4.002 4.002 0 0 0-1.895 3.395 4.11 4.11 0 0 1 1.082-.486A3.014 3.014 0 0 1 5.06 4.1c-.01-.023-.018-.046-.027-.069l-.015-.038C4.783 3.398 4.926 2.617 5.406 2.08A1.964 1.964 0 0 1 7.037 1.4c.397-.013.817.08 1.163.28a.25.25 0 0 0 .261 0c.346-.2.766-.293 1.163-.28.583.019 1.13.305 1.631.72.501.416.85 1.027.85 1.68 0 .358-.09.672-.237.961l-.015.038c-.009.023-.017.046-.027.069a4.11 4.11 0 0 1 1.082.486 4.002 4.002 0 0 0-1.895-3.395A2.965 2.965 0 0 0 8 1Z"/>
                </svg>
            </div>
            <p class="int-title">Integration of Engineering and Technology</p>
            <p class="int-text">Applying information technology to support engineering — monitoring systems, data analysis, and smart infrastructure built on real data.</p>
        </div>

    </div>
</section>


<!-- ═══════════════════════════════════════════════════ -->
<!-- DAILY JOURNAL SECTION                              -->
<!-- ═══════════════════════════════════════════════════ -->
<section class="journal-section" id="journal">

    <div class="journal-top">
        <div>
            <span class="section-label">Latest</span>
            <h2 class="section-heading">
                Daily Journal<br>
                <em>&amp; Notes</em>
            </h2>
        </div>
        <a href="<?= base_url('journal') ?>" class="view-all">View All Entries</a>
    </div>

    <?php if (!empty($journals)): ?>
        <?php $featured = $journals[0] ?? null; ?>
        <?php $side_cards = array_slice($journals, 1, 3); ?>

        <div class="journal-grid">

            <?php if ($featured): ?>
            <a href="<?= base_url('journal/' . $featured['slug']) ?>" class="j-featured">
                <div class="j-feat-inner">
                    <?php if (!empty($featured['cover_image'])): ?>
                        <div class="j-feat-img-wrap">
                            <div class="j-img-inner">
                                <img src="<?= base_url($featured['cover_image']) ?>"
                                     alt="<?= esc($featured['title']) ?>" loading="lazy">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="j-feat-body">
                        <?php if (!empty($featured['category'])): ?>
                            <span class="j-tag"><?= esc($featured['category']) ?></span>
                        <?php endif; ?>
                        <h3 class="j-title"><?= esc($featured['title']) ?></h3>
                        <p class="j-excerpt">
                            <?= character_limiter(strip_tags(preg_replace('/[^\x00-\x7F]/u', '', $featured['content'])), 200) ?>
                        </p>
                        <div style="display:flex; align-items:center; gap:12px; margin-top:auto; padding-top:16px;">
                            <span class="j-date" style="margin-top:0;"><?= date('d M Y', strtotime($featured['created_at'])) ?></span>
                            <span style="margin-left:auto; font-size:11px; color:var(--brown); letter-spacing:.06em; font-weight:600;">Read More &rarr;</span>
                        </div>
                    </div>
                </div>
            </a>
            <?php endif; ?>

            <?php if (!empty($side_cards)): ?>
            <div class="j-row">
                <?php foreach ($side_cards as $journal): ?>
                <a href="<?= base_url('journal/' . $journal['slug']) ?>" class="j-card">
                    <div class="j-card-img-wrap">
                        <?php if (!empty($journal['cover_image'])): ?>
                            <div class="j-img-inner">
                                <img src="<?= base_url($journal['cover_image']) ?>"
                                     alt="<?= esc($journal['title']) ?>" loading="lazy">
                            </div>
                        <?php else: ?>
                            <div class="j-img-inner j-no-img">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#c5a37d" viewBox="0 0 16 16">
                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="j-card-body">
                        <?php if (!empty($journal['category'])): ?>
                            <span class="j-tag"><?= esc($journal['category']) ?></span>
                        <?php endif; ?>
                        <h5 class="j-title"><?= esc($journal['title']) ?></h5>
                        <p class="j-excerpt">
                            <?= character_limiter(strip_tags(preg_replace('/[^\x00-\x7F]/u', '', $journal['content'])), 110) ?>
                        </p>
                        <span class="j-date"><?= date('d M Y', strtotime($journal['created_at'])) ?></span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>

    <?php else: ?>
        <div style="text-align:center; padding:80px 0;">
            <div style="opacity:.2; margin-bottom:16px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="var(--brown)" viewBox="0 0 16 16">
                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                </svg>
            </div>
            <p style="color:var(--muted); font-size:14px;">No journal entries yet. Check back soon!</p>
        </div>
    <?php endif; ?>

</section>




<!-- ═══════════════════════════════════════════════════ -->
<!-- CAROUSEL SCRIPT                                     -->
<!-- ═══════════════════════════════════════════════════ -->
<script>
(function () {
    const track = document.getElementById('carouselTrack');
    const fill  = document.getElementById('indicatorFill');
    const cur   = document.getElementById('currentSlide');

    if (!track) return;

    const cards = [...track.children];
    const total = cards.length;

    track.prepend(cards[total - 1].cloneNode(true));
    track.append(cards[0].cloneNode(true));

    let idx = 1;

    function cardWidth() {
        const gap = 12;
        return track.children[0].getBoundingClientRect().width + gap;
    }

    function updateIndicator() {
        let realIdx = idx - 1;
        if (realIdx < 0) realIdx = total - 1;
        if (realIdx >= total) realIdx = 0;
        fill.style.width = `${((realIdx + 1) / total) * 100}%`;
        cur.textContent = String(realIdx + 1).padStart(2, '0');
    }

    function goTo(n, animate = true) {
        idx = n;
        track.style.transition = animate ? 'transform .6s ease' : 'none';
        track.style.transform = `translateX(-${idx * cardWidth()}px)`;
        updateIndicator();
    }

    goTo(1, false);

    track.addEventListener('transitionend', () => {
        if (idx >= total + 1) { idx = 1; track.style.transition = 'none'; track.style.transform = `translateX(-${idx * cardWidth()}px)`; }
        if (idx <= 0) { idx = total; track.style.transition = 'none'; track.style.transform = `translateX(-${idx * cardWidth()}px)`; }
        updateIndicator();
    });

    function next() { goTo(idx + 1); }
    function prev() { goTo(idx - 1); }

    let autoTimer = setInterval(next, 3600);

    track.addEventListener('pointerdown', e => {
        clearInterval(autoTimer);
        const sx = e.clientX;
        const onUp = eu => {
            const dx = eu.clientX - sx;
            if (Math.abs(dx) > 40) { dx < 0 ? next() : prev(); }
            document.removeEventListener('pointerup', onUp);
            autoTimer = setInterval(next, 3600);
        };
        document.addEventListener('pointerup', onUp);
    });

    window.addEventListener('resize', () => goTo(idx, false));
})();
</script>


<?php $this->endSection(); ?>