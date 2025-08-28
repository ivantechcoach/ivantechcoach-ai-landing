<?php
/**
 * index.php
 * Home del blog: Muestra el listado de artículos.
 */

// Incluir dependencias principales
require_once 'config/db.php';

// --- Definir metadatos para esta página ---
$page_title = 'Blog | Ivan Tech Coach';
$page_description = 'Artículos recientes sobre tecnología, ciberseguridad, desarrollo web y guías prácticas de IA.';
$page_canonical = BASE_URL . 'blog/';

require_once '../partials/header.php';

// --- Lógica para obtener todos los artículos ---
$articles = []; // Inicializar $articles como un array vacío

// Usar la conexión mysqli proporcionada por db.php
if ($conn) {
    try {
        // Preparamos la consulta. No hay parámetros de usuario, pero usar prepare es buena práctica.
        $stmt = $conn->prepare('SELECT id, title, slug, excerpt, category, image, created_at FROM articles ORDER BY created_at DESC');
        
        // Ejecutamos la consulta
        $stmt->execute();
        
        // Obtenemos los resultados
        $result = $stmt->get_result();
        
        // Recorremos los resultados y los guardamos en el array $articles
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        
        // Cerramos la sentencia
        $stmt->close();

    } catch (Exception $e) {
        // En caso de error, lo registramos y mostramos un mensaje genérico.
        error_log("Error al consultar artículos: " . $e->getMessage());
        // $articles ya está inicializado como []
    }
} else {
    error_log("Error: Conexión a la base de datos no disponible en index.php");
}

?>

<!-- Título de la página principal del blog -->
<header class="page-header">
    <h1>Artículos Recientes</h1>
    <p>Explora nuestras últimas publicaciones sobre tecnología, ciberseguridad y más.</p>
</header>

<!-- Contenedor para la lista de artículos -->
<div class="article-grid">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <article class="article-card">
                <div class="card-image-wrapper">
                    <?php
                    // Determine image source and alt text
                    $image_filename = htmlspecialchars($article['image']);
                    $image_full_path = BASE_URL . 'assets/img/articles/' . $image_filename;
                    $image_alt_text = htmlspecialchars($article['title']);

                    // Check if image filename is provided and if the file actually exists
                    $display_image_src = '';
                    $display_image_alt = '';
                    $use_placeholder = false;

                    if (!empty($article['image'])) {
                        // Note: This check is relative to the server's file system, not the web path
                        $physical_image_path = __DIR__ . '/../../assets/img/articles/' . $image_filename;
                        if (file_exists($physical_image_path)) {
                            $display_image_src = $image_full_path;
                            $display_image_alt = $image_alt_text;
                        } else {
                            $use_placeholder = true;
                        }
                    } else {
                        $use_placeholder = true;
                    }

                    if ($use_placeholder) {
                        $display_image_src = BASE_URL . 'assets/img/articles/placeholder.webp';
                        $display_image_alt = 'Imagen por defecto'; // Or a more generic alt text
                    }
                    ?>
                    <a href="articulo/<?php echo htmlspecialchars($article['slug']); ?>">
                        <img src="<?php echo $display_image_src; ?>" alt="<?php echo $display_image_alt; ?>" class="card-image" loading="lazy">
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-category"><?php echo htmlspecialchars($article['category']); ?></span>
                    <h2 class="card-title">
                        <a href="articulo/<?php echo htmlspecialchars($article['slug']); ?>"><?php echo htmlspecialchars($article['title']); ?></a>
                    </h2>
                    <p class="card-excerpt"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                    <a href="articulo/<?php echo htmlspecialchars($article['slug']); ?>" class="read-more-btn">Leer Más &rarr;</a>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-articles-message">
            <h3>¡Próximamente!</h3>
            <p>Aún no hay artículos publicados. ¡Estamos preparando contenido increíble para ti!</p>
        </div>
    <?php endif; ?>
</div> <!-- /.article-grid -->

<?php
// Incluir el pie de página que cierra el HTML.
require_once '../partials/footer.php';
?>
