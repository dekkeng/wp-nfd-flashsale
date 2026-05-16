<?php

class NFD_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles( $hook_suffix ) {
		global $post_type;
		if ( 'nfd_flashsale' == $post_type ) {
			wp_enqueue_style( $this->plugin_name, NFD_FLASHSALE_URL . 'admin/css/admin-style.css', array(), $this->version, 'all' );
			// Enqueue WP Color Picker
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	public function enqueue_scripts( $hook_suffix ) {
		global $post_type;
		if ( 'nfd_flashsale' == $post_type ) {
			wp_enqueue_media();
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( $this->plugin_name, NFD_FLASHSALE_URL . 'admin/js/admin-script.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );
			
			// Localize script for text
			wp_localize_script( $this->plugin_name, 'nfd_flashsale_admin', array(
				'upload_title' => __( 'Choose Image', 'nfd-flashsale' ),
				'upload_button' => __( 'Use Image', 'nfd-flashsale' )
			));
		}
	}

	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'Flash Sales', 'Post Type General Name', 'nfd-flashsale' ),
			'singular_name'         => _x( 'Flash Sale', 'Post Type Singular Name', 'nfd-flashsale' ),
			'menu_name'             => __( 'Flash Sales', 'nfd-flashsale' ),
			'name_admin_bar'        => __( 'Flash Sale', 'nfd-flashsale' ),
			'archives'              => __( 'Item Archives', 'nfd-flashsale' ),
			'attributes'            => __( 'Item Attributes', 'nfd-flashsale' ),
			'parent_item_colon'     => __( 'Parent Item:', 'nfd-flashsale' ),
			'all_items'             => __( 'All Flash Sales', 'nfd-flashsale' ),
			'add_new_item'          => __( 'Add New Flash Sale', 'nfd-flashsale' ),
			'add_new'               => __( 'Add New', 'nfd-flashsale' ),
			'new_item'              => __( 'New Item', 'nfd-flashsale' ),
			'edit_item'             => __( 'Edit Item', 'nfd-flashsale' ),
			'update_item'           => __( 'Update Item', 'nfd-flashsale' ),
			'view_item'             => __( 'View Item', 'nfd-flashsale' ),
			'view_items'            => __( 'View Items', 'nfd-flashsale' ),
			'search_items'          => __( 'Search Item', 'nfd-flashsale' ),
			'not_found'             => __( 'Not found', 'nfd-flashsale' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'nfd-flashsale' ),
		);
		$args = array(
			'label'                 => __( 'Flash Sale', 'nfd-flashsale' ),
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
		register_post_type( 'nfd_flashsale', $args );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'nfd_flashsale_settings',
			__( 'Flash Sale Settings', 'nfd-flashsale' ),
			array( $this, 'render_meta_box' ),
			'nfd_flashsale',
			'normal',
			'high'
		);
	}

	public function render_meta_box( $post ) {
		wp_nonce_field( 'nfd_flashsale_save_meta', 'nfd_flashsale_nonce' );

		// Retrieve existing values
		$image_pc = get_post_meta( $post->ID, '_nfd_image_pc', true );
		$image_mobile = get_post_meta( $post->ID, '_nfd_image_mobile', true );
		$end_datetime = get_post_meta( $post->ID, '_nfd_end_datetime', true );
		$loop_hours = get_post_meta( $post->ID, '_nfd_loop_hours', true );
		$target_pages = get_post_meta( $post->ID, '_nfd_target_pages', true );
		if ( ! is_array( $target_pages ) ) $target_pages = array();
		
		$link_url = get_post_meta( $post->ID, '_nfd_link_url', true );
		
		$font_size_pc = get_post_meta( $post->ID, '_nfd_font_size_pc', true ) ?: '24';
		$font_size_mobile = get_post_meta( $post->ID, '_nfd_font_size_mobile', true ) ?: '16';
		$max_width_pc = get_post_meta( $post->ID, '_nfd_max_width_pc', true ) ?: '1000px';

		// Fallbacks from old global settings
		$legacy_font_color = get_post_meta( $post->ID, '_nfd_font_color', true ) ?: '#ffffff';
		$legacy_sep_color = get_post_meta( $post->ID, '_nfd_sep_color', true ) ?: '#ffffff';
		$legacy_bg_enable = get_post_meta( $post->ID, '_nfd_digit_bg_enable', true ) ?: '0';
		$legacy_bg_color = get_post_meta( $post->ID, '_nfd_digit_bg_color', true ) ?: '#000000';
		$legacy_bg_padding = get_post_meta( $post->ID, '_nfd_digit_bg_padding', true ) ?: '5px 10px';
		$legacy_bg_radius = get_post_meta( $post->ID, '_nfd_digit_bg_radius', true ) ?: '5px';

		// PC Specific Settings
		$font_color_pc = get_post_meta( $post->ID, '_nfd_font_color_pc', true ) ?: $legacy_font_color;
		$sep_color_pc = get_post_meta( $post->ID, '_nfd_sep_color_pc', true ) ?: $legacy_sep_color;
		$digit_bg_enable_pc = get_post_meta( $post->ID, '_nfd_digit_bg_enable_pc', true );
		if ($digit_bg_enable_pc === '') $digit_bg_enable_pc = $legacy_bg_enable;
		$digit_bg_color_pc = get_post_meta( $post->ID, '_nfd_digit_bg_color_pc', true ) ?: $legacy_bg_color;
		$digit_bg_padding_pc = get_post_meta( $post->ID, '_nfd_digit_bg_padding_pc', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_pc = get_post_meta( $post->ID, '_nfd_digit_bg_radius_pc', true ) ?: $legacy_bg_radius;
		$auto_gap_pc = get_post_meta( $post->ID, '_nfd_auto_gap_pc', true ) ?: '0.8';

		// Mobile Specific Settings
		$font_color_mobile = get_post_meta( $post->ID, '_nfd_font_color_mobile', true ) ?: $legacy_font_color;
		$sep_color_mobile = get_post_meta( $post->ID, '_nfd_sep_color_mobile', true ) ?: $legacy_sep_color;
		$digit_bg_enable_mobile = get_post_meta( $post->ID, '_nfd_digit_bg_enable_mobile', true );
		if ($digit_bg_enable_mobile === '') $digit_bg_enable_mobile = $legacy_bg_enable;
		$digit_bg_color_mobile = get_post_meta( $post->ID, '_nfd_digit_bg_color_mobile', true ) ?: $legacy_bg_color;
		$digit_bg_padding_mobile = get_post_meta( $post->ID, '_nfd_digit_bg_padding_mobile', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_mobile = get_post_meta( $post->ID, '_nfd_digit_bg_radius_mobile', true ) ?: $legacy_bg_radius;
		$auto_gap_mobile = get_post_meta( $post->ID, '_nfd_auto_gap_mobile', true ) ?: '1.5';
		
		$is_active = get_post_meta( $post->ID, '_nfd_is_active', true );
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
		$digit_pos_pc = get_post_meta( $post->ID, '_nfd_digit_positions_pc', true );
		$digit_pos_pc = is_array($digit_pos_pc) ? array_merge($default_positions, $digit_pos_pc) : $default_positions;
		
		$digit_pos_mobile = get_post_meta( $post->ID, '_nfd_digit_positions_mobile', true );
		$digit_pos_mobile = is_array($digit_pos_mobile) ? array_merge($default_positions, $digit_pos_mobile) : $default_positions;

		$visibility_pc = get_post_meta( $post->ID, '_nfd_digit_visibility_pc', true );
		if ( ! is_array( $visibility_pc ) && $visibility_pc === '' ) {
			// Default all to true (1)
			$visibility_pc = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}
		
		$visibility_mobile = get_post_meta( $post->ID, '_nfd_digit_visibility_mobile', true );
		if ( ! is_array( $visibility_mobile ) && $visibility_mobile === '' ) {
			$visibility_mobile = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}

		// CTAs
		$ctas_bottom = get_post_meta( $post->ID, '_nfd_ctas_bottom', true );
		if ( ! is_array( $ctas_bottom ) ) {
			$ctas_bottom = array(
				'layout' => 'split', // none, full, split
				'btn1' => array('text' => 'สอบถาม', 'link' => '', 'bg_color' => '#00B900', 'color' => '#ffffff', 'icon' => 'line'),
				'btn2' => array('text' => 'โทร', 'link' => '', 'bg_color' => '#f05a28', 'color' => '#ffffff', 'icon' => 'phone')
			);
		}
		
		$ctas_floating = get_post_meta( $post->ID, '_nfd_ctas_floating', true );
		if ( ! is_array( $ctas_floating ) ) $ctas_floating = array();

		// Pages dropdown
		$pages = get_pages();
		
		// Render HTML
		include NFD_FLASHSALE_DIR . 'admin/partials/nfd-flashsale-admin-display.php';
	}

	public function save_meta_boxes( $post_id ) {
		if ( ! isset( $_POST['nfd_flashsale_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['nfd_flashsale_nonce'], 'nfd_flashsale_save_meta' ) ) {
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
			'_nfd_image_pc', '_nfd_image_mobile', '_nfd_end_datetime', 
			'_nfd_loop_hours', '_nfd_link_url', '_nfd_max_width_pc', '_nfd_is_active',
			
			// PC fields
			'_nfd_font_size_pc', '_nfd_font_color_pc', '_nfd_sep_color_pc', 
			'_nfd_digit_bg_enable_pc', '_nfd_digit_bg_color_pc', '_nfd_digit_bg_padding_pc', '_nfd_digit_bg_radius_pc', '_nfd_auto_gap_pc',
			
			// Mobile fields
			'_nfd_font_size_mobile', '_nfd_font_color_mobile', '_nfd_sep_color_mobile', 
			'_nfd_digit_bg_enable_mobile', '_nfd_digit_bg_color_mobile', '_nfd_digit_bg_padding_mobile', '_nfd_digit_bg_radius_mobile', '_nfd_auto_gap_mobile'
		);
		foreach ( $fields as $field ) {
			if ( isset( $_POST[$field] ) ) {
				update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
			} else {
				if ($field === '_nfd_is_active' || $field === '_nfd_digit_bg_enable_pc' || $field === '_nfd_digit_bg_enable_mobile') {
					update_post_meta( $post_id, $field, '0' );
				}
			}
		}

		// Target pages (array)
		if ( isset( $_POST['_nfd_target_pages'] ) && is_array( $_POST['_nfd_target_pages'] ) ) {
			$pages = array_map( 'intval', $_POST['_nfd_target_pages'] );
			update_post_meta( $post_id, '_nfd_target_pages', $pages );
		} else {
			update_post_meta( $post_id, '_nfd_target_pages', array() );
		}

		// Digit positions
		if ( isset( $_POST['_nfd_digit_positions_pc'] ) && is_array( $_POST['_nfd_digit_positions_pc'] ) ) {
			update_post_meta( $post_id, '_nfd_digit_positions_pc', $_POST['_nfd_digit_positions_pc'] );
		}
		if ( isset( $_POST['_nfd_digit_positions_mobile'] ) && is_array( $_POST['_nfd_digit_positions_mobile'] ) ) {
			update_post_meta( $post_id, '_nfd_digit_positions_mobile', $_POST['_nfd_digit_positions_mobile'] );
		}

		// Digit visibility
		$visibility_pc = isset( $_POST['_nfd_digit_visibility_pc'] ) ? $_POST['_nfd_digit_visibility_pc'] : array();
		update_post_meta( $post_id, '_nfd_digit_visibility_pc', $visibility_pc );
		
		$visibility_mobile = isset( $_POST['_nfd_digit_visibility_mobile'] ) ? $_POST['_nfd_digit_visibility_mobile'] : array();
		update_post_meta( $post_id, '_nfd_digit_visibility_mobile', $visibility_mobile );

		// CTAs Bottom
		if ( isset( $_POST['_nfd_ctas_bottom'] ) && is_array( $_POST['_nfd_ctas_bottom'] ) ) {
			$ctas_bottom = wp_unslash( $_POST['_nfd_ctas_bottom'] );
			
			// Process custom icon
			if ( isset($ctas_bottom['btn1']['icon']) && $ctas_bottom['btn1']['icon'] === 'custom' ) {
				$ctas_bottom['btn1']['icon'] = isset($ctas_bottom['btn1']['custom_icon']) ? $ctas_bottom['btn1']['custom_icon'] : '';
			}
			if ( isset($ctas_bottom['btn2']['icon']) && $ctas_bottom['btn2']['icon'] === 'custom' ) {
				$ctas_bottom['btn2']['icon'] = isset($ctas_bottom['btn2']['custom_icon']) ? $ctas_bottom['btn2']['custom_icon'] : '';
			}
			
			unset($ctas_bottom['btn1']['custom_icon']);
			unset($ctas_bottom['btn2']['custom_icon']);

			update_post_meta( $post_id, '_nfd_ctas_bottom', $ctas_bottom );
		}

		// CTAs Floating
		if ( isset( $_POST['_nfd_ctas_floating'] ) && is_array( $_POST['_nfd_ctas_floating'] ) ) {
			// re-index array
			$floating = array_values( wp_unslash( $_POST['_nfd_ctas_floating'] ) );
			update_post_meta( $post_id, '_nfd_ctas_floating', $floating );
		} else {
			update_post_meta( $post_id, '_nfd_ctas_floating', array() );
		}
	}
}
