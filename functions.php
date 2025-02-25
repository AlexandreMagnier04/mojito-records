<?php
/**
 * mojito functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mojito
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mojito_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on mojito, use a find and replace
		* to change 'mojito' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'mojito', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'mojito' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'mojito_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'mojito_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mojito_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mojito_content_width', 640 );
}
add_action( 'after_setup_theme', 'mojito_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mojito_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mojito' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mojito' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mojito_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mojito_scripts() {
	wp_enqueue_style( 'mojito-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mojito-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mojito-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mojito_scripts' );

function mojito_enqueue_styles() {
    // Ajouter un style spécifique pour la page d’accueil
    if (is_front_page()) {
        wp_enqueue_style('home', get_template_directory_uri() . '/css/home.css');
    }

    // Charger un style spécifique pour les pages SINGLE des albums et artistes
    if (is_singular('album') || is_singular('artiste')) {
        wp_enqueue_style('single-cpt-style', get_template_directory_uri() . '/css/single-cpt.css');
    }

    // Charger un style spécifique pour les ARCHIVES des albums et artistes
    if (is_archive('album') || is_archive('artiste')) {
        wp_enqueue_style('archive-cpt-style', get_template_directory_uri() . '/css/archive-cpt.css');
    }
}
add_action('wp_enqueue_scripts', 'mojito_enqueue_styles');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function filter_albums() {
    $genre = isset($_POST['genre']) ? sanitize_text_field($_POST['genre']) : '';

    $args = array(
        'post_type'      => 'album',
        'posts_per_page' => -1,
    );

    if (!empty($genre)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'genre_musical',
                'field'    => 'slug',
                'terms'    => $genre,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <article class="album-card">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-album.jpg" alt="Image par défaut">
                    <?php endif; ?>
                </a>
                <h3><?php the_title(); ?></h3>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucun album trouvé pour ce genre.</p>';
    endif;

    wp_die();
}
add_action('wp_ajax_filter_albums', 'filter_albums');
add_action('wp_ajax_nopriv_filter_albums', 'filter_albums');


function enqueue_custom_scripts() {
    wp_enqueue_script('filter-albums', get_template_directory_uri() . '/js/filter-albums.js', array('jquery'), null, true);
    wp_localize_script('filter-albums', 'ajaxurl', array('ajaxurl' => admin_url('admin-ajax.php')));
	wp_enqueue_script('filter-artistes', get_template_directory_uri() . '/js/filter-artistes.js', array('jquery'), null, true);
    wp_localize_script('filter-artistes', 'ajaxurl', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function get_artiste_details() {
    $artiste_id = $_POST['artiste_id'];

    if (!$artiste_id) {
        wp_send_json_error('Artiste introuvable.');
        return;
    }

    $post = get_post($artiste_id);
    $genres = get_the_terms($artiste_id, 'genre_musical');
    $albums = new WP_Query(array(
        'post_type' => 'album',
        'meta_query' => array(
            array(
                'key' => 'artiste_associe',
                'value' => '"' . $artiste_id . '"',
                'compare' => 'LIKE'
            )
        )
    ));

    ob_start(); ?>

    <h2><?php echo get_the_title($post); ?></h2>
    <p><strong>Début de carrière :</strong> <?php echo SCF::get('debut_carriere', $artiste_id); ?></p>
    <p><strong>Biographie :</strong> <?php echo SCF::get('biographie', $artiste_id); ?></p>
    <p><strong>Genre Musical :</strong> 
        <?php
        if (!is_wp_error($genres) && !empty($genres)) {
            foreach ($genres as $genre) {
                echo '<span>' . esc_html($genre->name) . '</span> ';
            }
        } else {
            echo 'Non classé';
        }
        ?>
    </p>

    <h3>Albums :</h3>
    <ul>
        <?php if ($albums->have_posts()) :
            while ($albums->have_posts()) : $albums->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun album trouvé.</p>
        <?php endif; ?>
    </ul>

    <?php
    wp_send_json_success(ob_get_clean());
}

add_action('wp_ajax_get_artiste_details', 'get_artiste_details');
add_action('wp_ajax_nopriv_get_artiste_details', 'get_artiste_details');

function create_post_type_artistes() {
    register_post_type('artiste',
        array(
            'labels'      => array(
                'name'          => __('Artistes'),
                'singular_name' => __('Artiste'),
            ),
            'public'      => true,
            'has_archive' => true, // ✅ Assure que l'archive /artiste/ est activée
            'supports'    => array('title', 'editor', 'thumbnail'),
            'rewrite'     => array('slug' => 'artiste'),
        )
    );
}
add_action('init', 'create_post_type_artistes');

function filter_artistes() {
    // Vérifie si un genre est sélectionné
    $genre = isset($_POST['genre']) ? sanitize_text_field($_POST['genre']) : '';

    $args = array(
        'post_type'      => 'artiste',
        'posts_per_page' => -1,
    );

    // Ajoute la condition de filtre si un genre est sélectionné
    if (!empty($genre)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'genre_musical',
                'field'    => 'slug',
                'terms'    => $genre,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <article class="artiste-card">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-artist.jpg" alt="Image par défaut">
                    <?php endif; ?>
                </a>
                <h2><?php the_title(); ?></h2>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucun artiste trouvé pour ce genre.</p>';
    endif;

    wp_die();
}
add_action('wp_ajax_filter_artistes', 'filter_artistes');
add_action('wp_ajax_nopriv_filter_artistes', 'filter_artistes');


function register_genre_musical_taxonomy() {
    register_taxonomy(
        'genre_musical',
        array('artiste', 'album'), // Appliquer aux artistes et albums
        array(
            'label'        => __('Genres Musicaux'),
            'rewrite'      => array('slug' => 'genre'),
            'hierarchical' => true, // Si TRUE = type "Catégorie", si FALSE = type "Étiquette"
        )
    );
}
add_action('init', 'register_genre_musical_taxonomy');
