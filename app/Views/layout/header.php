<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&display=swap');

:root {
    --brown:   #9c6f3e;
    --brown-d: #7a5430;
    --brown-l: #c5a37d;
    --text:    #1c1814;
    --muted:   #8a8480;
    --bg:      #f5f3ef;
    --white:   #ffffff;
    --border:  #ddd9d3;
}

/* ══ MOBILE MENU OVERLAY ══ */
.mobile-menu {
    display: none;
    position: fixed; inset: 0; z-index: 200;
    background: rgba(245,243,239,.97);
    backdrop-filter: blur(12px);
    flex-direction: column; align-items: center; justify-content: center; gap: 10px;
}
.mobile-menu.open { display: flex; }

.mobile-menu-logo {
    position: absolute; top: 24px; left: 5%;
    display: flex; align-items: center; gap: 10px;
}
.mobile-menu-logo img {
    width: 36px; height: 36px;
    border-radius: 50%; object-fit: cover;
    border: 2px solid rgba(156,111,62,.3);
}
.mobile-menu-logo span {
    font-family: 'Sora', sans-serif;
    font-size: 14px; font-weight: 700; color: var(--text);
    letter-spacing: .04em;
}

.mobile-menu .close-btn {
    position: absolute; top: 22px; right: 5%;
    background: none; border: none;
    font-size: 24px; cursor: pointer; color: var(--muted);
    width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%; transition: background .2s, color .2s;
}
.mobile-menu .close-btn:hover { background: rgba(156,111,62,.1); color: var(--brown); }

.mobile-menu a {
    font-family: 'Sora', sans-serif;
    font-size: 13px; font-weight: 600;
    text-decoration: none; color: var(--muted);
    letter-spacing: .08em; text-transform: uppercase;
    padding: 14px 40px; border-radius: 50px;
    transition: color .2s, background .2s;
    width: 280px; text-align: center;
}
.mobile-menu a:hover,
.mobile-menu a.active { color: var(--brown); background: rgba(156,111,62,.08); }

.mobile-menu-social {
    position: absolute; bottom: 36px;
    display: flex; gap: 12px; align-items: center;
}
.mobile-menu-social a {
    width: 38px; height: 38px; border-radius: 50%;
    background: rgba(156,111,62,.08);
    border: 1px solid rgba(156,111,62,.18);
    display: flex; align-items: center; justify-content: center;
    color: var(--brown); padding: 0; width: 38px;
    transition: background .2s, transform .2s;
    font-size: 0; /* hides text */
}
.mobile-menu-social a:hover { background: var(--brown); color: #fff; transform: translateY(-2px); }
.mobile-menu-social a svg { flex-shrink: 0; }

/* ══ NAVBAR ══ */
header {
    position: sticky; top: 0; z-index: 100;
    background: rgba(245,243,239,.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--border);
    font-family: 'Sora', sans-serif;
}

.header-inner {
    max-width: 1400px; margin: 0 auto;
    padding: 0 5%;
    height: 68px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 24px;
}

/* Logo */
.h-logo {
    display: flex; align-items: center; gap: 12px;
    text-decoration: none; flex-shrink: 0;
}
.h-logo-mark {
    display: grid; grid-template-columns: 1fr 1fr; gap: 3.5px;
}
.h-logo-mark span {
    width: 8px; height: 8px;
    background: var(--brown); border-radius: 2px;
    transition: transform .3s;
    display: block;
}
.h-logo:hover .h-logo-mark span:nth-child(1) { transform: translate(-2px,-2px); }
.h-logo:hover .h-logo-mark span:nth-child(2) { transform: translate(2px,-2px); }
.h-logo:hover .h-logo-mark span:nth-child(3) { transform: translate(-2px,2px); }
.h-logo:hover .h-logo-mark span:nth-child(4) { transform: translate(2px,2px); }
.h-logo-img {
    width: 34px; height: 34px;
    border-radius: 50%; object-fit: cover;
    border: 2px solid rgba(156,111,62,.25);
    transition: border-color .2s, transform .2s;
}
.h-logo:hover .h-logo-img { border-color: var(--brown); transform: scale(1.05); }
.h-logo-text {
    font-size: 15px; font-weight: 800;
    letter-spacing: .06em; text-transform: uppercase;
    color: var(--text);
}

/* Nav links */
.h-nav {
    display: flex; align-items: center; gap: 2px;
    flex: 1; justify-content: center;
}
.h-nav a {
    text-decoration: none; color: var(--muted);
    font-size: 13px; font-weight: 600;
    padding: 8px 18px; border-radius: 50px;
    letter-spacing: .04em;
    transition: color .2s, background .2s;
    white-space: nowrap;
}
.h-nav a:hover { color: var(--text); }
.h-nav a.active {
    background: var(--brown); color: #fff;
    padding: 8px 22px;
}

/* Right side */
.h-right {
    display: flex; align-items: center; gap: 10px; flex-shrink: 0;
}

.h-social {
    display: flex; align-items: center; gap: 6px;
}
.h-social a {
    width: 34px; height: 34px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--muted);
    background: transparent;
    transition: color .2s, background .2s, transform .2s;
    text-decoration: none;
}
.h-social a:hover { color: var(--brown); background: rgba(156,111,62,.1); transform: translateY(-2px); }

.h-contact-btn {
    border: 1.5px solid var(--border); background: var(--white);
    padding: 9px 22px; border-radius: 50px;
    font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700;
    cursor: pointer; transition: all .2s;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
    text-decoration: none; color: var(--text);
    display: inline-flex; align-items: center; gap: 6px;
}
.h-contact-btn:hover { border-color: var(--brown); color: var(--brown); box-shadow: 0 4px 16px rgba(156,111,62,.15); }

.h-menu-btn {
    display: none; flex-direction: column; gap: 5px;
    background: none; border: none; cursor: pointer; padding: 4px;
}
.h-menu-btn span { display: block; width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: all .3s; }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .h-nav a { font-size: 12px; padding: 7px 14px; }
    .h-nav a.active { padding: 7px 18px; }
    .h-social { display: none; }
}

@media (max-width: 768px) {
    .h-nav { display: none; }
    .h-contact-btn { display: none; }
    .h-menu-btn { display: flex; }
    .h-social { display: none; }
}
</style>

<!-- ══ MOBILE OVERLAY ══ -->
<div class="mobile-menu" id="mobileMenu">

    <div class="mobile-menu-logo">
        <img src="<?= base_url('images/logo-header-img.webp') ?>" alt="Logo">
        <span>Dany Atha Najib</span>
    </div>

    <button class="close-btn" onclick="closeMobile()">✕</button>

    <a href="<?= base_url('/') ?>" class="active">Home</a>
    <a href="<?= base_url('profile') ?>">Profile</a>
    <a href="<?= base_url('portfolio') ?>">Portfolio</a>
    <a href="<?= base_url('skills') ?>">Skills</a>
    <a href="<?= base_url('work-experiences') ?>">Experiences</a>
    <a href="<?= base_url('social-media') ?>">Contact</a>

    <div class="mobile-menu-social">
        <a href="#" title="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
            </svg>
        </a>
        <a href="#" title="Twitter/X">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
            </svg>
        </a>
        <a href="#" title="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
            </svg>
        </a>
        <a href="#" title="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
            </svg>
        </a>
    </div>
</div>

<!-- ══ HEADER / NAVBAR ══ -->
<header>
    <div class="header-inner">

        <!-- Logo -->
        <a href="<?= base_url('/') ?>" class="h-logo">
            <div class="h-logo-mark">
                <span></span><span></span><span></span><span></span>
            </div>
            <img src="<?= base_url('images/logo-header-img.webp') ?>" alt="Logo" class="h-logo-img">
            <span class="h-logo-text">Dany Atha Najib</span>
        </a>

        <!-- Navigation -->
        <nav class="h-nav">
            <a href="<?= base_url('/') ?>" class="active">Home</a>
            <a href="<?= base_url('profile') ?>">Profile</a>
            <a href="<?= base_url('portfolio') ?>">Portfolio</a>
            <a href="<?= base_url('skills') ?>">Skills</a>
            <a href="<?= base_url('work-experiences') ?>">Experiences</a>
        </nav>

        <!-- Right: social + contact + hamburger -->
        <div class="h-right">
            <div class="h-social">
                <a href="#" title="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </a>
                <a href="#" title="Twitter/X">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                </a>
                <a href="#" title="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                    </svg>
                </a>
                <a href="#" title="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                    </svg>
                </a>
            </div>

            <a href="<?= base_url('social-media') ?>" class="h-contact-btn">
                Contact me!
            </a>

            <button class="h-menu-btn" aria-label="Open menu" onclick="openMobile()">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</header>

<script>
function openMobile() {
    document.getElementById('mobileMenu').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeMobile() {
    document.getElementById('mobileMenu').classList.remove('open');
    document.body.style.overflow = '';
}
// Close on outside click
document.getElementById('mobileMenu').addEventListener('click', function(e) {
    if (e.target === this) closeMobile();
});
</script>