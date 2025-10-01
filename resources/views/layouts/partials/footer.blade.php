
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display.swap');

    :root {
        --footer-bg: #111111;
        --text-primary: #EAEAEA;
        --text-secondary: #888888;
        --accent-teal: #00B5AD;
        --border-color: rgba(255, 255, 255, 0.1);
    }

    .site-footer {
        background-color: transparent;
        color: var(--text-primary);
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }
    
    .footer-container {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 2;
    }

    .site-footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-color: var(--footer-bg);
        z-index: 0;
        clip-path: polygon(0 100%, 100% 100%, 100% 100%, 0 100%);
        transition: clip-path 0.8s cubic-bezier(0.7, 0, 0.2, 1);
    }
    .site-footer.is-visible::before {
        clip-path: polygon(0 100%, 100% 100%, 100% 0, 0 0);
    }
    
    .animated-text { display: inline-flex; gap: 0.1em; flex-wrap: wrap; }
    .char-container { display: inline-block; height: 1.2em; line-height: 1.2em; overflow: hidden; vertical-align: bottom; }
    .char-reel { display: block; transition: transform 1.5s cubic-bezier(0.68, -0.6, 0.32, 1.6); transform: translateY(0); transition-delay: var(--char-delay, 0s); }
    .site-footer.is-visible .char-reel { transform: var(--final-transform); }
    .char-reel span { display: block; height: 1.2em; line-height: 1.2em; }
    .animated-element { opacity: 0; transform: scale(0.8); transition: opacity 0.6s ease, transform 0.6s ease; transition-delay: var(--delay, 0s); }
    .site-footer.is-visible .animated-element { opacity: 1; transform: scale(1); transition-delay: calc(var(--delay) + 0.6s); }
    
    .footer-top { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; padding-top: 3.5rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border-color); }
    .footer-logo img { height: 450px; width: 450px; margin-top: -200px; margin-bottom: -200px; object-fit: contain; }
    .footer-main { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 2rem; padding-top: 4rem; padding-bottom: 4rem; }
    .footer-nav-column, .footer-subscribe-column { flex-grow: 1; min-width: 160px; }
    .footer-nav-heading { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; text-transform: capitalize; color: var(--text-primary); margin-bottom: 1.5rem; }
    .footer-nav-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem; }
    .footer-nav-list a { color: var(--text-secondary); text-decoration: none; font-size: 14px; transition: color 0.3s ease; position: relative; padding-bottom: 4px; }
    .footer-nav-list a:hover { color: var(--accent-teal); }
    .footer-nav-list a::after, .footer-bottom-links a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background-color: var(--accent-teal); transform: scaleX(0); transform-origin: center; transition: transform 0.4s cubic-bezier(0.19, 1, 0.22, 1); }
    .footer-nav-list a:hover::after, .footer-bottom-links a:hover::after { transform: scaleX(1); }
    .footer-social { display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; color: var(--text-secondary); }
    .social-links { display: flex; flex-wrap: wrap; align-items: center; gap: 0.75rem; }
    .social-icon { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; color: var(--text-primary); border: 1px solid var(--border-color); border-radius: 50%; text-decoration: none; transition: all 0.3s ease, box-shadow 0.3s ease; }
    .social-icon:hover { background-color: var(--accent-teal); border-color: var(--accent-teal); color: #fff; box-shadow: 0 0 8px var(--accent-teal), 0 0 20px var(--accent-teal); }
    .subscribe-form { display: flex; align-items: center; height: 48px; border-radius: 8px; overflow: hidden; margin-top: 1.5rem; background-color: #fff; border: 2px solid var(--accent-teal); transition: box-shadow 0.3s ease; }
    .subscribe-form:focus-within { box-shadow: 0 0 8px var(--accent-teal), 0 0 20px var(--accent-teal); }
    .subscribe-form input { height: 100%; width: 100%; border: none; padding: 0 0.75rem; color: #333; outline: none; background-color: transparent; font-family: 'Poppins', sans-serif; }
    .subscribe-form button { display: flex; align-items: center; justify-content: center; width: 46px; height: 100%; background-color: var(--accent-teal); border: none; cursor: pointer; flex-shrink: 0; color: #fff; }
    .footer-bottom { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 0.5rem; padding: 1.5rem 0; border-top: 1px solid var(--border-color); font-size: 14px; color: var(--text-secondary); }
    .footer-bottom-links { display: flex; align-items: center; gap: 0.625rem; }
    .footer-bottom-links a { color: var(--text-secondary); text-decoration: none; transition: color 0.3s ease; position: relative; padding-bottom: 4px; }
    .footer-bottom-links a:hover { color: var(--accent-teal); }
    @media (max-width: 767px) {
        .footer-nav-column { width: calc(50% - 1rem); min-width: 0; }
        .footer-bottom { flex-direction: column; }
        .footer-logo img { height: 400px; width: 400px; margin-top: -180px; margin-bottom: -180px;}
    }
    @media (min-width: 640px) and (max-width: 767px) {
        .footer-logo img { height: 420px; width: 420px; margin-top: -190px; margin-bottom: -190px; margin-left: 120px; }
        .footer-social { margin-left: 125px; }
    }
    </style>

    
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-content-wrapper">
                <div class="footer-top">
                    <a href="#" class="footer-logo animated-element" style="--delay: 0.8s;">
                        <img src="{{ asset('assets/images/JobSplit 2.png ') }}" alt="JobSplit Logo" />
                    </a>
                    <div class="footer-social animated-element" style="--delay: 0.9s;">
                        <span class="animated-text">Follow Us:</span>
                        <div class="social-links">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <div class="footer-main">
                    <div class="footer-nav-column">
                        <h4 class="footer-nav-heading animated-text">Categories</h4>
                        <ul class="footer-nav-list animated-element" style="--delay: 1s;">
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                        </ul>
                    </div>
                    <div class="footer-nav-column">
                        <h4 class="footer-nav-heading animated-text">For Candidates</h4>
                        <ul class="footer-nav-list animated-element" style="--delay: 1.1s;">
                            <li><a href="#">Candidate Dashboard</a></li>
                            <li><a href="#">Browse jobs</a></li>
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                        </ul>
                    </div>
                    <div class="footer-nav-column">
                        <h4 class="footer-nav-heading animated-text">For Employer</h4>
                        <ul class="footer-nav-list animated-element" style="--delay: 1.2s;">
                            <li><a href="#">Employer Dashboard</a></li>
                            <li><a href="#">Submit jobs</a></li>
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Graphics & Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                        </ul>
                    </div>
                    <div class="footer-subscribe-column">
                        <div class="subscribe-block animated-element" style="--delay: 1.3s;">
                            <h4 class="footer-nav-heading animated-text">Subscribe</h4>
                            <form class="subscribe-form">
                                <input type="email" placeholder="Your email address" required />
                                <button type="submit"><span>&rarr;</span></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="copyright-text animated-element" style="--delay: 1.4s;">©2025 JobSplit. All Rights Reserved.</div>
                    <div class="footer-bottom-links animated-element" style="--delay: 1.5s;">
                        <a href="#">Terms Of Services</a><span>|</span><a href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const footer = document.querySelector('.site-footer');

        function setupDecoderAnimation(selector) {
            const elements = document.querySelectorAll(selector);
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!?@#$%&';

            elements.forEach((el, elIndex) => {
                const originalText = el.textContent.trim();
                el.innerHTML = '';
                
                originalText.split('').forEach((char, charIndex) => {
                    const container = document.createElement('div');
                    container.className = 'char-container';
                    const reel = document.createElement('div');
                    reel.className = 'char-reel';
                    
                    for(let i = 0; i < 15; i++) {
                        const randSpan = document.createElement('span');
                        randSpan.textContent = chars[Math.floor(Math.random() * chars.length)];
                        reel.appendChild(randSpan);
                    }
                    
                    const finalSpan = document.createElement('span');
                    finalSpan.textContent = (char === ' ') ? '\u00A0' : char;
                    reel.appendChild(finalSpan);
                    
                    container.appendChild(reel);
                    el.appendChild(container);
                    
                    const charHeight = finalSpan.offsetHeight;

                    // FIX #2: Backticks (`) istemal kiye hain
                    const finalTransform = `translateY(-${15 * charHeight}px)`;
                    reel.style.setProperty('--final-transform', finalTransform);

                    const delay = 0.8 + (elIndex * 0.1) + (charIndex * 0.03);
                    
                    // FIX #2: Backticks (`) istemal kiye hain
                    reel.style.setProperty('--char-delay', `${delay}s`);
                });
            });
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.classList.add('is-visible');
                    setupDecoderAnimation('.animated-text');
                    observer.unobserve(footer);
                }
            });
        }, {
            threshold: 0.3
        });

        observer.observe(footer);
    });
</script>
