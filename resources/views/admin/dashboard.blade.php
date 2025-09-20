@extends('admin.layouts.app')

@section('content')




<div class="page-background-container">
    <div class="meteors"></div>
</div>
<div class="cursor-dot"></div>
<div class="cursor-outline"></div>

<div class="container-fluid dashboard-container pt-5">

    <div class="mb-5 card-enter" style="--animation-order: 0;">
        <h1 class="display-5 fw-bold mb-0">Dashboard</h1>
        <p class="fs-5 mb-0 text-muted">Welcome-Back Admin</p>
    </div>
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4 card-enter" style="--animation-order: 1;"><div class="stat-card glass-card tilt-card"><h5>Total Users</h5><p class="stat-number animated-number">{{ $totalUsers ?? 0 }}</p><i class="fas fa-users card-icon-bg"></i></div></div>
        <div class="col-xl-3 col-md-6 mb-4 card-enter" style="--animation-order: 2;"><div class="stat-card glass-card tilt-card"><h5>Total Jobs</h5><p class="stat-number animated-number">{{ $totalJobs ?? 0 }}</p><i class="fas fa-briefcase card-icon-bg"></i></div></div>
        <div class="col-xl-3 col-md-6 mb-4 card-enter" style="--animation-order: 3;"><div class="stat-card glass-card tilt-card"><h5>Active Users</h5><p class="stat-number animated-number">{{ $activeUsers ?? 0 }}</p><i class="fas fa-user-check card-icon-bg"></i></div></div>
        <div class="col-xl-3 col-md-6 mb-4 card-enter" style="--animation-order: 4;"><div class="stat-card glass-card tilt-card"><h5>Banned Users</h5><p class="stat-number animated-number">{{ $bannedUsers ?? 0 }}</p><i class="fas fa-user-slash card-icon-bg"></i></div></div>
    </div>
    <div class="row">
        <div class="col-lg-4 d-flex flex-column mb-4 card-enter" style="--animation-order: 5;"><div class="content-card glass-card tilt-card"><h4>Complaints Status</h4><div class="chart-container"><canvas id="complaintsChart"></canvas></div></div></div>
        <div class="col-lg-4 d-flex flex-column mb-4 card-enter" style="--animation-order: 6;"><div class="content-card glass-card tilt-card activity-feed-card">
            <h4 class="mb-3">Recent Activity</h4>
            <ul class="list-group list-group-flush">
                @forelse($latestUsers->take(1) as $user)
                    <li class="list-group-item"><span class="activity-icon icon-bg-primary"><i class="fas fa-user-plus"></i></span><div>New user: <strong>{{ $user->name }}</strong></div></li>
                @empty
                    <li class="list-group-item text-muted">No new user activity.</li>
                @endforelse
                @forelse($latestJobs->take(1) as $job)
                    <li class="list-group-item"><span class="activity-icon icon-bg-success"><i class="fas fa-briefcase"></i></span><div>New job: <strong>{{ Str::limit($job->title, 20) }}</strong></div></li>
                @empty
                    <li class="list-group-item text-muted">No new job activity.</li>
                @endforelse
                @forelse($latestComplaints->take(1) as $complaint)
                    <li class="list-group-item"><span class="activity-icon icon-bg-danger"><i class="fas fa-exclamation-triangle"></i></span><div>Complaint: <strong>{{ $complaint->user->name ?? 'N/A' }}</strong></div></li>
                @empty
                    <li class="list-group-item text-muted">No new complaints.</li>
                @endforelse
            </ul>
        </div></div>
        <div class="col-lg-4 d-flex flex-column mb-4 card-enter" style="--animation-order: 7;"><div class="content-card glass-card tilt-card"><h4>Users Overview</h4><div class="chart-container"><canvas id="totalUsersChart"></canvas></div></div></div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    :root {
        --font-main: 'Poppins', sans-serif;
        --bg-color: #0c0d14;
        --text-primary: #f0f2ff;
        --text-secondary: #a7b3d3;
        --accent-gradient: linear-gradient(90deg, #00c3ff, #ff00c3);
        --glass-bg: rgba(18, 20, 36, 0.6);
        --glass-border: rgba(255, 255, 255, 0.1);
        --backdrop-blur: 15px;
        --cursor-color: #ffffff;
    }
    * { cursor: none; }

    .cursor-dot, .cursor-outline { position: fixed; top: 0; left: 0; transform: translate(-50%, -50%); border-radius: 50%; z-index: 9999; pointer-events: none; transition: transform 0.2s cubic-bezier(0.19, 1, 0.22, 1), opacity 0.2s ease; }
    .cursor-dot { width: 8px; height: 8px; background-color: var(--cursor-color); }
    .cursor-outline { width: 40px; height: 40px; border: 2px solid var(--cursor-color); transition-duration: 0.3s; }

    .page-background-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden; }
    .page-background-container::before {
        content: ''; position: absolute; top: -10%; left: -10%; width: 120%; height: 120%;
        background: radial-gradient(circle at 10% 20%, rgba(12, 53, 106, 0.7) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(84, 19, 119, 0.7) 0%, transparent 40%),
                    radial-gradient(circle at 50% 50%, rgba(17, 98, 127, 0.6) 0%, transparent 40%);
        background-color: var(--bg-color);
        z-index: 1;
        animation: moveAurora 25s infinite linear alternate;
    }
    @keyframes moveAurora { from { transform: rotate(0deg) scale(1); } to { transform: rotate(360deg) scale(1); } }
    
    .meteors { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
    .meteor { position: absolute; width: 2px; height: 150px; background: linear-gradient(to bottom, rgba(255, 255, 255, 0.7), transparent); transform: rotate(-45deg); animation: fall linear infinite; z-index: 2; }
    @keyframes fall { from { top: -150px; opacity: 1; } to { top: calc(100% + 150px); opacity: 0; } }

    .dashboard-container { font-family: var(--font-main); position: relative; }
    .dashboard-container h1, .dashboard-container h4 { color: var(--text-primary); }

    .glass-card { background: var(--glass-bg); backdrop-filter: blur(var(--backdrop-blur)); border: 1px solid var(--glass-border); border-radius: 20px; padding: 30px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3); transition: transform 0.3s ease, box-shadow 0.3s ease; position: relative; overflow: hidden; }
    .tilt-card::after { content: ''; position: absolute; left: var(--mouse-x, 0); top: var(--mouse-y, 0); width: 250px; height: 250px; background: radial-gradient(circle, rgba(255, 255, 255, 0.25) 0%, transparent 70%); border-radius: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.5s ease, left 0.1s ease-out, top 0.1s ease-out; pointer-events: none; }
    .tilt-card:hover::after { opacity: 1; }
    .stat-card h5 { color: var(--text-secondary); font-weight: 500; font-size: 1rem; }
    .stat-card .stat-number { font-size: 2.8rem; font-weight: 700; background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent; }
    .stat-card .card-icon-bg { font-size: 4.5rem; opacity: 0.05; position: absolute; right: 20px; bottom: 15px; }
    .content-card { height: 100%; display: flex; flex-direction: column; }
    .chart-container { flex-grow: 1; min-height: 250px; }
    
    .activity-feed-card .list-group {
        background-color: transparent;
    }

    .activity-feed-card .list-group-item { 
        background: transparent !important; 
        border-bottom: 1px solid var(--glass-border) !important; 
        display: flex; 
        align-items: flex-start; 
        gap: 1rem; 
        padding: 0.9rem 0; 
        /* === YAHAN PAR FIX ADD KIYA GAYA HAI === */
        color: var(--text-secondary); 
    }
    .activity-feed-card .list-group-item strong { color: var(--text-primary); }
    .activity-feed-card .list-group-item:hover { background-color: rgba(255, 255, 255, 0.03) !important; }
    .icon-bg-primary { background-color: rgba(0, 195, 255, 0.1); color: #00c3ff; }
    .icon-bg-success { background-color: rgba(0, 255, 157, 0.1); color: #00ff9d; }
    .icon-bg-danger { background-color: rgba(255, 71, 102, 0.1); color: #ff4766; }
    
    @keyframes cardEnter { from { opacity: 0; transform: translateY(50px) scale(0.9); } to { opacity: 1; transform: translateY(0) scale(1); } }
    .card-enter { animation: cardEnter 0.8s cubic-bezier(0.19, 1, 0.22, 1) forwards; opacity: 0; }
    .row > * { animation-delay: calc(0.1s * var(--animation-order, 0)); }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cursorDot = document.querySelector('.cursor-dot');
    const cursorOutline = document.querySelector('.cursor-outline');
    window.addEventListener('mousemove', (e) => {
        const posX = e.clientX;
        const posY = e.clientY;
        cursorDot.style.left = `${posX}px`;
        cursorDot.style.top = `${posY}px`;
        cursorOutline.animate({ left: `${posX}px`, top: `${posY}px` }, { duration: 500, fill: "forwards" });
        const target = e.target;
        if (target.matches('a, button') || target.closest('.tilt-card')) {
            cursorOutline.style.transform = 'translate(-50%, -50%) scale(1.5)';
        } else {
            cursorOutline.style.transform = 'translate(-50%, -50%) scale(1)';
        }
    });

    const meteorsContainer = document.querySelector('.meteors');
    if (meteorsContainer) {
        const meteorCount = 10;
        for(let i = 0; i < meteorCount; i++) {
            const meteor = document.createElement('div');
            meteor.classList.add('meteor');
            meteor.style.left = `${Math.random() * 120 - 10}vw`;
            meteor.style.animationDuration = `${Math.random() * 5 + 3}s`;
            meteor.style.animationDelay = `${Math.random() * 10}s`;
            meteorsContainer.appendChild(meteor);
        }
    }
    
    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
            if (progress < 1) { window.requestAnimationFrame(step); }
        };
        window.requestAnimationFrame(step);
    }
    document.querySelectorAll('.animated-number').forEach(el => {
        const endVal = parseInt(el.innerText.replace(/,/g, ''), 10) || 0;
        animateValue(el, 0, endVal, 2000);
    });

    const tiltCards = document.querySelectorAll('.tilt-card');
    tiltCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const width = card.offsetWidth;
            const height = card.offsetHeight;
            const yRotation = 15 * ((x - width / 2) / width);
            const xRotation = -15 * ((y - height / 2) / height);
            const transformString = `perspective(1000px) scale(1.05) rotateX(${xRotation}deg) rotateY(${yRotation}deg)`;
            card.style.transform = transformString;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) scale(1) rotateX(0) rotateY(0)';
        });
    });

    let complaintsChart, totalUsersChart;
    const complaintsStats = @json($complaintsStats ?? [0, 0]);
    const totalUsersStats = [@json($activeUsers ?? 0), @json($bannedUsers ?? 0)];
    const complaintsCtx = document.getElementById('complaintsChart').getContext('2d');
    const totalUsersCtx = document.getElementById('totalUsersChart').getContext('2d');
    function renderCharts() {
        const textColor = 'rgba(238, 242, 255, 0.8)';
        Chart.defaults.color = textColor;
        Chart.defaults.font.family = 'Poppins, sans-serif';
        if (complaintsChart) complaintsChart.destroy();
        if (totalUsersChart) totalUsersChart.destroy();
        const chartOptions = {
            responsive: true, maintainAspectRatio: false, cutout: '80%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 20, color: textColor } } },
            elements: { arc: { borderWidth: 0 } },
            animation: { animateScale: true, animateRotate: true, duration: 1500 }
        };
        complaintsChart = new Chart(complaintsCtx, { type: 'doughnut', data: { labels: ['Pending', 'Resolved'], datasets: [{ data: complaintsStats, backgroundColor: ['#f6c23e', '#1cc88a'], hoverOffset: 10 }] }, options: chartOptions });
        totalUsersChart = new Chart(totalUsersCtx, { type: 'doughnut', data: { labels: ['Active', 'Banned'], datasets: [{ data: totalUsersStats, backgroundColor: ['#4e73df', '#e74a3b'], hoverOffset: 10 }] }, options: chartOptions });
    }
    renderCharts();
    window.addEventListener('themeChanged', renderCharts);
});
</script>
@endpush