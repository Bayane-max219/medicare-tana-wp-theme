<?php
/**
 * Medicare Tana - functions.php
 * Theme setup, enqueue scripts & styles, custom features
 */

// =============================================================================
// THEME SETUP
// =============================================================================
function medicare_tana_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Menu Principal', 'medicare-tana'),
        'footer'  => __('Menu Footer', 'medicare-tana'),
    ]);
}
add_action('after_setup_theme', 'medicare_tana_setup');

// =============================================================================
// ENQUEUE STYLES & SCRIPTS
// =============================================================================
function medicare_tana_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap',
        [],
        null
    );

    // Font Awesome (icons)
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );

    // Main theme stylesheet
    wp_enqueue_style(
        'medicare-tana-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['google-fonts', 'font-awesome'],
        '1.0.0'
    );

    // Theme style.css
    wp_enqueue_style('medicare-tana-style', get_stylesheet_uri(), [], '1.0.0');

    // Main JS
    wp_enqueue_script(
        'medicare-tana-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );

    // Pass AJAX url to JS
    wp_localize_script('medicare-tana-main', 'medicareAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('medicare_contact_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'medicare_tana_scripts');

// =============================================================================
// CONTACT FORM AJAX HANDLER
// =============================================================================
function medicare_handle_contact() {
    check_ajax_referer('medicare_contact_nonce', 'nonce');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'Veuillez remplir tous les champs obligatoires.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Adresse email invalide.']);
    }

    $to      = get_option('admin_email');
    $subject = 'Nouveau message - MediCare Tana';
    $body    = "Nom: $name\nEmail: $email\nTéléphone: $phone\n\nMessage:\n$message";
    $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: $name <$email>"];

    // Sauvegarder dans la base de données (Custom Post Type rendez_vous)
    $post_id = wp_insert_post([
        'post_type'   => 'rendez_vous',
        'post_title'  => sanitize_text_field($name) . ' — ' . current_time('d/m/Y H:i'),
        'post_status' => 'publish',
        'post_content' => sanitize_textarea_field($message),
    ]);

    if ($post_id) {
        update_post_meta($post_id, '_rdv_email', $email);
        update_post_meta($post_id, '_rdv_phone', $phone);
        update_post_meta($post_id, '_rdv_name',  $name);
    }

    // Envoyer aussi par email
    $to      = 'baymi312@gmail.com';
    $subject = 'Nouveau RDV — MediCare Tana';
    $body    = "Nom: $name\nEmail: $email\nTéléphone: $phone\n\nMessage:\n$message";
    $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: $name <$email>"];
    wp_mail($to, $subject, $body, $headers);

    wp_send_json_success(['message' => 'Votre demande a été envoyée ! Nous vous contactons sous 2h.']);
}
add_action('wp_ajax_medicare_contact', 'medicare_handle_contact');
add_action('wp_ajax_nopriv_medicare_contact', 'medicare_handle_contact');

// =============================================================================
// CUSTOM POST TYPE : MÉDECINS
// =============================================================================
function medicare_register_doctors_cpt() {
    $labels = [
        'name'               => 'Médecins',
        'singular_name'      => 'Médecin',
        'add_new'            => 'Ajouter un médecin',
        'add_new_item'       => 'Ajouter un nouveau médecin',
        'edit_item'          => 'Modifier le médecin',
        'new_item'           => 'Nouveau médecin',
        'view_item'          => 'Voir le médecin',
        'search_items'       => 'Rechercher un médecin',
        'not_found'          => 'Aucun médecin trouvé',
        'not_found_in_trash' => 'Aucun médecin dans la corbeille',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'medecins'],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
    ];

    register_post_type('medecin', $args);
}
add_action('init', 'medicare_register_doctors_cpt');

// =============================================================================
// CUSTOM META BOXES : MÉDECIN (spécialité, téléphone)
// =============================================================================
function medicare_doctor_meta_boxes() {
    add_meta_box(
        'doctor_info',
        'Informations du médecin',
        'medicare_doctor_meta_callback',
        'medecin',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'medicare_doctor_meta_boxes');

function medicare_doctor_meta_callback($post) {
    wp_nonce_field('medicare_doctor_meta', 'medicare_doctor_nonce');
    $specialite = get_post_meta($post->ID, '_doctor_specialite', true);
    $tel        = get_post_meta($post->ID, '_doctor_tel', true);
    ?>
    <p>
        <label><strong>Spécialité :</strong></label><br>
        <input type="text" name="doctor_specialite" value="<?php echo esc_attr($specialite); ?>" style="width:100%">
    </p>
    <p>
        <label><strong>Téléphone :</strong></label><br>
        <input type="text" name="doctor_tel" value="<?php echo esc_attr($tel); ?>" style="width:100%">
    </p>
    <?php
}

function medicare_save_doctor_meta($post_id) {
    if (!isset($_POST['medicare_doctor_nonce'])) return;
    if (!wp_verify_nonce($_POST['medicare_doctor_nonce'], 'medicare_doctor_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['doctor_specialite'])) {
        update_post_meta($post_id, '_doctor_specialite', sanitize_text_field($_POST['doctor_specialite']));
    }
    if (isset($_POST['doctor_tel'])) {
        update_post_meta($post_id, '_doctor_tel', sanitize_text_field($_POST['doctor_tel']));
    }
}
add_action('save_post_medecin', 'medicare_save_doctor_meta');

// =============================================================================
// HELPER : Get doctors from CPT or fallback to static data
// =============================================================================
function medicare_get_doctors() {
    $query = new WP_Query([
        'post_type'      => 'medecin',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    $doctors = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $doctors[] = [
                'name'       => get_the_title(),
                'specialite' => get_post_meta(get_the_ID(), '_doctor_specialite', true),
                'tel'        => get_post_meta(get_the_ID(), '_doctor_tel', true),
                'image'      => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'excerpt'    => get_the_excerpt(),
            ];
        }
        wp_reset_postdata();
    }

    // Fallback si aucun médecin créé dans le dashboard
    if (empty($doctors)) {
        $doctors = [
            [
                'name'       => 'Dr. Heritiana Toojanahary',
                'specialite' => 'Médecin Généraliste',
                'tel'        => '+261 34 83 498 86',
                'image'      => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face&q=80',
                'excerpt'    => '12 ans d\'expérience en médecine générale, urgences et suivi des patients chroniques.',
            ],
            [
                'name'       => 'Dr. Raharilala Miraille',
                'specialite' => 'Cardiologue',
                'tel'        => '+261 34 83 498 86',
                'image'      => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face&q=80',
                'excerpt'    => 'Spécialiste des maladies cardiovasculaires. ECG, holter et suivi cardiologique.',
            ],
            [
                'name'       => 'Dr. Nomenjanahary Lucienne',
                'specialite' => 'Pédiatre',
                'tel'        => '+261 34 83 498 86',
                'image'      => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&crop=face&q=80',
                'excerpt'    => 'Prise en charge des nourrissons, enfants et adolescents. Suivi de croissance.',
            ],
        ];
    }

    return $doctors;
}

// =============================================================================
// CUSTOM POST TYPE : RENDEZ-VOUS (stockage des messages en DB)
// =============================================================================
function medicare_register_rdv_cpt() {
    register_post_type('rendez_vous', [
        'labels'        => [
            'name'          => 'Rendez-vous',
            'singular_name' => 'Rendez-vous',
            'menu_name'     => 'Rendez-vous',
            'all_items'     => 'Tous les rendez-vous',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-calendar-alt',
        'supports'      => ['title', 'editor', 'custom-fields'],
        'menu_position' => 6,
    ]);
}
add_action('init', 'medicare_register_rdv_cpt');

// =============================================================================
// SEO : Meta description auto
// =============================================================================
function medicare_meta_description() {
    if (is_front_page()) {
        echo '<meta name="description" content="MediCare Tana - Clinique médicale professionnelle à Antananarivo. Consultation, urgences, analyses médicales. Nos médecins spécialisés vous accueillent 7j/7.">' . "\n";
    } elseif (is_singular()) {
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags($excerpt)) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'medicare_meta_description');

// =============================================================================
// PERFORMANCE : Remove unnecessary WordPress bloat
// =============================================================================
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
add_filter('the_generator', '__return_empty_string');
