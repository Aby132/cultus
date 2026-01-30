<?php
$basePath = isset($basePath) ? $basePath : '';
?>
<!-- Footer -->
<footer id="contact" class="footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <div class="footer-logo">
                <img src="<?php echo $basePath; ?>assets/images/logo.png" alt="Cultus Logo">
                <span>Cultus India</span>
            </div>
            <p>Building credibility for international trade with quality exports.</p>
        </div>
        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="<?php echo $basePath; ?>index.php">Home</a></li>
                <li><a href="<?php echo $basePath; ?>index.php#about">About</a></li>
                <li><a href="<?php echo $basePath; ?>lightning.php">Power Solutions</a></li>
                <li><a href="<?php echo $basePath; ?>garments.php">Apparel</a></li>
                <li><a href="<?php echo $basePath; ?>trade.php">Trade Services</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h4>Contact Us</h4>
            <p><i data-lucide="map-pin"></i> India</p>
            <p><i data-lucide="mail"></i> info@cultusindia.com</p>
            <p><i data-lucide="phone"></i> +91 123 456 7890</p>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <p>&copy; <?php echo date('Y'); ?> Cultus India. All rights reserved.</p>
    </div>
</footer>
