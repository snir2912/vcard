</main>
<footer class="site-footer">
    <div class="container footer-grid">

        <div class="footer-col brand-col">
            <div class="footer-logo">
                <?php 
                if ( has_custom_logo() ) {
                    // אם הועלה לוגו - הצג אותו
                    the_custom_logo();
                } else {
                    // אם אין לוגו - הצג את הטקסט הרגיל
                    ?>
                    <h3>VCARD<span class="dot">.</span></h3>
                    <?php
                }
                ?>
            </div>
            
            <p>הפלטפורמה המתקדמת ביותר לכרטיסי ביקור דיגיטליים. הצטרפו למהפכה הדיגיטלית והציגו את העסק שלכם בסטייל.</p>
            <div class="social-links">
                <a href="#"><i class="dashicons dashicons-facebook"></i></a>
                <a href="#"><i class="dashicons dashicons-instagram"></i></a>
                <a href="#"><i class="dashicons dashicons-twitter"></i></a>
            </div>
        </div>

        <div class="footer-col links-col">
            <h4>ניווט מהיר</h4>
            <?php 
            wp_nav_menu(array(
                'theme_location' => 'footer_menu',
                'container'      => false,
                'menu_class'     => 'footer-nav-list', 
                'depth'          => 1 
            )); 
            ?>
        </div>

        <div class="footer-col contact-col">
            <h4>בואו נדבר תכלס</h4>
            <p class="cta-text">רוצים כרטיס משלכם? השאירו פרטים ונחזור אליכם.</p>

            <div class="footer-form-wrapper">
                <?php echo do_shortcode('[contact-form-7 id="3d7e8bd" title="contact form"]'); ?>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> כל הזכויות שמורות ל-VCARD.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>