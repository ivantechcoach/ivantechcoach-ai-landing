<?php
// Valores por defecto para las metaetiquetas
$page_title = isset($page_title) ? $page_title : 'Ivan Tech Coach | Asesoría y Desarrollo Web Full Stack';
$page_description = isset($page_description) ? $page_description : 'Ofrezco asesoría y desarrollo web para startups y negocios. Experto en PHP, HTML5, CSS3 y optimización SEO para potenciar tu presencia online.';
$page_canonical = isset($page_canonical) ? $page_canonical : BASE_URL;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ============== META TAGS ESENCIALES ============== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ============== TÍTULO Y SEO BÁSICO ============== -->
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="author" content="Ivan Tech Coach">
    <link rel="canonical" href="<?php echo htmlspecialchars($page_canonical); ?>">

    <!-- ============== PRECONNECTS PARA RECURSOS EXTERNOS ============== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">

    <!-- ============== FAVICON Y APPLE TOUCH ICON ============== -->
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo BASE_URL; ?>assets/img/favicon_io/apple-touch-icon.png">

    <!-- ============== GOOGLE FONTS (Sora & Open Sans) ============== -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Sora:wght@700&display=swap" rel="stylesheet">

    <!-- ============== META TAGS OPEN GRAPH (Facebook, LinkedIn) ============== -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta property="og:image" content="<?php echo BASE_URL; ?>assets/img/preview.webp">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo htmlspecialchars($page_canonical); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Ivan Tech Coach">

    <!-- ============== META TAGS TWITTER CARDS ============== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="twitter:image" content="<?php echo BASE_URL; ?>assets/img/preview.webp">

    <!-- ============== GOOGLE ANALYTICS 4 (GA4) ============== -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6FMWT7R0VD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-6FMWT7R0VD');
    </script>

    <!-- ============== SCHEMA.ORG JSON-LD (PERSON) ============== -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Ivan Tech Coach",
      "url": "<?php echo BASE_URL; ?>",
      "sameAs": []
    }
    </script>

    <!-- ============== FONT AWESOME (ICONOS) ============== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ============== HOJA DE ESTILOS PRINCIPAL ============== -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">

</head>
<body>

    <!-- =================== HEADER =================== -->
    <header id="header">
        <div class="container header-container">
            <a href="<?php echo BASE_URL; ?>" class="logo">
                <img src="<?php echo BASE_URL; ?>assets/img/logo.webp" alt="Ivan Tech Coach Logo">
                <span class="logo-text">Ivan Tech Coach</span>
            </a>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>index.php#about" class="nav-link">Sobre Mí</a></li>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>index.php#services" class="nav-link">Servicios</a></li>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>portafolio.php" class="nav-link">Portafolio</a></li>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>blog/index.php" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="<?php echo BASE_URL; ?>index.php#contact" class="nav-link">Contacto</a></li>
                </ul>
                <button class="hamburger" id="hamburger" aria-label="Abrir menú de navegación">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>