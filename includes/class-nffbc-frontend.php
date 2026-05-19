<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class NFFBC_Frontend {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	private $active_sale_id = -1;

	private function get_active_flashsale() {
		if ( $this->active_sale_id !== -1 ) {
			return $this->active_sale_id;
		}

		$args = array(
			'post_type'      => 'nffbc_flashsale',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => '_nffbc_is_active',
					'value'   => '1',
					'compare' => '='
				)
			)
		);
		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) {
			$this->active_sale_id = false;
			return false;
		}

		$current_page_id = get_queried_object_id();
		$active_sale = null;

		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			$target_pages = get_post_meta( $post_id, '_nffbc_target_pages', true );
			
			if ( empty( $target_pages ) || ( is_array( $target_pages ) && in_array( $current_page_id, $target_pages ) ) ) {
				$active_sale = $post_id;
				break;
			}
		}

		wp_reset_postdata();

		$this->active_sale_id = $active_sale ? $active_sale : false;
		return $this->active_sale_id;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, NFFBC_FLASHSALE_URL . 'public/css/frontend-style.css', array(), $this->version, 'all' );

		$active_sale = $this->get_active_flashsale();
		if ( $active_sale ) {
			$font_size_pc = get_post_meta( $active_sale, '_nffbc_font_size_pc', true ) ?: '24';
			$font_size_mobile = get_post_meta( $active_sale, '_nffbc_font_size_mobile', true ) ?: '16';
			$max_width_pc = get_post_meta( $active_sale, '_nffbc_max_width_pc', true ) ?: '1000px';

			$legacy_font_color = get_post_meta( $active_sale, '_nffbc_font_color', true ) ?: '#ffffff';
			$legacy_sep_color = get_post_meta( $active_sale, '_nffbc_sep_color', true ) ?: '#ffffff';
			$legacy_bg_enable = get_post_meta( $active_sale, '_nffbc_digit_bg_enable', true ) ?: '0';
			$legacy_bg_color = get_post_meta( $active_sale, '_nffbc_digit_bg_color', true ) ?: '#000000';
			$legacy_bg_padding = get_post_meta( $active_sale, '_nffbc_digit_bg_padding', true ) ?: '5px 10px';
			$legacy_bg_radius = get_post_meta( $active_sale, '_nffbc_digit_bg_radius', true ) ?: '5px';

			$font_color_pc = get_post_meta( $active_sale, '_nffbc_font_color_pc', true ) ?: $legacy_font_color;
			$sep_color_pc = get_post_meta( $active_sale, '_nffbc_sep_color_pc', true ) ?: $legacy_sep_color;
			$digit_bg_enable_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_enable_pc', true );
			if ($digit_bg_enable_pc === '') $digit_bg_enable_pc = $legacy_bg_enable;
			$digit_bg_color_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_color_pc', true ) ?: $legacy_bg_color;
			$digit_bg_padding_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_padding_pc', true ) ?: $legacy_bg_padding;
			$digit_bg_radius_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_radius_pc', true ) ?: $legacy_bg_radius;

			$font_color_mobile = get_post_meta( $active_sale, '_nffbc_font_color_mobile', true ) ?: $legacy_font_color;
			$sep_color_mobile = get_post_meta( $active_sale, '_nffbc_sep_color_mobile', true ) ?: $legacy_sep_color;
			$digit_bg_enable_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_enable_mobile', true );
			if ($digit_bg_enable_mobile === '') $digit_bg_enable_mobile = $legacy_bg_enable;
			$digit_bg_color_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_color_mobile', true ) ?: $legacy_bg_color;
			$digit_bg_padding_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_padding_mobile', true ) ?: $legacy_bg_padding;
			$digit_bg_radius_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_radius_mobile', true ) ?: $legacy_bg_radius;

			$digit_pos_pc = get_post_meta( $active_sale, '_nffbc_digit_positions_pc', true );
			$digit_pos_mobile = get_post_meta( $active_sale, '_nffbc_digit_positions_mobile', true );
			
			$visibility_pc = get_post_meta( $active_sale, '_nffbc_digit_visibility_pc', true );
			if ( ! is_array( $visibility_pc ) && $visibility_pc === '' ) {
				$visibility_pc = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
			}
			
			$visibility_mobile = get_post_meta( $active_sale, '_nffbc_digit_visibility_mobile', true );
			if ( ! is_array( $visibility_mobile ) && $visibility_mobile === '' ) {
				$visibility_mobile = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
			}

			$custom_css = "
				#newfolder-flashsale-banner-with-counter-wrapper {
					max-width: {$max_width_pc} !important;
				}
				@media (min-width: 769px) {
					#newfolder-flashsale-banner-with-counter-wrapper {
						--nffbc-font-size: {$font_size_pc}px;
						--nffbc-font-color: {$font_color_pc};
					}
					#newfolder-flashsale-banner-with-counter-wrapper .nffbc-digit-sep1,
					#newfolder-flashsale-banner-with-counter-wrapper .nffbc-digit-sep2 {
						color: {$sep_color_pc};
					}
			";
			if ( $digit_bg_enable_pc == '1' ) {
				$custom_css .= "
					#newfolder-flashsale-banner-with-counter-wrapper .nffbc-banner-pc .nffbc-digit:not(.nffbc-digit-sep1):not(.nffbc-digit-sep2) {
						background-color: {$digit_bg_color_pc};
						padding: {$digit_bg_padding_pc};
						border-radius: {$digit_bg_radius_pc};
						line-height: 1;
					}
				";
			}
			$custom_css .= "
					.nffbc-banner-pc { display: block; }
					.nffbc-banner-mobile { display: none; }
			";
			$labels = array('h1' => 'H1', 'h2' => 'H2', 'sep1' => ':', 'm1' => 'M1', 'm2' => 'M2', 'sep2' => ':', 's1' => 'S1', 's2' => 'S2');
			foreach ($labels as $digit => $label) {
				if (isset($digit_pos_pc[$digit]) && !empty($visibility_pc[$digit])) {
					$custom_css .= ".nffbc-banner-pc .nffbc-digit-{$digit} { left: {$digit_pos_pc[$digit]['x']}%; top: {$digit_pos_pc[$digit]['y']}%; }\n";
				}
			}
			$custom_css .= "}
				@media (max-width: 768px) {
					#newfolder-flashsale-banner-with-counter-wrapper {
						--nffbc-font-size: {$font_size_mobile}px;
						--nffbc-font-color: {$font_color_mobile};
						max-width: 100% !important;
					}
					#newfolder-flashsale-banner-with-counter-wrapper .nffbc-digit-sep1,
					#newfolder-flashsale-banner-with-counter-wrapper .nffbc-digit-sep2 {
						color: {$sep_color_mobile};
					}
			";
			if ( $digit_bg_enable_mobile == '1' ) {
				$custom_css .= "
					#newfolder-flashsale-banner-with-counter-wrapper .nffbc-banner-mobile .nffbc-digit:not(.nffbc-digit-sep1):not(.nffbc-digit-sep2) {
						background-color: {$digit_bg_color_mobile};
						padding: {$digit_bg_padding_mobile};
						border-radius: {$digit_bg_radius_mobile};
						line-height: 1;
					}
				";
			}
			$custom_css .= "
					.nffbc-banner-pc { display: none; }
					.nffbc-banner-mobile { display: block; }
			";
			foreach ($labels as $digit => $label) {
				if (isset($digit_pos_mobile[$digit]) && !empty($visibility_mobile[$digit])) {
					$custom_css .= ".nffbc-banner-mobile .nffbc-digit-{$digit} { left: {$digit_pos_mobile[$digit]['x']}%; top: {$digit_pos_mobile[$digit]['y']}%; }\n";
				}
			}
			$custom_css .= "}";
			wp_add_inline_style( $this->plugin_name, $custom_css );
		}
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, NFFBC_FLASHSALE_URL . 'public/js/frontend-script.js', array( 'jquery' ), $this->version, true );
	}

	public function render_flashsale_banner() {
		$active_sale = $this->get_active_flashsale();
		if ( ! $active_sale ) return;

		// Fetch meta for active sale
		$image_pc_id = get_post_meta( $active_sale, '_nffbc_image_pc', true );
		$image_mobile_id = get_post_meta( $active_sale, '_nffbc_image_mobile', true );
		
		$image_pc_url = $image_pc_id ? wp_get_attachment_image_url( $image_pc_id, 'full' ) : '';
		$image_mobile_url = $image_mobile_id ? wp_get_attachment_image_url( $image_mobile_id, 'full' ) : '';
		
		// If both are missing, don't show
		if ( ! $image_pc_url && ! $image_mobile_url ) return;
		if ( ! $image_mobile_url ) $image_mobile_url = $image_pc_url; // fallback
		if ( ! $image_pc_url ) $image_pc_url = $image_mobile_url;

		$end_datetime = get_post_meta( $active_sale, '_nffbc_end_datetime', true );
		$loop_hours = get_post_meta( $active_sale, '_nffbc_loop_hours', true ) ?: 0;
		$link_url = get_post_meta( $active_sale, '_nffbc_link_url', true );
		
		$font_size_pc = get_post_meta( $active_sale, '_nffbc_font_size_pc', true ) ?: '24';
		$font_size_mobile = get_post_meta( $active_sale, '_nffbc_font_size_mobile', true ) ?: '16';
		$max_width_pc = get_post_meta( $active_sale, '_nffbc_max_width_pc', true ) ?: '1000px';

		// Legacy fallbacks
		$legacy_font_color = get_post_meta( $active_sale, '_nffbc_font_color', true ) ?: '#ffffff';
		$legacy_sep_color = get_post_meta( $active_sale, '_nffbc_sep_color', true ) ?: '#ffffff';
		$legacy_bg_enable = get_post_meta( $active_sale, '_nffbc_digit_bg_enable', true ) ?: '0';
		$legacy_bg_color = get_post_meta( $active_sale, '_nffbc_digit_bg_color', true ) ?: '#000000';
		$legacy_bg_padding = get_post_meta( $active_sale, '_nffbc_digit_bg_padding', true ) ?: '5px 10px';
		$legacy_bg_radius = get_post_meta( $active_sale, '_nffbc_digit_bg_radius', true ) ?: '5px';

		// PC Settings
		$font_color_pc = get_post_meta( $active_sale, '_nffbc_font_color_pc', true ) ?: $legacy_font_color;
		$sep_color_pc = get_post_meta( $active_sale, '_nffbc_sep_color_pc', true ) ?: $legacy_sep_color;
		$digit_bg_enable_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_enable_pc', true );
		if ($digit_bg_enable_pc === '') $digit_bg_enable_pc = $legacy_bg_enable;
		$digit_bg_color_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_color_pc', true ) ?: $legacy_bg_color;
		$digit_bg_padding_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_padding_pc', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_pc = get_post_meta( $active_sale, '_nffbc_digit_bg_radius_pc', true ) ?: $legacy_bg_radius;

		// Mobile Settings
		$font_color_mobile = get_post_meta( $active_sale, '_nffbc_font_color_mobile', true ) ?: $legacy_font_color;
		$sep_color_mobile = get_post_meta( $active_sale, '_nffbc_sep_color_mobile', true ) ?: $legacy_sep_color;
		$digit_bg_enable_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_enable_mobile', true );
		if ($digit_bg_enable_mobile === '') $digit_bg_enable_mobile = $legacy_bg_enable;
		$digit_bg_color_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_color_mobile', true ) ?: $legacy_bg_color;
		$digit_bg_padding_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_padding_mobile', true ) ?: $legacy_bg_padding;
		$digit_bg_radius_mobile = get_post_meta( $active_sale, '_nffbc_digit_bg_radius_mobile', true ) ?: $legacy_bg_radius;

		$digit_pos_pc = get_post_meta( $active_sale, '_nffbc_digit_positions_pc', true );
		$digit_pos_mobile = get_post_meta( $active_sale, '_nffbc_digit_positions_mobile', true );
		
		$visibility_pc = get_post_meta( $active_sale, '_nffbc_digit_visibility_pc', true );
		if ( ! is_array( $visibility_pc ) && $visibility_pc === '' ) {
			$visibility_pc = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}
		
		$visibility_mobile = get_post_meta( $active_sale, '_nffbc_digit_visibility_mobile', true );
		if ( ! is_array( $visibility_mobile ) && $visibility_mobile === '' ) {
			$visibility_mobile = array('h1'=>1, 'h2'=>1, 'sep1'=>1, 'm1'=>1, 'm2'=>1, 'sep2'=>1, 's1'=>1, 's2'=>1);
		}

		$ctas_bottom = get_post_meta( $active_sale, '_nffbc_ctas_bottom', true );
		if ( ! is_array( $ctas_bottom ) ) {
			$ctas_bottom = array(
				'layout' => 'split',
				'btn1' => array('text' => 'สอบถาม', 'link' => '', 'bg_color' => '#00B900', 'color' => '#ffffff', 'icon' => 'line'),
				'btn2' => array('text' => 'โทร', 'link' => '', 'bg_color' => '#f05a28', 'color' => '#ffffff', 'icon' => 'phone')
			);
		}
		$ctas_floating = get_post_meta( $active_sale, '_nffbc_ctas_floating', true );
		if ( ! is_array( $ctas_floating ) ) $ctas_floating = array();

		// Pass data to JS
		$js_data = array(
			'endTime' => $end_datetime,
			'loopHours' => intval( $loop_hours )
		);
		wp_localize_script( $this->plugin_name, 'nffbc_flashsale_data', $js_data );

		include NFFBC_FLASHSALE_DIR . 'public/partials/newfolder-flashsale-banner-with-counter-public-display.php';
	}
}
