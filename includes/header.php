<?php
// Base path for assets (relative to root)
$basePath = isset($basePath) ? $basePath : '';
?>
<!-- Top Bar -->
<div class="top-bar">
    <div class="container top-bar-content">
        <div class="top-bar-left">
            <span><i data-lucide="mail"></i> info@cultusindia.com</span>
            <span><i data-lucide="phone"></i> +91 981 874 7608</span>
        </div>
        <div class="top-bar-right">
            <a href="#" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
            <a href="#" aria-label="Twitter"><i data-lucide="twitter"></i></a>
            <a href="#" aria-label="Facebook"><i data-lucide="facebook"></i></a>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar">
    <div class="container nav-container">
        <a href="<?php echo $basePath; ?>index.php" class="logo">
            <img src="<?php echo $basePath; ?>assets/images/logo.png" alt="Cultus India Logo">
            <div class="logo-text-group">
                <span class="logo-name">Cultus India</span>
                <span class="logo-tagline">Global Trade Solutions</span>
            </div>
        </a>
        
        <button class="mobile-toggle" aria-label="Toggle Menu" id="mobileToggle">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="<?php echo $basePath; ?>index.php">Home</a></li>
            <li><a href="<?php echo $basePath; ?>about.php">About</a></li>
            <li class="dropdown">
                <a href="<?php echo $basePath; ?>index.php#verticals" class="dropdown-trigger">
                    Services <i data-lucide="chevron-down" class="dropdown-icon"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo $basePath; ?>lightning.php">
                            <i data-lucide="zap"></i>
                            <div>
                                <strong>Lightning Protection</strong>
                                <span>Industrial safety solutions</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $basePath; ?>garments.php">
                            <i data-lucide="shirt"></i>
                            <div>
                                <strong>Garments Export</strong>
                                <span>Quality apparel worldwide</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $basePath; ?>trade.php">
                            <i data-lucide="globe"></i>
                            <div>
                                <strong>Import/Export</strong>
                                <span>End-to-end trade support</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li><a href="<?php echo $basePath; ?>index.php#contact" class="nav-cta">
                <i data-lucide="send"></i> Get Quote
            </a></li>
        </ul>
    </div>
</nav>
