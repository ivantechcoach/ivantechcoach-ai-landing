    <!-- =================== FOOTER =================== -->
    <footer>
        <div class="container footer-container">
            <div class="social-links">
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
            </div>
            <div class="footer-nav">
                <a href="#" target="_blank">Aviso Legal</a>
                <a href="#" target="_blank">Política de Privacidad</a>
                <a href="<?php echo BASE_URL; ?>blog/admin/login.php">Admin</a>
            </div>
            <div class="footer-copyright">
                &copy; <span id="year"></span> Ivan Tech Coach. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- JavaScript - `defer` asegura que el script se ejecute después de que el HTML ha sido analizado -->
    <script src="<?php echo BASE_URL; ?>assets/js/main.js" defer></script>
    <script>
        // Actualizar el año del copyright automáticamente
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

</body>
</html>