<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Threed_Menu_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       3D Menu Awesome
 * Plugin URI:        https://3dmenu.themesawesome.com/
 * Description:       WordPress menu interface element with custom layouts and effects.
 * Version:           1.0.0
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       threed-menu-awesome
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'THREED_MENU_AWESOME_VERSION', '1.0.0' );

define( 'THREED_MENU_AWESOME', __FILE__ );

define( 'THREED_MENU_AWESOME_BASENAME', plugin_basename( THREED_MENU_AWESOME ) );

define( 'THREED_MENU_AWESOME_NAME', trim( dirname( THREED_MENU_AWESOME_BASENAME ), '/' ) );

define( 'THREED_MENU_AWESOME_DIR', untrailingslashit( dirname( THREED_MENU_AWESOME ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-threed-menu-awesome-activator.php
 */
function activate_threed_menu_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-threed-menu-awesome-activator.php';
	Threed_Menu_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-threed-menu-awesome-deactivator.php
 */
function deactivate_threed_menu_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-threed-menu-awesome-deactivator.php';
	Threed_Menu_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_threed_menu_awesome' );
register_deactivation_hook( __FILE__, 'deactivate_threed_menu_awesome' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-threed-menu-awesome.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_threed_menu_awesome() {

	$plugin = new Threed_Menu_Awesome();
	$plugin->run();

}
run_threed_menu_awesome();

// init carbon field
add_action( 'after_setup_theme', 'threed_menu_awesome_crb_load' );
function threed_menu_awesome_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

// all themesawesome threed-menu-awesome options
require plugin_dir_path( __FILE__ ) . 'threed-menu-awesome-options.php';

function threed_menu_open_body() {
$threed_menu_menu_button_style_choice = carbon_get_theme_option( 'threed_menu_menu_button_style_choice' );
$threed_menu_custom_menu_label = carbon_get_theme_option( 'threed_menu_custom_menu_label' );

$threed_menu_button_menu_style = carbon_get_theme_option( 'threed_menu_button_menu_style' );
$threed_menu_btn_icon_pos = carbon_get_theme_option( 'threed_menu_btn_icon_pos' );

// menu layout
$threed_menu_style_choice = carbon_get_theme_option( 'threed_menu_style_choice' );

if(!empty($threed_menu_custom_menu_label)) {
	$ta_3d_btn_label = esc_html($threed_menu_custom_menu_label);
}
else {
	$ta_3d_btn_label = esc_html__('Show Menu', 'threed-menu-awesome');
} ?>

<?php if($threed_menu_style_choice == 'layout-1') { ?>
	<div id="perspective" class="perspective effect-airbnb">
<?php } ?>
	<div class="container-3d-menu">
		<div class="wrapper-3d-menu"><!-- wrapper needed for scroll -->
		<?php threed_menu_awesome_menu_button_style(); ?>

<?php }
add_action('wp_body_open', 'threed_menu_open_body');


function threed_menu_close_footer() {

	$threed_menu_menu_style_choice = carbon_get_theme_option( 'threed_menu_menu_style_choice' );

	// menu layout
	$threed_menu_style_choice = carbon_get_theme_option( 'threed_menu_style_choice' );
	$threed_menu_icon_position = carbon_get_theme_option( 'threed_menu_icon_position' );
?>
		</div><!-- wrapper -->
	</div><!-- /container -->
	
	<?php if($threed_menu_style_choice == 'layout-1') { ?>
		<nav id="outer-nav-wrap" class="outer-nav left vertical">
	<?php } ?>

		<?php if($threed_menu_menu_style_choice == 'manual') {

			$threed_menu_manual_menu = carbon_get_theme_option( 'threed_menu_manual_menu' );

			foreach ($threed_menu_manual_menu as $menu_item) { ?>
				<a href="<?php echo esc_url($menu_item['threed_menu_link_menu']); ?>" class="ta-3d-menu-item-cust">
					<?php if($threed_menu_icon_position == 'left') { ?>
						<i class="<?php echo esc_attr($menu_item['threed_menu_icon']['class']); ?>"></i>
						<?php echo esc_html($menu_item['threed_menu_menu_label']); ?>
					<?php }
					elseif($threed_menu_icon_position == 'right') { ?>
						<?php echo esc_html($menu_item['threed_menu_menu_label']); ?>
						<i class="<?php echo esc_attr($menu_item['threed_menu_icon']['class']); ?>"></i>
					<?php } ?>
				</a>
			<?php } ?>
		<?php } else {

			$menu_name = '3d-menu';
 
			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
			 
				$menu_items = wp_get_nav_menu_items($menu->term_id);

				$menu_list = '';
			 
				foreach ( (array) $menu_items as $key => $menu_item ) {

					$threed_single_menu_icon = carbon_get_nav_menu_item_meta( $menu_item->ID, 'threed_single_menu_icon' );

					$title = $menu_item->title;
					$url = $menu_item->url;

					// if has icon
					if(!empty($threed_single_menu_icon['class'])) {
						$threed_single_menu_icon_html = '<i class="'. esc_attr($threed_single_menu_icon['class']). '"></i>';
					}
					else {
						$threed_single_menu_icon_html = '';
					}

					if($threed_menu_icon_position == 'left') {
						$menu_list .= '<a href="' . esc_url($url) . '">'. $threed_single_menu_icon_html . esc_html($title) . '</a>';
					}
					elseif($threed_menu_icon_position == 'right') {
						$menu_list .= '<a href="' . esc_url($url) . '">'. esc_html($title) . $threed_single_menu_icon_html . '</a>';
					}
				}
				echo wp_specialchars_decode($menu_list);
			}
		} ?>
	</nav>
</div><!-- /perspective -->
<?php }
add_action('wp_footer', 'threed_menu_close_footer', 100);

// Try Carbon Field for Menu
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'threed_menu_wp_menu_field' );
function threed_menu_wp_menu_field() {

	Container::make( 'nav_menu_item', esc_html__( 'Menu Settings', 'threed-menu-awesome' ) )
	->add_fields( array(
		Field::make( 'icon', 'threed_single_menu_icon', esc_html__('Icon', 'threed-menu-awesome') ),
	));

}

//Register Menus
add_action( 'after_setup_theme', 'threed_menu_awesome_register_my_menu' );

function threed_menu_awesome_register_my_menu() {
	register_nav_menu( '3d-menu', esc_html__( '3D Menu', 'threed_menu_awesome' ) ); 
}

//MAIN MENU
function threed_menu_awesome_main_nav_menu(){
	wp_nav_menu( array(
		'theme_location' => '3d-menu',
	));
}

$threed_menu_menu_button_style_choice = get_option( '_threed_menu_menu_button_style_choice' );
function threed_menu_awesome_custom_menu_btn($items, $args) {
	$threed_menu_button_menu_style = get_option( '_threed_menu_button_menu_style' );
	$threed_menu_custom_menu_label = get_option( '_threed_menu_custom_menu_label' );
	$threed_menu_button_menu_position_screen = get_option( '_threed_menu_button_menu_position_screen' );

	if(!empty($threed_menu_custom_menu_label)) {
		$threed_menu_custom_menu_label = $threed_menu_custom_menu_label;
	}
	else {
		$threed_menu_custom_menu_label = '';
	}

	$threed_menu_btn_icon_pos = get_option( '_threed_menu_btn_icon_pos' );

	if($threed_menu_button_menu_style == 'style-1') {
		wp_enqueue_style( 'threed-menu-awesome-btn1', plugin_dir_url( __FILE__ ) . 'public/css/threed-menu-awesome-btn1.css', array(), '', 'all' );
		$items .= '<li class="menu-item">'
		  . '<a id="showMenu" href="#" class="btn-activate-menu3d-tgt '.esc_attr($threed_menu_button_menu_position_screen).'">'
		  . '<div id="burger-ta-trd1">'
		  . '<div class="line"></div>'
		  . '<div class="line"></div>'
		  . '<div class="line"></div>'
		  . '</div>'
		  . ''.esc_html($threed_menu_custom_menu_label).''
		  . '</a>'
		  . '</li>';
	}
	elseif($threed_menu_button_menu_style == 'style-2') {
		wp_enqueue_style( 'threed-menu-awesome-btn2', plugin_dir_url( __FILE__ ) . 'public/css/threed-menu-awesome-btn2.css', array(), '', 'all' );
		$items .= '<li class="menu-item">'
		  . '<a id="showMenu" href="#" class="btn-activate-menu3d-tgt '.esc_attr($threed_menu_button_menu_position_screen).'">'
		  . '<label for="toggle" class="burger-menu">'
		  . '<div class="burger-menu-lines">'
		  . '<div class="line"></div>'
		  . '<div class="line"></div>'
		  . '<div class="line"></div>'
		  . '</div>'
		  . '</label>'
		  . '<input type="checkbox" id="toggle" class="invisible">'
		  . ''.esc_html($threed_menu_custom_menu_label).''
		  . '</a>'
		  . '</li>';
	}
	else {
		$items .= '<li class="menu-item">'
		  . '<a id="showMenu" href="#">'
		  . ''.esc_html($threed_menu_custom_menu_label).''
		  . '</a>'
		  . '</li>';
	}
	return $items;
}

if($threed_menu_menu_button_style_choice == 'wordpress-menu') {
add_filter('wp_nav_menu_items', 'threed_menu_awesome_custom_menu_btn', 10, 2);
}

function threed_menu_awesome_menu_button_style() {

	$threed_menu_menu_button_style_choice = carbon_get_theme_option( 'threed_menu_menu_button_style_choice' );
	$threed_menu_button_menu_style = carbon_get_theme_option( 'threed_menu_button_menu_style' );
	$threed_menu_btn_icon_pos = carbon_get_theme_option( 'threed_menu_btn_icon_pos' );
	$threed_menu_button_menu_position_screen = carbon_get_theme_option( 'threed_menu_button_menu_position_screen' );

	$threed_menu_custom_menu_label = carbon_get_theme_option( 'threed_menu_custom_menu_label' );

	if(!empty($threed_menu_custom_menu_label)) {
		$ta_3d_btn_label = esc_html($threed_menu_custom_menu_label);
	}
	else {
		$ta_3d_btn_label = '';
	}

	if($threed_menu_menu_button_style_choice == 'manual') {
		if($threed_menu_button_menu_style == 'style-1') {

			wp_enqueue_style( 'threed-menu-awesome-btn1', plugin_dir_url( __FILE__ ) . 'public/css/threed-menu-awesome-btn1.css', array(), '', 'all' ); ?>

			<button id="showMenu" class="btn-activate-menu3d btn-activate-menu3d-tgt <?php echo esc_attr($threed_menu_button_menu_position_screen); ?>">
				<?php if($threed_menu_btn_icon_pos == 'left') { ?>
					<div id="burger-ta-trd1">
						<div class="line"></div>
						<div class="line"></div>
						<div class="line"></div>
					</div>
				<?php } ?>
				<div class="text-btn-klas">
					<?php echo esc_html($ta_3d_btn_label); ?>
				</div>
				<?php if($threed_menu_btn_icon_pos == 'right') { ?>
					<div id="burger-ta-trd1">
						<div class="line"></div>
						<div class="line"></div>
						<div class="line"></div>
					</div>
				<?php } ?>
			</button>
		<?php }
		if($threed_menu_button_menu_style == 'style-2') {

			wp_enqueue_style( 'threed-menu-awesome-btn2', plugin_dir_url( __FILE__ ) . 'public/css/threed-menu-awesome-btn2.css', array(), '', 'all' ); ?>

			<button id="showMenu" class="btn-activate-menu3d btn-activate-menu3d-tgt <?php echo esc_attr($threed_menu_button_menu_position_screen); ?>">
				<?php if($threed_menu_btn_icon_pos == 'left') { ?>
					<label for="toggle" class="burger-menu">
						<div class="burger-menu-lines">
							<div class="line"></div>
							<div class="line"></div>
							<div class="line"></div>
						</div>
						<div class="burger-menu-close-icon"></div>
					</label>
					<input type="checkbox" id="toggle" class="invisible">
				<?php } ?>
				<div class="text-btn-klas">
					<?php echo esc_html($ta_3d_btn_label); ?>
				</div>
				<?php if($threed_menu_btn_icon_pos == 'right') { ?>
					<label for="toggle" class="burger-menu">
						<div class="burger-menu-lines">
							<div class="line"></div>
							<div class="line"></div>
							<div class="line"></div>
						</div>
						<div class="burger-menu-close-icon"></div>
					</label>
					<input type="checkbox" id="toggle" class="invisible">
				<?php } ?>
			</button>
		<?php }
	}
}

// threed_menu_awesome head css
add_action('wp_head', 'threed_menu_awesome_color_custom_styles', 100);
function threed_menu_awesome_color_custom_styles()
{ ?>

   <style>
		<?php

		$threed_menu_layout_background_color = carbon_get_theme_option( 'threed_menu_layout_background_color' );
		$threed_menu_layout_background_image = carbon_get_theme_option( 'threed_menu_layout_background_image' );

		$threed_menu_font_color = carbon_get_theme_option( 'threed_menu_font_color' );
		$threed_menu_font_hov_color = carbon_get_theme_option( 'threed_menu_font_hov_color' );
		$threed_menu_font_size = carbon_get_theme_option( 'threed_menu_font_size' );
		$threed_menu_font_weight = carbon_get_theme_option( 'threed_menu_font_weight' );
		$threed_menu_line_height = carbon_get_theme_option( 'threed_menu_line_height' );

		$threed_menu_icon_position = carbon_get_theme_option( 'threed_menu_icon_position' );
		$threed_menu_icon_color = carbon_get_theme_option( 'threed_menu_icon_color' );
		$threed_menu_icon_hov_color = carbon_get_theme_option( 'threed_menu_icon_hov_color' );
		$threed_menu_icon_size = carbon_get_theme_option( 'threed_menu_icon_size' );

		$threed_menu_button_menu_margin_left = carbon_get_theme_option( 'threed_menu_button_menu_margin_left' );
		$threed_menu_button_menu_margin_bottom = carbon_get_theme_option( 'threed_menu_button_menu_margin_bottom' );
		$threed_menu_button_menu_margin_right = carbon_get_theme_option( 'threed_menu_button_menu_margin_right' );
		$threed_menu_button_menu_margin_top = carbon_get_theme_option( 'threed_menu_button_menu_margin_top' );

		$threed_menu_button_menu_round = carbon_get_theme_option( 'threed_menu_button_menu_round' );
		$threed_menu_button_menu_round_unit = carbon_get_theme_option( 'threed_menu_button_menu_round_unit' );

		$threed_menu_btn_txt_color = carbon_get_theme_option( 'threed_menu_btn_txt_color' );
		$threed_menu_btn_bg_color = carbon_get_theme_option( 'threed_menu_btn_bg_color' );
		$threed_menu_btn_txt_hov_color = carbon_get_theme_option( 'threed_menu_btn_txt_hov_color' );
		$threed_menu_btn_bg_hov_color = carbon_get_theme_option( 'threed_menu_btn_bg_hov_color' );

		$threed_menu_button_menu_position_screen = carbon_get_theme_option( 'threed_menu_button_menu_position_screen' );

		$threed_menu_button_menu_width = carbon_get_theme_option( 'threed_menu_button_menu_width' );
		$threed_menu_button_menu_height = carbon_get_theme_option( 'threed_menu_button_menu_height' );

		$threed_menu_btn_icon_pos = carbon_get_theme_option( 'threed_menu_btn_icon_pos' );
		$threed_menu_space_between = carbon_get_theme_option( 'threed_menu_space_between' );
		$threed_menu_btn_font_size = carbon_get_theme_option( 'threed_menu_btn_font_size' );
		$threed_menu_btn_font_weight = carbon_get_theme_option( 'threed_menu_btn_font_weight' );

		?>

		<?php 
		if(!empty($threed_menu_layout_background_color)) { ?>
			.perspective.modalview {
				background-color: <?php echo esc_html($threed_menu_layout_background_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_layout_background_image)) {
		$threed_menu_bg_img = wp_get_attachment_image_src($threed_menu_layout_background_image, 'full'); ?>
			.perspective.modalview {
				background-image: url(<?php echo esc_html($threed_menu_bg_img[0]); ?>);
			}
		<?php }
		if(!empty($threed_menu_font_color)) { ?>
			.perspective .outer-nav a {
				color: <?php echo esc_html($threed_menu_font_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_font_hov_color)) { ?>
			.perspective .outer-nav a:hover {
				color: <?php echo esc_html($threed_menu_font_hov_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_font_size)) { ?>
			.perspective .outer-nav a {
				font-size: <?php echo esc_html($threed_menu_font_size); ?>px;
			}
		<?php }
		if(!empty($threed_menu_font_weight)) { ?>
			.perspective .outer-nav a {
				font-weight: <?php echo esc_html($threed_menu_font_weight); ?>;
			}
		<?php }
		if(!empty($threed_menu_line_height)) { ?>
			.perspective .outer-nav i {
				line-height: <?php echo esc_html($threed_menu_line_height); ?>;
			}
		<?php }

		// menu icon
		if($threed_menu_icon_position == 'left') { ?>
			.perspective .outer-nav i {
				margin-right: 10px;
			}
		<?php }
		elseif($threed_menu_icon_position == 'right') { ?>
			.perspective .outer-nav i {
				margin-left: 10px;
			}
		<?php }
		if(!empty($threed_menu_icon_color)) { ?>
			.perspective .outer-nav i {
				color: <?php echo esc_html($threed_menu_icon_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_icon_hov_color)) { ?>
			.perspective .outer-nav a:hover i {
				color: <?php echo esc_html($threed_menu_icon_hov_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_icon_size)) { ?>
			.perspective .outer-nav i {
				font-size: <?php echo esc_html($threed_menu_icon_size); ?>px;
			}
		<?php }

		// menu button margin
		if(!empty($threed_menu_button_menu_margin_left)) { ?>
			.wrapper-3d-menu .btn-activate-menu3d-tgt {
				margin-left: <?php echo esc_html($threed_menu_button_menu_margin_left); ?>px;
			}
		<?php }
		if(!empty($threed_menu_button_menu_margin_bottom)) { ?>
			.wrapper-3d-menu .btn-activate-menu3d-tgt {
				margin-bottom: <?php echo esc_html($threed_menu_button_menu_margin_bottom); ?>px;
			}
		<?php }
		if(!empty($threed_menu_button_menu_margin_right)) { ?>
			.wrapper-3d-menu .btn-activate-menu3d-tgt {
				margin-right: <?php echo esc_html($threed_menu_button_menu_margin_right); ?>px;
			}
		<?php }
		if(!empty($threed_menu_button_menu_margin_top)) { ?>
			.wrapper-3d-menu .btn-activate-menu3d-tgt {
				margin-top: <?php echo esc_html($threed_menu_button_menu_margin_top); ?>px;
			}
		<?php }

		// button border radius
		if(!empty($threed_menu_button_menu_round)) { ?>
			.wrapper-3d-menu .btn-activate-menu3d-tgt {
				border-radius: <?php echo esc_html($threed_menu_button_menu_round); ?><?php echo esc_html($threed_menu_button_menu_round_unit); ?>;
			}
		<?php }

		if(!empty($threed_menu_btn_txt_color)) { ?>
			.btn-activate-menu3d-tgt {
				color: <?php echo esc_html($threed_menu_btn_txt_color); ?>;
			}
			.btn-activate-menu3d-tgt #burger-ta-trd1 .line, .btn-activate-menu3d-tgt .burger-menu-lines .line::before, .btn-activate-menu3d-tgt .burger-menu-lines .line::after {
				background-color: <?php echo esc_html($threed_menu_btn_txt_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_btn_bg_color)) { ?>
			.btn-activate-menu3d-tgt {
				background-color: <?php echo esc_html($threed_menu_btn_bg_color); ?>;
			}
		<?php }
		if(!empty($threed_menu_btn_txt_hov_color)) { ?>
			.btn-activate-menu3d-tgt:hover {
				color: <?php echo esc_html($threed_menu_btn_txt_hov_color); ?>;
			}
			.btn-activate-menu3d-tgt:hover .burger-menu-lines .line::before, .btn-activate-menu3d-tgt:hover .burger-menu-lines .line::after, .btn-activate-menu3d-tgt:hover #burger-ta-trd1 .line {
				background: <?php echo esc_html($threed_menu_btn_txt_hov_color); ?>;
			}
		<?php }

		if(!empty($threed_menu_btn_bg_hov_color)) { ?>
			.btn-activate-menu3d-tgt:hover {
				background: <?php echo esc_html($threed_menu_btn_bg_hov_color); ?>;
			}
		<?php }

		// button menu position

		if(!empty($threed_menu_button_menu_width)) { ?>
			.btn-activate-menu3d-tgt {
				padding-left: <?php echo esc_html($threed_menu_button_menu_width); ?>px;
				padding-right: <?php echo esc_html($threed_menu_button_menu_width); ?>px;
			}
		<?php }
		if(!empty($threed_menu_button_menu_height)) { ?>
			.btn-activate-menu3d-tgt {
				padding-top: <?php echo esc_html($threed_menu_button_menu_height); ?>px;
				padding-bottom: <?php echo esc_html($threed_menu_button_menu_height); ?>px;
			}
		<?php }

		// menu button icon
		if($threed_menu_btn_icon_pos == 'left') {
			if(!empty($threed_menu_space_between)) { ?>
				.btn-activate-menu3d-tgt #burger-ta-trd1 {
					margin-right: <?php echo esc_html($threed_menu_space_between); ?>px;
				}
			<?php }
		}
		elseif($threed_menu_btn_icon_pos == 'right') {
			if(!empty($threed_menu_space_between)) { ?>
				.btn-activate-menu3d-tgt #burger-ta-trd1 {
					margin-left: <?php echo esc_html($threed_menu_space_between); ?>px;
				}
			<?php }
		}

		if(!empty($threed_menu_btn_font_size)) { ?>
			.btn-activate-menu3d-tgt {
				font-size: <?php echo esc_html($threed_menu_btn_font_size); ?>px;
			}
		<?php }
		if(!empty($threed_menu_btn_font_weight)) { ?>
			.btn-activate-menu3d-tgt {
				font-weight: <?php echo esc_html($threed_menu_btn_font_weight); ?>;
			}
		<?php } ?>

		<?php wp_reset_postdata(); ?>
	</style>

<?php }