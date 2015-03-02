<?php
/**
 * Plugin Name: Verbatim
 * Plugin URI: http://verbat.im
 * Description: Allows deep linking directly to post content
 * Version: 1.5
 * Author: Ramsay Lanier and Maxim Leyzerovich of nclud Labs
 * Author URI: http://nclud.com
 * License: GPL
 */

define( 'VRBTM_URL',     plugin_dir_url( __FILE__ )  );
define( 'VRBTM_PATH',    plugin_dir_path( __FILE__ ) );
define( 'VRBTM_VERSION', '1.5'                     );

if (!is_admin()){
	add_action( 'plugins_loaded', 'vrbtm_init' );
}

function vrbtm_init(){
	wp_register_script('verbatim', VRBTM_URL . '/js/verbatim.js', array('jquery'), VRBTM_VERSION, false );
	wp_register_script('twitter-widgets', 'http://platform.twitter.com/widgets.js', array('jquery') );
	wp_enqueue_style('verbatim', VRBTM_URL . '/css/verbatim.css', array(), VRBTM_VERSION );

	$vrbtm_options = array(
		'highlightParent' => get_option( 'vrbtm_highlight_parent', 1 ),
		'searchContainer' => get_option( 'vrbtm_search_container', 'body' ),
		'addedClass' => get_option( 'vrbtm_added_class', 'verbatim-found-content'),
		'highlightedClass' => get_option('vrbtm_highlighted_class', 'highlight'),
		'highlightColor' => get_option('vrbtm_highlighted_color', '#FFFF00'),
		'selectedClass' => get_option('vrbtm_selected_class', 'verbatim-selected-text'),
		'buttonClass' => get_option('vrbtm_button_class', 'verbatim-button-container'),
		'animated' => get_option('vrbtm_animated', true),
		'animationSpeed' => get_option('vrbtm_animation_speed', 2000),
		'scrollingOffset' => get_option('vrbtm_scrolling_offset', 200),
		'allowImages' => get_option('vrbtm_allow_images', 1),
		'bitlyToken' => get_option('vrbtm_bitly_token', 0)
	);

	wp_localize_script('verbatim', 'wordpressOptions', $vrbtm_options);

	wp_enqueue_script('verbatim');
	wp_enqueue_script('twitter-widgets');
}

function vrbtm_plugin_page() {
	add_options_page( 
		'Verbatim Options', 
		'Verbatim', 
		'manage_options', 
		'verbatim_settings_page', 
		'vrbtm_plugin_options'
	);
}

function vrbtm_plugin_options() {
    include('admin/verbatim_admin.php');
}

function register_vrbtm_settings(){
	add_settings_section(
		'vrbtm_setting_section',
		'Verbatim Settings',
		'vrbtm_settings_section_callback_function',
		'verbatim_settings_page'
	);

	add_settings_field(
		'vrbtm_search_container',
		'Search Container',
		'search_container_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_highlight_parent',
		'Highlight Parent Element',
		'highlight_parent_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_added_class',
		'CSS Class To Add To Found Elements',
		'added_class_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_highlighted_class',
		'CSS Class To Add To Highlighted Elements',
		'highlighted_class_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_highlighted_color',
		'Default Color of Highlights',
		'highlighted_color_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_selected_class',
		'CSS Class to Add To Selected Text When Copying Link',
		'selected_class_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_button_class',
		'CSS Class to Add To Copy Link Button',
		'button_class_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_animated',
		'Enable Amimated Scrolling To Content',
		'animated_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_animation_speed',
		'Speed of Scrolling Animation',
		'animation_speed_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_scrolling_offset',
		'Amount of Offset in Pixel From Top of Window',
		'scrolling_offset_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_scrolling_offset',
		'Amount of Offset in Pixel From Top of Window',
		'scrolling_offset_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_allow_images',
		'Allow users to link to images',
		'allow_images_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	add_settings_field(
		'vrbtm_bitly_token',
		'Add Bitlye Token to Enable Short Links',
		'bitly_token_callback_function',
		'verbatim_settings_page',
		'verbatim_settings_group'
	);

	register_setting( 'verbatim_settings_group', 'vrbtm_search_container' );
	register_setting( 'verbatim_settings_group', 'vrbtm_highlight_parent' );
	register_setting( 'verbatim_settings_group', 'vrbtm_added_class' );
	register_setting( 'verbatim_settings_group', 'vrbtm_highlighted_class' );
	register_setting( 'verbatim_settings_group', 'vrbtm_highlighted_color' );
	register_setting( 'verbatim_settings_group', 'vrbtm_selected_class' );
	register_setting( 'verbatim_settings_group', 'vrbtm_button_class' );
	register_setting( 'verbatim_settings_group', 'vrbtm_highlight_parent' );
	register_setting( 'verbatim_settings_group', 'vrbtm_animated' );
	register_setting( 'verbatim_settings_group', 'vrbtm_animation_speed' );
	register_setting( 'verbatim_settings_group', 'vrbtm_scrolling_offset' );
	register_setting( 'verbatim_settings_group', 'vrbtm_allow_images' );
	register_setting( 'verbatim_settings_group', 'vrbtm_bitly_token' );
}

function vrbtm_settings_section_callback_function() {
	echo '<p>Please refer to the <a href="https://github.com/nclud/verbatim">Verbatim github page</a> for questions referring to these options.</p>';
}

function load_custom_wp_admin_style($hook) {
	if ('settings_page_verbatim_settings_page' != $hook){
		return;
	}

	wp_enqueue_style('verbatim-admin', VRBTM_URL . '/css/verbatim-admin-style.css', array(), VRBTM_VERSION );
}

if (is_admin()){
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' ); 
	add_action( 'admin_menu', 'vrbtm_plugin_page' );
	add_action( 'admin_init', 'register_vrbtm_settings' );
}