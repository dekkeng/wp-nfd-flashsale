<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">
	<h2><?php esc_html_e( 'Flash Sale Configuration', 'nffbc-flashsale' ); ?></h2>
	
	<table class="form-table">
		<tr>
			<th><label for="_nffbc_is_active"><?php esc_html_e( 'Active', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<input type="checkbox" name="_nffbc_is_active" id="_nffbc_is_active" value="1" <?php checked( $is_active, '1' ); ?> />
				<span class="description"><?php esc_html_e( 'Check to enable this flash sale', 'nffbc-flashsale' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="_nffbc_target_pages"><?php esc_html_e( 'Target Pages', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<div style="max-height: 150px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; max-width: 300px; background: #fff;">
					<?php foreach ( $pages as $page ) : ?>
						<label style="display: block; margin-bottom: 5px;">
							<input type="checkbox" name="_nffbc_target_pages[]" value="<?php echo esc_attr( $page->ID ); ?>" <?php echo in_array( $page->ID, $target_pages ) ? 'checked="checked"' : ''; ?> />
							<?php echo esc_html( $page->post_title ); ?>
						</label>
					<?php endforeach; ?>
				</div>
				<p class="description"><?php esc_html_e( 'Select pages to display the banner. Leave empty to show on all pages.', 'nffbc-flashsale' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="_nffbc_end_datetime"><?php esc_html_e( 'End Date & Time', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<input type="datetime-local" name="_nffbc_end_datetime" id="_nffbc_end_datetime" value="<?php echo esc_attr( $end_datetime ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="_nffbc_loop_hours"><?php esc_html_e( 'Loop Hours', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<input type="number" name="_nffbc_loop_hours" id="_nffbc_loop_hours" value="<?php echo esc_attr( $loop_hours ); ?>" step="1" min="0" />
				<p class="description"><?php esc_html_e( 'Hours to add when timer reaches zero. Set to 0 to make it disappear when time is up.', 'nffbc-flashsale' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="_nffbc_link_url"><?php esc_html_e( 'Banner Link URL', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<input type="url" name="_nffbc_link_url" id="_nffbc_link_url" class="regular-text" value="<?php echo esc_attr( $link_url ); ?>" />
			</td>
		</tr>
	</table>

	<hr>

	<h3><?php esc_html_e( 'Appearance', 'nffbc-flashsale' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="_nffbc_max_width_pc"><?php esc_html_e( 'PC Max Width', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<input type="text" name="_nffbc_max_width_pc" id="_nffbc_max_width_pc" value="<?php echo esc_attr( $max_width_pc ); ?>" class="regular-text" placeholder="e.g. 1000px or 100%" />
				<p class="description"><?php esc_html_e( 'Maximum width for the PC layout.', 'nffbc-flashsale' ); ?></p>
			</td>
		</tr>
	</table>

	<hr>

	<h3><?php esc_html_e( 'Images, Styling & Timer Positions', 'nffbc-flashsale' ); ?></h3>
	<p class="description"><?php esc_html_e( 'Configure separate styling and positions for PC and Mobile.', 'nffbc-flashsale' ); ?></p>
	
	<div class="nffbc-image-section">
		<h4><?php esc_html_e( 'PC Layout', 'nffbc-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label for="_nffbc_font_size_pc"><?php esc_html_e( 'Font Size (px)', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="number" name="_nffbc_font_size_pc" id="_nffbc_font_size_pc" value="<?php echo esc_attr( $font_size_pc ); ?>" /></td>
			</tr>
			<tr>
				<th><label for="_nffbc_font_color_pc"><?php esc_html_e( 'Text/Digit Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_font_color_pc" id="_nffbc_font_color_pc" value="<?php echo esc_attr( $font_color_pc ); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr>
				<th><label for="_nffbc_sep_color_pc"><?php esc_html_e( 'Separator (:) Color', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<input type="text" name="_nffbc_sep_color_pc" id="_nffbc_sep_color_pc" value="<?php echo esc_attr( $sep_color_pc ); ?>" class="nffbc-color-picker" />
					<p class="description"><?php esc_html_e( 'Color for the ":" characters (useful if they are outside the digit background).', 'nffbc-flashsale' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><label for="_nffbc_digit_bg_enable_pc"><?php esc_html_e( 'Digit Background Enable', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<input type="checkbox" name="_nffbc_digit_bg_enable_pc" id="_nffbc_digit_bg_enable_pc" value="1" <?php checked( $digit_bg_enable_pc, '1' ); ?> />
					<?php esc_html_e( 'Add background box to digits (H1, H2, M1, M2, S1, S2)', 'nffbc-flashsale' ); ?>
				</td>
			</tr>
			<tr class="nffbc-digit-bg-settings-pc" style="<?php echo $digit_bg_enable_pc ? '' : 'display:none;'; ?>">
				<th><label for="_nffbc_digit_bg_color_pc"><?php esc_html_e( 'Digit Background Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_digit_bg_color_pc" id="_nffbc_digit_bg_color_pc" value="<?php echo esc_attr( $digit_bg_color_pc ); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr class="nffbc-digit-bg-settings-pc" style="<?php echo $digit_bg_enable_pc ? '' : 'display:none;'; ?>">
				<th><label for="_nffbc_digit_bg_padding_pc"><?php esc_html_e( 'Digit Padding', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_digit_bg_padding_pc" id="_nffbc_digit_bg_padding_pc" value="<?php echo esc_attr( $digit_bg_padding_pc ); ?>" class="regular-text" placeholder="e.g. 5px 10px" /></td>
			</tr>
			<tr class="nffbc-digit-bg-settings-pc" style="<?php echo $digit_bg_enable_pc ? '' : 'display:none;'; ?>">
				<th><label for="_nffbc_digit_bg_radius_pc"><?php esc_html_e( 'Digit Border Radius', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_digit_bg_radius_pc" id="_nffbc_digit_bg_radius_pc" value="<?php echo esc_attr( $digit_bg_radius_pc ); ?>" class="regular-text" placeholder="e.g. 5px" /></td>
			</tr>
		</table>

		<h4 style="margin-top:20px;"><?php esc_html_e( 'PC Background Image', 'nffbc-flashsale' ); ?></h4>
		<input type="hidden" name="_nffbc_image_pc" id="_nffbc_image_pc" value="<?php echo esc_attr( $image_pc ); ?>" />
		<button type="button" class="button nffbc-upload-btn" data-target="_nffbc_image_pc" data-preview="preview_pc"><?php esc_html_e( 'Upload/Select Image', 'nffbc-flashsale' ); ?></button>
		<button type="button" class="button nffbc-remove-btn" data-target="_nffbc_image_pc" data-preview="preview_pc"><?php esc_html_e( 'Remove', 'nffbc-flashsale' ); ?></button>
		
		<div style="padding: 10px; background: #fff; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 4px;">
			<strong><?php esc_html_e('Visible Digits:', 'nffbc-flashsale' ); ?></strong>
			<?php 
			$nffbc_labels = array('h1' => 'H1', 'h2' => 'H2', 'sep1' => ':', 'm1' => 'M1', 'm2' => 'M2', 'sep2' => ':', 's1' => 'S1', 's2' => 'S2');
			foreach ($nffbc_labels as $nffbc_digit => $nffbc_label) : ?>
				<label style="margin-right: 15px;">
					<input type="checkbox" name="_nffbc_digit_visibility_pc[<?php echo esc_attr($nffbc_digit); ?>]" value="1" class="nffbc-digit-toggle" data-device="pc" data-digit="<?php echo esc_attr($nffbc_digit); ?>" <?php checked(!empty($visibility_pc[$nffbc_digit])); ?> />
					<?php echo esc_html($nffbc_label); ?>
				</label>
			<?php endforeach; ?>
		</div>
		
		<div class="nffbc-preview-wrap" id="preview_pc" style="max-width:800px; border:1px solid #ccc; position:relative;">
			<?php if ( $image_pc ) : ?>
				<?php echo wp_get_attachment_image( $image_pc, 'full', false, array('style' => 'width:100%; height:auto; display:block;') ); ?>
			<?php else : ?>
				<div class="nffbc-no-image-text" style="padding:40px; text-align:center; background:#f1f1f1;"><?php esc_html_e( 'No image selected', 'nffbc-flashsale' ); ?></div>
			<?php endif; ?>
			<div class="nffbc-timer-overlay" data-device="pc" style="color: <?php echo esc_attr($font_color_pc); ?>; font-size: <?php echo esc_attr($font_size_pc); ?>px;">
				<?php foreach ($nffbc_labels as $nffbc_digit => $nffbc_label) : 
					$nffbc_is_visible = !empty($visibility_pc[$nffbc_digit]);
					$nffbc_preview_char = ($nffbc_digit === 'sep1' || $nffbc_digit === 'sep2') ? ':' : '8';
				?>
					<div class="nffbc-digit nffbc-digit-<?php echo esc_attr($nffbc_digit); ?>" data-digit="<?php echo esc_attr($nffbc_digit); ?>" title="Drag to position <?php echo esc_html($nffbc_label); ?>" style="left:<?php echo esc_attr($digit_pos_pc[$nffbc_digit]['x']); ?>%; top:<?php echo esc_attr($digit_pos_pc[$nffbc_digit]['y']); ?>%; display: <?php echo $nffbc_is_visible ? 'block' : 'none'; ?>; position:absolute; cursor:move;">
						<?php echo esc_html($nffbc_preview_char); ?>
						<span style="position:absolute; top:-8px; right:-15px; font-size:10px; font-weight:normal; background:rgba(0,0,0,0.7); color:#fff; padding:2px 4px; border-radius:3px; line-height:1; font-family:sans-serif; letter-spacing:0;"><?php echo esc_html($nffbc_label); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
			
		<div class="nffbc-digit-positions-manual" style="margin-top:15px; padding:10px; background:#fff; border:1px solid #ddd; border-radius: 4px;">
			<div style="display:flex; justify-content:space-between; align-items:center;">
				<strong><?php esc_html_e('Manual Positions (%):', 'nffbc-flashsale' ); ?></strong>
				<div>
					<label style="margin-right: 10px; font-size: 13px;">Gap (%): 
						<input type="number" step="0.1" name="_nffbc_auto_gap_pc" class="nffbc-auto-gap" value="<?php echo esc_attr($auto_gap_pc); ?>" style="width: 60px;">
					</label>
					<button type="button" class="button nffbc-auto-align-btn" data-device="pc"><?php esc_html_e('Auto Align (from H1)', 'nffbc-flashsale' ); ?></button>
				</div>
			</div>
			<div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
				<?php foreach ($nffbc_labels as $nffbc_digit => $nffbc_label) : ?>
				<div style="border:1px solid #eee; padding:5px 10px; background:#f9f9f9; border-radius:4px;">
					<div style="font-weight:bold; text-align:center; margin-bottom:5px; border-bottom:1px solid #ddd; padding-bottom:3px;"><?php echo esc_html($nffbc_label); ?></div>
					X: <input type="number" step="any" name="_nffbc_digit_positions_pc[<?php echo esc_attr($nffbc_digit); ?>][x]" class="pos-input pos-x" data-device="pc" data-digit="<?php echo esc_attr($nffbc_digit); ?>" value="<?php echo esc_attr($digit_pos_pc[$nffbc_digit]['x']); ?>" style="width:70px; font-size:12px;">
					<br>
					Y: <input type="number" step="any" name="_nffbc_digit_positions_pc[<?php echo esc_attr($nffbc_digit); ?>][y]" class="pos-input pos-y" data-device="pc" data-digit="<?php echo esc_attr($nffbc_digit); ?>" value="<?php echo esc_attr($digit_pos_pc[$nffbc_digit]['y']); ?>" style="width:70px; font-size:12px; margin-top:5px;">
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="nffbc-image-section" style="margin-top:40px; padding-top:20px; border-top:1px dashed #ccc;">
		<h4><?php esc_html_e( 'Mobile Layout', 'nffbc-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label for="_nffbc_font_size_mobile"><?php esc_html_e( 'Font Size (px)', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="number" name="_nffbc_font_size_mobile" id="_nffbc_font_size_mobile" value="<?php echo esc_attr( $font_size_mobile ); ?>" /></td>
			</tr>
			<tr>
				<th><label for="_nffbc_font_color_mobile"><?php esc_html_e( 'Text/Digit Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_font_color_mobile" id="_nffbc_font_color_mobile" value="<?php echo esc_attr( $font_color_mobile ); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr>
				<th><label for="_nffbc_sep_color_mobile"><?php esc_html_e( 'Separator (:) Color', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<input type="text" name="_nffbc_sep_color_mobile" id="_nffbc_sep_color_mobile" value="<?php echo esc_attr( $sep_color_mobile ); ?>" class="nffbc-color-picker" />
					<p class="description"><?php esc_html_e( 'Color for the ":" characters (useful if they are outside the digit background).', 'nffbc-flashsale' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><label for="_nffbc_digit_bg_enable_mobile"><?php esc_html_e( 'Digit Background Enable', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<input type="checkbox" name="_nffbc_digit_bg_enable_mobile" id="_nffbc_digit_bg_enable_mobile" value="1" <?php checked( $digit_bg_enable_mobile, '1' ); ?> />
					<?php esc_html_e( 'Add background box to digits (H1, H2, M1, M2, S1, S2)', 'nffbc-flashsale' ); ?>
				</td>
			</tr>
			<tr class="nffbc-digit-bg-settings-mobile" style="<?php echo $digit_bg_enable_mobile ? '' : 'display:none;'; ?>">
				<th><label for="_nffbc_digit_bg_color_mobile"><?php esc_html_e( 'Digit Background Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_digit_bg_color_mobile" id="_nffbc_digit_bg_color_mobile" value="<?php echo esc_attr( $digit_bg_color_mobile ); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr class="nffbc-digit-bg-settings-mobile" style="<?php echo $digit_bg_enable_mobile ? '' : 'display:none;'; ?>">
				<th><label for="_nffbc_digit_bg_padding_mobile"><?php esc_html_e( 'Digit Padding', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_digit_bg_padding_mobile" id="_nffbc_digit_bg_padding_mobile" value="<?php echo esc_attr( $digit_bg_padding_mobile ); ?>" class="regular-text" placeholder="e.g. 5px 10px" /></td>
			</tr>
			<tr class="nffbc-digit-bg-settings-mobile" style="<?php echo $digit_bg_enable_mobile ? '' : 'display:none;'; ?>">
				<th><label for="_nffbc_digit_bg_radius_mobile"><?php esc_html_e( 'Digit Border Radius', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_digit_bg_radius_mobile" id="_nffbc_digit_bg_radius_mobile" value="<?php echo esc_attr( $digit_bg_radius_mobile ); ?>" class="regular-text" placeholder="e.g. 5px" /></td>
			</tr>
		</table>

		<h4 style="margin-top:20px;"><?php esc_html_e( 'Mobile Background Image', 'nffbc-flashsale' ); ?></h4>
		<input type="hidden" name="_nffbc_image_mobile" id="_nffbc_image_mobile" value="<?php echo esc_attr( $image_mobile ); ?>" />
		<button type="button" class="button nffbc-upload-btn" data-target="_nffbc_image_mobile" data-preview="preview_mobile"><?php esc_html_e( 'Upload/Select Image', 'nffbc-flashsale' ); ?></button>
		<button type="button" class="button nffbc-remove-btn" data-target="_nffbc_image_mobile" data-preview="preview_mobile"><?php esc_html_e( 'Remove', 'nffbc-flashsale' ); ?></button>
		
		<div style="padding: 10px; background: #fff; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 4px;">
			<strong><?php esc_html_e('Visible Digits:', 'nffbc-flashsale' ); ?></strong>
			<?php foreach ($nffbc_labels as $nffbc_digit => $nffbc_label) : ?>
				<label style="margin-right: 10px;">
					<input type="checkbox" name="_nffbc_digit_visibility_mobile[<?php echo esc_attr($nffbc_digit); ?>]" value="1" class="nffbc-digit-toggle" data-device="mobile" data-digit="<?php echo esc_attr($nffbc_digit); ?>" <?php checked(!empty($visibility_mobile[$nffbc_digit])); ?> />
					<?php echo esc_html($nffbc_label); ?>
				</label>
			<?php endforeach; ?>
		</div>

		<div class="nffbc-preview-wrap" id="preview_mobile" style="max-width:400px; border:1px solid #ccc; position:relative;">
			<?php if ( $image_mobile ) : ?>
				<?php echo wp_get_attachment_image( $image_mobile, 'full', false, array('style' => 'width:100%; height:auto; display:block;') ); ?>
			<?php else : ?>
				<div class="nffbc-no-image-text" style="padding:40px; text-align:center; background:#f1f1f1;"><?php esc_html_e( 'No image selected', 'nffbc-flashsale' ); ?></div>
			<?php endif; ?>
			<div class="nffbc-timer-overlay" data-device="mobile" style="color: <?php echo esc_attr($font_color_mobile); ?>; font-size: <?php echo esc_attr($font_size_mobile); ?>px;">
				<?php foreach ($nffbc_labels as $nffbc_digit => $nffbc_label) : 
					$nffbc_is_visible = !empty($visibility_mobile[$nffbc_digit]);
					$nffbc_preview_char = ($nffbc_digit === 'sep1' || $nffbc_digit === 'sep2') ? ':' : '8';
				?>
					<div class="nffbc-digit nffbc-digit-<?php echo esc_attr($nffbc_digit); ?>" data-digit="<?php echo esc_attr($nffbc_digit); ?>" title="Drag to position <?php echo esc_html($nffbc_label); ?>" style="left:<?php echo esc_attr($digit_pos_mobile[$nffbc_digit]['x']); ?>%; top:<?php echo esc_attr($digit_pos_mobile[$nffbc_digit]['y']); ?>%; display: <?php echo $nffbc_is_visible ? 'block' : 'none'; ?>; position:absolute; cursor:move;">
						<?php echo esc_html($nffbc_preview_char); ?>
						<span style="position:absolute; top:-8px; right:-15px; font-size:10px; font-weight:normal; background:rgba(0,0,0,0.7); color:#fff; padding:2px 4px; border-radius:3px; line-height:1; font-family:sans-serif; letter-spacing:0;"><?php echo esc_html($nffbc_label); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
			
		<div class="nffbc-digit-positions-manual" style="margin-top:15px; padding:10px; background:#fff; border:1px solid #ddd; border-radius: 4px;">
			<div style="display:flex; justify-content:space-between; align-items:center;">
				<strong><?php esc_html_e('Manual Positions (%):', 'nffbc-flashsale' ); ?></strong>
				<div>
					<label style="margin-right: 10px; font-size: 13px;">Gap (%): 
						<input type="number" step="0.1" name="_nffbc_auto_gap_mobile" class="nffbc-auto-gap" value="<?php echo esc_attr($auto_gap_mobile); ?>" style="width: 60px;">
					</label>
					<button type="button" class="button nffbc-auto-align-btn" data-device="mobile"><?php esc_html_e('Auto Align (from H1)', 'nffbc-flashsale' ); ?></button>
				</div>
			</div>
			<div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
				<?php foreach ($nffbc_labels as $nffbc_digit => $nffbc_label) : ?>
				<div style="border:1px solid #eee; padding:5px 10px; background:#f9f9f9; border-radius:4px;">
					<div style="font-weight:bold; text-align:center; margin-bottom:5px; border-bottom:1px solid #ddd; padding-bottom:3px;"><?php echo esc_html($nffbc_label); ?></div>
					X: <input type="number" step="any" name="_nffbc_digit_positions_mobile[<?php echo esc_attr($nffbc_digit); ?>][x]" class="pos-input pos-x" data-device="mobile" data-digit="<?php echo esc_attr($nffbc_digit); ?>" value="<?php echo esc_attr($digit_pos_mobile[$nffbc_digit]['x']); ?>" style="width:70px; font-size:12px;">
					<br>
					Y: <input type="number" step="any" name="_nffbc_digit_positions_mobile[<?php echo esc_attr($nffbc_digit); ?>][y]" class="pos-input pos-y" data-device="mobile" data-digit="<?php echo esc_attr($nffbc_digit); ?>" value="<?php echo esc_attr($digit_pos_mobile[$nffbc_digit]['y']); ?>" style="width:70px; font-size:12px; margin-top:5px;">
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>



	<hr>

	<!-- CTAs Bottom Bar -->
	<h3><?php esc_html_e( 'Bottom Bar CTAs', 'nffbc-flashsale' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="_nffbc_ctas_bottom_layout"><?php esc_html_e( 'Layout', 'nffbc-flashsale' ); ?></label></th>
			<td>
				<select name="_nffbc_ctas_bottom[layout]" id="_nffbc_ctas_bottom_layout">
					<option value="none" <?php selected($ctas_bottom['layout'], 'none'); ?>><?php esc_html_e( 'Disabled', 'nffbc-flashsale' ); ?></option>
					<option value="full" <?php selected($ctas_bottom['layout'], 'full'); ?>><?php esc_html_e( '1 Full Width Button', 'nffbc-flashsale' ); ?></option>
					<option value="split" <?php selected($ctas_bottom['layout'], 'split'); ?>><?php esc_html_e( '2 Split Buttons (Left/Right)', 'nffbc-flashsale' ); ?></option>
				</select>
			</td>
		</tr>
	</table>

	<div id="nffbc-bottom-btn1-settings" class="nffbc-cta-settings" style="<?php echo $ctas_bottom['layout'] === 'none' ? 'display:none;' : ''; ?>">
		<h4><?php esc_html_e( 'Button 1 (Left / Full Width)', 'nffbc-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label><?php esc_html_e( 'Text', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_ctas_bottom[btn1][text]" value="<?php echo esc_attr($ctas_bottom['btn1']['text']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Link URL', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="url" name="_nffbc_ctas_bottom[btn1][link]" value="<?php echo esc_attr($ctas_bottom['btn1']['link']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Background Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_ctas_bottom[btn1][bg_color]" value="<?php echo esc_attr($ctas_bottom['btn1']['bg_color']); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Text Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_ctas_bottom[btn1][color]" value="<?php echo esc_attr($ctas_bottom['btn1']['color']); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Icon', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<?php $nffbc_current_icon = isset($ctas_bottom['btn1']['icon']) ? $ctas_bottom['btn1']['icon'] : ''; ?>
					<select name="_nffbc_ctas_bottom[btn1][icon]" class="nffbc-icon-select" data-btn="btn1">
						<option value="" <?php selected($nffbc_current_icon, ''); ?>><?php esc_html_e('None', 'nffbc-flashsale' ); ?></option>
						<option value="line" <?php selected($nffbc_current_icon, 'line'); ?>>LINE (SVG)</option>
						<option value="phone" <?php selected($nffbc_current_icon, 'phone'); ?>>Phone (SVG)</option>
						<option value="facebook" <?php selected($nffbc_current_icon, 'facebook'); ?>>Facebook (SVG)</option>
						<option value="messenger" <?php selected($nffbc_current_icon, 'messenger'); ?>>Messenger (SVG)</option>
						<option value="cart" <?php selected($nffbc_current_icon, 'cart'); ?>>Cart (SVG)</option>
						<option value="custom" <?php selected(is_numeric($nffbc_current_icon), true); ?>><?php esc_html_e('Custom Image', 'nffbc-flashsale' ); ?></option>
					</select>
				</td>
			</tr>
			<tr id="nffbc_custom_icon_row_btn1" style="<?php echo is_numeric($nffbc_current_icon) ? '' : 'display:none;'; ?>">
				<th><label><?php esc_html_e( 'Custom Icon Image', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<input type="hidden" name="_nffbc_ctas_bottom[btn1][custom_icon]" id="_nffbc_ctas_bottom_btn1_custom_icon" value="<?php echo is_numeric($nffbc_current_icon) ? esc_attr($nffbc_current_icon) : ''; ?>" />
					<button type="button" class="button nffbc-upload-btn" data-target="_nffbc_ctas_bottom_btn1_custom_icon" data-preview="preview_btn1_icon"><?php esc_html_e( 'Select Image', 'nffbc-flashsale' ); ?></button>
					<button type="button" class="button nffbc-remove-btn" data-target="_nffbc_ctas_bottom_btn1_custom_icon" data-preview="preview_btn1_icon"><?php esc_html_e( 'Remove', 'nffbc-flashsale' ); ?></button>
					<div id="preview_btn1_icon" style="margin-top:10px; max-width:50px;">
						<?php 
						if ( is_numeric($nffbc_current_icon) ) {
							echo wp_get_attachment_image($nffbc_current_icon, 'thumbnail', false, array('style' => 'width:100%; height:auto;'));
						}
						?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div id="nffbc-bottom-btn2-settings" class="nffbc-cta-settings" style="<?php echo $ctas_bottom['layout'] === 'split' ? '' : 'display:none;'; ?>">
		<h4><?php esc_html_e( 'Button 2 (Right)', 'nffbc-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label><?php esc_html_e( 'Text', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_ctas_bottom[btn2][text]" value="<?php echo esc_attr($ctas_bottom['btn2']['text']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Link URL', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="url" name="_nffbc_ctas_bottom[btn2][link]" value="<?php echo esc_attr($ctas_bottom['btn2']['link']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Background Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_ctas_bottom[btn2][bg_color]" value="<?php echo esc_attr($ctas_bottom['btn2']['bg_color']); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Text Color', 'nffbc-flashsale' ); ?></label></th>
				<td><input type="text" name="_nffbc_ctas_bottom[btn2][color]" value="<?php echo esc_attr($ctas_bottom['btn2']['color']); ?>" class="nffbc-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php esc_html_e( 'Icon', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<?php $nffbc_current_icon2 = isset($ctas_bottom['btn2']['icon']) ? $ctas_bottom['btn2']['icon'] : ''; ?>
					<select name="_nffbc_ctas_bottom[btn2][icon]" class="nffbc-icon-select" data-btn="btn2">
						<option value="" <?php selected($nffbc_current_icon2, ''); ?>><?php esc_html_e('None', 'nffbc-flashsale' ); ?></option>
						<option value="line" <?php selected($nffbc_current_icon2, 'line'); ?>>LINE (SVG)</option>
						<option value="phone" <?php selected($nffbc_current_icon2, 'phone'); ?>>Phone (SVG)</option>
						<option value="facebook" <?php selected($nffbc_current_icon2, 'facebook'); ?>>Facebook (SVG)</option>
						<option value="messenger" <?php selected($nffbc_current_icon2, 'messenger'); ?>>Messenger (SVG)</option>
						<option value="cart" <?php selected($nffbc_current_icon2, 'cart'); ?>>Cart (SVG)</option>
						<option value="custom" <?php selected(is_numeric($nffbc_current_icon2), true); ?>><?php esc_html_e('Custom Image', 'nffbc-flashsale' ); ?></option>
					</select>
				</td>
			</tr>
			<tr id="nffbc_custom_icon_row_btn2" style="<?php echo is_numeric($nffbc_current_icon2) ? '' : 'display:none;'; ?>">
				<th><label><?php esc_html_e( 'Custom Icon Image', 'nffbc-flashsale' ); ?></label></th>
				<td>
					<input type="hidden" name="_nffbc_ctas_bottom[btn2][custom_icon]" id="_nffbc_ctas_bottom_btn2_custom_icon" value="<?php echo is_numeric($nffbc_current_icon2) ? esc_attr($nffbc_current_icon2) : ''; ?>" />
					<button type="button" class="button nffbc-upload-btn" data-target="_nffbc_ctas_bottom_btn2_custom_icon" data-preview="preview_btn2_icon"><?php esc_html_e( 'Select Image', 'nffbc-flashsale' ); ?></button>
					<button type="button" class="button nffbc-remove-btn" data-target="_nffbc_ctas_bottom_btn2_custom_icon" data-preview="preview_btn2_icon"><?php esc_html_e( 'Remove', 'nffbc-flashsale' ); ?></button>
					<div id="preview_btn2_icon" style="margin-top:10px; max-width:50px;">
						<?php 
						if ( is_numeric($nffbc_current_icon2) ) {
							echo wp_get_attachment_image($nffbc_current_icon2, 'thumbnail', false, array('style' => 'width:100%; height:auto;'));
						}
						?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<hr>

	<!-- CTAs Floating -->
	<h3><?php esc_html_e( 'Floating CTAs', 'nffbc-flashsale' ); ?></h3>
	<p class="description"><?php esc_html_e( 'Add floating icon buttons above the banner on the left or right side.', 'nffbc-flashsale' ); ?></p>
	<div id="nffbc-floating-ctas-container">
		<?php foreach ( $ctas_floating as $nffbc_i => $nffbc_cta ) : ?>
			<div class="nffbc-floating-cta-item" style="border:1px solid #ddd; padding:15px; margin-bottom:15px; background:#fafafa;">
				<table class="form-table">
					<tr>
						<th><label><?php esc_html_e( 'Font Icon Class', 'nffbc-flashsale' ); ?></label></th>
						<td><input type="text" name="_nffbc_ctas_floating[<?php echo esc_attr($nffbc_i); ?>][fonticon]" value="<?php echo esc_attr(isset($nffbc_cta['fonticon']) ? $nffbc_cta['fonticon'] : ''); ?>" class="regular-text" placeholder="e.g. fab fa-line" /><br><small><?php esc_html_e( 'Overrides image icon below if set.', 'nffbc-flashsale' ); ?></small></td>
					</tr>
					<tr>
						<th><label><?php esc_html_e( 'Icon Image', 'nffbc-flashsale' ); ?></label></th>
						<td>
							<input type="hidden" name="_nffbc_ctas_floating[<?php echo esc_attr($nffbc_i); ?>][icon]" id="_nffbc_floating_icon_<?php echo esc_attr($nffbc_i); ?>" value="<?php echo esc_attr($nffbc_cta['icon']); ?>" />
							<button type="button" class="button nffbc-upload-btn" data-target="_nffbc_floating_icon_<?php echo esc_attr($nffbc_i); ?>" data-preview="preview_floating_<?php echo esc_attr($nffbc_i); ?>"><?php esc_html_e( 'Select Icon', 'nffbc-flashsale' ); ?></button>
							<div id="preview_floating_<?php echo esc_attr($nffbc_i); ?>" style="margin-top:10px; max-width:50px;">
								<?php if ( $nffbc_cta['icon'] ) echo wp_get_attachment_image( $nffbc_cta['icon'], 'thumbnail', false, array('style' => 'width:100%; height:auto;') ); ?>
							</div>
						</td>
					</tr>
					<tr>
						<th><label><?php esc_html_e( 'Link URL', 'nffbc-flashsale' ); ?></label></th>
						<td><input type="url" name="_nffbc_ctas_floating[<?php echo esc_attr($nffbc_i); ?>][link]" value="<?php echo esc_attr($nffbc_cta['link']); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th><label><?php esc_html_e( 'Position', 'nffbc-flashsale' ); ?></label></th>
						<td>
							<select name="_nffbc_ctas_floating[<?php echo esc_attr($nffbc_i); ?>][position]">
								<option value="right" <?php selected($nffbc_cta['position'], 'right'); ?>><?php esc_html_e( 'Right', 'nffbc-flashsale' ); ?></option>
								<option value="left" <?php selected($nffbc_cta['position'], 'left'); ?>><?php esc_html_e( 'Left', 'nffbc-flashsale' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th></th>
						<td><button type="button" class="button button-link-delete nffbc-remove-floating-cta"><?php esc_html_e( 'Remove this CTA', 'nffbc-flashsale' ); ?></button></td>
					</tr>
				</table>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button" id="nffbc-add-floating-cta"><?php esc_html_e( 'Add Floating CTA', 'nffbc-flashsale' ); ?></button>

	<!-- Template for new Floating CTA -->
	<script type="text/template" id="tmpl-nffbc-floating-cta">
		<div class="nffbc-floating-cta-item" style="border:1px solid #ddd; padding:15px; margin-bottom:15px; background:#fafafa;">
			<table class="form-table">
				<tr>
					<th><label><?php esc_html_e( 'Font Icon Class', 'nffbc-flashsale' ); ?></label></th>
					<td><input type="text" name="_nffbc_ctas_floating[{{id}}][fonticon]" value="" class="regular-text" placeholder="e.g. fab fa-line" /><br><small><?php esc_html_e( 'Overrides image icon below if set.', 'nffbc-flashsale' ); ?></small></td>
				</tr>
				<tr>
					<th><label><?php esc_html_e( 'Icon Image', 'nffbc-flashsale' ); ?></label></th>
					<td>
						<input type="hidden" name="_nffbc_ctas_floating[{{id}}][icon]" id="_nffbc_floating_icon_{{id}}" value="" />
						<button type="button" class="button nffbc-upload-btn" data-target="_nffbc_floating_icon_{{id}}" data-preview="preview_floating_{{id}}"><?php esc_html_e( 'Select Icon', 'nffbc-flashsale' ); ?></button>
						<div id="preview_floating_{{id}}" style="margin-top:10px; max-width:50px;"></div>
					</td>
				</tr>
				<tr>
					<th><label><?php esc_html_e( 'Link URL', 'nffbc-flashsale' ); ?></label></th>
					<td><input type="url" name="_nffbc_ctas_floating[{{id}}][link]" value="" class="regular-text" /></td>
				</tr>
				<tr>
					<th><label><?php esc_html_e( 'Position', 'nffbc-flashsale' ); ?></label></th>
					<td>
						<select name="_nffbc_ctas_floating[{{id}}][position]">
							<option value="right"><?php esc_html_e( 'Right', 'nffbc-flashsale' ); ?></option>
							<option value="left"><?php esc_html_e( 'Left', 'nffbc-flashsale' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th></th>
					<td><button type="button" class="button button-link-delete nffbc-remove-floating-cta"><?php esc_html_e( 'Remove this CTA', 'nffbc-flashsale' ); ?></button></td>
				</tr>
			</table>
		</div>
	</script>

	<hr>

	<div class="nffbc-json-section" style="margin-top:30px; background:#fff; padding:15px; border:1px solid #ccc;">
		<h4><?php esc_html_e( 'Advanced: Data JSON (Export / Import)', 'nffbc-flashsale' ); ?></h4>
		<p class="description"><?php esc_html_e( 'Copy this JSON to apply the exact same settings (positions, visibility, text, colors) to another flash sale. To import, paste the JSON here and click Apply.', 'nffbc-flashsale' ); ?></p>
		<textarea id="nffbc-json-data" rows="8" style="width:100%; font-family:monospace; margin-top:10px;"></textarea>
		<button type="button" class="button button-secondary" id="nffbc-apply-json" style="margin-top:10px;"><?php esc_html_e( 'Apply JSON', 'nffbc-flashsale' ); ?></button>
		<span id="nffbc-json-msg" style="color:green; margin-left:10px; display:none;"><?php esc_html_e('Applied successfully!', 'nffbc-flashsale' ); ?></span>
	</div>
</div>
