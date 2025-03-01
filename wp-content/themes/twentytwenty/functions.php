<?php

/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_theme_support()
{

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if (!isset($content_width)) {
		$content_width = 580;
	}

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// Set post thumbnail size.
	set_post_thumbnail_size(1200, 9999);

	// Add custom image size used in Cover Template.
	add_image_size('twentytwenty-fullscreen', 1980, 9999);

	// Custom logo.
	$logo_width = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if (get_theme_mod('retina_logo', false)) {
		$logo_width = floor($logo_width * 2);
		$logo_height = floor($logo_height * 2);
	}

	add_theme_support(
		'custom-logo',
		array(
			'height' => $logo_height,
			'width' => $logo_width,
			'flex-height' => true,
			'flex-width' => true,
		)
	);

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

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
			'script',
			'style',
			'navigation-widgets',
		)
	);

	// Add support for full and wide align images.
	add_theme_support('align-wide');

	// Add support for responsive embeds.
	add_theme_support('responsive-embeds');

	/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
	if (is_customize_preview()) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support('starter-content', twentytwenty_get_starter_content());
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/*
		* Adds `async` and `defer` support for scripts registered or enqueued
		* by the theme.
		*/
	$loader = new TwentyTwenty_Script_Loader();
	if (version_compare($GLOBALS['wp_version'], '6.3', '<')) {
		add_filter('script_loader_tag', array($loader, 'filter_script_loader_tag'), 10, 2);
	} else {
		add_filter('print_scripts_array', array($loader, 'migrate_legacy_strategy_script_data'), 100);
	}
}

add_action('after_setup_theme', 'twentytwenty_theme_support');

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Register and Enqueue Styles.
 *
 * @since Twenty Twenty 1.0
 * @since Twenty Twenty 2.6 Enqueue the CSS file for the variable font.
 */
function twentytwenty_register_styles()
{

	$theme_version = wp_get_theme()->get('Version');

	wp_enqueue_style('twentytwenty-style', get_stylesheet_uri(), array(), $theme_version);
	wp_style_add_data('twentytwenty-style', 'rtl', 'replace');

	// Enqueue the CSS file for the variable font, Inter.
	wp_enqueue_style('twentytwenty-fonts', get_theme_file_uri('/assets/css/font-inter.css'), array(), wp_get_theme()->get('Version'), 'all');

	// Add output of Customizer settings as inline style.
	$customizer_css = twentytwenty_get_customizer_css('front-end');
	if ($customizer_css) {
		wp_add_inline_style('twentytwenty-style', $customizer_css);
	}

	// Add print CSS.
	wp_enqueue_style('twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print');

	$parent_style = 'parent-style';

	wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
	wp_enqueue_style('reset', get_template_directory_uri() . '/assets/css/reset.css');
	wp_enqueue_style('fontawesome', 'https://tory.ua/assets/fa/fontawesome.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/styles.css');
}

add_action('wp_enqueue_scripts', 'twentytwenty_register_styles');

/**
 * Register and Enqueue Scripts.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_scripts()
{

	$theme_version = wp_get_theme()->get('Version');

	if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	/*
		* This script is intentionally printed in the head because it involves the page header. The `defer` script loading
		* strategy ensures that it does not block rendering; being in the head it will start loading earlier so that it
		* will execute sooner once the DOM has loaded. The $args array is not used here to avoid unintentional footer
		* placement in WP<6.3; the wp_script_add_data() call is used instead.
		*/
	wp_enqueue_script('twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version);
	wp_script_add_data('twentytwenty-js', 'strategy', 'defer');

	wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), $theme_version);
	wp_script_add_data('swiper', 'strategy', '');

	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/js/fancybox.js', array(), $theme_version);
	wp_script_add_data('fancybox', 'strategy', 'defer');

	wp_enqueue_script('global', get_template_directory_uri() . '/assets/js/global.js', array(), $theme_version);
	wp_script_add_data('global', 'strategy', 'defer');

	wp_enqueue_script('wishlist', get_template_directory_uri() . '/assets/js/wishlist.js', array(), $theme_version);
	wp_script_add_data('wishlist', 'strategy', 'defer');
}


add_action('wp_enqueue_scripts', 'twentytwenty_register_scripts');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty 1.0
 * @deprecated Twenty Twenty 2.3 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix()
{
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
?>
	<script>
		/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
			var t, e = location.hash.substring(1);
			/^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
		}, !1);
	</script>
<?php
}

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages()
{
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css('front-end');

	if ($custom_css) {
		wp_add_inline_style('twentytwenty-style', $custom_css);
	}
}

add_action('wp_enqueue_scripts', 'twentytwenty_non_latin_languages');

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_menus()
{

	$locations = array(
		'primary' => __('Desktop Horizontal Menu', 'twentytwenty'),
		'expanded' => __('Desktop Expanded Menu', 'twentytwenty'),
		'mobile' => __('Mobile Menu', 'twentytwenty'),
		'footer' => __('Footer Menu', 'twentytwenty'),
		'social' => __('Social Menu', 'twentytwenty'),
	);

	register_nav_menus($locations);
}

add_action('init', 'twentytwenty_menus');

/**
 * Get the information about the logo.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo($html)
{

	$logo_id = get_theme_mod('custom_logo');

	if (!$logo_id) {
		return $html;
	}

	$logo = wp_get_attachment_image_src($logo_id, 'full');

	if ($logo) {
		// For clarity.
		$logo_width = esc_attr($logo[1]);
		$logo_height = esc_attr($logo[2]);

		// If the retina logo setting is active, reduce the width/height by half.
		if (get_theme_mod('retina_logo', false)) {
			$logo_width = floor($logo_width / 2);
			$logo_height = floor($logo_height / 2);

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if (false === strpos($html, ' style=')) {
				$search[] = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[] = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace($search, $replace, $html);
		}
	}

	return $html;
}

add_filter('get_custom_logo', 'twentytwenty_get_custom_logo');

if (!function_exists('wp_body_open')) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 *
	 * @since Twenty Twenty 1.0
	 */
	function wp_body_open()
	{
		/** This action is documented in wp-includes/general-template.php */
		do_action('wp_body_open');
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_skip_link()
{
	echo '<a class="skip-link screen-reader-text" href="#site-content">' .
		/* translators: Hidden accessibility text. */
		__('Skip to the content', 'twentytwenty') .
		'</a>';
}

add_action('wp_body_open', 'twentytwenty_skip_link', 5);

/**
 * Register widget areas.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration()
{

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title' => '<h2 class="widget-title subheading heading-size-3">',
		'after_title' => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name' => __('Footer #1', 'twentytwenty'),
				'id' => 'sidebar-1',
				'description' => __('Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty'),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name' => __('Footer #2', 'twentytwenty'),
				'id' => 'sidebar-2',
				'description' => __('Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty'),
			)
		)
	);
}

add_action('widgets_init', 'twentytwenty_sidebar_registration');

/**
 * Enqueue supplemental block editor styles.
 *
 * @since Twenty Twenty 1.0
 * @since Twenty Twenty 2.4 Removed a script related to the obsolete Squared style of Button blocks.
 * @since Twenty Twenty 2.6 Enqueue the CSS file for the variable font.
 */
function twentytwenty_block_editor_styles()
{

	// Enqueue the editor styles.
	wp_enqueue_style('twentytwenty-block-editor-styles', get_theme_file_uri('/assets/css/editor-style-block.css'), array(), wp_get_theme()->get('Version'), 'all');
	wp_style_add_data('twentytwenty-block-editor-styles', 'rtl', 'replace');

	// Add inline style from the Customizer.
	$customizer_css = twentytwenty_get_customizer_css('block-editor');
	if ($customizer_css) {
		wp_add_inline_style('twentytwenty-block-editor-styles', $customizer_css);
	}

	// Enqueue the CSS file for the variable font, Inter.
	wp_enqueue_style('twentytwenty-fonts', get_theme_file_uri('/assets/css/font-inter.css'), array(), wp_get_theme()->get('Version'), 'all');

	// Add inline style for non-latin fonts.
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css('block-editor');
	if ($custom_css) {
		wp_add_inline_style('twentytwenty-block-editor-styles', $custom_css);
	}
}

if (is_admin() && version_compare($GLOBALS['wp_version'], '6.3', '>=')) {
	add_action('enqueue_block_assets', 'twentytwenty_block_editor_styles', 1, 1);
} else {
	add_action('enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1);
}

/**
 * Enqueue classic editor styles.
 *
 * @since Twenty Twenty 1.0
 * @since Twenty Twenty 2.6 Enqueue the CSS file for the variable font.
 */
function twentytwenty_classic_editor_styles()
{

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
		'/assets/css/font-inter.css',
	);

	add_editor_style($classic_editor_styles);
}

add_action('init', 'twentytwenty_classic_editor_styles');

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @since Twenty Twenty 1.0
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles($mce_init)
{

	$styles = twentytwenty_get_customizer_css('classic-editor');

	if (!$styles) {
		return $mce_init;
	}

	if (!isset($mce_init['content_style'])) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;
}

add_filter('tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles');

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles($mce_init)
{

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css('classic-editor');

	// Return if there are no styles to add.
	if (!$styles) {
		return $mce_init;
	}

	if (!isset($mce_init['content_style'])) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;
}

add_filter('tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles');

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_settings()
{

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name' => __('Accent Color', 'twentytwenty'),
			'slug' => 'accent',
			'color' => twentytwenty_get_color_for_area('content', 'accent'),
		),
		array(
			'name' => _x('Primary', 'color', 'twentytwenty'),
			'slug' => 'primary',
			'color' => twentytwenty_get_color_for_area('content', 'text'),
		),
		array(
			'name' => _x('Secondary', 'color', 'twentytwenty'),
			'slug' => 'secondary',
			'color' => twentytwenty_get_color_for_area('content', 'secondary'),
		),
		array(
			'name' => __('Subtle Background', 'twentytwenty'),
			'slug' => 'subtle-background',
			'color' => twentytwenty_get_color_for_area('content', 'borders'),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod('background_color');
	if (!$background_color) {
		$background_color_arr = get_theme_support('custom-background');
		$background_color = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name' => __('Background Color', 'twentytwenty'),
		'slug' => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ($editor_color_palette) {
		add_theme_support('editor-color-palette', $editor_color_palette);
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => _x('Small', 'Name of the small font size in the block editor', 'twentytwenty'),
				'shortName' => _x('S', 'Short name of the small font size in the block editor.', 'twentytwenty'),
				'size' => 18,
				'slug' => 'small',
			),
			array(
				'name' => _x('Regular', 'Name of the regular font size in the block editor', 'twentytwenty'),
				'shortName' => _x('M', 'Short name of the regular font size in the block editor.', 'twentytwenty'),
				'size' => 21,
				'slug' => 'normal',
			),
			array(
				'name' => _x('Large', 'Name of the large font size in the block editor', 'twentytwenty'),
				'shortName' => _x('L', 'Short name of the large font size in the block editor.', 'twentytwenty'),
				'size' => 26.25,
				'slug' => 'large',
			),
			array(
				'name' => _x('Larger', 'Name of the larger font size in the block editor', 'twentytwenty'),
				'shortName' => _x('XL', 'Short name of the larger font size in the block editor.', 'twentytwenty'),
				'size' => 32,
				'slug' => 'larger',
			),
		)
	);

	add_theme_support('editor-styles');

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ('#ffffff' === strtolower(twentytwenty_get_color_for_area('content', 'text'))) {
		add_theme_support('dark-editor-style');
	}
}

add_action('after_setup_theme', 'twentytwenty_block_editor_settings');

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag($html)
{
	return preg_replace('/<a(.*)>(.*)<\/a>/iU', sprintf('<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title(get_the_ID())), $html);
}

add_filter('the_content_more_link', 'twentytwenty_read_more_tag');

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts()
{
	$theme_version = wp_get_theme()->get('Version');

	// Add main customizer js file.
	wp_enqueue_script('twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array('jquery'), $theme_version);

	// Add script for color calculations.
	wp_enqueue_script('twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array('wp-color-picker'), $theme_version);

	// Add script for controls.
	wp_enqueue_script('twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array('twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery'), $theme_version);
	wp_localize_script('twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars());
}

add_action('customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts');

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init()
{
	$theme_version = wp_get_theme()->get('Version');

	wp_enqueue_script('twentytwenty-customize-preview', get_theme_file_uri('/assets/js/customize-preview.js'), array('customize-preview', 'customize-selective-refresh', 'jquery'), $theme_version, array('in_footer' => true));
	wp_localize_script('twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars());
	// wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode('cover_opacity'),
			wp_json_encode(twentytwenty_customize_opacity_range())
		)
	);
}

add_action('customize_preview_init', 'twentytwenty_customize_preview_init');

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area    The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area($area = 'content', $context = 'text')
{

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content' => array(
				'text' => '#000000',
				'accent' => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders' => '#dcd7ca',
			),
			'header-footer' => array(
				'text' => '#000000',
				'accent' => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders' => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if (isset($settings[$area]) && isset($settings[$area][$context])) {
		return $settings[$area][$context];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars()
{
	$colors = array(
		'content' => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array()
{

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content' => array(
			'accent' => array(
				'color' => array('.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a'),
				'border-color' => array('blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus'),
				'background-color' => array('button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link'),
				'fill' => array('.fill-children-accent', '.fill-children-accent *'),
			),
			'background' => array(
				'color' => array(':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)'),
				'background-color' => array(':root .has-background-background-color'),
			),
			'text' => array(
				'color' => array('body', '.entry-title a', ':root .has-primary-color'),
				'background-color' => array(':root .has-primary-background-color'),
			),
			'secondary' => array(
				'color' => array('cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color'),
				'background-color' => array(':root .has-secondary-background-color'),
			),
			'borders' => array(
				'border-color' => array('pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr'),
				'background-color' => array('caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color'),
				'border-bottom-color' => array('.wp-block-table.is-style-stripes'),
				'border-top-color' => array('.wp-block-latest-posts.is-grid li'),
				'color' => array(':root .has-subtle-background-color'),
			),
		),
		'header-footer' => array(
			'accent' => array(
				'color' => array('body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a:where(:not(.wp-block-button__link))', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover'),
				'background-color' => array('.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]'),
			),
			'background' => array(
				'color' => array('.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]'),
				'background-color' => array('#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before'),
			),
			'text' => array(
				'color' => array('.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle'),
				'background-color' => array('body:not(.overlay-header) .primary-menu ul'),
				'border-bottom-color' => array('body:not(.overlay-header) .primary-menu > li > ul:after'),
				'border-left-color' => array('body:not(.overlay-header) .primary-menu ul ul:after'),
			),
			'secondary' => array(
				'color' => array('.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.footer-credits .privacy-policy', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a'),
			),
			'borders' => array(
				'border-color' => array('.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top'),
				'background-color' => array('.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before'),
			),
		),
	);

	/**
	 * Filters Twenty Twenty theme elements.
	 *
	 * @since Twenty Twenty 1.0
	 *
	 * @param array Array of elements.
	 */
	// return apply_filters('twentytwenty_get_elements_array', $elements);
}

function WebP_upload_mimes($existing_mimes)
{
	// add WebP to the list of mime types
	$existing_mimes['WebP'] = 'image/WebP';
	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter('mime_types', 'WebP_upload_mimes');

//** * Enable preview / thumbnail for WebP image files.*/
function WebP_is_displayable($result, $path)
{
	if ($result === false) {
		$displayable_image_types = array(IMAGETYPE_WebP);
		$info = @getimagesize($path);
		if (empty($info)) {
			$result = false;
		} elseif (!in_array($info[2], $displayable_image_types)) {
			$result = false;
		} else {
			$result = true;
		}
	}
	return $result;
}
add_filter('file_is_displayable_image', 'WebP_is_displayable', 10, 2);


function custom_breadcrumbs()
{
	// Settings
	$separator = '  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8 4L15.5 11.5L8 19" stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>';
	$home_text = 'Головна';
	$show_on_home = false;

	global $post;
	$home_link = home_url('/');

	echo '<div class="breadcrumbs">';
	echo '<div class="breadcrumbs__wrapper">';
	echo '<div class="container">';
	echo '<nav class="breadcrumbs__inner">';
	echo '<ul class="breadcrumbs__list">';

	// echo '<a href="' . $home_link . '">' . $home_text . '</a>' . ' ' . $separator . ' ';

	echo '	<li class="breadcrumbs__item">
				<a href="' . $home_link . '" class="breadcrumbs__item_link fw-500">' . $home_text . '</a>' . $separator . '</li>';

	if (is_search()) {
		echo '<li class="breadcrumbs__item">
		<p class="breadcrumbs__item_link fw-500">Пошук</p></li>';
	}

	if (is_category() || is_single()) {
		$category = get_the_category();
		if ($category) {
			$cat_id = $category[0]->cat_ID;
			$cats = get_category_parents($cat_id, true, ' ' . $separator . ' ');
			if ($show_on_home && is_single()) {
				echo '	<li class="breadcrumbs__item">
							<a href="' . $home_link . '" class="breadcrumbs__item_link fw-500">' . $home_text . '</a>' . $separator . '</li>';
			}
			// echo $cats;
			echo '<li class="breadcrumbs__item">
			<p class="breadcrumbs__item_link fw-500">' . $cats . '</p>' . $separator . '</li>';
		}
		if (is_single() && !is_product()) {
			echo '<li class="breadcrumbs__item">
						<p class="breadcrumbs__item_link fw-500">' . the_title() . '</p>' . $separator . '</li>';
		}
		if (is_product()) {
			$product_category = wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'names'))[0];
			$product = wc_get_product(get_the_ID());
			$categories_id = $product->get_category_ids();
			$category_link = get_term_link($categories_id[0]);

			echo '	<li class="breadcrumbs__item">
		    <a href="/catalog" class="breadcrumbs__item_link fw-500">Каталог</a>' . $separator . '</li>';
			// echo $cats;
			echo '<li class="breadcrumbs__item">
			<a href="' . $category_link . '" class="breadcrumbs__item_link fw-500">' . $product_category . '</a>' . $separator . '</li>';
			echo '<li class="breadcrumbs__item">
						<p class="breadcrumbs__item_link fw-500">' . the_title() . '</p>' . $separator . '</li>';
		}
	} elseif (is_page()) {
		if ($post->post_parent) {
			$parent_id = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li class="breadcrumbs__item">
				<a href="' . get_permalink($page->ID) . '" class="breadcrumbs__item_link fw-500">' . get_the_title($page->ID) . '</a>' . $separator . '</li>';

				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) {
				// echo $crumb . ' ' . $separator . ' ';
				echo '<li class="breadcrumbs__item">
				<p class="breadcrumbs__item_link fw-500">' . $crumb . '</p>' . $separator . '</li>';
			}
		}
		echo '<li class="breadcrumbs__item">
		<p class="breadcrumbs__item_link fw-500">' . get_the_title() . '</p>' . $separator . '</li>';
	} elseif (is_archive()) {
		$archive_title = get_the_archive_title();
		$parts = explode(':', $archive_title);
		$category_name = end($parts);
		$category_name = trim($category_name);

		echo '	<li class="breadcrumbs__item">
		<a href="/catalog" class="breadcrumbs__item_link fw-500">Каталог</a>' . $separator . '</li>';

		echo '<li class="breadcrumbs__item">
		<p class="breadcrumbs__item_link fw-500">' . $category_name . '</p>' . $separator . '</li>';
	}

	echo '</ul>';
	echo '</nav>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
};

add_filter('woocommerce_product_query', 'filter_products_by_category');
function filter_products_by_category($query)
{
	if (!is_admin() && isset($_GET['product_category']) && $_GET['product_category'] != '') {
		$query->set(
			'tax_query',
			array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $_GET['product_category'],
				),
			)
		);
	}
	return $query;
}

function get_unique_acf_field_values($field_name, $post_type = 'product')
{
	global $wpdb;
	$query = "SELECT DISTINCT meta_value 
              FROM $wpdb->postmeta 
              INNER JOIN $wpdb->posts ON $wpdb->postmeta.post_id = $wpdb->posts.ID 
              WHERE $wpdb->posts.post_type = '$post_type' 
              AND $wpdb->posts.post_status = 'publish' 
              AND $wpdb->postmeta.meta_key = '$field_name' 
              AND $wpdb->postmeta.meta_value != ''
              ORDER BY meta_value ASC";

	return $wpdb->get_col($query);
}

function showItems($field_name, $device_type)
{

	$field_values = get_unique_acf_field_values($field_name);
	$common_arr = [];

	foreach ($field_values as $value) {
		$arr = unserialize($value);
		if ($arr) {
			$common_arr = array_merge($common_arr, $arr);
		} else {
			$common_arr[] = $value;
		}
	};

	$common_arr = array_unique($common_arr);

	foreach ($common_arr as $value) {
		if ($device_type === 'mobile') {
			echo '<li class="filters-mobile__sublist_item" data-value="' . $value . '">' . $value . '</li>';
		} else {
			echo '<li class="filters__item_option" data-value="' . $value . '">' . $value . '</li>';
		}
	};

	return;
};

// change variation product label
function custom_attribute_label($label, $name, $product)
{
	switch ($name) {
		case 'Розмір':
			$label = __('Оберіть розмір*', 'twentytwenty');
			break;
		case 'Рама':
			$label = __('Оберіть раму', 'twentytwenty');
			break;
		case 'Вартість':
			$label = __('Оберіть вартість*', 'twentytwenty');
			break;
	}

	return $label;
}
add_filter('woocommerce_attribute_label', 'custom_attribute_label', 10, 3);

// remove all default wc tabs
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);
function remove_product_tabs($tabs)
{
	return array();
}

// add new wc tabs
add_filter('woocommerce_product_tabs', function ($tabs) {
	$meta_fields = array('wc_cus_delivery_info', 'wc_cus_payment_info', 'wc_cus_guarantee_info');
	$meta_data = array();
	$content = '';

	// get value from custom fields
	foreach ($meta_fields as $field) {
		$value = get_option($field);
		$meta_data[$field] = $value;
	}

	// add new tabs
	foreach ($meta_data as $key => $value) {
		$content = $value;
		$tab_name = 'tab';

		if ($key === 'wc_cus_delivery_info') {
			$tab_name = __('Доставка', 'twentytwenty');
		} elseif ($key === 'wc_cus_payment_info') {
			$tab_name = __('Оплата', 'twentytwenty');
		} elseif ($key === 'wc_cus_guarantee_info') {
			$tab_name = __('Гарантія', 'twentytwenty');
		}

		$tabs[$key] = array(
			'title' => __($tab_name, 'twentytwenty'),
			'priority' => 50,
			'callback' => function () use ($content) {
				custom_tab_content($content);
			}
		);
	}

	return $tabs;
}, 99);

// tab content
function custom_tab_content($content)
{
	echo '<div class="wc_tab-content">' . $content . '</div>';
}

// add new option tab in woocommerce settings
add_filter('woocommerce_settings_tabs_array', 'add_custom_tab_to_woocommerce_settings_tabs', 50);

function add_custom_tab_to_woocommerce_settings_tabs($tabs)
{
	$tabs['custom_info'] = 'Додаткові налаштування';
	return $tabs;
}

add_action('woocommerce_settings_tabs_custom_info', 'output_custom_info_tab_content');

//template tab content in woocommerce settings
function output_custom_info_tab_content()
{
?>
	<h2>Додаткові налаштування</h2>
	<table class="form-table">
		<tr valign="top">
			<th scope="row" class="titledesc">Інформація про доставку</th>
			<td class="forminp forminp-textarea">
				<?php
				custom_output_custom_editor('wc_cus_delivery_info');
				?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">Інформація про оплату</th>
			<td class="forminp forminp-textarea">
				<?php
				custom_output_custom_editor('wc_cus_payment_info');
				?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">Інформація про гарантію</th>
			<td class="forminp forminp-textarea">
				<?php
				custom_output_custom_editor('wc_cus_guarantee_info');
				?>
			</td>
		</tr>
	</table>
	<?php
}

// add field in woocommerce settings
function custom_output_custom_editor($field_id)
{
	$options = array(
		'textarea_name' => $field_id,
		'editor_class' => 'woocommerce_admin_textarea short',
		'media_buttons' => false,
		'textarea_rows' => 5,
	);

	$field_value = get_option($field_id);

	wp_editor($field_value, $field_id, $options);
}

add_action('woocommerce_update_options', 'save_custom_info_fields');

function save_custom_info_fields()
{
	$fields = array('wc_cus_delivery_info', 'wc_cus_payment_info', 'wc_cus_guarantee_info');

	foreach ($fields as $field) {
		if (isset($_POST[$field])) {
			$value = wp_unslash($_POST[$field]);
			$value = wpautop(wp_kses_post($value));
			update_option($field, $value);
		}
	}
}

// custom ajax add to cart
add_action('wp_ajax_custom_add_to_cart', 'custom_add_to_cart');
add_action('wp_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart');

function custom_add_to_cart()
{
	if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
		$product_id = intval($_POST['product_id']);
		$quantity = intval($_POST['quantity']);
		$variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
		$isVariableProduct = true;

		if ($variation_id > 0) {
			WC()->cart->add_to_cart($product_id, $quantity, $variation_id);
			$current_product = wc_get_product($variation_id);
			$isVariableProduct = true;
		} else {
			WC()->cart->add_to_cart($product_id, $quantity);
			$current_product = wc_get_product($product_id);
			$isVariableProduct = false;
		}

		// get cart
		$cart_items = WC()->cart->get_cart();

		/// find current product in cart items
		foreach ($cart_items as $item) {
			if ($isVariableProduct && $item['variation_id'] === $variation_id) {
				$current_cart_item =  $item;
			} elseif (!$isVariableProduct && $item['$product_id'] === $product_id) {
				$current_cart_item =  $item;
			}
		}

		$current_cart_item['price'] = $current_product->get_price();

		echo json_encode($current_cart_item);

		wp_die();
	}
}

function get_information_menu_items()
{
	$information_menu_obj = wp_get_nav_menu_items(26);
	$current_url = get_permalink();
	$result_array = array();

	foreach ($information_menu_obj as $menu_item) {
		if ($menu_item->menu_item_parent == 0) {
			$parent_array = array(
				'parent' => $menu_item,
				'children' => array()
			);

			foreach ($information_menu_obj as $child_menu_item) {
				if ($child_menu_item->menu_item_parent == $menu_item->ID) {
					$parent_array['children'][] = $child_menu_item;
				}
			}
			$result_array[] = $parent_array;
		}
	}
	return $result_array;
}

function is_menu_item_active($menu_item)
{
	$current_url = get_permalink();
	if ($current_url == $menu_item['parent']->url) {
		return true;
	}
	foreach ($menu_item['children'] as $child_item) {
		if ($current_url == $child_item->url) {
			return true;
		}
	}
	return false;
}


// get cart drawer
add_action('wp_ajax_get_cart_drawer', 'get_cart_drawer');
add_action('wp_ajax_nopriv_get_cart_drawer', 'get_cart_drawer');

function get_cart_drawer()
{
	$result = array();
	$cart_items = WC()->cart->get_cart();
	$cart_count = WC()->cart->get_cart_contents_count();

	$result['rendered_items'] = render_cart_items($cart_items);
	$result['cart_count'] = $cart_count;

	/// cart prices values
	$total_regular_price = 0;
	$total_discounted_price = 0;

	foreach ($cart_items as $cart_item_key => $cart_item) {
		$product = $cart_item['data'];
		$price = $product->get_price();

		if ($product->is_on_sale()) {
			$wc_product = wc_get_product($cart_item['variation_id']);
			$total_discounted_price += ($wc_product->get_regular_price() - $wc_product->get_price()) * $cart_item['quantity'];
		}
		$total_regular_price += $price * $cart_item['quantity'];
	}

	$total_saving = $total_regular_price - $total_discounted_price;

	$result['total_price'] = '$' . $total_regular_price;
	$result['total_discounted_price'] = '$' . $total_discounted_price;
	$result['total_saving'] = '$' . $total_saving;

	echo json_encode($result);
	wp_die();
}

function render_cart_items($cart_items)
{
	if (count($cart_items) > 0) {
		$html = '';
		foreach ($cart_items as $cart_item_key => $cart_item_value) {
			$product_id = 0;
			if ($cart_item_value['variation_id'] > 0) {
				$current_product = wc_get_product($cart_item_value['variation_id']);
				$product_id = $cart_item_value['variation_id'];
			} else {
				$current_product = wc_get_product($cart_item_value['product_id']);
				$product_id = $cart_item_value['product_id'];
			}

			$image = get_the_post_thumbnail($current_product->get_parent_id(), 'thumbnail');
			$title = $current_product->get_title();
			$quantity = $cart_item_value['quantity'];
			$active_quantity =  ($quantity == 1) ? 'disabled' : 'enabled';
			$line_total = wc_price($cart_item_value['line_total']);
			$atributes = $cart_item_value['variation'];
			$atributes_encoded = array();
			$atributes_html = '';
			$has_attr_frame = false;

			// url encoded
			foreach ($atributes as $key => $value) {
				$atributes_encoded[urldecode($key)] = $value;
			}

			foreach ($atributes_encoded as $key => $value) {
				$attribute = explode('attribute_', $key)[1];
				$attribute = str_replace('-', ' ', $attribute);

				// capitalize string
				$firstChar = mb_strtoupper(mb_substr($attribute, 0, 1));
				$restOfString = mb_substr($attribute, 1);
				$attribute = $firstChar . $restOfString;

				if ($key === 'attribute_колір-рами' && !empty($atributes_encoded['attribute_рама'])) {
					if ($has_attr_frame === false) {
						if ($atributes_encoded['attribute_колір-рами'] !== 'Без кольору') {
							$atributes_html .= '<p>' . __("Рама: ", "twentytwenty") . mb_strtolower($atributes_encoded['attribute_колір-рами']) . ' ' . mb_strtolower(explode(' ', $atributes_encoded['attribute_рама'])[0]) . '</p>';
						} else {
							$atributes_html .= '<p>' . __("Рама: ", "twentytwenty") . __("без рами", "twentytwenty") . '</p>';
						}
					}

					$has_attr_frame = true;
				} elseif ($key === 'attribute_рама' && !empty($atributes_encoded['attribute_колір-рами'])) {
					if ($has_attr_frame === false) {
						if ($atributes_encoded['attribute_колір-рами'] !== 'Без кольору') {
							$atributes_html .= '<p>' . __("Рама: ", "twentytwenty") . mb_strtolower($atributes_encoded['attribute_колір-рами']) . ' ' . mb_strtolower(explode(' ', $atributes_encoded['attribute_рама'])[0]) . '</p>';
						} else {
							$atributes_html .= '<p>' . __("Рама: ", "twentytwenty") . __("без рами", "twentytwenty") . '</p>';
						}
					}

					$has_attr_frame = true;
				} else {
					$atributes_html = $atributes_html . '<p>' . $attribute . ': ' . mb_strtolower($value) . '</p>';
				}
			}

			$html .= '
        <li class="cart-modal__item" data-id="' . $cart_item_key . '">
         <div class="cart-modal__item_image">
         ' . $image . '
         </div>
         <div class="cart-modal__item_info">
          <h3 class="cart-modal__item_title">' . $title . '</h3>
          ' . $atributes_html . '
          <div class="cart-modal__quantity">
           <button class="cart-modal__quantity_minus ' . $active_quantity . '">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M18 12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black"></path>
            </svg>
           </button>
           <input class="cart-modal__quantity_input" min="1" max="99" type="number" value="' . $quantity . '">
           <button class="cart-modal__quantity_plus">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M18 12.998H13V17.998C13 18.2633 12.8946 18.5176 12.7071 18.7052C12.5196 18.8927 12.2652 18.998 12 18.998C11.7348 18.998 11.4804 18.8927 11.2929 18.7052C11.1054 18.5176 11 18.2633 11 17.998V12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H11V5.99805C11 5.73283 11.1054 5.47848 11.2929 5.29094C11.4804 5.1034 11.7348 4.99805 12 4.99805C12.2652 4.99805 12.5196 5.1034 12.7071 5.29094C12.8946 5.47848 13 5.73283 13 5.99805V10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="black"></path>
            </svg>
           </button>
          </div>
         </div>
         <p class="cart-modal__item_price">' . $line_total . '</p>
         <button class="cart-modal__item_remove">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
           <path d="M4 12L12 4M4 4L12 12" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
         </button>
        </li>
';
		}
	} else {
		$html = '<p class="cart-modal__empty">' . __("Ваш кошик порожній.", "twentytwenty") . '</p>';
	}

	return $html;
}

// update cart quantity
add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');

function update_cart_quantity()
{
	$cart = WC()->cart;

	$cart_id = $_POST['id'];
	$new_quantity = $_POST['quantity'];
	$cart->set_quantity($cart_id, $new_quantity, true);
}

// remove cart item
add_action('wp_ajax_remove_cart_item', 'remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item');

function remove_cart_item()
{
	$cart = WC()->cart;
	$cart_id = $_POST['id'];

	$cart_items = $cart->get_cart();

	foreach ($cart_items as $cart_item_key => $cart_item) {
		if ($cart_item_key === $cart_id) {
			$cart->remove_cart_item($cart_item_key);
			break;
		}
	}
}


/// add theme option page and register in ACF
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Опції теми',
		'menu_title' => 'Опції теми',
		'menu_slug' => 'theme-settings',
		'capability' => 'edit_posts',
		'position' => 99,
		'icon_url' => 'dashicons-admin-generic',
		'redirect' => false
	));
}

function register_settings()
{
	register_setting('theme-settings', 'custom_option');
	add_settings_section('custom_section', 'Секція налаштувань', 'section_callback', 'theme-settings');
}
add_action('admin_init', 'register_settings');

function section_callback()
{
	echo '';
}

// get whishlist products
add_action('wp_ajax_get_wishlist', 'get_wishlist');
add_action('wp_ajax_nopriv_get_wishlist', 'get_wishlist');

function get_wishlist()
{
	$products_id = $_GET['products'];
	$products_id = explode(",", $products_id);

	if (!empty($products_id)) {
		foreach ($products_id as $product_id) {
			$product = wc_get_product($product_id);

			$product_category = wp_get_post_terms($product->get_id(), 'product_cat', array('fields' => 'names'))[0];
	?>
			<li class="wishlist__item">
				<div class="product-card">
					<a href="<?php echo $product->get_permalink(); ?>" class="product-card__link"></a>
					<div class="featured-product__swiper_image">
						<?php
						$image_id  = $product->get_image_id();
						$image_url = wp_get_attachment_image_url($image_id, 'full');

						?>
						<img class="product-card__image_primary" src="<?= $image_url ?>" alt="image preview of <?= $product->name ?>">
						<?php if ($product->get_gallery_image_ids() && $product->get_gallery_image_ids()[0]) : ?>
							<?php

							$second_image_id  = $product->get_gallery_image_ids()[0];
							$second_image_url = wp_get_attachment_image_url($second_image_id, 'full');

							?>
							<img class="product-card__image_preview" src="<?= $second_image_url ?>" alt="second image preview of <?= $product->name ?>">
						<?php endif; ?>
					</div>
					<div class="product-card__info">
						<h3 class="product-card__title fz-22 text-center open-sans"><?= $product->name ?></h3>
						<?php

						if ($product_category === 'Розпис') {
						?>
							<div class="product-card__price fz-20 text-center"><span><?= $product->price . ' ' . __('$/м.кв.', 'twentytwenty') ?></span></div>
						<?php
						} else {
						?>
							<div class="product-card__price fz-20 text-center"><span><?= __('від', 'twentytwenty') . ' ' . get_woocommerce_currency_symbol() . $product->price ?></span></div>
						<?php
						}
						?>

					</div>
					<button class="product-card__remove" data-id="<?= $product->get_id() ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</button>
				</div>
			</li>
<?php
		}
	}

	wp_die();
}

// change related product count

add_filter('woocommerce_output_related_products_args', 'custom_related_products_args', 20);
function custom_related_products_args($args)
{
	$args['posts_per_page'] = 6;
	return $args;
}

// get search suggestions

function get_search_suggestions()
{
	$query = sanitize_text_field($_POST['query']);

	$args = array(
		's' => $query,
		'post_status' => 'publish',
		'post_type' => array('post', 'product'),
		'posts_per_page' => 5
	);

	$search_query = new WP_Query($args);

	if ($search_query->have_posts()) {
		while ($search_query->have_posts()) {
			$search_query->the_post();
			echo '<li class="search-modal__item"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
		}
	} else {
		echo '<p>Нічого не знайдено</p>';
	}

	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_nopriv_get_search_suggestions', 'get_search_suggestions');
add_action('wp_ajax_get_search_suggestions', 'get_search_suggestions');

// allow svg files to upload

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
	$filetype = wp_check_filetype($filename, $mimes);
	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

add_filter('upload_mimes', 'svgMimeTypes');

function svgMimeTypes($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
