<?php
/**
 * article.php
 * Muestra un artículo individual basado en el slug proporcionado en la URL.
 */

require_once 'config/db.php';

// --- Lógica para obtener el artículo individual ---
$article = null;

// 1. Validar que el slug existe en la URL.
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    // Si no hay slug, redirigimos al inicio. No hay nada que mostrar.
    header('Location: ' . BASE_URL . 'blog/');
    exit;
}

$slug = $_GET['slug'];

// Usar la conexión mysqli proporcionada por db.php
if ($conn) {
    try {
        // 2. Usar una sentencia preparada para máxima seguridad (previene inyección SQL).
        $stmt = $conn->prepare('SELECT id, title, slug, excerpt, content, category, image, created_at FROM articles WHERE slug = ?');
        // 3. Vincular el valor del slug al placeholder.
        $stmt->bind_param('s', $slug); // 's' indica que el parámetro es un string
        // 4. Ejecutar la consulta.
        $stmt->execute();
        // 5. Obtener el resultado
        $result = $stmt->get_result();
        // 6. Obtener el artículo. fetch_assoc() devuelve null si no hay resultados.
        $article = $result->fetch_assoc();
        
        // Cerramos la sentencia
        $stmt->close();

    } catch (Exception $e) {
        // En un entorno de producción, nunca mostrarías el error directamente.
        error_log("Error al obtener el artículo con slug [$slug]: " . $e->getMessage());
        // Podríamos redirigir a una página de error 500 o simplemente dejar $article como null.
    }
} else {
    error_log("Error: Conexión a la base de datos no disponible en article.php");
}

// Si después de la consulta, $article sigue siendo null, significa que no se encontró.
if (!$article) {
    // Enviamos una cabecera 404 Not Found para que los buscadores lo entiendan.
    http_response_code(404);
}

// Incluimos la cabecera. El título de la página se puede ajustar dinámicamente.
require_once '../partials/header.php';

?>

<div class="article-view-container">
    <?php if ($article): ?>
        <article class="full-article">
            <header class="article-header-full">
                <!-- Título del Artículo -->
                <h1><?php echo htmlspecialchars($article['title']); ?></h1>
                <!-- Metadatos: Categoría y Fecha -->
                <div class="article-meta">
                    <span class="meta-item category-tag">#<?php echo htmlspecialchars($article['category']); ?></span>
                    <span class="meta-item-separator">|</span>
                    <span class="meta-item">Publicado el <?php echo date('j F, Y', strtotime($article['created_at'])); ?></span>
                </div>
            </header>

            <!-- Imagen Destacada -->
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
            <figure class="article-figure-full">
                <img src="<?php echo $display_image_src; ?>" alt="<?php echo $display_image_alt; ?>" loading="lazy">
            </figure>

            <!-- Contenido Principal del Artículo -->
            <section class="article-content-full">
                <?php echo $article['content']; // Se asume que el HTML es seguro (sanitizado al guardar) ?>
            </section>
        </article>
    <?php else: ?>
        <!-- Mensaje de Artículo No Encontrado -->
        <div class="article-not-found">
            <h1>Error 404</h1>
            <h2>Artículo no encontrado</h2>
            <p>Lo sentimos, la página que buscas no existe o ha sido movida. Puede que el enlace esté roto o que el artículo haya sido eliminado.</p>
            <a href="<?php echo BASE_URL; ?>blog/" class="btn-primary">Volver a la página de inicio</a>
        </div>
    <?php endif; ?>
</div>

<?php
// Incluir el pie de página.
require_once '../partials/footer.php';
?>
