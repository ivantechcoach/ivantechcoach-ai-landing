<?php include 'partials/header.php'; ?>

    <!-- =================== HEADER =================== -->
    <header id="header">
        <div class="container header-container">
            <a href="#" class="logo">
                <img src="assets/img/logo.webp" alt="Ivan Tech Coach Logo">
                <span class="logo-text">Ivan Tech Coach</span>
            </a>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item"><a href="#hero" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">Sobre Mí</a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">Servicios</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contacto</a></li>
                </ul>
                <button class="hamburger" id="hamburger" aria-label="Abrir menú de navegación">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- =================== HERO SECTION =================== -->
    <section id="hero" class="hero visible">
        <div class="hero-shape"></div>
        <div class="hero-shape"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Tu Coach de Tecnología Personal</h1>
                <p class="hero-subtitle">Te acompaño en tu viaje tecnológico con un lenguaje simple y soluciones prácticas para tus necesidades digitales.</p>
                <div class="hero-cta">
                    <a href="#contact" class="btn btn-primary">Contáctame</a>
                    <a href="#services" class="btn btn-secondary">Ver Servicios</a>
                </div>
            </div>
        </div>
    </section>

    <!-- =================== ABOUT SECTION =================== -->
    <section id="about" class="about">
        <div class="container about-container">
            <div class="about-image">
                <img src="assets/img/profile.webp" alt="Ivan Tech Coach - Perfil">
            </div>
            <div class="about-content">
                <h2 class="section-title">Sobre Mí</h2>
                <p class="about-text">
                    Soy Ivan, tu guía personal en el mundo tecnológico. Con más de 10 años de experiencia como técnico IT y formador digital, me especializo en hacer la tecnología accesible para todos, especialmente para personas mayores de 40 años que quieren adaptarse al mundo digital sin sentirse abrumados.
                </p>
                <p class="about-text">
                    Mi enfoque es humano y directo: te explico la tecnología en términos sencillos, resuelvo tus problemas informáticos y te enseño a protegerte en el mundo digital. Creo firmemente que la edad nunca debe ser una barrera para disfrutar de los beneficios de la tecnología moderna.
                </p>
                <a href="#services" class="btn btn-secondary">Descubre cómo puedo ayudarte</a>
            </div>
        </div>
    </section>

    <!-- =================== SERVICES SECTION =================== -->
    <section id="services" class="services">
        <div class="container">
            <div class="services-container">
                <h2 class="section-title">Mis Servicios</h2>
                <p class="services-description">
                    Ofrezco soluciones personalizadas para tus necesidades digitales, desde soporte técnico hasta formación en nuevas tecnologías. Todo con un lenguaje claro y enfoque práctico.
                </p>
            </div>
            <div class="services-grid">
                <!-- Servicio 1 -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-laptop-house"></i>
                    </div>
                    <h3 class="service-title">Soporte Técnico Personalizado</h3>
                    <p class="service-description">
                        Resolución de problemas informáticos, mantenimiento preventivo y optimización de equipos. Atención a domicilio o remota, adaptada a tus horarios y necesidades.
                    </p>
                </div>
                <!-- Servicio 2 -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="service-title">Seguridad Digital</h3>
                    <p class="service-description">
                        Protección contra amenazas online, gestión segura de contraseñas, configuración de privacidad y respaldo de información importante. Tu tranquilidad digital es mi prioridad.
                    </p>
                </div>
                <!-- Servicio 3 -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="service-title">Formación Personalizada</h3>
                    <p class="service-description">
                        Aprende a tu ritmo cómo usar dispositivos, aplicaciones y servicios digitales. Sesiones individuales enfocadas en tus intereses y necesidades específicas.
                    </p>
                </div>
                <!-- Servicio 4 -->
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="service-title">Introducción a la IA</h3>
                    <p class="service-description">
                        Descubre cómo la Inteligencia Artificial puede simplificar tu vida y trabajo. Aprende a utilizar herramientas como ChatGPT, Midjourney y asistentes virtuales de forma práctica y segura.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- =================== TESTIMONIAL SECTION =================== -->
    <section id="testimonial" class="testimonial visible">
        <div class="container">
            <div class="testimonial-content">
                <p class="testimonial-text">
                    "La tecnología no tiene por qué ser complicada. Mi misión es convertir lo complejo en simple, y lo confuso en claro. Juntos, haremos que la tecnología trabaje para ti, no al revés."
                </p>
                <p class="testimonial-author">- Ivan, Tech Coach</p>
            </div>
        </div>
    </section>

    <!-- =================== CONTACT SECTION =================== -->
    <section id="contact" class="contact">
        <div class="container contact-container">
            <h2 class="section-title">Contacto</h2>
            <p class="contact-description">
                ¿Tienes alguna duda o necesitas ayuda con algún problema tecnológico? Estoy aquí para ayudarte. Puedes contactarme a través de cualquiera de estos medios y responderé lo antes posible.
            </p>
            <div class="contact-buttons">
                <!-- Se añade rel="noopener noreferrer" por seguridad y rendimiento al abrir enlaces en una nueva pestaña -->
                <a href="https://wa.me/+TUNUMERO" class="contact-btn whatsapp" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="mailto:ivan@techcoach.com" class="contact-btn gmail">
                    <i class="far fa-envelope"></i> Email
                </a>
                <a href="tel:+TUNUMERO" class="contact-btn phone">
                    <i class="fas fa-phone-alt"></i> Llamar
                </a>
            </div>
        </div>
    </section>

    <!-- =================== FOOTER =================== -->
    <footer>
        <div class="container footer-container">
            <div class="social-links">
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Tiktok"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Email"><i class="far fa-envelope"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            </div>
            <div class="footer-nav">
                <a href="#hero" class="footer-link">Inicio</a>
                <a href="#about" class="footer-link">Sobre Mí</a>
                <a href="#services" class="footer-link">Servicios</a>
                <a href="#contact" class="footer-link">Contacto</a>
            </div>
            <div class="footer-copyright">
                &copy; <span id="year">2025</span> Ivan Tech Coach. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- JavaScript - `defer` asegura que el script se ejecute después de que el HTML ha sido analizado -->
    <script src="assets/js/main.js" defer></script>

</body>
</html>