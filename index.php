<?php get_header(); ?>

<!-- ============================================================
     HERO SECTION
     ============================================================ -->
<section class="hero" id="accueil">
    <div class="hero-bg"></div>
    <div class="container hero-content">
        <div class="hero-text">
            <span class="hero-badge"><i class="fas fa-shield-alt"></i> Soins de qualité depuis 2010</span>
            <h1 class="hero-title">
                Votre santé,<br>
                <span class="text-primary">notre priorité</span>
            </h1>
            <p class="hero-desc">
                Clinique médicale professionnelle au cœur d'Antananarivo.
                Médecins spécialisés, équipements modernes, disponibles 7j/7.
            </p>
            <div class="hero-actions">
                <a href="#contact" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i>
                    Prendre rendez-vous
                </a>
                <a href="#services" class="btn btn-outline">
                    <i class="fas fa-stethoscope"></i>
                    Nos services
                </a>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">5000+</span>
                    <span class="stat-label">Patients</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">15+</span>
                    <span class="stat-label">Médecins</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">24h/7</span>
                    <span class="stat-label">Urgences</span>
                </div>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-img-wrapper">
                <img
                    src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=560&h=560&fit=crop&q=80"
                    alt="Équipe médicale MediCare Tana"
                    class="hero-photo"
                    loading="eager"
                >
                <div class="hero-card hero-card--float hero-card--1">
                    <i class="fas fa-user-md"></i>
                    <span>3 Spécialistes</span>
                </div>
                <div class="hero-card hero-card--float hero-card--2">
                    <i class="fas fa-ambulance"></i>
                    <span>Urgences 24h</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SERVICES SECTION
     ============================================================ -->
<section class="services" id="services">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Ce que nous offrons</span>
            <h2 class="section-title">Nos <span class="text-primary">Services Médicaux</span></h2>
            <p class="section-desc">Une prise en charge complète pour toute votre famille</p>
        </div>

        <div class="services-grid">
            <?php
            $services = [
                ['icon' => 'fa-stethoscope',     'title' => 'Consultation Générale',   'desc' => 'Bilan de santé, diagnostic et traitement par nos médecins généralistes expérimentés.'],
                ['icon' => 'fa-ambulance',        'title' => 'Urgences 24h/24',         'desc' => 'Service d\'urgences disponible à toute heure pour les cas critiques.'],
                ['icon' => 'fa-flask',            'title' => 'Analyses Médicales',      'desc' => 'Laboratoire équipé pour toutes vos analyses biologiques et bilans sanguins.'],
                ['icon' => 'fa-x-ray',            'title' => 'Radiologie',              'desc' => 'Radiographie, échographie et scanner avec résultats rapides.'],
                ['icon' => 'fa-baby',             'title' => 'Pédiatrie',               'desc' => 'Suivi de croissance et soins adaptés aux nourrissons, enfants et adolescents.'],
                ['icon' => 'fa-heartbeat',        'title' => 'Cardiologie',             'desc' => 'ECG, holter et consultation cardiologique avec nos spécialistes.'],
            ];
            foreach ($services as $service): ?>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas <?php echo $service['icon']; ?>"></i>
                </div>
                <h3 class="service-title"><?php echo $service['title']; ?></h3>
                <p class="service-desc"><?php echo $service['desc']; ?></p>
                <a href="#contact" class="service-link">
                    En savoir plus <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     POURQUOI NOUS
     ============================================================ -->
<section class="why-us">
    <div class="container why-us-inner">
        <div class="why-us-image">
            <div class="why-us-card">
                <i class="fas fa-award"></i>
                <div>
                    <strong>Certifié ISO</strong>
                    <span>Qualité reconnue</span>
                </div>
            </div>
            <img
                src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=520&h=520&fit=crop&q=80"
                alt="Salle médicale MediCare Tana"
                class="why-us-real-img"
                loading="lazy"
            >
        </div>
        <div class="why-us-content">
            <span class="section-tag">Pourquoi nous choisir</span>
            <h2 class="section-title">Une clinique <span class="text-primary">de confiance</span></h2>
            <p class="why-us-desc">
                Depuis plus de 14 ans, MediCare Tana accompagne les familles d'Antananarivo
                avec des soins médicaux de haute qualité, accessibles et humains.
            </p>
            <ul class="why-us-list">
                <li><i class="fas fa-check-circle"></i> Médecins diplômés et expérimentés</li>
                <li><i class="fas fa-check-circle"></i> Équipements médicaux modernes</li>
                <li><i class="fas fa-check-circle"></i> Résultats rapides et fiables</li>
                <li><i class="fas fa-check-circle"></i> Tarifs transparents et accessibles</li>
                <li><i class="fas fa-check-circle"></i> Prise en charge assurance maladie</li>
            </ul>
            <a href="#contact" class="btn btn-primary">
                <i class="fas fa-calendar-check"></i>
                Prendre rendez-vous
            </a>
        </div>
    </div>
</section>

<!-- ============================================================
     MÉDECINS SECTION (Custom Post Type)
     ============================================================ -->
<section class="doctors" id="medecins">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Notre équipe</span>
            <h2 class="section-title">Nos <span class="text-primary">Médecins Spécialistes</span></h2>
            <p class="section-desc">Des professionnels qualifiés à votre service</p>
        </div>

        <div class="doctors-grid">
            <?php
            $doctors = medicare_get_doctors();
            foreach ($doctors as $doctor):
                $img = !empty($doctor['image']) ? $doctor['image'] : '';
            ?>
            <div class="doctor-card">
                <div class="doctor-photo">
                    <?php if ($img): ?>
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($doctor['name']); ?>" loading="lazy">
                    <?php else: ?>
                        <div class="doctor-photo-placeholder">
                            <i class="fas fa-user-md"></i>
                        </div>
                    <?php endif; ?>
                    <div class="doctor-badge">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name"><?php echo esc_html($doctor['name']); ?></h3>
                    <span class="doctor-specialite"><?php echo esc_html($doctor['specialite']); ?></span>
                    <?php if (!empty($doctor['excerpt'])): ?>
                        <p class="doctor-desc"><?php echo esc_html($doctor['excerpt']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($doctor['tel'])): ?>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\s/', '', $doctor['tel'])); ?>" class="doctor-tel">
                            <i class="fas fa-phone-alt"></i>
                            <?php echo esc_html($doctor['tel']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     À PROPOS SECTION
     ============================================================ -->
<section class="about" id="apropos">
    <div class="container about-inner">
        <div class="about-content">
            <span class="section-tag">Notre histoire</span>
            <h2 class="section-title">À propos de <span class="text-primary">MediCare Tana</span></h2>
            <p class="about-text">
                Fondée en 2010, MediCare Tana est née de la volonté d'offrir des soins médicaux
                accessibles et de qualité aux habitants d'Antananarivo. Notre clinique allie
                expertise médicale et approche humaine.
            </p>
            <p class="about-text">
                Avec une équipe de plus de 15 médecins spécialisés et un plateau technique moderne,
                nous prenons en charge tous vos besoins de santé, des consultations courantes
                aux urgences les plus critiques.
            </p>
            <div class="about-numbers">
                <div class="about-number">
                    <span class="number">14</span>
                    <span class="label">Ans d'expérience</span>
                </div>
                <div class="about-number">
                    <span class="number">15+</span>
                    <span class="label">Spécialistes</span>
                </div>
                <div class="about-number">
                    <span class="number">98%</span>
                    <span class="label">Satisfaction</span>
                </div>
            </div>
        </div>
        <div class="about-visual">
            <div class="about-visual-inner">
                <i class="fas fa-hospital-alt about-icon"></i>
                <div class="about-badge about-badge--1">
                    <i class="fas fa-medal"></i>
                    <span>Meilleure clinique 2023</span>
                </div>
                <div class="about-badge about-badge--2">
                    <i class="fas fa-heart"></i>
                    <span>5000+ patients</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     CONTACT SECTION (AJAX)
     ============================================================ -->
<section class="contact" id="contact">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Nous contacter</span>
            <h2 class="section-title">Prendre <span class="text-primary">Rendez-vous</span></h2>
            <p class="section-desc">Remplissez le formulaire, nous vous rappelons sous 2h</p>
        </div>

        <div class="contact-inner">

            <!-- Infos de contact -->
            <div class="contact-info">
                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h4>Adresse</h4>
                        <p>Alasora, Commune d'Alasora,<br>Antananarivo, Madagascar</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <h4>Téléphone</h4>
                        <p><a href="tel:+261348349886">034 83 498 86</a></p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <h4>WhatsApp</h4>
                        <p><a href="https://wa.me/261348349886" target="_blank" rel="noopener">034 83 498 86</a></p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4>Email</h4>
                        <p><a href="mailto:baymi312@gmail.com">baymi312@gmail.com</a></p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h4>Horaires</h4>
                        <p>Lun–Sam : 7h00 – 20h00<br>Urgences : 24h/24 – 7j/7</p>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="contact-form-wrapper">
                <form id="medicare-contact-form" class="contact-form" novalidate>
                    <?php wp_nonce_field('medicare_contact_nonce', 'nonce'); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name">Nom complet *</label>
                            <input type="text" id="contact-name" name="name" placeholder="Jean Rakoto" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email *</label>
                            <input type="email" id="contact-email" name="email" placeholder="jean@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact-phone">Téléphone</label>
                        <input type="tel" id="contact-phone" name="phone" placeholder="+261 34 00 000 00">
                    </div>

                    <div class="form-group">
                        <label for="contact-message">Message / Motif de consultation *</label>
                        <textarea id="contact-message" name="message" rows="5" placeholder="Décrivez votre motif de consultation..." required></textarea>
                    </div>

                    <div class="form-alert" id="form-alert" role="alert" aria-live="polite"></div>

                    <button type="submit" class="btn btn-primary btn-full" id="form-submit">
                        <i class="fas fa-paper-plane"></i>
                        <span>Envoyer le message</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
