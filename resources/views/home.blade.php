@extends('layouts.public')

@section('content')
  <!-- Hero -->
  <section class="hero">
    <div class="hero-container">
      <div>
        <h1 class="hero-title">Find Your Dream Job Today</h1>
        <p class="hero-subtitle">Discover thousands of opportunities from top companies. Your perfect career is just a click away.</p>
                {{-- Is poore form se purane search-box ko replace karein --}}
        <form class="search-box" action="{{ route('jobs.browse') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Job title, keywords, or company">

            <select name="category" class="search-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>

            <button type="submit" class="search-btn"><i class="fas fa-search"></i> Search</button>
        </form>
      </div>
      <div class="hero-image">
        <img src="{{ asset('assets/images/home 2.jpg ') }}" alt="Professional person">
      </div>
    </div>
  </section>

    <!-- How it Works -->
  <section class="how-it-works section">
    <h2 class="section-title">How It Works</h2>
    <p class="section-subtitle">Simple steps to land your dream job</p>
    <div class="steps">
      <div class="step-card-animation-wrapper">
        <div class="step-card">
            <i class="fas fa-search"></i>
            <h3>Search</h3>
            <p>Find jobs by title, skill, or company in just a few clicks.</p>
        </div>
      </div>

      <div class="step-card-animation-wrapper">
      <div class="step-card">
        <i class="fas fa-paper-plane"></i
        ><h3>Apply</h3>
        <p>Submit your application easily and track status online.</p>
      </div>
      </div>

      <div class="step-card-animation-wrapper">
      <div class="step-card">
        <i class="fas fa-briefcase"></i>
        <h3>Get Hired</h3>
        <p>Connect with top employers and start your new career.</p>
      </div>
      </div>
    </div>
  </section>

  <!--featured Jobs-->
<section class="jobs-section">
    <div class="container">
        
        <div class="section-header gsap-reveal">
            <h2>Latest Job Openings</h2>
            <p>Find your next career opportunity from our hand-picked listings.</p>
        </div>

        {{-- Yeh raha naya dynamic grid --}}
        <div class="job-grid-container">
            @forelse($latestJobs as $job)
                <div class="job-card gsap-reveal">
                    
                    <div class="job-card__content">
                        <div class="job-card__header">
                            <div class="job-card__company-info">
                                <div class="job-card__logo">
                                     {{-- User ki profile picture ya initials yahan ayenge --}}
                                     <img class="job-card__logo-img" 
                                          src="{{ $job->user->profile_photo_url }}" 
                                          alt="{{ $job->user->name ?? 'Company' }}'s logo">
                                </div>
                                <div>
                                    <h3 class="job-card__title">
                                        {{-- Job ka title ab database se ayega --}}
                                        <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                                    </h3>
                                    <p class="job-card__company">{{ $job->user->name ?? 'Company Name' }}</p>
                                </div>
                            </div>
                            <span class="job-card__category">{{ $job->category }}</span>
                        </div>

                        <div class="job-card__meta">
                            <div class="meta-item">
                                <i class="ph ph-map-pin"></i>
                                <span>{{ $job->location }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="ph ph-clock"></i>
                                <span>Full Time</span>
                            </div>
                            <div class="meta-item">
                                <i class="ph ph-calendar-blank"></i>
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="ph ph-hourglass"></i>
                                <span>{{ $job->duration }}</span>
                            </div>
                        </div>

                        <div class="job-card__salary">
                            <p>{{ $job->pay }}</p>
                        </div>
                    </div>

                    <div class="job-card__actions">
                        {{-- Button ab job ke detail page par jayega --}}
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn--apply">View Details</a>
                    </div>
                </div>
            @empty
                {{-- Agar koi job na ho to yeh message show hoga --}}
                <div class="no-jobs-found">
                    <p>No recent job openings found. Check back later!</p>
                </div>
            @endforelse
        </div>

        <div class="view-all-btn-container gsap-reveal">
            {{-- Yeh button ab aapke Browse Jobs page par jana chahiye --}}
            <a href="{{ route('jobs.browse') }}" class="view-all-btn">View All Jobs</a>
        </div>
        
    </div>
</section>

  <!-- Categories -->
<!-- Categories Parallax Showcase -->
<section class="categories-parallax section">
    <h2 class="section-title">Explore Our Top Categories</h2>
    <p class="section-subtitle">Find skilled and verified professionals for any job, big or small. Quality service is just a click away.</p>

    <div class="parallax-item" style="background-image: url('https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=1500&q=80');">
        <div class="content-box">
            <h3>Electricians</h3>
            <p>Connect with skilled electricians for safe and reliable electrical work.</p>
        </div>
    </div>

    <div class="parallax-item" style="background-image: url('{{ asset('assets/images/ac tech.avif') }}')">
        <div class="content-box right">
            <h3>AC technicians</h3>
            <p>Find Expert AC technicians for reliable installation, repair, and maintenance.</p>
        </div>
    </div>

    <div class="parallax-item" style="background-image: url('https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=1500&q=80');">
        <div class="content-box">
            <h3>Web Developers</h3>
            <p>Bring your digital vision to life with our expert web developers.</p>
        </div>
    </div>
</section>

  <!-- Testimonials -->
  <section class="testimonials section">
    <h2 class="section-title">What People Say</h2>
    <p class="section-subtitle">Real stories from job seekers</p>
    <div class="testimonial-grid">
      <div class="testimonial-card"><p>"JobPro helped me land my first remote job within 2 weeks. Super easy platform!"</p><div class="testimonial-author"><img src="https://randomuser.me/api/portraits/women/44.jpg"><div><strong>Sarah J.</strong><br><small>Designer</small></div></div></div>
      <div class="testimonial-card"><p>"As an employer, I found talented developers quickly. Highly recommended!"</p><div class="testimonial-author"><img src="https://randomuser.me/api/portraits/men/32.jpg"><div><strong>Michael B.</strong><br><small>HR Manager</small></div></div></div>
      <div class="testimonial-card"><p>"Clean, professional, and very intuitive to use. It saved me so much time."</p><div class="testimonial-author"><img src="https://randomuser.me/api/portraits/women/68.jpg"><div><strong>Amy K.</strong><br><small>Marketing Lead</small></div></div></div>
    </div>
  </section>

  <!-- Blog -->
  <section class="blog section">
    <h2 class="section-title">Latest Career Advice</h2>
    <p class="section-subtitle">Tips and guides to boost your career</p>
    <div class="blog-grid">
      <div class="blog-card"><img src="https://source.unsplash.com/400x200/?career,office"><div class="content"><h3>10 Tips for Acing Your Interview</h3><p>Learn the do’s and don’ts to impress your interviewer.</p></div></div>
      <div class="blog-card"><img src="https://source.unsplash.com/400x200/?team,work"><div class="content"><h3>How to Build a Strong Resume</h3><p>Stand out with a professional and eye-catching resume.</p></div></div>
      <div class="blog-card"><img src="https://source.unsplash.com/400x200/?success,career"><div class="content"><h3>Remote Work Productivity Hacks</h3><p>Stay focused and productive while working from home.</p></div></div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <h2>Ready to Find Your Next Job?</h2>
    <p>Join thousands of professionals using JobPro today.</p>
    <button>Register Now</button>
  </section>

  <!-- Extra Sections Start -->

  <!-- Stats -->
  <section class="section">
    <h2 class="section-title">Our Achievements</h2>
    <div style="display:flex;justify-content:center;gap:40px;flex-wrap:wrap;margin-top:40px">
      <div style="text-align:center">
        <h3 id="jobsCounter" style="font-size:2rem;color:var(--primary)">0</h3>
        <p>Jobs Posted</p>
      </div>
      <div style="text-align:center">
        <h3 id="companiesCounter" style="font-size:2rem;color:var(--primary)">0</h3>
        <p>Companies</p>
      </div>
      <div style="text-align:center">
        <h3 id="candidatesCounter" style="font-size:2rem;color:var(--primary)">0</h3>
        <p>Candidates</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="section">
    <h2 class="section-title">Frequently Asked Questions</h2>
    <div style="max-width:800px;margin:auto">
      <div style="margin-bottom:15px;border:1px solid #ddd;border-radius:10px;overflow:hidden">
        <div class="faq-question" style="padding:15px;font-weight:600;cursor:pointer;background:#f9fafb">How do I apply for jobs?</div>
        <div class="faq-answer" style="display:none;padding:15px;color:var(--text-gray)">Search and click "Apply" on any job listing. Submit your resume directly.</div>
      </div>
      <div style="margin-bottom:15px;border:1px solid #ddd;border-radius:10px;overflow:hidden">
        <div class="faq-question" style="padding:15px;font-weight:600;cursor:pointer;background:#f9fafb">Is JobPro free to use?</div>
        <div class="faq-answer" style="display:none;padding:15px;color:var(--text-gray)">Yes, job seekers can use JobPro for free. Employers can choose paid plans.</div>
      </div>
      <div style="margin-bottom:15px;border:1px solid #ddd;border-radius:10px;overflow:hidden">
        <div class="faq-question" style="padding:15px;font-weight:600;cursor:pointer;background:#f9fafb">Can employers find candidates?</div>
        <div class="faq-answer" style="display:none;padding:15px;color:var(--text-gray)">Yes, employers can browse candidates and contact them directly.</div>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="section" style="text-align:center;background:var(--primary);color:#fff">
    <h2 class="section-title" style="color:#fff">Stay Updated!</h2>
    <p class="section-subtitle" style="color:#f0f0f0">Subscribe to get the latest jobs straight to your inbox</p>
    
    {{-- Success ya Error messages dikhane ke liye --}}
    @if (session('success'))
        <div style="background: #28a745; padding: 10px; border-radius: 5px; margin-bottom: 15px; display: inline-block;">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div style="background: #dc3545; padding: 10px; border-radius: 5px; margin-bottom: 15px; display: inline-block;">{{ $errors->first('email') }}</div>
    @endif

    {{-- Form tag add kiya gaya --}}
    <form action="{{ route('subscribe') }}" method="POST" style="margin-top: 20px;">
        {{-- CSRF token (security ke liye zaroori) --}}
        @csrf
        
        {{-- Input ko 'name="email"' diya gaya --}}
        <input type="email" name="email" placeholder="Enter your email" style="padding:15px;border:none;border-radius:10px;width:300px;max-width:80%;color:black" required>
        
        {{-- Button ko 'type="submit"' kiya gaya --}}
        <button type="submit" style="padding:15px 25px;border:none;border-radius:10px;background:#fff;color:var(--primary);font-weight:600;margin-left:10px;cursor:pointer">Subscribe</button>
    </form>
</section>

@endsection

@push('scripts')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <script>

    // Hero Animation
  gsap.from(".hero-title", {y:50, opacity:0, duration:1});
  gsap.from(".hero-subtitle", {y:50, opacity:0, duration:1, delay:0.3});
  gsap.from(".search-box", {y:50, opacity:0, duration:1, delay:0.6});
  gsap.from(".hero-image img", {x:100, opacity:0, duration:1.2, delay:0.8});

  // Section Titles Animation on Scroll
  gsap.utils.toArray(".section").forEach(section=>{
    gsap.from(section.querySelectorAll(".section-title, .section-subtitle"),{
      scrollTrigger:{trigger:section,start:"top 80%"},
      y:50,opacity:0,duration:1,stagger:0.2
    });
  });

  // Category Cards Animation
  gsap.utils.toArray(".category-card").forEach(card=>{
    gsap.from(card,{
      scrollTrigger:{trigger:card,start:"top 85%"},
      y:60,opacity:0,duration:0.8
    });
  });

  // Testimonials Animation
  gsap.utils.toArray(".testimonial-card").forEach(card=>{
    gsap.from(card,{
      scrollTrigger:{trigger:card,start:"top 85%"},
      y:60,opacity:0,duration:0.8
    });
  });

  // Blog Cards Animation
  gsap.utils.toArray(".blog-card").forEach(card=>{
    gsap.from(card,{
      scrollTrigger:{trigger:card,start:"top 85%"},
      y:60,opacity:0,duration:0.8
    });
  });

  // Parallax Effect for Hero Image
  document.addEventListener("mousemove", function(e){
    const heroImage = document.querySelector(".hero-image");
    if(heroImage){
      const x = (window.innerWidth - e.pageX*2)/100;
      const y = (window.innerHeight - e.pageY*2)/100;
      heroImage.style.transform = `translate(${x}px, ${y}px)`;
    }
  });


        // === CORRECTED ANIMATION SCRIPT ===
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-on-scroll');

            // This observer will add the 'animated' class to elements when they enter the screen
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, {
                threshold: 0.1 // Trigger when 10% of the element is visible
            });

            // Tell the observer to watch every element with the 'animate-on-scroll' class
            animatedElements.forEach(el => {
                observer.observe(el);
            });

            // Your counter animation and other scripts can go here...
        });
    // FAQ Toggle
    document.querySelectorAll('.faq-question').forEach(q=>{
      q.addEventListener('click',()=>{
        const ans=q.nextElementSibling;
        ans.style.display=ans.style.display==='block'?'none':'block';
      });
    });

    // Counters
    function animateCounter(id,target){
      let count=0;let el=document.getElementById(id);
      let interval=setInterval(()=>{
        if(count<target){count+=Math.ceil(target/100);el.innerText=count;}else{el.innerText=target.toLocaleString();clearInterval(interval);}
      },30);
    }
    animateCounter("jobsCounter",25000);
    animateCounter("companiesCounter",12000);
    animateCounter("candidatesCounter",50000);

  </script>
@endpush 

@push('styles')
    
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    /* Scroll Animation Classes */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s ease-out;
}

.animate-on-scroll.animated {
    opacity: 1;
    transform: translateY(0);
}
    :root {
      --primary: #00B5AD;
      --primary-dark: #008b84;
      --text-dark: #111827;
      --text-gray: #6b7280;
      --bg-light: #ffffff;
    }
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Poppins',sans-serif;background:var(--bg-light);color:var(--text-dark);line-height:1.6}

   
    /* Hero */
    .hero{padding:140px 20px 100px;background:#fff;color:var(--text-dark)}
    .hero-container{max-width:1200px;margin:auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));align-items:center;gap:50px}
    .hero-title{font-size:3.5rem;font-weight:900;line-height:1.2;margin-bottom:20px;color:var(--text-dark)}
    .hero-subtitle{font-size:1.2rem;margin-bottom:30px;color:var(--text-gray)}
    .search-box{display:flex;gap:10px;background:#f9fafb;padding:8px;border-radius:15px;box-shadow:0 5px 20px rgba(0,0,0,.05)}
    .search-input,.search-select{padding:15px;border:none;outline:none;border-radius:10px;font-size:1rem;flex:1}
    .search-select{flex:.5;background:#f3f4f6}
    .search-btn{background:var(--primary);color:#fff;padding:15px 25px;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:.3s}
    .search-btn:hover{background:var(--primary-dark)}

    /* Sections */
    .section{padding:100px 20px}
    .section-title{font-size:2.5rem;font-weight:800;margin-bottom:15px;text-align:center;color:var(--text-dark)}
    .section-subtitle{max-width:650px;margin:auto;color:var(--text-gray);margin-bottom:50px;text-align:center}

    /* Categories */
    .categories{background:#f9fafb}
    .categories-grid{max-width:1200px;margin:auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:30px}
    .category-card{background:#fff;border:1px solid #eee;border-radius:20px;padding:30px;box-shadow:0 5px 15px rgba(0,0,0,.05);transition:.3s}
    .category-card:hover{transform:translateY(-10px)}
    .category-icon{width:70px;height:70px;border-radius:20px;margin:auto;margin-bottom:20px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;background:var(--primary);color:#fff}
    .category-title{font-size:1.3rem;font-weight:600}
    .category-count{color:var(--text-gray);font-size:.9rem}

    /* How it Works */
    .how-it-works{background:#fff;text-align:center}
    .steps{max-width:1200px;margin:auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px}
    .step-card{padding:30px;border-radius:20px;background:#f9fafb;box-shadow:0 5px 15px rgba(0,0,0,.05)}
    .step-card i{font-size:2.5rem;color:var(--primary);margin-bottom:15px}
      
    /* Wrapper for the animated border */
.step-card-animation-wrapper {
    position: relative;
    padding: 3px; /* Yeh border ki motai (thickness) hai */
    border-radius: 23px; /* Card se thora sa bara radius */
    overflow: hidden; /* Zaroori hai taake animation corners se bahar na nikle */
    /* Box shadow is for the base glow when no rotation is happening, or static glow */
    box-shadow: 0 0 10px rgba(20, 184, 166, 0.3); /* Base halka glow */
}

/* The actual step card, apni original styling ke saath */
.step-card {
    padding: 30px;
    border-radius: 20px; /* Original radius */
    background: #f9fafb; /* Original background */
    box-shadow: 0 5px 15px rgba(0,0,0,.05); /* Original shadow */
    position: relative; /* Zaroori hai taake content upar rahe */
    z-index: 2; /* Card ko animated border ke upar rakhega */
    width: 100%;
    height: 100%;
}

.step-card i {
    font-size: 2.5rem;
    color: #14b8a6; /* Original color */
    margin-bottom: 15px;
}

.step-card h3 { /* Assuming h3 for title */
    color: #333; /* Default text color */
    margin-bottom: 10px;
}

.step-card p { /* Assuming p for description */
    color: #555; /* Default text color */
}

/* The element that creates the rotating gradient light (::before pseudo-element on the wrapper) */
.step-card-animation-wrapper::before {
    content: '';
    position: absolute;
    /* Isay wrapper se 50% bahar rakhein aur 200% bara karein taake yeh ghoom sakay */
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(
        transparent, /* Shuru mein transparent */
        #14b8a6 5%, /* Teal green line ka shuru */
        #34d399 20%, /* Lighter teal */
        #14b8a6 35%, /* Teal green line ka aakhir */
        transparent 50% /* Baqi area transparent */
    );
    animation: rotate-conic-glow 4s linear infinite; /* Animation laga dein */
    z-index: 1; /* Card ke peeche rakhein */
    filter: blur(40px); /* Blur effect (glow) */
}

/* Keyframes for the rotation animation */
@keyframes rotate-conic-glow {
    to {
        transform: rotate(360deg);
    }
}

/* --- YAHAN TAK NAYA CODE HAI --- */

      
     /* Job Cards */

        .jobs-section {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark-color);
            margin-bottom: 0.5rem;
        }

        .section-header p {
            font-size: 1.1rem;
            color: var(--text-light-color);
        }

         .job-grid-container {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 32px;
        margin-top: 40px;
    }

    /* Main Job Card */
    .job-card {
        background-color: #ffffff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        /* border: 1px solid #f0f0f0; */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* transition: transform 0.3s ease, box-shadow 0.3s ease; */
       border: 3px solid #e0f2f2; /* Default halka sa border */
    transition: all 0.3s ease;
}

/* Step 2: Hover par solid border dein aur glow animation shuru karein */
.job-card:hover {
    transform: translateY(-5px);

    border: 3px solid;
    border-color: #14b8a6; /* Solid Teal Green Border */
    animation: border-glow 1.5s infinite alternate; /* Glow animation apply karein */
}

/* Step 3: Glow ki animation banayein */
@keyframes border-glow {
  from {
    /* Shuru mein halka sa glow */
    box-shadow: 0 0 5px rgba(20, 184, 166, 0.5), 
                0 0 10px rgba(20, 184, 166, 0.3);
  }
  to {
    /* Aakhir mein tez glow */
    box-shadow: 0 0 20px rgba(20, 184, 166, 0.8), 
                0 0 30px rgba(20, 184, 166, 0.6);
  }
}

    .job-card__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }
    
    .job-card__logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Tasveer ko distort hone se bachata hai */
        border-radius: inherit; /* Apne parent div (job-card__logo) jaisa hi border-radius le lega */
    }
    
    .job-card__company-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .job-card__logo {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background-color: #ef4444; /* Red */
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .job-card__title a {
        font-size: 18px;
        font-weight: 700;
        color: #1a202c;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .job-card__title a:hover {
        color: #14b8a6; /* Teal */
    }
    .job-card__company {
        font-size: 14px;
        color: #718096;
        margin-top: 2px;
    }

    .job-card__category {
        background-color: #f5f3ff;
        color: #4338ca; /* Purple */
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 9999px;
        white-space: nowrap;
    }

    .job-card__meta {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        font-size: 14px;
        color: #0d0f11ff;
        
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .job-card__salary {
        margin-top: 20px;
        font-size: 22px;
        font-weight: 700;
        color: #16a34a; /* Green */
    }

    .job-card__actions {
        margin-top: 24px;
    }
    
    /* Buttons */
    .btn {
        display: block;
        width: 100%;
        text-align: center;
        font-weight: 600;
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn--apply {
        background-color: #14b8a6; /* Teal */
        color: #ffffff;
    }
    .btn--apply:hover {
        background-color: #0d9488; /* Darker Teal */
    }

        .view-all-btn-container {
            text-align: center;
            margin-top: 50px;
        }
        
        .view-all-btn {
            display: inline-block;
            padding: 12px 30px;
           background-color: #14b8a6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        
        /* Parallax Categories */
/* Parallax Section ka Main Container */
.categories-parallax {
    background: #f7fafc; /* Thora sa off-white background */
    padding-top: 80px;
    padding-bottom: 40px; /* Neechay se thora kam padding */
}

/* Section Title ki styling (aapke paas pehle se ho sakti hai) */
.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-align: center;
    color: #111827;
}
.section-subtitle {
    max-width: 650px;
    margin: auto;
    color: #6b7280;
    margin-bottom: 60px;
    text-align: center;
}

/* Har Parallax Item ki styling */
.parallax-item {
    position: relative;
    height: 580px; /* === CHANGE: Height 450px se 580px kar di hai === */
    background-attachment: fixed; /* Yeh Parallax effect banata hai */
    background-size: cover;
    background-position: center;
    margin-bottom: 40px; /* Har section ke darmiyan fasla */
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Naya design: White content box overlay */
.parallax-item .content-box {
    position: absolute;
    top: 50%;
    transform: translateY(-50%); /* Vertically center karta hai */
    left: 5%; /* Screen ke left side par */
    width: 90%;
    max-width: 450px; /* Box ki max chaurai */
    background: rgba(255, 255, 255, 0.95); /* Thora sa transparent white */
    backdrop-filter: blur(5px); /* Peechay ki image ko halka sa blur karta hai */
    -webkit-backdrop-filter: blur(5px);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Alternate design ke liye, box ko right side par shift karega */
.parallax-item .content-box.right {
    left: auto;
    right: 5%;
}

.content-box h3 {
    font-size: 2.2rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 10px 0;
}

.content-box p {
    font-size: 1.1rem;
    color: #6b7280;
    margin: 0;
}

/* Mobile ke liye adjustments */
@media (max-width: 768px) {
    .parallax-item {
        background-attachment: scroll; /* Mobile par parallax ajeeb lagta hai, isliye scroll kar diya */
        height: 450px; /* === CHANGE: Mobile par bhi height thori barha di hai === */
    }
    .parallax-item .content-box,
    .parallax-item .content-box.right {
        left: 50%;
        transform: translate(-50%, -50%); /* Mobile par center mein */
        text-align: center;
    }
}
        /* Responsive Grid */
        @media (max-width: 992px) {
            .jobs-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .jobs-grid {
                grid-template-columns: 1fr;}}

    /* Companies */
    .companies{background:#f9fafb}
    .company-logos{max-width:1000px;margin:auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:20px;align-items:center;justify-items:center}
    .company-logos img{max-width:120px;opacity:.8;transition:.3s}
    .company-logos img:hover{opacity:1}

    /* Testimonials */
    .testimonials{background:#fff}
    .testimonial-grid{max-width:1200px;margin:auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:30px}
    .testimonial-card{background:#f9fafb;border-radius:20px;padding:25px;box-shadow:0 5px 15px rgba(0,0,0,.05)}
    .testimonial-card p{color:var(--text-gray);margin-bottom:15px}
    .testimonial-author{display:flex;align-items:center;gap:15px}
    .testimonial-author img{width:50px;height:50px;border-radius:50%}

    /* Blog */
    .blog{background:#f9fafb}
    .blog-grid{max-width:1200px;margin:auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:30px}
    .blog-card{background:#fff;border-radius:15px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.05)}
    .blog-card img{width:100%;height:200px;object-fit:cover}
    .blog-card .content{padding:20px}
    .blog-card h3{font-size:1.2rem;margin-bottom:10px}
    .blog-card p{color:var(--text-gray);font-size:.9rem}

    /* CTA */
    .cta{background:var(--primary);color:#fff;text-align:center;padding:80px 20px}
    .cta h2{font-size:2rem;margin-bottom:20px}
    .cta button{background:#fff;color:var(--primary);padding:15px 30px;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:.3s}
    .cta button:hover{background:#f3f4f6}
   
</style>
@endpush