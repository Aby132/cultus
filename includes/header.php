<?php
// Base path for assets (relative to root)
$basePath = '';
?>
<!-- Navigation -->
<nav class="navbar">
    <div class="container nav-container">
        <a href="<?php echo $basePath; ?>index.php" class="logo">
            <img src="<?php echo $basePath; ?>assets/images/logo.png" alt="Cultus India Logo">
            <span class="logo-text">Cultus India</span>
        </a>
        <button class="mobile-toggle" aria-label="Toggle Menu">
            <i data-lucide="menu"></i>
        </button>
        <ul class="nav-links">
            <li><a href="<?php echo $basePath; ?>index.php#home">Home</a></li>
            <li><a href="<?php echo $basePath; ?>index.php#about">About Us</a></li>
            <li class="dropdown">
                <a href="<?php echo $basePath; ?>index.php#verticals">Verticals <i data-lucide="chevron-down" class="icon-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $basePath; ?>lightning.php">Lightning Protection</a></li>
                    <li><a href="<?php echo $basePath; ?>garments.php">Garments Export</a></li>
                    <li><a href="<?php echo $basePath; ?>trade.php">Import/Export</a></li>
                </ul>
            </li>
            <li><a href="<?php echo $basePath; ?>index.php#contact" class="btn btn-primary btn-sm">Contact Us</a></li>
        </ul>
    </div>
</nav>
