<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class NFFBC_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles( $hook_suffix ) {
		global $post_type;
		if ( 'nffbc_flashsale' == $post_type ) {
			wp_enqueue_style( $this->plugin_name, NFFBC_FLASHSALE_URL . 'admin/css/admin-style.css', array(), $this->version, 'all' );
			// Enqueue WP Color Picker
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	public function enqueue_scripts( $hook_suffix ) {
		global $post_type;
		if ( 'nffbc_flashsale' == $post_type ) {
			wp_enqueue_media();
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( $this->plugin_name, NFFBC_FLASHSALE_URL . 'admin/js/admin-script.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );
			
			// Localize script for text
			wp_localize_script( $this->plugin_name, 'nffbc_flashsale_admin', array(
				'upload_title' => __( 'Choose Image', 'newfolder-flashsale-banner-with-counter' ),
				'upload_button' => __( 'Use Image', 'newfolder-flashsale-banner-with-counter' )
			));
		}
	}

	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'Flash Sales', 'Post Type General Name', 'newfolder-flashsale-banner-with-counter' ),
			'singular_name'         => _x( 'Flash Sale', 'Post Type Singular Name', 'newfolder-flashsale-banner-with-counter' ),
			'menu_name'             => __( 'Flash Sales', 'newfolder-flashsale-banner-with-counter' ),
			'name_admin_bar'        => __( 'Flash Sale', 'newfolder-flashsale-banner-with-counter' ),
			'archives'              => __( 'Item Archives', 'newfolder-flashsale-banner-with-counter' ),
			'attributes'            => __( 'Item Attributes', 'newfolder-flashsale-banner-with-counter' ),
			'parent_item_colon'     => __( 'Parent Item:', 'newfolder-flashsale-banner-with-counter' ),
			'all_items'             => __( 'All Flash Sales', 'newfolder-flashsale-banner-with-counter' ),
			'add_new_item'          => __( 'Add New Flash Sale', 'newfolder-flashsale-banner-with-counter' ),
			'add_new'               => __( 'Add New', 'newfolder-flashsale-banner-with-counter' ),
			'new_item'              => __( 'New Item', 'newfolder-flashsale-banner-with-counter' ),
			'edit_item'             => __( 'Edit Item', 'newfolder-flashsale-banner-with-counter' ),
			'update_item'           => __( 'Update Item', 'newfolder-flashsale-banner-with-counter' ),
			'view_item'             => __( 'View Item', 'newfolder-flashsale-banner-with-counter' ),
			'view_items'            => __( 'View Items', 'newfolder-flashsale-banner-with-counter' ),
			'search_items'          => __( 'Search Item', 'newfolder-flashsale-banner-with-counter' ),
			'not_found'             => __( 'Not found', 'newfolder-flashsale-banner-with-counter' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'newfolder-flashsale-banner-with-counter' ),
		);
		$args = array(
			'label'                 => __( 'Flash Sale', 'newfolder-flashsale-banner-with-counter' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 25,
			'menu_icon'             => 'dashicons-tag',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
		);
		register_post_type( 'nffbc_flashsale', $args );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'nffbc_flashsale_settings',
			__( 'Flash Sale Settings', 'newfolder-flashsale-banner-with-counter' ),
			array( $this, 'render_meta_box' ),
			'nffbc_flashsale',
			'normal',
			'high'
		);
	}

	public function render_meta_box( $post ) {
		wp_nonce_field( 'nffbc_flashsale_save_meta', 'nffbc_flashsale_nonce' );

		// Retrieve existing values
		$image_pc = get_post_meta( $post->ID, '_nffbc_image_pc', true );
		$image_mobile = get_post_meta( $post->ID, '_nffbc_image_mobile', true );
		$end_datetime = get_post_meta( $post->ID, '_nffbc_end_datetime', true );
		$loop_hours = get_post_meta( $post->ID, '_nffbc_loop_hours', true );
		$target_pages = get_post_meta( $post->ID, '_nffbc_target_pages', true );
		if ( ! is_array( $target_pages ) ) $target_pages = array();
		
		$link_url = get_post_meta( $post->ID, '_nffbc_link_url', true );
		
		$font_size_pc = get_post_meta( $post->ID, '_nffbc_font_size_pc', true ) ?: '24';
		$font_size_mobile = get_post_meta( $post->ID, '_nffbc_font_size_mobile', true ) ?: '16';
		$max_width_pc = get_post_meta( $post->ID, '_nffbc_max_width_pc', true ) ?: '1000px';

		// Fallbacks from old global settings
		$legacy_font_color = get_post_meta( $post->ID, '_nffbc_font_color', true ) ?: '#ffffff';
		$legacy_sep_color = get_post_meta( $post->ID, '_nffbc_sep_color', true ) ?: '#ffffff';
		$legacy_bg_enable = get_post_meta( $post->ID, '_nffbc_digit_bg_enable', true ) ?: '0';
		$legacy_bg_color = get_post_meta( $post->ID, '_nffbc_digit_bg_color', true ) ?: '#000000';
		$legacy_bg_padding = get_post_meta( $post->ID, '_nffbc_digit_bg_padding', true ) ?: '5px 10px';
		$legacy_bg_radius = get_post_meta( $post->ID, '_nffbc_digit_bg_radius', true ) ?: '5px';

		// PC Specific Settings
		$font_color_pc = get_post_meta( $post->ID, '_nffbc_font_color_pc', true ) ?: $legacy_font_color;
		$sep_color_pc = get_post_meta( $post->ID, '_nffbc_sep_color_pc', true ) ?: $legacy_sep_color;
		$digit_bg_enable_pc = get_post_meta( $post->ID, '_nffbc_digit_bg_enable_pc', true );
		if ($digit_bg_enable_pc === '') $digit_bg_enable_pc = $legacy_bg_enable;
		$digit_bg_color_pc = get_post_meta( $post->ID, '_nffbc_digit_bg_color_pc', true ) ?: $legacy_bg_color;
		$digit_bg_padding_pc = get_post_meta( $post->ID, '_nffbc_digit_bg_padding_pc', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_pc = get_post_meta( $post->ID, '_nffbc_digit_bg_radius_pc', true ) ?: $legacy_bg_radius;
		$auto_gap_pc = get_post_meta( $post->ID, '_nffbc_auto_gap_pc', true ) ?: '0.8';

		// Mobile Specific Settings
		$font_color_mobile = get_post_meta( $post->ID, '_nffbc_font_color_mobile', true ) ?: $legacy_font_color;
		$sep_color_mobile = get_post_meta( $post->ID, '_nffbc_sep_color_mobile', true ) ?: $legacy_sep_color;
		$digit_bg_enable_mobile = get_post_meta( $post->ID, '_nffbc_digit_bg_enable_mobile', true );
		if ($digit_bg_enable_mobile === '') $digit_bg_enable_mobile = $legacy_bg_enable;
		$digit_bg_color_mobile = get_post_meta( $post->ID, '_nffbc_digit_bg_color_mobile', true ) ?: $legacy_bg_color;
		$digit_bg_padding_mobile = get_post_meta( $post->ID, '_nffbc_digit_bg_padding_mobile', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_mobile = get_post_meta( $post->ID, '_nffbc_digit_bg_radius_mobile', true ) ?: $legacy_bg_radius;
		$auto_gap_mobile = get_post_meta( $post->ID, '_nffbc_auto_gap_mobile', true ) ?: '1.5';
		
		$is_active = get_post_meta( $post->ID, '_nffbc_is_active', true );
		if ( $is_active === '' ) $is_active = '1';

		// Digit positions defaults
		$default_positions = array(
			'h1' => array('x' => 10, 'y' => 50),
			'h2' => array('x' => 20, 'y' => 50),
			'sep1' => array('x' => 30, 'y' => 50),
			'm1' => array('x' => 40, 'y' => 50),
			'm2' => array('x' => 50, 'y' => 50),
			'sep2' => array('x' => 60, 'y' => 50),
			's1' => array('x' => 70, 'y' => 50),
			's2' => array('x' => 80, 'y' => 50),
		);
		$digit_pos_pc = get_post_meta( $post->ID, '_nffbc_digit_positions_pc', true );
		$digit_pos_pc = is_array($digit_pos_pc) ? array_merge($default_positions, $digit_pos_pc) : $default_positions;
		
		$digit_pos_mobile = get_post_meta( $post->ID, '_nffbc_digit_positions_mobile', true );
		$digit_pos_mobile = is_array($digit_pos_mobile) ? array_merge($default_positions, $digit_pos_mobile) : $default_positions;

		$visibility_pc = get_post_meta( $post->ID, '_nffbc_digit_visibility_pc', true );
		if ( ! is_array( $visibility_pc ) && $visibility_pc === '' ) {
			// Default all to true (1)
			$visibility_pc = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}
		
		$visibility_mobile = get_post_meta( $post->ID, '_nffbc_digit_visibility_mobile', true );
		if ( ! is_array( $visibility_mobile ) && $visibility_mobile === '' ) {
			$visibility_mobile = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}

		// CTAs
		$ctas_bottom = get_post_meta( $post->ID, '_nffbc_ctas_bottom', true );
		if ( ! is_array( $ctas_bottom ) ) {
			$ctas_bottom = array(
				'layout' => 'split', // none, full, split
				'btn1' => array('text' => 'สอบถาม', 'link' => '', 'bg_color' => '#00B900', 'color' => '#ffffff', 'icon' => 'line'),
				'btn2' => array('text' => 'โทร', 'link' => '', 'bg_color' => '#f05a28', 'color' => '#ffffff', 'icon' => 'phone')
			);
		}
		
		$ctas_floating = get_post_meta( $post->ID, '_nffbc_ctas_floating', true );
		if ( ! is_array( $ctas_floating ) ) $ctas_floating = array();

		// Pages dropdown
		$pages = get_pages();
		
		// Render HTML
		include NFFBC_FLASHSALE_DIR . 'admin/partials/newfolder-flashsale-banner-with-counter-admin-display.php';
	}

	public function save_meta_boxes( $post_id ) {
		if ( ! isset( $_POST['nffbc_flashsale_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['nffbc_flashsale_nonce'], 'nffbc_flashsale_save_meta' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Save scalar fields
		$fields = array(
			'_nffbc_image_pc', '_nffbc_image_mobile', '_nffbc_end_datetime', 
			'_nffbc_loop_hours', '_nffbc_link_url', '_nffbc_max_width_pc', '_nffbc_is_active',
			
			// PC fields
			'_nffbc_font_size_pc', '_nffbc_font_color_pc', '_nffbc_sep_color_pc', 
			'_nffbc_digit_bg_enable_pc', '_nffbc_digit_bg_color_pc', '_nffbc_digit_bg_padding_pc', '_nffbc_digit_bg_radius_pc', '_nffbc_auto_gap_pc',
			
			// Mobile fields
			'_nffbc_font_size_mobile', '_nffbc_font_color_mobile', '_nffbc_sep_color_mobile', 
			'_nffbc_digit_bg_enable_mobile', '_nffbc_digit_bg_color_mobile', '_nffbc_digit_bg_padding_mobile', '_nffbc_digit_bg_radius_mobile', '_nffbc_auto_gap_mobile'
		);
		foreach ( $fields as $field ) {
			if ( isset( $_POST[$field] ) ) {
				update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[$field] ) ) );
			} else {
				if ($field === '_nffbc_is_active' || $field === '_nffbc_digit_bg_enable_pc' || $field === '_nffbc_digit_bg_enable_mobile') {
					update_post_meta( $post_id, $field, '0' );
				}
			}
		}

		// Target pages (array)
		if ( isset( $_POST['_nffbc_target_pages'] ) && is_array( $_POST['_nffbc_target_pages'] ) ) {
			$pages = array_map( 'absint', wp_unslash( $_POST['_nffbc_target_pages'] ) );
			update_post_meta( $post_id, '_nffbc_target_pages', $pages );
		} else {
			update_post_meta( $post_id, '_nffbc_target_pages', array() );
		}

		// Digit positions
		if ( isset( $_POST['_nffbc_digit_positions_pc'] ) && is_array( $_POST['_nffbc_digit_positions_pc'] ) ) {
			$positions_pc = array();
			foreach ( wp_unslash( $_POST['_nffbc_digit_positions_pc'] ) as $key => $pos ) {
				$positions_pc[ sanitize_text_field( $key ) ] = array(
					'x' => sanitize_text_field( $pos['x'] ),
					'y' => sanitize_text_field( $pos['y'] ),
				);
			}
			update_post_meta( $post_id, '_nffbc_digit_positions_pc', $positions_pc );
		}
		if ( isset( $_POST['_nffbc_digit_positions_mobile'] ) && is_array( $_POST['_nffbc_digit_positions_mobile'] ) ) {
			$positions_mobile = array();
			foreach ( wp_unslash( $_POST['_nffbc_digit_positions_mobile'] ) as $key => $pos ) {
				$positions_mobile[ sanitize_text_field( $key ) ] = array(
					'x' => sanitize_text_field( $pos['x'] ),
					'y' => sanitize_text_field( $pos['y'] ),
				);
			}
			update_post_meta( $post_id, '_nffbc_digit_positions_mobile', $positions_mobile );
		}

		// Digit visibility
		$visibility_pc = isset( $_POST['_nffbc_digit_visibility_pc'] ) ? array_map( 'absint', wp_unslash( $_POST['_nffbc_digit_visibility_pc'] ) ) : array();
		update_post_meta( $post_id, '_nffbc_digit_visibility_pc', $visibility_pc );
		
		$visibility_mobile = isset( $_POST['_nffbc_digit_visibility_mobile'] ) ? array_map( 'absint', wp_unslash( $_POST['_nffbc_digit_visibility_mobile'] ) ) : array();
		update_post_meta( $post_id, '_nffbc_digit_visibility_mobile', $visibility_mobile );

		// CTAs Bottom
		if ( isset( $_POST['_nffbc_ctas_bottom'] ) && is_array( $_POST['_nffbc_ctas_bottom'] ) ) {
			$ctas_bottom = wp_unslash( $_POST['_nffbc_ctas_bottom'] );
			
			// Process custom icon
			if ( isset($ctas_bottom['btn1']['icon']) && $ctas_bottom['btn1']['icon'] === 'custom' ) {
				$ctas_bottom['btn1']['icon'] = isset($ctas_bottom['btn1']['custom_icon']) ? sanitize_text_field( $ctas_bottom['btn1']['custom_icon'] ) : '';
			}
			if ( isset($ctas_bottom['btn2']['icon']) && $ctas_bottom['btn2']['icon'] === 'custom' ) {
				$ctas_bottom['btn2']['icon'] = isset($ctas_bottom['btn2']['custom_icon']) ? sanitize_text_field( $ctas_bottom['btn2']['custom_icon'] ) : '';
			}
			
			unset($ctas_bottom['btn1']['custom_icon']);
			unset($ctas_bottom['btn2']['custom_icon']);

			update_post_meta( $post_id, '_nffbc_ctas_bottom', $ctas_bottom );
		}

		// CTAs Floating
		if ( isset( $_POST['_nffbc_ctas_floating'] ) && is_array( $_POST['_nffbc_ctas_floating'] ) ) {
			// re-index array
			$floating = array_values( wp_unslash( $_POST['_nffbc_ctas_floating'] ) );
			// sanitize each item
			foreach ( $floating as $key => $cta ) {
				$floating[$key] = array_map( 'sanitize_text_field', $cta );
			}
			update_post_meta( $post_id, '_nffbc_ctas_floating', $floating );
		} else {
			update_post_meta( $post_id, '_nffbc_ctas_floating', array() );
		}
	}
}
