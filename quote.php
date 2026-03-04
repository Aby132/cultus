<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get a Quote - Request Pricing | Cultus India</title>
    
    <meta name="description" content="Request a quote for Lightning Protection, Garment Exports, or Import-Export services from Cultus India.">
    
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="favicon.png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/pages.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <!-- Page Hero -->
    <header class="page-hero page-hero-quote">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="breadcrumb">
                <a href="index.php">Home</a> <i data-lucide="chevron-right"></i> <span>Get Quote</span>
            </div>
            <h1 class="hero-title animate-fade-up">Request a Quote</h1>
            <p class="hero-subtitle animate-fade-up delay-100">Tell us about your requirements and we'll get back to you within 24 hours</p>
        </div>
    </header>

    <!-- Quote Form Section -->
    <section class="quote-section section-padding">
        <div class="container">
            <div class="quote-wrapper">
                <!-- Service Selection Cards -->
                <div class="quote-services">
                    <h3>Select Your Service</h3>
                    <p class="text-muted">Choose the service you're interested in</p>
                    
                    <div class="service-option" data-service="lightning">
                        <div class="service-option-image">
                            <img src="assets/images/pexels-86419958-8956453.jpg" alt="Lightning Protection">
                        </div>
                        <div class="service-option-content">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <h4>Lightning Protection</h4>
                            <p>ESE Arresters, Earthing Systems, Surge Protection</p>
                        </div>
                        <div class="service-check"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                    
                    <div class="service-option" data-service="garments">
                        <div class="service-option-image">
                            <img src="assets/images/different types of uniforms.jpg" alt="Garments Export">
                        </div>
                        <div class="service-option-content">
                            <i class="bi bi-scissors"></i>
                            <h4>Garments Export</h4>
                            <p>Men's, Women's, Kids Wear, Uniforms, Private Label</p>
                        </div>
                        <div class="service-check"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                    
                    <div class="service-option" data-service="trade">
                        <div class="service-option-image">
                            <img src="assets/images/pexels-tomfisk-3848793.jpg" alt="Import Export">
                        </div>
                        <div class="service-option-content">
                            <i class="bi bi-globe-americas"></i>
                            <h4>Import / Export Services</h4>
                            <p>Product Sourcing, Documentation, Logistics</p>
                        </div>
                        <div class="service-check"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                </div>
                
                <!-- Quote Form -->
                <div class="quote-form-container">
                    <div class="quote-form-header">
                        <h3>Your Details</h3>
                        <p>Fill in your information and we'll contact you shortly</p>
                    </div>

                    <div id="quoteAlert" style="display:none;"></div>

                    <form id="quoteForm" class="quote-form" novalidate>
                        <input type="hidden" name="service" id="selectedService" value="">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fullName"><i class="bi bi-person-fill"></i> Full Name *</label>
                                <input type="text" id="fullName" name="fullName" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="company"><i class="bi bi-building"></i> Company Name</label>
                                <input type="text" id="company" name="company" placeholder="Your Company Ltd.">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="quoteEmail"><i class="bi bi-envelope-fill"></i> Email Address *</label>
                                <input type="email" id="quoteEmail" name="email" placeholder="john@company.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="bi bi-telephone-fill"></i> Phone Number *</label>
                                <input type="tel" id="phone" name="phone" placeholder="+91 98765 43210" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="country"><i class="bi bi-geo-alt-fill"></i> Country *</label>
                            <select id="country" name="country" required>
                                <option value="">Select your country</option>
                                <option value="India">India</option>
                                <option value="UAE">UAE</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="USA">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="Australia">Australia</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="requirements"><i class="bi bi-card-text"></i> Your Requirements *</label>
                            <textarea id="requirements" name="requirements" rows="5" placeholder="Please describe your requirements in detail:
- Quantity needed
- Specifications
- Target delivery date
- Any other details..." required></textarea>
                        </div>
                        
                        <button type="submit" id="quoteSubmitBtn" class="btn btn-primary btn-quote-submit">
                            <span class="btn-text"><i class="bi bi-send-fill"></i> Submit Quote Request</span>
                            <span class="btn-loading" style="display:none;"><i class="bi bi-arrow-repeat spin-icon"></i> Sending...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Why Request a Quote from Us?</h2>
                <div class="header-line"></div>
            </div>
            <div class="quote-benefits">
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="bi bi-clock-fill"></i></div>
                    <h4>24-Hour Response</h4>
                    <p>We respond to all inquiries within one business day.</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="bi bi-shield-check"></i></div>
                    <h4>No Obligation</h4>
                    <p>Get pricing without any commitment or pressure.</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h4>Competitive Rates</h4>
                    <p>Best-in-class pricing for quality products and services.</p>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="bi bi-headset"></i></div>
                    <h4>Expert Consultation</h4>
                    <p>Get personalized advice from industry specialists.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- Toast Notification -->
    <div id="toastOverlay"></div>
    <div id="toastCard">
        <div class="toast-band"></div>
        <div class="toast-body">
            <div class="toast-icon-wrap">
                <i id="toastIcon" class="bi"></i>
            </div>
            <p class="toast-title" id="toastTitle"></p>
            <p class="toast-msg"  id="toastMsg"></p>
            <button class="toast-close-btn" onclick="closeToast()">Got it</button>
        </div>
        <div class="toast-progress">
            <div class="toast-progress-bar" id="toastBar"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
    <script>
        lucide.createIcons();

        // ── Toast helpers ──
        let toastTimer;
        function showToast(success, title, msg) {
            const overlay = document.getElementById('toastOverlay');
            const card    = document.getElementById('toastCard');
            const icon    = document.getElementById('toastIcon');
            const ttl     = document.getElementById('toastTitle');
            const tmsg    = document.getElementById('toastMsg');
            const bar     = document.getElementById('toastBar');

            card.className  = success ? 'toast-success' : 'toast-error';
            icon.className  = success ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill';
            ttl.textContent  = success ? 'Quote Request Sent!' : 'Failed to Send';
            tmsg.textContent = msg;

            bar.style.transition = 'none';
            bar.style.transform  = 'scaleX(1)';

            overlay.classList.add('show');
            card.classList.add('show');

            clearTimeout(toastTimer);
            if (success) {
                requestAnimationFrame(() => {
                    bar.style.transition = 'transform 5s linear';
                    bar.style.transform  = 'scaleX(0)';
                });
                toastTimer = setTimeout(closeToast, 5000);
            }
        }
        function closeToast() {
            clearTimeout(toastTimer);
            document.getElementById('toastOverlay').classList.remove('show');
            document.getElementById('toastCard').classList.remove('show');
        }
        document.getElementById('toastOverlay').addEventListener('click', closeToast);

        // Service Selection
        const serviceOptions = document.querySelectorAll('.service-option');
        const selectedServiceInput = document.getElementById('selectedService');

        serviceOptions.forEach(option => {
            option.addEventListener('click', () => {
                serviceOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                selectedServiceInput.value = option.dataset.service;
            });
        });

        // ── AJAX Quote Form ──
        document.getElementById('quoteForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form    = this;
            const btn     = document.getElementById('quoteSubmitBtn');
            const btnText = btn.querySelector('.btn-text');
            const btnLoad = btn.querySelector('.btn-loading');

            btn.disabled = true;
            btnText.style.display = 'none';
            btnLoad.style.display = 'inline-flex';

            try {
                const res  = await fetch('send-quote.php', { method: 'POST', body: new FormData(form) });
                const data = await res.json();
                showToast(data.success, '', data.message);
                if (data.success) {
                    form.reset();
                    serviceOptions.forEach(opt => opt.classList.remove('active'));
                    selectedServiceInput.value = '';
                }
            } catch (err) {
                showToast(false, '', 'Network error. Please try again.');
            }

            btn.disabled = false;
            btnText.style.display = 'inline-flex';
            btnLoad.style.display = 'none';
        });
    </script>
</body>
</html>
