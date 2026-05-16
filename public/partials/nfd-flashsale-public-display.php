<?php
// Function to render icon
if (!function_exists('nfd_render_icon')) {
	function nfd_render_icon($icon, $fonticon = '') {
		if ( ! empty( $fonticon ) ) {
			return '<i class="' . esc_attr( $fonticon ) . ' nfd-btn-icon" style="vertical-align: middle; margin-right: 5px;"></i>';
		}
		if ( $icon === 'line' ) {
			return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="nfd-btn-icon" style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 5px;"><path d="M448 256c0-106-100.3-192-224-192S0 150 0 256c0 94.7 79.5 174.1 184.2 189.6 8 1.2 18.7 3.7 21.4 10.5 2.5 6.2 1.9 16.1 1.4 22.4-.6 7.3-3.8 21.8 19.3 12 23.1-9.8 124.6-73.4 167.3-124 30.6-36.3 54.4-78.5 54.4-110.5zM128 320c0 4.4-3.6 8-8 8H96c-4.4 0-8-3.6-8-8V192c0-4.4 3.6-8 8-8h24c4.4 0 8 3.6 8 8v128zm64-64c0 4.4-3.6 8-8 8h-32v48c0 4.4-3.6 8-8 8h-24c-4.4 0-8-3.6-8-8V192c0-4.4 3.6-8 8-8h24c4.4 0 8 3.6 8 8v48h32c4.4 0 8 3.6 8 8v16zm80 72c0 4.4-3.6 8-8 8h-24c-4.4 0-8-3.6-8-8v-64l-48 68c-1.6 2.4-4 4-6.8 4h-21.2c-4.4 0-8-3.6-8-8V192c0-4.4 3.6-8 8-8h24c4.4 0 8 3.6 8 8v64l48-68c1.6-2.4 4-4 6.8-4h21.2c4.4 0 8 3.6 8 8v136zm80-16c0 4.4-3.6 8-8 8h-48v16h48c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8h-72c-4.4 0-8-3.6-8-8V192c0-4.4 3.6-8 8-8h72c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8h-48v16h48c4.4 0 8 3.6 8 8v16z"/></svg>';
		} else if ( $icon === 'phone' ) {
			return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="nfd-btn-icon" style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 5px;"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>';
		} else if ( $icon === 'facebook' ) {
			return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="nfd-btn-icon" style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 5px;"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.8 90.7 226.4 209.3 245V327.7h-63V256h63v-54.6c0-62.2 37-96.5 93.7-96.5 27.1 0 55.5 4.8 55.5 4.8v61h-31.3c-30.8 0-40.4 19.1-40.4 38.7V256h68.8l-11 71.7h-57.8V501C413.3 482.4 504 379.8 504 256z"/></svg>';
		} else if ( $icon === 'messenger' ) {
			return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="nfd-btn-icon" style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 5px;"><path d="M256.5 8C116.3 8 8 110.3 8 248.6c0 76.3 35.8 144 92.5 188.7V504l81.6-45c23.6 6.6 48.7 10 74.4 10 140.2 0 248.5-102.3 248.5-240.6C505 110.3 396.7 8 256.5 8zm118.8 322.6l-60.7-97-111 97-120.3-97 122.6 131 60.7 97 111-97 120.3 97-122.6-131z"/></svg>';
		} else if ( $icon === 'cart' ) {
			return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" class="nfd-btn-icon" style="width: 1.2em; height: 1.2em; vertical-align: middle; margin-right: 5px;"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41.1 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>';
		} else if ( is_numeric($icon) ) {
			return '<img src="' . esc_url(wp_get_attachment_url($icon)) . '" alt="" class="nfd-btn-icon" style="vertical-align: middle; margin-right: 5px;">';
		}
		return '';
	}
}

// Generate dynamic CSS for positions
$custom_css = "
	#nfd-flashsale-wrapper {
		max-width: {$max_width_pc} !important;
	}
";

$custom_css .= "
	@media (min-width: 769px) {
		#nfd-flashsale-wrapper {
			--nfd-font-size: {$font_size_pc}px;
			--nfd-font-color: {$font_color_pc};
		}
		#nfd-flashsale-wrapper .nfd-digit-sep1,
		#nfd-flashsale-wrapper .nfd-digit-sep2 {
			color: {$sep_color_pc};
		}
";
if ( $digit_bg_enable_pc == '1' ) {
	$custom_css .= "
		#nfd-flashsale-wrapper .nfd-banner-pc .nfd-digit:not(.nfd-digit-sep1):not(.nfd-digit-sep2) {
			background-color: {$digit_bg_color_pc};
			padding: {$digit_bg_padding_pc};
			border-radius: {$digit_bg_radius_pc};
			line-height: 1;
		}
	";
}
$custom_css .= "
		.nfd-banner-pc { display: block; }
		.nfd-banner-mobile { display: none; }
";
$labels = array('h1' => 'H1', 'h2' => 'H2', 'sep1' => ':', 'm1' => 'M1', 'm2' => 'M2', 'sep2' => ':', 's1' => 'S1', 's2' => 'S2');
foreach ($labels as $digit => $label) {
	if (isset($digit_pos_pc[$digit]) && !empty($visibility_pc[$digit])) {
		$custom_css .= ".nfd-banner-pc .nfd-digit-{$digit} { left: {$digit_pos_pc[$digit]['x']}%; top: {$digit_pos_pc[$digit]['y']}%; }\n";
	}
}
$custom_css .= "}
	@media (max-width: 768px) {
		#nfd-flashsale-wrapper {
			--nfd-font-size: {$font_size_mobile}px;
			--nfd-font-color: {$font_color_mobile};
			max-width: 100% !important;
		}
		#nfd-flashsale-wrapper .nfd-digit-sep1,
		#nfd-flashsale-wrapper .nfd-digit-sep2 {
			color: {$sep_color_mobile};
		}
";
if ( $digit_bg_enable_mobile == '1' ) {
	$custom_css .= "
		#nfd-flashsale-wrapper .nfd-banner-mobile .nfd-digit:not(.nfd-digit-sep1):not(.nfd-digit-sep2) {
			background-color: {$digit_bg_color_mobile};
			padding: {$digit_bg_padding_mobile};
			border-radius: {$digit_bg_radius_mobile};
			line-height: 1;
		}
	";
}
$custom_css .= "
		.nfd-banner-pc { display: none; }
		.nfd-banner-mobile { display: block; }
";
foreach ($labels as $digit => $label) {
	if (isset($digit_pos_mobile[$digit]) && !empty($visibility_mobile[$digit])) {
		$custom_css .= ".nfd-banner-mobile .nfd-digit-{$digit} { left: {$digit_pos_mobile[$digit]['x']}%; top: {$digit_pos_mobile[$digit]['y']}%; }\n";
	}
}
$custom_css .= "}";
?>

<style>
	<?php echo $custom_css; ?>
</style>

<div id="nfd-flashsale-wrapper" style="display:none;">
	<!-- Floating CTAs -->
	<?php if ( ! empty( $ctas_floating ) ) : ?>
		<div class="nfd-floating-ctas">
			<?php foreach ( $ctas_floating as $cta ) : 
				if ( empty( $cta['icon'] ) && empty( $cta['fonticon'] ) ) continue;
				$pos_class = 'nfd-floating-' . esc_attr( $cta['position'] );
			?>
				<a href="<?php echo esc_url( $cta['link'] ); ?>" class="nfd-floating-cta <?php echo $pos_class; ?>" target="_blank" rel="noopener noreferrer">
					<?php if ( ! empty( $cta['fonticon'] ) ) : ?>
						<i class="<?php echo esc_attr( $cta['fonticon'] ); ?>" style="font-size: 2em;"></i>
					<?php else : 
						$icon_url = wp_get_attachment_url( $cta['icon'] );
					?>
						<img src="<?php echo esc_url( $icon_url ); ?>" alt="CTA">
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<!-- Banner PC -->
	<div class="nfd-banner nfd-banner-pc">
		<?php if ( $link_url ) : ?>
			<a href="<?php echo esc_url( $link_url ); ?>" class="nfd-banner-link" target="_blank" rel="noopener noreferrer">
		<?php endif; ?>
		
		<img src="<?php echo esc_url( $image_pc_url ); ?>" alt="Flash Sale">
		<div class="nfd-timer-overlay">
			<?php foreach ($labels as $digit => $label) : 
				if (empty($visibility_pc[$digit])) continue;
				if ($digit === 'sep1' || $digit === 'sep2') {
					echo '<span class="nfd-digit nfd-digit-' . $digit . '">:</span>';
				} else {
					echo '<span class="nfd-digit nfd-digit-' . $digit . '" data-val="0">0</span>';
				}
			endforeach; ?>
		</div>

		<?php if ( $link_url ) : ?>
			</a>
		<?php endif; ?>
	</div>

	<!-- Banner Mobile -->
	<div class="nfd-banner nfd-banner-mobile">
		<?php if ( $link_url ) : ?>
			<a href="<?php echo esc_url( $link_url ); ?>" class="nfd-banner-link" target="_blank" rel="noopener noreferrer">
		<?php endif; ?>
		
		<img src="<?php echo esc_url( $image_mobile_url ); ?>" alt="Flash Sale">
		<div class="nfd-timer-overlay">
			<?php foreach ($labels as $digit => $label) : 
				if (empty($visibility_mobile[$digit])) continue;
				if ($digit === 'sep1' || $digit === 'sep2') {
					echo '<span class="nfd-digit nfd-digit-' . $digit . '">:</span>';
				} else {
					echo '<span class="nfd-digit nfd-digit-' . $digit . '" data-val="0">0</span>';
				}
			endforeach; ?>
		</div>

		<?php if ( $link_url ) : ?>
			</a>
		<?php endif; ?>
	</div>

	<!-- Bottom CTAs -->
	<?php if ( isset($ctas_bottom['layout']) && $ctas_bottom['layout'] !== 'none' ) : ?>
		<div class="nfd-bottom-bar nfd-layout-<?php echo esc_attr($ctas_bottom['layout']); ?>">
			
			<?php if ( in_array($ctas_bottom['layout'], array('full', 'split')) ) : 
				$btn1 = $ctas_bottom['btn1'];
			?>
				<a href="<?php echo esc_url($btn1['link']); ?>" class="nfd-bottom-btn nfd-btn-1" target="_blank" rel="noopener noreferrer" style="background-color: <?php echo esc_attr($btn1['bg_color']); ?>; color: <?php echo esc_attr($btn1['color']); ?>;">
					<?php echo nfd_render_icon($btn1['icon'], isset($btn1['fonticon']) ? $btn1['fonticon'] : ''); ?>
					<span class="nfd-btn-text"><?php echo esc_html($btn1['text']); ?></span>
				</a>
			<?php endif; ?>

			<?php if ( $ctas_bottom['layout'] === 'split' ) : 
				$btn2 = $ctas_bottom['btn2'];
			?>
				<a href="<?php echo esc_url($btn2['link']); ?>" class="nfd-bottom-btn nfd-btn-2" target="_blank" rel="noopener noreferrer" style="background-color: <?php echo esc_attr($btn2['bg_color']); ?>; color: <?php echo esc_attr($btn2['color']); ?>;">
					<?php echo nfd_render_icon($btn2['icon'], isset($btn2['fonticon']) ? $btn2['fonticon'] : ''); ?>
					<span class="nfd-btn-text"><?php echo esc_html($btn2['text']); ?></span>
				</a>
			<?php endif; ?>

		</div>
	<?php endif; ?>
</div>
