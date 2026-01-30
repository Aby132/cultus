<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultus India - Global Supply & Manufacturing</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Cultus India - Your trusted partner for Lightning Protection, Garment Exports, and Global Import-Export Solutions.">
    <meta name="keywords" content="lightning protection, garment exports, import export, India trade, ESE lightning arresters, apparel manufacturing">
    
    <!-- Open Graph / Social -->
    <meta property="og:title" content="Cultus India - Global Supply & Manufacturing">
    <meta property="og:description" content="Lightning Protection, Garment Exports, and Custom Import-Export Solutions">
    <meta property="og:image" content="assets/images/logo.png">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="favicon.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <header id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="hero-title animate-fade-up">Global Supply. <br>Trusted Protection. <br>Quality Exports.</h1>
            <p class="hero-subtitle animate-fade-up delay-100">
                Lightning Protection <span class="divider">|</span> Garment Exports <span class="divider">|</span> Custom Import–Export Solutions
            </p>
            <div class="hero-cta-group animate-fade-up delay-200">
                <a href="lightning.php" class="btn btn-accent">Lightning Protection</a>
                <a href="garments.php" class="btn btn-primary">Garments Export</a>
                <a href="trade.php" class="btn btn-secondary">Import–Export Services</a>
            </div>
        </div>
    </header>

    <!-- Why Cultus Section -->
    <section id="about" class="why-us section-padding">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Why Cultus India?</h2>
                <div class="header-line"></div>
            </div>
            <div class="why-grid">
                <div class="feature-card">
                    <div class="icon-box"><i data-lucide="globe"></i></div>
                    <h3>Multi-industry Expertise</h3>
                    <p>Combining technical precision in engineering with creative excellence in fashion.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box"><i data-lucide="shield-check"></i></div>
                    <h3>International Compliance</h3>
                    <p>Adhering to IEC, IS, and global export standards for peace of mind.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box"><i data-lucide="users"></i></div>
                    <h3>Customer-Centric</h3>
                    <p>Tailored solutions met with rigorous quality assurance and on-time delivery.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box"><i data-lucide="award"></i></div>
                    <h3>Quality Assurance</h3>
                    <p>Imported certified products and rigorous testing at every stage.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Verticals Section -->
    <section id="verticals" class="verticals section-padding bg-light">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Our Business Verticals</h2>
                <p class="section-desc">Diverse expertise. Unified excellence.</p>
                <div class="header-line"></div>
            </div>
            
            <div class="verticals-container">
                
                <!-- Vertical 1: Lightning -->
                <article id="lightning-preview" class="vertical-card vertical-lightning">
                    <div class="card-image-wrapper">
                         <div class="card-bg-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="card-badge badge-accent">Industrial & Commercial</div>
                        <h3>Cultus Power Solutions</h3>
                        <p class="hero-line">"Advanced Lightning Protection for Critical Infrastructure"</p>
                        <ul class="card-features">
                            <li><i data-lucide="zap"></i> ESE Lightning Arresters</li>
                            <li><i data-lucide="anchor"></i> Earthing & Grounding</li>
                            <li><i data-lucide="shield"></i> Surge Protection</li>
                        </ul>
                        <div class="card-actions">
                            <a href="lightning.php" class="btn btn-accent btn-full">View Power Solutions</a>
                        </div>
                    </div>
                </article>

                <!-- Vertical 2: Garments -->
                <article id="garments-preview" class="vertical-card vertical-garments">
                    <div class="card-image-wrapper">
                         <div class="card-bg-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="card-badge badge-primary">Global Fashion Supply</div>
                        <h3>Cultus Apparel Exports</h3>
                        <p class="hero-line">"Exporting Quality Apparel to Global Markets"</p>
                        <ul class="card-features">
                            <li><i data-lucide="shirt"></i> Men's, Women's & Kids Wear</li>
                            <li><i data-lucide="briefcase"></i> Workwear & Uniforms</li>
                            <li><i data-lucide="scissors"></i> Private Label Mfg</li>
                        </ul>
                        <div class="card-actions">
                            <a href="garments.php" class="btn btn-primary btn-full">View Apparel Catalog</a>
                        </div>
                    </div>
                </article>

                <!-- Vertical 3: Trade -->
                <article id="trade-preview" class="vertical-card vertical-trade">
                    <div class="card-image-wrapper">
                         <div class="card-bg-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="card-badge badge-secondary">End-to-End Support</div>
                        <h3>Cultus Global Trade Services</h3>
                        <p class="hero-line">"Your Trusted Partner for Global Import & Export"</p>
                        <ul class="card-features">
                            <li><i data-lucide="package"></i> Product Sourcing</li>
                            <li><i data-lucide="file-check"></i> Documentation & Compliance</li>
                            <li><i data-lucide="truck"></i> Logistics Coordination</li>
                        </ul>
                        <div class="card-actions">
                            <a href="trade.php" class="btn btn-secondary btn-full">Explore Trade Services</a>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
