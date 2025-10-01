@extends('layouts.public')

@section('content')

    <section class="page-header">
        <div class="container">
            <h1 class="gsap-reveal">About JobSplit</h1>
            <p class="gsap-reveal" data-gsap-delay="0.2">Connecting talent with opportunity since 2024.</p>
        </div>
    </section>

    <section class="section">
        <div class="container mission-container">
            <div class="mission-content gsap-reveal">
                <h3>Our Mission</h3>
                <p>At JobSplit, our mission is to empower individuals by connecting them with their dream jobs and to help companies find the perfect talent to drive their success. We believe that the right job can transform a person's life, and the right person can transform a business.</p>
                <p class="mt-4">We are dedicated to creating a seamless, transparent, and efficient job marketplace where opportunities are accessible to everyone, everywhere.</p>
            </div>
            <div class="mission-image gsap-reveal" data-gsap-delay="0.2">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Team collaborating in an office">
            </div>
        </div>
    </section>
    
    <section class="section why-us">
        <div class="container">
            <h2 class="section-title gsap-reveal">Why Choose Us?</h2>
            <div class="features-grid">
                <div class="feature-card gsap-reveal" data-gsap-stagger="0.1"><i class="fas fa-rocket"></i><h3>Vast Opportunities</h3><p>Access thousands of verified job listings from top companies across various industries.</p></div>
                <div class="feature-card gsap-reveal" data-gsap-stagger="0.2"><i class="fas fa-user-shield"></i><h3>Trusted Platform</h3><p>We verify every company to ensure a safe and secure job search experience for our users.</p></div>
                <div class="feature-card gsap-reveal" data-gsap-stagger="0.3"><i class="fas fa-headset"></i><h3>Career Support</h3><p>Get access to career advice, resume building tools, and support from our expert team.</p></div>
            </div>
        </div>
    </section>

    <section class="section values">
        <div class="container">
            <h2 class="section-title gsap-reveal">Our Core Values</h2>
            <div class="features-grid">
                <div class="feature-card gsap-reveal" data-gsap-stagger="0.1"><i class="fas fa-handshake-angle"></i><h3>Integrity</h3><p>We operate with honesty and transparency in everything we do.</p></div>
                <div class="feature-card gsap-reveal" data-gsap-stagger="0.2"><i class="fas fa-lightbulb"></i><h3>Innovation</h3><p>We constantly innovate to provide the best tools for job seekers and employers.</p></div>
                <div class="feature-card gsap-reveal" data-gsap-stagger="0.3"><i class="fas fa-users"></i><h3>Community</h3><p>We are building a supportive community to help everyone grow professionally.</p></div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container stats-container">
            <div class="stat-item gsap-reveal">
                <div class="stat-number gsap-counter" data-target="50000">0</div>
                <div class="stat-label">Successful Placements</div>
            </div>
            <div class="stat-item gsap-reveal" data-gsap-delay="0.1">
                <div class="stat-number gsap-counter" data-target="1500">0</div>
                <div class="stat-label">Partner Companies</div>
            </div>
            <div class="stat-item gsap-reveal" data-gsap-delay="0.2">
                <div class="stat-number gsap-counter" data-target="99">0</div>
                <div class="stat-label">User Satisfaction %</div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title gsap-reveal">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member gsap-reveal" data-gsap-stagger="0.1"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Team Member"><div class="team-info"><h4>John Doe</h4><p>CEO & Founder</p></div></div>
                <div class="team-member gsap-reveal" data-gsap-stagger="0.2"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Team Member"><div class="team-info"><h4>Jane Smith</h4><p>Head of Product</p></div></div>
                <div class="team-member gsap-reveal" data-gsap-stagger="0.3"><img src="https://randomuser.me/api/portraits/men/36.jpg" alt="Team Member"><div class="team-info"><h4>Michael Brown</h4><p>Lead Engineer</p></div></div>
                <div class="team-member gsap-reveal" data-gsap-stagger="0.4"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Team Member"><div class="team-info"><h4>Emily White</h4><p>Marketing Director</p></div></div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container gsap-reveal">
            <h2>Start Your Journey With Us Today</h2>
            <p>Whether you're looking for your next career move or searching for the perfect candidate, we're here to help.</p>
            <div class="mt-4">
                <a href="#" class="btn-cta">Find a Job</a>
                <a href="#" class="btn-cta">Post a Job</a>
            </div>
        </div>
    </section>
@endsection
    
   
    

   @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);

            gsap.utils.toArray('.gsap-reveal').forEach(elem => {
                gsap.from(elem, { 
                    autoAlpha: 0, y: 50, duration: 1, ease: 'power3.out',
                    delay: elem.dataset.gsapDelay || 0,
                    stagger: elem.dataset.gsapStagger || 0.1,
                    scrollTrigger: { trigger: elem, start: "top 85%", toggleActions: "play none none none" }
                });
            });

            // Counter Animation
            gsap.utils.toArray('.gsap-counter').forEach(elem => {
                const target = parseInt(elem.dataset.target, 10);
                const counter = { val: 0 };
                gsap.to(counter, {
                    val: target, duration: 2.5, ease: 'power2.out',
                    scrollTrigger: { trigger: elem, start: "top 90%" },
                    onUpdate: () => { elem.textContent = Math.floor(counter.val).toLocaleString(); }
                });
            });
        });
    </script>
   @endpush

@push('styles')
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #00B5AD;
            --primary-dark: #008b84;
            --text-dark: #111827;
            --text-gray: #6b7280;
            --bg-light: #ffffff;
            --bg-off-white: #f9fafb;
        }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Poppins',sans-serif;background:var(--bg-light);color:var(--text-dark);line-height:1.6; overflow-x: hidden;}
        .container{max-width:1200px;margin:auto;padding:0 20px}
        
        header{position:sticky;top:0;left:0;width:100%;background:#fff;box-shadow:0 2px 20px rgba(0,0,0,0.05);z-index:1000}
        .header-container{max-width:1200px;margin:auto;display:flex;align-items:center;justify-content:space-between;padding:15px 20px;height:80px}
        .logo{display:flex;align-items:center;font-size:1.8rem;font-weight:800;color:#2563eb;text-decoration:none}
        nav ul{display:flex;gap:25px;list-style:none}
        nav ul li a{text-decoration:none;color:var(--text-dark);font-weight:500;position:relative;padding-bottom:5px;transition:.3s}
        nav ul li a:hover, nav ul li a.active{color:var(--primary)}
        nav ul li a::after{content:"";position:absolute;left:0;bottom:0;width:0;height:2px;background:var(--primary);transition:.3s}
        nav ul li a:hover::after, nav ul li a.active::after{width:100%}
        .header-buttons{display:flex;gap:15px;align-items:center}
        .btn-login,.btn-register{padding:10px 20px;border-radius:10px;font-weight:600;cursor:pointer;text-decoration:none;transition:.3s}
        .btn-login{border:1px solid #ddd;background:transparent;color:var(--text-dark)}
        .btn-login:hover{background:#f3f4f6;color:var(--primary)}
        .btn-register{background:var(--primary);color:#fff;border:none}
        .btn-register:hover{background:var(--primary-dark)}
        .mobile-menu-toggle{display:none;font-size:1.6rem;background:none;border:none;color:var(--text-dark)}

        .page-header { padding: 140px 0 60px; background: linear-gradient(45deg, #f9fafb, #dbeafe); text-align: center; }
        .page-header h1 { font-size: 3rem; font-weight: 900; color: var(--text-dark); }
        .page-header p { font-size: 1.1rem; color: var(--text-gray); margin-top: 10px; }

        .section{padding:80px 20px}
        .section-title{font-size:2.5rem;font-weight:800;margin-bottom:15px;text-align:center;color:var(--text-dark)}
        .section-subtitle{max-width:650px;margin:auto;color:var(--text-gray);margin-bottom:50px;text-align:center}

        .mission-container { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
        .mission-image img { width: 100%; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .mission-content h3 { font-size: 1.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 20px; }

        .why-us, .values { background: var(--bg-off-white); }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .feature-card { background: var(--white-color); padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); text-align: center; }
        .feature-card i { font-size: 2.5rem; color: var(--primary); margin-bottom: 20px; }
        .feature-card h3 { font-size: 1.3rem; font-weight: 600; margin-bottom: 10px; color: var(--text-dark); }
        
        

        .stats { background: var(--text-dark); color: white; padding: 60px 0; }
        .stats-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center; }
        .stat-number { font-size: 3rem; font-weight: 800; color: var(--primary); }

        .team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .team-member { background: var(--white-color); border-radius: 15px; text-align: center; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .team-member img { width: 100%; height: 280px; object-fit: cover; }
        .team-info { padding: 20px; }
        .team-info h4 { font-size: 1.2rem; font-weight: 600; color: var(--text-dark); }
        .team-info p { font-size: 0.9rem; color: var(--primary); }

        .cta { background: var(--primary); color: #fff; text-align: center; padding: 60px 20px; }
        .cta h2 { font-size: 2rem; margin-bottom: 20px; }
        .cta .btn-cta { background: #fff; color: var(--primary); padding: 15px 30px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; margin: 0 10px; } 

        @media(max-width: 768px) {
            nav{display:none;position:absolute;top:100%;left:0;width:100%;background:#fff}
            nav.active{display:block}
            nav ul{flex-direction:column;padding:20px}
            .mobile-menu-toggle{display:block}
            .mission-container { grid-template-columns: 1fr; }
        }
    </style>
@endpush