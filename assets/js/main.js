/**
 * Funcionalidad Principal de la Landing Page
 * Autor: Ivan Tech Coach (Optimizado por Gemini)
 * Descripción: Maneja la interactividad del menú de navegación, animaciones de scroll y otras funcionalidades dinámicas.
 */

document.addEventListener('DOMContentLoaded', () => {

    // --- MANEJO DEL HEADER Y NAVEGACIÓN ---

    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    const header = document.getElementById('header');
    const navLinks = document.querySelectorAll('.nav-link');

    /**
     * Alterna la visibilidad del menú de navegación en dispositivos móviles.
     * Añade/quita la clase 'active' al menú y al botón hamburguesa.
     * También bloquea/desbloquea el scroll del body.
     */
    const toggleNavMenu = () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
        document.body.classList.toggle('no-scroll'); // Añade o quita la clase para bloquear/desbloquear el scroll
    };

    /**
     * Cierra el menú de navegación si está abierto.
     * Útil para cuando se hace clic en un enlace del menú.
     */
    const closeNavMenu = () => {
        if (navMenu.classList.contains('active')) {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.classList.remove('no-scroll'); // Se asegura de quitar la clase y restaurar el scroll
        }
    };

    // Event listener para el botón hamburguesa
    hamburger.addEventListener('click', toggleNavMenu);

    // Event listeners para cada enlace del menú, para cerrar el menú al hacer clic
    navLinks.forEach(link => {
        link.addEventListener('click', closeNavMenu);
    });

    // --- EFECTO DE SCROLL EN EL HEADER ---

    /**
     * Añade o quita la clase 'scrolled' al header según la posición del scroll.
     * Esto permite aplicar estilos diferentes cuando el usuario ha hecho scroll hacia abajo.
     */
    const handleHeaderScroll = () => {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };

    // Event listener para el evento de scroll en la ventana
    window.addEventListener('scroll', handleHeaderScroll);

    // --- ANIMACIÓN DE APARICIÓN DE SECCIONES ---

    /**
     * Observa las secciones de la página y les añade la clase 'visible'
     * cuando entran en el viewport, creando un efecto de "fade-in".
     */
    const sections = document.querySelectorAll('section:not(.visible)');
    const observerOptions = {
        root: null,       // El viewport es el área de referencia
        rootMargin: '0px',
        threshold: 0.1  // La sección se considera visible cuando el 10% de ella está en pantalla
    };

    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Dejar de observar la sección una vez que es visible
            }
        });
    }, observerOptions);

    // Observar cada una de las secciones
    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // --- ACTUALIZACIÓN DINÁMICA DEL AÑO EN EL FOOTER ---

    /**
     * Actualiza automáticamente el año en el copyright del footer.
     * Así se evita tener que cambiarlo manualmente cada año.
     */
    const yearSpan = document.getElementById('year');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }

});