<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'threed_menu_awesome_theme_options_opt' );
function threed_menu_awesome_theme_options_opt() {

	// loader background
	$basic_threed_menu_options_container = Container::make( 'theme_options', 'threed_menu_awesome_opts', esc_html__( '3D Menu', 'threed-menu-awesome' ) )
	->add_tab('Layout', array(
		Field::make( 'radio_image', 'threed_menu_style_choice', esc_html__('Select Layout', 'threed-menu-awesome') )
		->add_options( array(
			'layout-1' => plugin_dir_url('README.txt') . THREED_MENU_AWESOME_NAME . '/assets/menu3d-1.png',
		) )
		->set_width( 70),

		Field::make( 'color', 'threed_menu_layout_background_color', esc_html__('Layout Background Color', 'threed-menu-awesome') )
		->set_width( 15 ),

		Field::make( 'image', 'threed_menu_layout_background_image', esc_html__('Layout Background Image', 'threed-menu-awesome') )
		->set_width( 15 ),

		Field::make( 'html', 'buy_pro' )
   		->set_html( '<p>Get more styles! Let&#39;s upgrade to pro</p><a href="https://1.envato.market/Az6K1" target="_blank" class="btn-buy">Upgrade to Pro</a>' ),
	) )

	->add_tab('Menu', array(
		Field::make( 'select', 'threed_menu_menu_style_choice', esc_html__('Select Menu', 'threed-menu-awesome') )
		->add_options( array(
			'wordpress-menu' => esc_html__('WordPress Menu', '3d-menu-awesome'),
			'manual' => esc_html__('Manual Menu', '3d-menu-awesome'),
		) ),

		Field::make( 'complex', 'threed_menu_manual_menu', esc_html__('Menu', 'threed-menu-awesome') )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) )
		->set_layout( 'tabbed-vertical' )
		->add_fields( array(
			Field::make( 'text', 'threed_menu_menu_label', esc_html__('Menu', 'threed-menu-awesome') )
			->set_attribute( 'placeholder', esc_html__('Enter your label menu here', 'threed-menu-awesome') )
			->set_width( 33 ),

			Field::make( 'text', 'threed_menu_link_menu', esc_html__('Link', 'threed-menu-awesome') )
			->set_attribute( 'placeholder', esc_html__('Enter menu url', 'threed-menu-awesome') )
			->set_width( 33 ),

			Field::make( 'icon', 'threed_menu_icon', esc_html__('Icon', 'threed-menu-awesome') )
			->set_width( 33 ),
		) ),

		// menu font
		Field::make( 'color', 'threed_menu_font_color', esc_html__('Menu Font Color', 'threed-menu-awesome') )
		->set_width( 20 ),

		Field::make( 'color', 'threed_menu_font_hov_color', esc_html__('Menu Font Hover Color', 'threed-menu-awesome') )
		->set_width( 20 ),

		Field::make( 'number', 'threed_menu_font_size', esc_html__( 'Menu Font Size', 'threed-menu-awesome' ) )
		->set_width( 20 ),

		Field::make( 'select', 'threed_menu_font_weight', esc_html__( 'Menu Font Weight', 'threed-menu-awesome' ) )
		->add_options( array(
			'400' => esc_html__('Normal', 'threed-menu-awesome'),
			'700' => esc_html__('Bold', 'threed-menu-awesome'),
		) )
		->set_width( 20 ),

		Field::make( 'number', 'threed_menu_line_height', esc_html__( 'Line Height', 'threed-menu-awesome' ) )
		->set_width( 20 ),

		// icon menu font
		Field::make( 'color', 'threed_menu_icon_color', esc_html__('Icon Color', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'color', 'threed_menu_icon_hov_color', esc_html__('Icon Hover Color', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'number', 'threed_menu_icon_size', esc_html__( 'Icon Size', 'threed-menu-awesome' ) )
		->set_width( 25 ),

		Field::make( 'select', 'threed_menu_icon_position', esc_html__('Icon Position', 'threed-menu-awesome') )
		->add_options( array(
			'left' => esc_html__('Icon left', 'threed-menu-awesome'),
			'right' => esc_html__('Icon right', 'threed-menu-awesome'),
		) )
		->set_width( 25 ),
	) )

	->add_tab('Menu Button', array(
		Field::make( 'select', 'threed_menu_menu_button_style_choice', esc_html__('Select Menu Location', 'threed-menu-awesome') )
		->add_options( array(
			'wordpress-menu' => esc_html__('As WordPress Menu', '3d-menu-awesome'),
			'manual' => esc_html__('Floating Button Menu', '3d-menu-awesome'),
		) )
		->set_width( 50 ),

		Field::make( 'select', 'threed_menu_button_menu_style', esc_html__('Menu Button Style', 'threed-menu-awesome') )
		->add_options( array(
			'style-1' => esc_html__('Style 1', 'threed-menu-awesome'),
			'style-2' => esc_html__('Style 2', 'threed-menu-awesome'),
		) )
		->set_width( 50 ),

		Field::make( 'text', 'threed_menu_custom_menu_label', esc_html__('Button Label', 'threed-menu-awesome') )
		->set_attribute( 'placeholder', esc_html__('Text beside menu button', 'threed-menu-awesome') )
		->set_width( 20 ),

		Field::make( 'select', 'threed_menu_btn_icon_pos', esc_html__('Button Icon Position', 'threed-menu-awesome') )
		->add_options( array(
			'left' => esc_html__('Icon left', 'threed-menu-awesome'),
			'right' => esc_html__('Icon right', 'threed-menu-awesome'),
		) )
		->set_width( 20 ),

		Field::make( 'number', 'threed_menu_space_between', esc_html__('Space Between Text', 'threed-menu-awesome') )
		->set_width( 20 ),

		Field::make( 'number', 'threed_menu_btn_font_size', esc_html__('Button Text Size', 'threed-menu-awesome') )
		->set_width( 20 ),

		Field::make( 'select', 'threed_menu_btn_font_weight', esc_html__('Button Text Weight', 'threed-menu-awesome') )
		->add_options( array(
			'400' => esc_html__('Normal', 'threed-menu-awesome'),
			'700' => esc_html__('Bold', 'threed-menu-awesome'),
		) )
		->set_width( 20 ),

		Field::make( 'number', 'threed_menu_button_menu_width', esc_html__('Padding Horizontal Button', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'number', 'threed_menu_button_menu_height', esc_html__('Padding Vertical Button', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'number', 'threed_menu_button_menu_round', esc_html__('Button Border Radius', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'select', 'threed_menu_button_menu_round_unit', esc_html__('Radius Unit', 'threed-menu-awesome') )
		->add_options( array(
			'px' => esc_html__('px', 'threed-menu-awesome'),
			'%' => esc_html__('%', 'threed-menu-awesome'),
		) )
		->set_width( 25 ),

		Field::make( 'color', 'threed_menu_btn_txt_color', esc_html__('Button Color', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'color', 'threed_menu_btn_txt_hov_color', esc_html__('Button Hover Color', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'color', 'threed_menu_btn_bg_color', esc_html__('Button Background Color', 'threed-menu-awesome') )
		->set_width( 25 ),

		Field::make( 'color', 'threed_menu_btn_bg_hov_color', esc_html__('Button Background Hover', 'threed-menu-awesome') )
		->set_width( 25 ),

		// only for manual button
		Field::make( 'html', 'crb_information_text' )
		->set_html( '<h2 class="separator-title">Floating Menu Options</h2>' )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_button_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) ),

		Field::make( 'number', 'threed_menu_button_menu_margin_left', esc_html__('Margin Button Left', 'threed-menu-awesome') )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_button_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) )
		->set_width( 15 ),

		Field::make( 'number', 'threed_menu_button_menu_margin_bottom', esc_html__('Margin Button Bottom', 'threed-menu-awesome') )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_button_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) )
		->set_width( 15 ),

		Field::make( 'number', 'threed_menu_button_menu_margin_right', esc_html__('Margin Button Right', 'threed-menu-awesome') )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_button_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) )
		->set_width( 15 ),

		Field::make( 'number', 'threed_menu_button_menu_margin_top', esc_html__('Margin Button Top', 'threed-menu-awesome') )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_button_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) )
		->set_width( 15 ),

		Field::make( 'select', 'threed_menu_button_menu_position_screen', esc_html__('Position Select', 'threed-menu-awesome') )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'threed_menu_menu_button_style_choice',
				'value' => 'manual',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'top-left' => esc_html__('Top Left Screen', 'threed-menu-awesome'),
			'center-left' => esc_html__('Center Left Screen', 'threed-menu-awesome'),
			'bottom-left' => esc_html__('Bottom Left Screen', 'threed-menu-awesome'),
			'top-right' => esc_html__('Top Right Screen', 'threed-menu-awesome'),
			'center-right' => esc_html__('Center Right Screen', 'threed-menu-awesome'),
			'bottom-right' => esc_html__('Bottom Right Screen', 'threed-menu-awesome'),
			'center-top' => esc_html__('Center Top Screen', 'threed-menu-awesome'),
			'center-bottom' => esc_html__('Center Bottom Screen', 'threed-menu-awesome'),
		) )
		->set_width( 40 ),
	) );

	// docs
	Container::make( 'theme_options', 'threed_go_pro', esc_html__( 'Go Pro', 'threed-menu-awesome' ) )
	->set_page_parent( $basic_threed_menu_options_container ) // identificator of the "Appearance" admin section
	->add_fields( array(
	) );

	Container::make( 'theme_options', 'threed_docs', esc_html__( 'Documentation', 'threed-menu-awesome' ) )
	->set_page_parent( $basic_threed_menu_options_container ) // identificator of the "Appearance" admin section
	->add_fields( array(
	) );
}