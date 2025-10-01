@extends('layouts.public')

@section('content')

    <section class="page-header">
        <div class="container">
            <h1 class="gsap-reveal">Get In Touch</h1>
            <p class="gsap-reveal" data-gsap-delay="0.2">We'd love to hear from you. Here's how you can reach us.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
           <div class="info-grid">
    
    {{-- Pehla Card --}}
    <div class="info-card-animation-wrapper">
        <div class="info-card gsap-reveal" data-gsap-stagger="0.1">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Our Address</h3>
            <p>123 Business Avenue, Metropolis, Pakistan</p>
        </div>
    </div>

    {{-- Doosra Card --}}
    <div class="info-card-animation-wrapper">
        <div class="info-card gsap-reveal" data-gsap-stagger="0.2">
            <i class="fas fa-envelope"></i>
            <h3>Email Us</h3>
            <p>contact@jobsplit.com</p>
        </div>
    </div>

    {{-- Teersa Card --}}
    <div class="info-card-animation-wrapper">
        <div class="info-card gsap-reveal" data-gsap-stagger="0.3">
            <i class="fas fa-phone-alt"></i>
            <h3>Call Us</h3>
            <p>+92 300 1234567</p>
        </div>
    </div>
    
</div>

            <div class="contact-grid">
                <div class="contact-form gsap-reveal">
                    <h3>Send Us a Message</h3>
                    

{{-- Success message dikhane ke liye --}}
@if(session('success'))
    <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

{{-- Validation errors dikhane ke liye --}}
@if ($errors->any())
    <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('contact.store') }}" method="POST">
    @csrf {{-- CSRF token zaroori hai --}}
    <div class="input-group">
        <input type="text" name="name" class="input-field" placeholder="Your Name" required>
    </div>
    <div class="input-group">
        <input type="email" name="email" class="input-field" placeholder="Your Email" required>
    </div>
    <div class="input-group">
        <input type="text" name="subject" class="input-field" placeholder="Subject" required>
    </div>
    <div class="input-group">
        <textarea name="message" class="input-field" rows="6" placeholder="Your Message" required></textarea>
    </div>
    <button type="submit" class="submit-btn">Send Message</button>
</form>
                </div>
                <div class="map-container gsap-reveal" data-gsap-delay="0.2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115831.93335759145!2d66.996918819777!3d24.86921315579998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e06651d4bbf%3A0x9cf92f44555a0c23!2sKarachi%2C%20Karachi%20City%2C%20Sindh%2C%20Pakistan!5e0!3m2!1sen!2s!4v1695582845683!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
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
        
        /* Header (Same as other pages) */
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
        .btn-register{background:var(--primary);color:#fff;border:none}
        .mobile-menu-toggle{display:none;font-size:1.6rem;background:none;border:none;color:var(--text-dark)}

        /* Page Header */
        .page-header {
            padding: 140px 0 60px;
            background: linear-gradient(45deg, #f9fafb, #dbeafe);
            text-align: center;
        }
        .page-header h1 { font-size: 3rem; font-weight: 900; color: var(--text-dark); }
        .page-header p { font-size: 1.1rem; color: var(--text-gray); margin-top: 10px; }

        /* Section Styling */
        .section{padding:80px 20px}
        .section-title{font-size:2.5rem;font-weight:800;margin-bottom:15px;text-align:center;color:var(--text-dark)}
        .section-subtitle{max-width:650px;margin:auto;color:var(--text-gray);margin-bottom:50px;text-align:center}

        /* Contact Info Section */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 80px;
        }
        .info-card {
            background: var(--white-color);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            text-align: center;
        }
        .info-card i { font-size: 2.5rem; color: var(--primary); margin-bottom: 15px; }
        .info-card h3 { font-size: 1.3rem; font-weight: 600; margin-bottom: 10px; color: var(--text-dark); }
        .info-card p { color: var(--text-gray); font-size: 1rem; }

        /* Grid Container ki styling */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

/* Wrapper for the animated border */
.info-card-animation-wrapper {
    position: relative;
    padding: 3px; /* Border ki motai (thickness) */
    border-radius: 23px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(20, 184, 166, 0.3); /* Base halka glow */
}

/* Asli info-card ki styling */
.info-card {
    padding: 30px;
    border-radius: 20px;
    background: #f9fafb;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    text-align: center; /* Content ko center mein rakhein */
}

.info-card i {
    font-size: 2.5rem;
    color: #14b8a6; /* Teal Green */
    margin-bottom: 20px;
}

.info-card h3 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.5rem;
}

.info-card p {
    color: #555;
    font-size: 1rem;
}

/* Rotating gradient light (pseudo-element) */
.info-card-animation-wrapper::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(
        transparent,
        #14b8a6 5%,
        #34d399 20%,
        #14b8a6 35%,
        transparent 50%
    );
    animation: rotate-conic-glow 4s linear infinite;
    z-index: 1;
    filter: blur(8px);
}

/* Rotation ki keyframes animation */
/* Note: Agar yeh animation pehle se aapki CSS mein hai, to isay dobara add na karein */
@keyframes rotate-conic-glow {
    to {
        transform: rotate(360deg);
    }
}

        /* Contact Form & Map Section */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: flex-start;
        }
        .contact-form { background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .contact-form h3 { font-size: 1.8rem; font-weight: 700; margin-bottom: 20px; }
        
        .input-group { position: relative; margin-bottom: 1.5rem; }
        .input-field { width: 100%; padding: 14px; font-size: 1rem; border: 1px solid #ddd; border-radius: 8px; }
        .input-field:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0, 181, 173, 0.2); }
        
        .map-container { border-radius: 15px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .map-container iframe { border: 0; width: 100%; height: 520px; }

        .submit-btn { width: 100%; padding: 15px; background: var(--primary); color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; }

        /* Responsive */
        @media(max-width: 992px) {
            .contact-grid { grid-template-columns: 1fr; }
            .map-container { margin-top: 40px; }
        }
        @media(max-width: 768px) {
            nav{display:none;position:absolute;top:100%;left:0;width:100%;background:#fff}
            nav.active{display:block}
            nav ul{flex-direction:column;padding:20px}
            .mobile-menu-toggle{display:block}
        }
    </style>
@endpush