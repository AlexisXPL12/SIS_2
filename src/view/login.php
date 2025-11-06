<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #1a237e, #3f51b5, #00897b, #26a69a, #1565c0);
            background-size: 300% 300%;
            animation: gradientShift 10s ease infinite;
            opacity: 0.95;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(63, 81, 181, 0.15);
            border-radius: 50%;
            animation: float 7s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 15%;
            left: 10%;
            animation-delay: 0s;
            background: rgba(0, 137, 123, 0.12);
        }

        .shape:nth-child(2) {
            width: 140px;
            height: 140px;
            top: 60%;
            right: 8%;
            animation-delay: 2s;
            background: rgba(63, 81, 181, 0.18);
        }

        .shape:nth-child(3) {
            width: 70px;
            height: 70px;
            bottom: 15%;
            left: 18%;
            animation-delay: 4s;
            background: rgba(255, 111, 0, 0.1);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(25px);
            border: 3px solid rgba(63, 81, 181, 0.2);
            border-radius: 24px;
            padding: 45px 35px;
            width: 420px;
            box-shadow: 0 30px 60px rgba(26, 35, 126, 0.4);
            position: relative;
            z-index: 10;
            animation: slideUp 0.9s ease-out;
            text-align: center;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container h1 {
            color: #1a237e;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 25px;
            text-shadow: 0 2px 6px rgba(63, 81, 181, 0.2);
            animation: textGlow 3s ease-in-out infinite alternate;
            letter-spacing: 0.5px;
        }

        @keyframes textGlow {
            from { text-shadow: 0 0 15px rgba(63, 81, 181, 0.3); }
            to { text-shadow: 0 0 25px rgba(63, 81, 181, 0.6); }
        }

        .login-container img {
            margin-bottom: 25px;
            border-radius: 12px;
            opacity: 0.95;
            transition: transform 0.4s ease;
            box-shadow: 0 4px 12px rgba(63, 81, 181, 0.15);
        }

        .login-container img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(63, 81, 181, 0.25);
        }

        .login-container h4 {
            color: #455a64;
            font-size: 1.15rem;
            margin-bottom: 35px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            color: #7986cb;
            font-size: 20px;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .input-wrapper input {
            padding-left: 55px !important;
        }

        .input-wrapper:focus-within .input-icon {
            color: #3f51b5;
            transform: scale(1.15);
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            color: #7986cb;
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
            transition: all 0.3s ease;
            user-select: none;
        }

        .toggle-password:hover {
            color: #3f51b5;
            transform: scale(1.15);
        }

        .toggle-password.active {
            color: #00897b;
            animation: toggleBounce 0.3s ease;
        }

        @keyframes toggleBounce {
            0% { transform: scale(1); }
            50% { transform: scale(1.25); }
            100% { transform: scale(1.15); }
        }

        .login-container input {
            width: 100%;
            padding: 16px 22px;
            background: rgba(245, 247, 250, 0.9);
            border: 2px solid rgba(63, 81, 181, 0.2);
            border-radius: 14px;
            color: #1a237e;
            font-size: 16px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            outline: none;
            font-weight: 500;
        }

        .login-container input::placeholder {
            color: rgba(69, 90, 100, 0.6);
            font-weight: 500;
        }

        .login-container input:focus {
            border-color: #3f51b5;
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(63, 81, 181, 0.2);
        }

        .login-container button {
            width: 100%;
            padding: 17px;
            background: linear-gradient(135deg, #3f51b5, #5c6bc0);
            border: none;
            border-radius: 14px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(63, 81, 181, 0.35);
        }

        .login-container button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .login-container button:hover::before {
            left: 100%;
        }

        .login-container button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(63, 81, 181, 0.45);
            background: linear-gradient(135deg, #5c6bc0, #7986cb);
        }

        .login-container button:active {
            transform: translateY(-1px);
        }

        .login-container a {
            display: block;
            margin-top: 25px;
            color: #455a64;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .login-container a:hover {
            color: #3f51b5;
            text-shadow: 0 0 12px rgba(63, 81, 181, 0.4);
        }

        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45px;
            height: 45px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 5px;
            height: 5px;
            background: rgba(63, 81, 181, 0.4);
            border-radius: 50%;
            opacity: 0.7;
            animation: particleFloat 5s linear infinite;
            box-shadow: 0 0 10px rgba(63, 81, 181, 0.5);
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.7;
            }
            90% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(-10px) translateX(100px);
                opacity: 0;
            }
        }
    </style>
    <!-- Sweet Alerts css -->
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
    </script>
</head>

<body>
    <div class="background-animation"></div>
    
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="particles" id="particles"></div>

    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <img src="<?php echo BASE_URL ?>src/view/pp/assets/images/logo IES.png" alt="Logo" width="100%">
        <h4>Sistema de Control de Docentes</h4>
        
        <form id="frm_login">
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input type="text" name="dni" id="dni" placeholder="DNI" required>
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
            </div>

            <button type="submit">
                Ingresar
                <div class="loading" id="loading"></div>
            </button>
        </form>

        <a href="#">¿Olvidaste tu contraseña?</a>
    </div>

    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
                toggleIcon.classList.add('active');
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
                toggleIcon.classList.remove('active');
            }
            
            // Animación de bounce
            toggleIcon.style.animation = 'none';
            setTimeout(() => {
                toggleIcon.style.animation = 'toggleBounce 0.3s ease';
            }, 10);
        }

        // Crear partículas animadas
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            
            setInterval(() => {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                
                particlesContainer.appendChild(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 4000);
            }, 300);
        }

        // Efectos de hover para inputs
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.animation = 'none';
                this.style.animation = 'inputFocus 0.3s ease forwards';
            });
        });

        // Inicializar partículas
        createParticles();

        // Efecto de ondas al hacer clic
        document.addEventListener('click', function(e) {
            const ripple = document.createElement('div');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(63, 81, 181, 0.3)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = (e.clientX - 25) + 'px';
            ripple.style.top = (e.clientY - 25) + 'px';
            ripple.style.width = '50px';
            ripple.style.height = '50px';
            ripple.style.pointerEvents = 'none';
            
            document.body.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // CSS para animación de ripple
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            @keyframes inputFocus {
                0% { transform: scale(1); }
                50% { transform: scale(1.02); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

<!-- Script de sesión original -->
<script src="<?php echo BASE_URL; ?>src/view/js/sesion.js"></script>
<!-- Sweet Alerts Js-->
<script src="<?php echo BASE_URL ?>src/view/pp/plugins/sweetalert2/sweetalert2.min.js"></script>

</html>