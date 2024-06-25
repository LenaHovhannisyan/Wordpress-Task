<?php
/**
 * theLogo functions and definitions
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

function thelogo_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// Navigation
	register_nav_menus(
		array(
			'main-menu' => esc_html__('Primary', 'thelogo'),
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'thelogo_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);

	// Updating permalinks
	flush_rewrite_rules();
}
add_action('after_setup_theme', 'thelogo_setup');

/**
 * Register widget area.
 */
function thelogo_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'thelogo'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'thelogo'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	// Widget area for custom post type 'books'
    register_sidebar( array(
        'name'          => __( 'Books Widget Area', 'text_domain' ),
        'id'            => 'books-widget-area',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action('widgets_init', 'thelogo_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function thelogo_scripts()
{
	// Enqueue Google Fonts
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap', false);

	// Enqueue FontAwesome CSS
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0-beta3');

	// Enqueue main stylesheet
	wp_enqueue_style('thelogo-style', get_stylesheet_uri(), array(), _S_VERSION);

	wp_enqueue_script('thelogo-script', get_template_directory_uri() . '/js/script.js', array(), _S_VERSION, true);

}
add_action('wp_enqueue_scripts', 'thelogo_scripts');

/**
 * Preconnecting to the Google Fonts.
 */
function add_preconnect_for_google_fonts()
{
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'add_preconnect_for_google_fonts', 1);

/**
 * Posts pagination
 */
function thelogo_custom_pagination($query = null)
{
	if (!$query) {
		global $wp_query;
		$query = $wp_query;
	}

	$big = 999999999;
	$pagination_links = paginate_links(
		array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $query->max_num_pages,
			'prev_text' => __('« Prev', 'textdomain'),
			'next_text' => __('Next »', 'textdomain'),
			'type' => 'array',
		)
	);

	if ($pagination_links) {
		echo '<div class="pagination"><ul>';
		foreach ($pagination_links as $link) {
			echo '<li>' . $link . '</li>';
		}
		echo '</ul></div>';
	}
}

/**
 * Reading time
 */
function get_reading_time($post_id)
{
	$post = get_post($post_id);
	if (!$post)
		return 0;

	$content = strip_tags($post->post_content);
	$word_count = str_word_count($content);
	$words_per_minute = 50;

	$reading_time = ceil($word_count / $words_per_minute);
	return $reading_time . ' min read';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

function thelogo_customize_css()
{
	?>
	<style type="text/css">
		:root {
			--primary:
				<?php echo get_theme_mod('primary_color', '#4CE0D7');
				?>
			;
			--secondary:
				<?php echo get_theme_mod('secondary_color', '#BCBCBC');
				?>
			;
		}
	</style>
	<?php
}
add_action('wp_head', 'thelogo_customize_css');


/**
 * Custom Widget.
 */
require get_template_directory() . '/inc/book-widgets.php';