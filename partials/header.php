<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ============== META TAGS ESENCIALES ============== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ============== TÍTULO Y SEO BÁSICO ============== -->
    <title>Ivan Tech Coach | Asesoría y Desarrollo Web Full Stack</title>
    <meta name="description" content="Ofrezco asesoría y desarrollo web para startups y negocios. Experto en PHP, HTML5, CSS3 y optimización SEO para potenciar tu presencia online.">
    <meta name="author" content="Ivan Tech Coach">
    <link rel="canonical" href="https://ivantechcoach.com">

    <!-- ============== FAVICON Y APPLE TOUCH ICON ============== -->
    <!-- Icono para la pestaña del navegador -->
    <link rel="icon" href="assets/img/favicon_io/favicon.ico" type="image/x-icon">
    <!-- Icono para dispositivos Apple -->
    <link rel="apple-touch-icon" href="assets/img/favicon_io/apple-touch-icon.png">

    <!-- ============== META TAGS OPEN GRAPH (Facebook, LinkedIn) ============== -->
    <meta property="og:title" content="Ivan Tech Coach | Asesoría y Desarrollo Web Full Stack">
    <meta property="og:description" content="Asesoría experta para llevar tu proyecto al siguiente nivel con las mejores prácticas de desarrollo y SEO.">
    <meta property="og:image" content="https://ivantechcoach.com/assets/img/preview.webp">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="https://ivantechcoach.com">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Ivan Tech Coach">

    <!-- ============== META TAGS TWITTER CARDS ============== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ivan Tech Coach | Asesoría y Desarrollo Web Full Stack">
    <meta name="twitter:description" content="Asesoría experta para llevar tu proyecto al siguiente nivel con las mejores prácticas de desarrollo y SEO.">
    <meta name="twitter:image" content="https://ivantechcoach.com/assets/img/preview.webp">
    <!-- Reemplazar con el usuario de Twitter si existe -->
    <!-- <meta name="twitter:site" content="@usuarioTwitter"> -->
    <!-- <meta name="twitter:creator" content="@usuarioTwitter"> -->

    <!-- ============== GOOGLE ANALYTICS 4 (GA4) ============== -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6FMWT7R0VD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-6FMWT7R0VD');
    </script>

    <!-- ============== SCHEMA.ORG JSON-LD (PERSON) ============== -->
    <!-- Reemplazar con las URLs reales de los perfiles sociales -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Ivan Tech Coach",
      "url": "https://ivantechcoach.com",
      "sameAs": [
        "https://www.instagram.com/USUARIO_INSTAGRAM/",
        "https://www.youtube.com/c/CANAL_YOUTUBE",
        "https://www.linkedin.com/in/USUARIO_LINKEDIN/"
      ]
    }
    </script>

    <!-- ============== FONT AWESOME (ICONOS) ============== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ============== HOJA DE ESTILOS PRINCIPAL ============== -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

    <!-- =================== HEADER =================== -->
    <header id="header">
        <div class="container header-container">
            <a href="index.php" class="logo">
                <img src="assets/img/logo.webp" alt="Ivan Tech Coach Logo">
                <span class="logo-text">Ivan Tech Coach</span>
            </a>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">Sobre Mí</a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">Servicios</a></li>
                    <li class="nav-item"><a href="portafolio.php" class="nav-link">Portafolio</a></li>
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