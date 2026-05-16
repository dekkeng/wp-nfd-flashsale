<?php

class NFD_Frontend {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, NFD_FLASHSALE_URL . 'public/css/frontend-style.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, NFD_FLASHSALE_URL . 'public/js/frontend-script.js', array( 'jquery' ), $this->version, true );
	}

	public function render_flashsale_banner() {
		// Query active flash sales
		$args = array(
			'post_type'      => 'nfd_flashsale',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => '_nfd_is_active',
					'value'   => '1',
					'compare' => '='
				)
			)
		);
		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) return;

		$current_page_id = get_queried_object_id();
		$active_sale = null;

		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			$target_pages = get_post_meta( $post_id, '_nfd_target_pages', true );
			
			if ( empty( $target_pages ) || in_array( $current_page_id, $target_pages ) ) {
				$active_sale = $post_id;
				break;
			}
		}

		wp_reset_postdata();

		if ( ! $active_sale ) return;

		// Fetch meta for active sale
		$image_pc_id = get_post_meta( $active_sale, '_nfd_image_pc', true );
		$image_mobile_id = get_post_meta( $active_sale, '_nfd_image_mobile', true );
		
		$image_pc_url = $image_pc_id ? wp_get_attachment_image_url( $image_pc_id, 'full' ) : '';
		$image_mobile_url = $image_mobile_id ? wp_get_attachment_image_url( $image_mobile_id, 'full' ) : '';
		
		// If both are missing, don't show
		if ( ! $image_pc_url && ! $image_mobile_url ) return;
		if ( ! $image_mobile_url ) $image_mobile_url = $image_pc_url; // fallback
		if ( ! $image_pc_url ) $image_pc_url = $image_mobile_url;

		$end_datetime = get_post_meta( $active_sale, '_nfd_end_datetime', true );
		$loop_hours = get_post_meta( $active_sale, '_nfd_loop_hours', true ) ?: 0;
		$link_url = get_post_meta( $active_sale, '_nfd_link_url', true );
		
		$font_size_pc = get_post_meta( $active_sale, '_nfd_font_size_pc', true ) ?: '24';
		$font_size_mobile = get_post_meta( $active_sale, '_nfd_font_size_mobile', true ) ?: '16';
		$max_width_pc = get_post_meta( $active_sale, '_nfd_max_width_pc', true ) ?: '1000px';

		// Legacy fallbacks
		$legacy_font_color = get_post_meta( $active_sale, '_nfd_font_color', true ) ?: '#ffffff';
		$legacy_sep_color = get_post_meta( $active_sale, '_nfd_sep_color', true ) ?: '#ffffff';
		$legacy_bg_enable = get_post_meta( $active_sale, '_nfd_digit_bg_enable', true ) ?: '0';
		$legacy_bg_color = get_post_meta( $active_sale, '_nfd_digit_bg_color', true ) ?: '#000000';
		$legacy_bg_padding = get_post_meta( $active_sale, '_nfd_digit_bg_padding', true ) ?: '5px 10px';
		$legacy_bg_radius = get_post_meta( $active_sale, '_nfd_digit_bg_radius', true ) ?: '5px';

		// PC Settings
		$font_color_pc = get_post_meta( $active_sale, '_nfd_font_color_pc', true ) ?: $legacy_font_color;
		$sep_color_pc = get_post_meta( $active_sale, '_nfd_sep_color_pc', true ) ?: $legacy_sep_color;
		$digit_bg_enable_pc = get_post_meta( $active_sale, '_nfd_digit_bg_enable_pc', true );
		if ($digit_bg_enable_pc === '') $digit_bg_enable_pc = $legacy_bg_enable;
		$digit_bg_color_pc = get_post_meta( $active_sale, '_nfd_digit_bg_color_pc', true ) ?: $legacy_bg_color;
		$digit_bg_padding_pc = get_post_meta( $active_sale, '_nfd_digit_bg_padding_pc', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_pc = get_post_meta( $active_sale, '_nfd_digit_bg_radius_pc', true ) ?: $legacy_bg_radius;

		// Mobile Settings
		$font_color_mobile = get_post_meta( $active_sale, '_nfd_font_color_mobile', true ) ?: $legacy_font_color;
		$sep_color_mobile = get_post_meta( $active_sale, '_nfd_sep_color_mobile', true ) ?: $legacy_sep_color;
		$digit_bg_enable_mobile = get_post_meta( $active_sale, '_nfd_digit_bg_enable_mobile', true );
		if ($digit_bg_enable_mobile === '') $digit_bg_enable_mobile = $legacy_bg_enable;
		$digit_bg_color_mobile = get_post_meta( $active_sale, '_nfd_digit_bg_color_mobile', true ) ?: $legacy_bg_color;
		$digit_bg_padding_mobile = get_post_meta( $active_sale, '_nfd_digit_bg_padding_mobile', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_mobile = get_post_meta( $active_sale, '_nfd_digit_bg_radius_mobile', true ) ?: $legacy_bg_radius;

		$digit_pos_pc = get_post_meta( $active_sale, '_nfd_digit_positions_pc', true );
		$digit_pos_mobile = get_post_meta( $active_sale, '_nfd_digit_positions_mobile', true );
		
		$visibility_pc = get_post_meta( $active_sale, '_nfd_digit_visibility_pc', true );
		if ( ! is_array( $visibility_pc ) && $visibility_pc === '' ) {
			$visibility_pc = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}
		
		$visibility_mobile = get_post_meta( $active_sale, '_nfd_digit_visibility_mobile', true );
		if ( ! is_array( $visibility_mobile ) && $visibility_mobile === '' ) {
			$visibility_mobile = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}

		$ctas_bottom = get_post_meta( $active_sale, '_nfd_ctas_bottom', true );
		if ( ! is_array( $ctas_bottom ) ) {
			$ctas_bottom = array(
				'layout' => 'split',
				'btn1' => array('text' => 'สอบถาม', 'link' => '', 'bg_color' => '#00B900', 'color' => '#ffffff', 'icon' => 'line'),
				'btn2' => array('text' => 'โทร', 'link' => '', 'bg_color' => '#f05a28', 'color' => '#ffffff', 'icon' => 'phone')
			);
		}
		$ctas_floating = get_post_meta( $active_sale, '_nfd_ctas_floating', true );
		if ( ! is_array( $ctas_floating ) ) $ctas_floating = array();

		// Pass data to JS
		$js_data = array(
			'endTime' => $end_datetime,
			'loopHours' => intval( $loop_hours )
		);
		wp_localize_script( $this->plugin_name, 'nfd_flashsale_data', $js_data );

		include NFD_FLASHSALE_DIR . 'public/partials/nfd-flashsale-public-display.php';
	}
}
