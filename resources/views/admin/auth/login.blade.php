<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        :root {
            --bg-color: #000000;
            --card-bg: #1a1a2e;
            --text-primary: #ffffff;
            --text-secondary: #9a9fb4;
            --input-underline: #3a3d5b;
            --accent-purple: #8A2BE2;
            --accent-purple-dark: #7b25c9;
            --accent-blue: #4e73df;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--bg-color);
            color: var(--text-primary);
            position: relative;
            overflow: hidden;
        }

        /* === HEAVY ANIMATED BACKGROUND CANVAS === */
        #animated-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            z-index: -1;
            filter: brightness(0.8);
        }

        /* === Login Container with Glowing Border === */
        .login-container {
            position: relative;
            width: 850px; max-width: 90vw;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            z-index: 2;
        }
        .login-container::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 200%; height: 200%;
            background: conic-gradient(transparent, var(--accent-purple), var(--accent-blue), transparent);
            z-index: -1;
            filter: blur(30px);
            opacity: 0.9;
            animation: rotateGlow 6s linear infinite;
        }
        @keyframes rotateGlow {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .login-inner {
            display: flex;
            width: 100%;
            border: 2px solid var(--accent-purple);
            border-radius: 10px;
            position: relative;
            z-index: 1;
        }
        
        /* === Form Panels ab canvas ke oopar hain === */
        .form-panel, .welcome-panel {
            position: relative;
            z-index: 2;
            backdrop-filter: blur(8px);
        }

        /* === Left Side (Form) === */
        .form-panel { 
            width: 55%; 
            padding: 50px 40px; 
            background-color: rgba(26, 26, 46, 0.7);
        }
        /* === TEXT GLOW ADDED === */
        .form-panel h2 {
            font-size: 2.2em;
            font-weight: 600;
            margin-bottom: 35px;
            text-shadow: 0 0 10px var(--accent-purple), 0 0 20px rgba(138, 43, 226, 0.5); /* Glow */
        }
        .input-group { position: relative; margin-bottom: 35px; text-align: left; }
        .input-group label {
            font-size: 0.9em;
            color: var(--text-secondary);
            margin-bottom: 8px;
            display: block;
            text-shadow: 0 0 5px rgba(138, 43, 226, 0.3); /* Soft glow for labels */
        }
        .input-group i { position: absolute; right: 5px; top: 50%; transform: translateY(10%); color: var(--text-secondary); }
        .input-group input {
            width: 100%; background: transparent; border: none; outline: none;
            border-bottom: 1px solid var(--input-underline);
            color: var(--text-primary); font-size: 1.1em; padding: 8px 5px;
            transition: border-color 0.3s ease;
        }
        .input-group input:focus { border-bottom-color: var(--accent-purple); }
        .btn-login {
            width: 100%; padding: 14px; border: none; border-radius: 50px;
            background: linear-gradient(90deg, var(--accent-purple), var(--accent-purple-dark));
            color: #fff; font-size: 1.1em; font-weight: 600; cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(138, 43, 226, 0.4);
            margin-top: 20px;
        }
        .btn-login:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(138, 43, 226, 0.6); }
        .signup-link { margin-top: 30px; font-size: 0.9em; color: var(--text-secondary); }
        .signup-link a {
            color: var(--accent-purple);
            text-decoration: none;
            font-weight: 600;
            text-shadow: 0 0 5px rgba(138, 43, 226, 0.5); /* Glow for sign up link */
        }

        /* === Right Side (Welcome Panel with Clip-Path) === */
        .welcome-panel {
            width: 45%;
            background: linear-gradient(135deg, rgba(123, 37, 201, 0.8), rgba(171, 43, 226, 0.8));
            padding: 50px 40px;
            display: flex; flex-direction: column; justify-content: center; text-align: left;
            clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
        }
        /* === TEXT GLOW ADDED for Welcome Panel === */
        .welcome-panel-content { margin-left: 10%; }
        .welcome-panel h3 {
            font-size: 2em;
            font-weight: 600;
            margin-bottom: 10px;
            text-shadow: 0 0 10px rgba(255,255,255,0.7); /* White glow */
        }
        .welcome-panel p {
            font-size: 1em;
            color: rgba(255,255,255,0.8);
            text-shadow: 0 0 5px rgba(255,255,255,0.5); /* Soft white glow */
        }
        
        /* Error Message */
        .error-message {
            background-color: rgba(255, 82, 82, 0.1); color: #ff8a80; padding: 10px;
            border-radius: 8px; margin-bottom: 20px; border: 1px solid #ff5252; text-align: left;
        }

        @media (max-width: 800px) {
            .welcome-panel { display: none; }
            .form-panel { width: 100%; }
            .login-container { width: 400px; }
        }
    </style>
</head>
<body>
    
    <canvas id="animated-bg"></canvas>
    <div class="login-container">
        <div class="login-inner">
            <div class="form-panel">
                <h2>Login</h2>
                
                @if ($errors->any())
                    <div class="error-message">{{ $errors->first() }}</div>
                @endif
                
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="email">Username</label>
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form>

            </div>

            <div class="welcome-panel">
                <div class="welcome-panel-content">
                    <h3>WELCOME<br>BACK ADMIN !</h3>
                    <p>Enter your details to access the admin panel.</p>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('animated-bg');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width, height, circles;

        function init() {
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;

            circles = [];
            for (let i = 0; i < 20; i++) { 
                circles.push(new Circle());
            }
        }

        class Circle {
            constructor() {
                this.pos = { x: Math.random() * width, y: Math.random() * height };
                this.vel = { x: Math.random() * 0.5 - 0.25, y: Math.random() * 0.5 - 0.25 };
                this.radius = Math.random() * 300 + 150;
                this.color = `hsla(${Math.random() * 360}, 100%, 70%, 0.1)`;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.pos.x, this.pos.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.filter = `blur(20px)`;
                ctx.fill();
                ctx.filter = 'none';
            }

            update() {
                this.pos.x += this.vel.x;
                this.pos.y += this.vel.y;
                if (this.pos.x > width + this.radius) this.pos.x = -this.radius;
                if (this.pos.x < -this.radius) this.pos.x = width + this.radius;
                if (this.pos.y > height + this.radius) this.pos.y = -this.radius;
                if (this.pos.y < -this.radius) this.pos.y = height + this.radius;
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            for (let circle of circles) {
                circle.update();
                circle.draw();
            }
            requestAnimationFrame(animate);
        }
        
        init();
        animate();
        window.addEventListener('resize', init);
    }
});
</script>

</body>
</html>