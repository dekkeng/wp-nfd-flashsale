<div class="wrap">
	<h2><?php _e( 'Flash Sale Configuration', 'nfd-flashsale' ); ?></h2>
	
	<table class="form-table">
		<tr>
			<th><label for="_nfd_is_active"><?php _e( 'Active', 'nfd-flashsale' ); ?></label></th>
			<td>
				<input type="checkbox" name="_nfd_is_active" id="_nfd_is_active" value="1" <?php checked( $is_active, '1' ); ?> />
				<span class="description"><?php _e( 'Check to enable this flash sale', 'nfd-flashsale' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="_nfd_target_pages"><?php _e( 'Target Pages', 'nfd-flashsale' ); ?></label></th>
			<td>
				<div style="max-height: 150px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; max-width: 300px; background: #fff;">
					<?php foreach ( $pages as $page ) : ?>
						<label style="display: block; margin-bottom: 5px;">
							<input type="checkbox" name="_nfd_target_pages[]" value="<?php echo esc_attr( $page->ID ); ?>" <?php echo in_array( $page->ID, $target_pages ) ? 'checked="checked"' : ''; ?> />
							<?php echo esc_html( $page->post_title ); ?>
						</label>
					<?php endforeach; ?>
				</div>
				<p class="description"><?php _e( 'Select pages to display the banner. Leave empty to show on all pages.', 'nfd-flashsale' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="_nfd_end_datetime"><?php _e( 'End Date & Time', 'nfd-flashsale' ); ?></label></th>
			<td>
				<input type="datetime-local" name="_nfd_end_datetime" id="_nfd_end_datetime" value="<?php echo esc_attr( $end_datetime ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="_nfd_loop_hours"><?php _e( 'Loop Hours', 'nfd-flashsale' ); ?></label></th>
			<td>
				<input type="number" name="_nfd_loop_hours" id="_nfd_loop_hours" value="<?php echo esc_attr( $loop_hours ); ?>" step="1" min="0" />
				<p class="description"><?php _e( 'Hours to add when timer reaches zero. Set to 0 to make it disappear when time is up.', 'nfd-flashsale' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="_nfd_link_url"><?php _e( 'Banner Link URL', 'nfd-flashsale' ); ?></label></th>
			<td>
				<input type="url" name="_nfd_link_url" id="_nfd_link_url" class="regular-text" value="<?php echo esc_attr( $link_url ); ?>" />
			</td>
		</tr>
	</table>

	<hr>

	<h3><?php _e( 'Appearance', 'nfd-flashsale' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="_nfd_max_width_pc"><?php _e( 'PC Max Width', 'nfd-flashsale' ); ?></label></th>
			<td>
				<input type="text" name="_nfd_max_width_pc" id="_nfd_max_width_pc" value="<?php echo esc_attr( $max_width_pc ); ?>" class="regular-text" placeholder="e.g. 1000px or 100%" />
				<p class="description"><?php _e( 'Maximum width for the PC layout.', 'nfd-flashsale' ); ?></p>
			</td>
		</tr>
	</table>

	<hr>

	<h3><?php _e( 'Images, Styling & Timer Positions', 'nfd-flashsale' ); ?></h3>
	<p class="description"><?php _e( 'Configure separate styling and positions for PC and Mobile.', 'nfd-flashsale' ); ?></p>
	
	<div class="nfd-image-section">
		<h4><?php _e( 'PC Layout', 'nfd-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label for="_nfd_font_size_pc"><?php _e( 'Font Size (px)', 'nfd-flashsale' ); ?></label></th>
				<td><input type="number" name="_nfd_font_size_pc" id="_nfd_font_size_pc" value="<?php echo esc_attr( $font_size_pc ); ?>" /></td>
			</tr>
			<tr>
				<th><label for="_nfd_font_color_pc"><?php _e( 'Text/Digit Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_font_color_pc" id="_nfd_font_color_pc" value="<?php echo esc_attr( $font_color_pc ); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr>
				<th><label for="_nfd_sep_color_pc"><?php _e( 'Separator (:) Color', 'nfd-flashsale' ); ?></label></th>
				<td>
					<input type="text" name="_nfd_sep_color_pc" id="_nfd_sep_color_pc" value="<?php echo esc_attr( $sep_color_pc ); ?>" class="nfd-color-picker" />
					<p class="description"><?php _e( 'Color for the ":" characters (useful if they are outside the digit background).', 'nfd-flashsale' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><label for="_nfd_digit_bg_enable_pc"><?php _e( 'Digit Background Enable', 'nfd-flashsale' ); ?></label></th>
				<td>
					<input type="checkbox" name="_nfd_digit_bg_enable_pc" id="_nfd_digit_bg_enable_pc" value="1" <?php checked( $digit_bg_enable_pc, '1' ); ?> />
					<?php _e( 'Add background box to digits (H1, H2, M1, M2, S1, S2)', 'nfd-flashsale' ); ?>
				</td>
			</tr>
			<tr class="nfd-digit-bg-settings-pc" style="<?php echo $digit_bg_enable_pc ? '' : 'display:none;'; ?>">
				<th><label for="_nfd_digit_bg_color_pc"><?php _e( 'Digit Background Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_digit_bg_color_pc" id="_nfd_digit_bg_color_pc" value="<?php echo esc_attr( $digit_bg_color_pc ); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr class="nfd-digit-bg-settings-pc" style="<?php echo $digit_bg_enable_pc ? '' : 'display:none;'; ?>">
				<th><label for="_nfd_digit_bg_padding_pc"><?php _e( 'Digit Padding', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_digit_bg_padding_pc" id="_nfd_digit_bg_padding_pc" value="<?php echo esc_attr( $digit_bg_padding_pc ); ?>" class="regular-text" placeholder="e.g. 5px 10px" /></td>
			</tr>
			<tr class="nfd-digit-bg-settings-pc" style="<?php echo $digit_bg_enable_pc ? '' : 'display:none;'; ?>">
				<th><label for="_nfd_digit_bg_radius_pc"><?php _e( 'Digit Border Radius', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_digit_bg_radius_pc" id="_nfd_digit_bg_radius_pc" value="<?php echo esc_attr( $digit_bg_radius_pc ); ?>" class="regular-text" placeholder="e.g. 5px" /></td>
			</tr>
		</table>

		<h4 style="margin-top:20px;"><?php _e( 'PC Background Image', 'nfd-flashsale' ); ?></h4>
		<input type="hidden" name="_nfd_image_pc" id="_nfd_image_pc" value="<?php echo esc_attr( $image_pc ); ?>" />
		<button type="button" class="button nfd-upload-btn" data-target="_nfd_image_pc" data-preview="preview_pc"><?php _e( 'Upload/Select Image', 'nfd-flashsale' ); ?></button>
		<button type="button" class="button nfd-remove-btn" data-target="_nfd_image_pc" data-preview="preview_pc"><?php _e( 'Remove', 'nfd-flashsale' ); ?></button>
		
		<div style="padding: 10px; background: #fff; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 4px;">
			<strong><?php _e('Visible Digits:', 'nfd-flashsale'); ?></strong>
			<?php 
			$labels = array('h1' => 'H1', 'h2' => 'H2', 'sep1' => ':', 'm1' => 'M1', 'm2' => 'M2', 'sep2' => ':', 's1' => 'S1', 's2' => 'S2');
			foreach ($labels as $digit => $label) : ?>
				<label style="margin-right: 15px;">
					<input type="checkbox" name="_nfd_digit_visibility_pc[<?php echo $digit; ?>]" value="1" class="nfd-digit-toggle" data-device="pc" data-digit="<?php echo $digit; ?>" <?php checked(!empty($visibility_pc[$digit])); ?> />
					<?php echo $label; ?>
				</label>
			<?php endforeach; ?>
		</div>
		
		<div class="nfd-preview-wrap" id="preview_pc" style="max-width:800px; border:1px solid #ccc; position:relative;">
			<?php if ( $image_pc ) : ?>
				<?php echo wp_get_attachment_image( $image_pc, 'full', false, array('style' => 'width:100%; height:auto; display:block;') ); ?>
			<?php else : ?>
				<div class="nfd-no-image-text" style="padding:40px; text-align:center; background:#f1f1f1;"><?php _e( 'No image selected', 'nfd-flashsale' ); ?></div>
			<?php endif; ?>
			<div class="nfd-timer-overlay" data-device="pc" style="color: <?php echo esc_attr($font_color_pc); ?>; font-size: <?php echo esc_attr($font_size_pc); ?>px;">
				<?php foreach ($labels as $digit => $label) : 
					$is_visible = !empty($visibility_pc[$digit]);
					$preview_char = ($digit === 'sep1' || $digit === 'sep2') ? ':' : '8';
				?>
					<div class="nfd-digit nfd-digit-<?php echo $digit; ?>" data-digit="<?php echo $digit; ?>" title="Drag to position <?php echo $label; ?>" style="left:<?php echo esc_attr($digit_pos_pc[$digit]['x']); ?>%; top:<?php echo esc_attr($digit_pos_pc[$digit]['y']); ?>%; display: <?php echo $is_visible ? 'block' : 'none'; ?>; position:absolute; cursor:move;">
						<?php echo $preview_char; ?>
						<span style="position:absolute; top:-8px; right:-15px; font-size:10px; font-weight:normal; background:rgba(0,0,0,0.7); color:#fff; padding:2px 4px; border-radius:3px; line-height:1; font-family:sans-serif; letter-spacing:0;"><?php echo $label; ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
			
		<div class="nfd-digit-positions-manual" style="margin-top:15px; padding:10px; background:#fff; border:1px solid #ddd; border-radius: 4px;">
			<div style="display:flex; justify-content:space-between; align-items:center;">
				<strong><?php _e('Manual Positions (%):', 'nfd-flashsale'); ?></strong>
				<div>
					<label style="margin-right: 10px; font-size: 13px;">Gap (%): 
						<input type="number" step="0.1" name="_nfd_auto_gap_pc" class="nfd-auto-gap" value="<?php echo esc_attr($auto_gap_pc); ?>" style="width: 60px;">
					</label>
					<button type="button" class="button nfd-auto-align-btn" data-device="pc"><?php _e('Auto Align (from H1)', 'nfd-flashsale'); ?></button>
				</div>
			</div>
			<div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
				<?php foreach ($labels as $digit => $label) : ?>
				<div style="border:1px solid #eee; padding:5px 10px; background:#f9f9f9; border-radius:4px;">
					<div style="font-weight:bold; text-align:center; margin-bottom:5px; border-bottom:1px solid #ddd; padding-bottom:3px;"><?php echo $label; ?></div>
					X: <input type="number" step="any" name="_nfd_digit_positions_pc[<?php echo $digit; ?>][x]" class="pos-input pos-x" data-device="pc" data-digit="<?php echo $digit; ?>" value="<?php echo esc_attr($digit_pos_pc[$digit]['x']); ?>" style="width:70px; font-size:12px;">
					<br>
					Y: <input type="number" step="any" name="_nfd_digit_positions_pc[<?php echo $digit; ?>][y]" class="pos-input pos-y" data-device="pc" data-digit="<?php echo $digit; ?>" value="<?php echo esc_attr($digit_pos_pc[$digit]['y']); ?>" style="width:70px; font-size:12px; margin-top:5px;">
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="nfd-image-section" style="margin-top:40px; padding-top:20px; border-top:1px dashed #ccc;">
		<h4><?php _e( 'Mobile Layout', 'nfd-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label for="_nfd_font_size_mobile"><?php _e( 'Font Size (px)', 'nfd-flashsale' ); ?></label></th>
				<td><input type="number" name="_nfd_font_size_mobile" id="_nfd_font_size_mobile" value="<?php echo esc_attr( $font_size_mobile ); ?>" /></td>
			</tr>
			<tr>
				<th><label for="_nfd_font_color_mobile"><?php _e( 'Text/Digit Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_font_color_mobile" id="_nfd_font_color_mobile" value="<?php echo esc_attr( $font_color_mobile ); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr>
				<th><label for="_nfd_sep_color_mobile"><?php _e( 'Separator (:) Color', 'nfd-flashsale' ); ?></label></th>
				<td>
					<input type="text" name="_nfd_sep_color_mobile" id="_nfd_sep_color_mobile" value="<?php echo esc_attr( $sep_color_mobile ); ?>" class="nfd-color-picker" />
					<p class="description"><?php _e( 'Color for the ":" characters (useful if they are outside the digit background).', 'nfd-flashsale' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><label for="_nfd_digit_bg_enable_mobile"><?php _e( 'Digit Background Enable', 'nfd-flashsale' ); ?></label></th>
				<td>
					<input type="checkbox" name="_nfd_digit_bg_enable_mobile" id="_nfd_digit_bg_enable_mobile" value="1" <?php checked( $digit_bg_enable_mobile, '1' ); ?> />
					<?php _e( 'Add background box to digits (H1, H2, M1, M2, S1, S2)', 'nfd-flashsale' ); ?>
				</td>
			</tr>
			<tr class="nfd-digit-bg-settings-mobile" style="<?php echo $digit_bg_enable_mobile ? '' : 'display:none;'; ?>">
				<th><label for="_nfd_digit_bg_color_mobile"><?php _e( 'Digit Background Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_digit_bg_color_mobile" id="_nfd_digit_bg_color_mobile" value="<?php echo esc_attr( $digit_bg_color_mobile ); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr class="nfd-digit-bg-settings-mobile" style="<?php echo $digit_bg_enable_mobile ? '' : 'display:none;'; ?>">
				<th><label for="_nfd_digit_bg_padding_mobile"><?php _e( 'Digit Padding', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_digit_bg_padding_mobile" id="_nfd_digit_bg_padding_mobile" value="<?php echo esc_attr( $digit_bg_padding_mobile ); ?>" class="regular-text" placeholder="e.g. 5px 10px" /></td>
			</tr>
			<tr class="nfd-digit-bg-settings-mobile" style="<?php echo $digit_bg_enable_mobile ? '' : 'display:none;'; ?>">
				<th><label for="_nfd_digit_bg_radius_mobile"><?php _e( 'Digit Border Radius', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_digit_bg_radius_mobile" id="_nfd_digit_bg_radius_mobile" value="<?php echo esc_attr( $digit_bg_radius_mobile ); ?>" class="regular-text" placeholder="e.g. 5px" /></td>
			</tr>
		</table>

		<h4 style="margin-top:20px;"><?php _e( 'Mobile Background Image', 'nfd-flashsale' ); ?></h4>
		<input type="hidden" name="_nfd_image_mobile" id="_nfd_image_mobile" value="<?php echo esc_attr( $image_mobile ); ?>" />
		<button type="button" class="button nfd-upload-btn" data-target="_nfd_image_mobile" data-preview="preview_mobile"><?php _e( 'Upload/Select Image', 'nfd-flashsale' ); ?></button>
		<button type="button" class="button nfd-remove-btn" data-target="_nfd_image_mobile" data-preview="preview_mobile"><?php _e( 'Remove', 'nfd-flashsale' ); ?></button>
		
		<div style="padding: 10px; background: #fff; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 4px;">
			<strong><?php _e('Visible Digits:', 'nfd-flashsale'); ?></strong>
			<?php foreach ($labels as $digit => $label) : ?>
				<label style="margin-right: 10px;">
					<input type="checkbox" name="_nfd_digit_visibility_mobile[<?php echo $digit; ?>]" value="1" class="nfd-digit-toggle" data-device="mobile" data-digit="<?php echo $digit; ?>" <?php checked(!empty($visibility_mobile[$digit])); ?> />
					<?php echo $label; ?>
				</label>
			<?php endforeach; ?>
		</div>

		<div class="nfd-preview-wrap" id="preview_mobile" style="max-width:400px; border:1px solid #ccc; position:relative;">
			<?php if ( $image_mobile ) : ?>
				<?php echo wp_get_attachment_image( $image_mobile, 'full', false, array('style' => 'width:100%; height:auto; display:block;') ); ?>
			<?php else : ?>
				<div class="nfd-no-image-text" style="padding:40px; text-align:center; background:#f1f1f1;"><?php _e( 'No image selected', 'nfd-flashsale' ); ?></div>
			<?php endif; ?>
			<div class="nfd-timer-overlay" data-device="mobile" style="color: <?php echo esc_attr($font_color_mobile); ?>; font-size: <?php echo esc_attr($font_size_mobile); ?>px;">
				<?php foreach ($labels as $digit => $label) : 
					$is_visible = !empty($visibility_mobile[$digit]);
					$preview_char = ($digit === 'sep1' || $digit === 'sep2') ? ':' : '8';
				?>
					<div class="nfd-digit nfd-digit-<?php echo $digit; ?>" data-digit="<?php echo $digit; ?>" title="Drag to position <?php echo $label; ?>" style="left:<?php echo esc_attr($digit_pos_mobile[$digit]['x']); ?>%; top:<?php echo esc_attr($digit_pos_mobile[$digit]['y']); ?>%; display: <?php echo $is_visible ? 'block' : 'none'; ?>; position:absolute; cursor:move;">
						<?php echo $preview_char; ?>
						<span style="position:absolute; top:-8px; right:-15px; font-size:10px; font-weight:normal; background:rgba(0,0,0,0.7); color:#fff; padding:2px 4px; border-radius:3px; line-height:1; font-family:sans-serif; letter-spacing:0;"><?php echo $label; ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
			
		<div class="nfd-digit-positions-manual" style="margin-top:15px; padding:10px; background:#fff; border:1px solid #ddd; border-radius: 4px;">
			<div style="display:flex; justify-content:space-between; align-items:center;">
				<strong><?php _e('Manual Positions (%):', 'nfd-flashsale'); ?></strong>
				<div>
					<label style="margin-right: 10px; font-size: 13px;">Gap (%): 
						<input type="number" step="0.1" name="_nfd_auto_gap_mobile" class="nfd-auto-gap" value="<?php echo esc_attr($auto_gap_mobile); ?>" style="width: 60px;">
					</label>
					<button type="button" class="button nfd-auto-align-btn" data-device="mobile"><?php _e('Auto Align (from H1)', 'nfd-flashsale'); ?></button>
				</div>
			</div>
			<div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
				<?php foreach ($labels as $digit => $label) : ?>
				<div style="border:1px solid #eee; padding:5px 10px; background:#f9f9f9; border-radius:4px;">
					<div style="font-weight:bold; text-align:center; margin-bottom:5px; border-bottom:1px solid #ddd; padding-bottom:3px;"><?php echo $label; ?></div>
					X: <input type="number" step="any" name="_nfd_digit_positions_mobile[<?php echo $digit; ?>][x]" class="pos-input pos-x" data-device="mobile" data-digit="<?php echo $digit; ?>" value="<?php echo esc_attr($digit_pos_mobile[$digit]['x']); ?>" style="width:70px; font-size:12px;">
					<br>
					Y: <input type="number" step="any" name="_nfd_digit_positions_mobile[<?php echo $digit; ?>][y]" class="pos-input pos-y" data-device="mobile" data-digit="<?php echo $digit; ?>" value="<?php echo esc_attr($digit_pos_mobile[$digit]['y']); ?>" style="width:70px; font-size:12px; margin-top:5px;">
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>



	<hr>

	<!-- CTAs Bottom Bar -->
	<h3><?php _e( 'Bottom Bar CTAs', 'nfd-flashsale' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="_nfd_ctas_bottom_layout"><?php _e( 'Layout', 'nfd-flashsale' ); ?></label></th>
			<td>
				<select name="_nfd_ctas_bottom[layout]" id="_nfd_ctas_bottom_layout">
					<option value="none" <?php selected($ctas_bottom['layout'], 'none'); ?>><?php _e( 'Disabled', 'nfd-flashsale' ); ?></option>
					<option value="full" <?php selected($ctas_bottom['layout'], 'full'); ?>><?php _e( '1 Full Width Button', 'nfd-flashsale' ); ?></option>
					<option value="split" <?php selected($ctas_bottom['layout'], 'split'); ?>><?php _e( '2 Split Buttons (Left/Right)', 'nfd-flashsale' ); ?></option>
				</select>
			</td>
		</tr>
	</table>

	<div id="nfd-bottom-btn1-settings" class="nfd-cta-settings" style="<?php echo $ctas_bottom['layout'] === 'none' ? 'display:none;' : ''; ?>">
		<h4><?php _e( 'Button 1 (Left / Full Width)', 'nfd-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label><?php _e( 'Text', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_ctas_bottom[btn1][text]" value="<?php echo esc_attr($ctas_bottom['btn1']['text']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Link URL', 'nfd-flashsale' ); ?></label></th>
				<td><input type="url" name="_nfd_ctas_bottom[btn1][link]" value="<?php echo esc_attr($ctas_bottom['btn1']['link']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Background Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_ctas_bottom[btn1][bg_color]" value="<?php echo esc_attr($ctas_bottom['btn1']['bg_color']); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Text Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_ctas_bottom[btn1][color]" value="<?php echo esc_attr($ctas_bottom['btn1']['color']); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Icon', 'nfd-flashsale' ); ?></label></th>
				<td>
					<?php $current_icon = isset($ctas_bottom['btn1']['icon']) ? $ctas_bottom['btn1']['icon'] : ''; ?>
					<select name="_nfd_ctas_bottom[btn1][icon]" class="nfd-icon-select" data-btn="btn1">
						<option value="" <?php selected($current_icon, ''); ?>><?php _e('None', 'nfd-flashsale'); ?></option>
						<option value="line" <?php selected($current_icon, 'line'); ?>>LINE (SVG)</option>
						<option value="phone" <?php selected($current_icon, 'phone'); ?>>Phone (SVG)</option>
						<option value="facebook" <?php selected($current_icon, 'facebook'); ?>>Facebook (SVG)</option>
						<option value="messenger" <?php selected($current_icon, 'messenger'); ?>>Messenger (SVG)</option>
						<option value="cart" <?php selected($current_icon, 'cart'); ?>>Cart (SVG)</option>
						<option value="custom" <?php selected(is_numeric($current_icon), true); ?>><?php _e('Custom Image', 'nfd-flashsale'); ?></option>
					</select>
				</td>
			</tr>
			<tr id="nfd_custom_icon_row_btn1" style="<?php echo is_numeric($current_icon) ? '' : 'display:none;'; ?>">
				<th><label><?php _e( 'Custom Icon Image', 'nfd-flashsale' ); ?></label></th>
				<td>
					<input type="hidden" name="_nfd_ctas_bottom[btn1][custom_icon]" id="_nfd_ctas_bottom_btn1_custom_icon" value="<?php echo is_numeric($current_icon) ? esc_attr($current_icon) : ''; ?>" />
					<button type="button" class="button nfd-upload-btn" data-target="_nfd_ctas_bottom_btn1_custom_icon" data-preview="preview_btn1_icon"><?php _e( 'Select Image', 'nfd-flashsale' ); ?></button>
					<button type="button" class="button nfd-remove-btn" data-target="_nfd_ctas_bottom_btn1_custom_icon" data-preview="preview_btn1_icon"><?php _e( 'Remove', 'nfd-flashsale' ); ?></button>
					<div id="preview_btn1_icon" style="margin-top:10px; max-width:50px;">
						<?php 
						if ( is_numeric($current_icon) ) {
							echo wp_get_attachment_image($current_icon, 'thumbnail', false, array('style' => 'width:100%; height:auto;'));
						}
						?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div id="nfd-bottom-btn2-settings" class="nfd-cta-settings" style="<?php echo $ctas_bottom['layout'] === 'split' ? '' : 'display:none;'; ?>">
		<h4><?php _e( 'Button 2 (Right)', 'nfd-flashsale' ); ?></h4>
		<table class="form-table">
			<tr>
				<th><label><?php _e( 'Text', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_ctas_bottom[btn2][text]" value="<?php echo esc_attr($ctas_bottom['btn2']['text']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Link URL', 'nfd-flashsale' ); ?></label></th>
				<td><input type="url" name="_nfd_ctas_bottom[btn2][link]" value="<?php echo esc_attr($ctas_bottom['btn2']['link']); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Background Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_ctas_bottom[btn2][bg_color]" value="<?php echo esc_attr($ctas_bottom['btn2']['bg_color']); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Text Color', 'nfd-flashsale' ); ?></label></th>
				<td><input type="text" name="_nfd_ctas_bottom[btn2][color]" value="<?php echo esc_attr($ctas_bottom['btn2']['color']); ?>" class="nfd-color-picker" /></td>
			</tr>
			<tr>
				<th><label><?php _e( 'Icon', 'nfd-flashsale' ); ?></label></th>
				<td>
					<?php $current_icon2 = isset($ctas_bottom['btn2']['icon']) ? $ctas_bottom['btn2']['icon'] : ''; ?>
					<select name="_nfd_ctas_bottom[btn2][icon]" class="nfd-icon-select" data-btn="btn2">
						<option value="" <?php selected($current_icon2, ''); ?>><?php _e('None', 'nfd-flashsale'); ?></option>
						<option value="line" <?php selected($current_icon2, 'line'); ?>>LINE (SVG)</option>
						<option value="phone" <?php selected($current_icon2, 'phone'); ?>>Phone (SVG)</option>
						<option value="facebook" <?php selected($current_icon2, 'facebook'); ?>>Facebook (SVG)</option>
						<option value="messenger" <?php selected($current_icon2, 'messenger'); ?>>Messenger (SVG)</option>
						<option value="cart" <?php selected($current_icon2, 'cart'); ?>>Cart (SVG)</option>
						<option value="custom" <?php selected(is_numeric($current_icon2), true); ?>><?php _e('Custom Image', 'nfd-flashsale'); ?></option>
					</select>
				</td>
			</tr>
			<tr id="nfd_custom_icon_row_btn2" style="<?php echo is_numeric($current_icon2) ? '' : 'display:none;'; ?>">
				<th><label><?php _e( 'Custom Icon Image', 'nfd-flashsale' ); ?></label></th>
				<td>
					<input type="hidden" name="_nfd_ctas_bottom[btn2][custom_icon]" id="_nfd_ctas_bottom_btn2_custom_icon" value="<?php echo is_numeric($current_icon2) ? esc_attr($current_icon2) : ''; ?>" />
					<button type="button" class="button nfd-upload-btn" data-target="_nfd_ctas_bottom_btn2_custom_icon" data-preview="preview_btn2_icon"><?php _e( 'Select Image', 'nfd-flashsale' ); ?></button>
					<button type="button" class="button nfd-remove-btn" data-target="_nfd_ctas_bottom_btn2_custom_icon" data-preview="preview_btn2_icon"><?php _e( 'Remove', 'nfd-flashsale' ); ?></button>
					<div id="preview_btn2_icon" style="margin-top:10px; max-width:50px;">
						<?php 
						if ( is_numeric($current_icon2) ) {
							echo wp_get_attachment_image($current_icon2, 'thumbnail', false, array('style' => 'width:100%; height:auto;'));
						}
						?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<hr>

	<!-- CTAs Floating -->
	<h3><?php _e( 'Floating CTAs', 'nfd-flashsale' ); ?></h3>
	<p class="description"><?php _e( 'Add floating icon buttons above the banner on the left or right side.', 'nfd-flashsale' ); ?></p>
	<div id="nfd-floating-ctas-container">
		<?php foreach ( $ctas_floating as $i => $cta ) : ?>
			<div class="nfd-floating-cta-item" style="border:1px solid #ddd; padding:15px; margin-bottom:15px; background:#fafafa;">
				<table class="form-table">
					<tr>
						<th><label><?php _e( 'Font Icon Class', 'nfd-flashsale' ); ?></label></th>
						<td><input type="text" name="_nfd_ctas_floating[<?php echo $i; ?>][fonticon]" value="<?php echo esc_attr(isset($cta['fonticon']) ? $cta['fonticon'] : ''); ?>" class="regular-text" placeholder="e.g. fab fa-line" /><br><small><?php _e( 'Overrides image icon below if set.', 'nfd-flashsale' ); ?></small></td>
					</tr>
					<tr>
						<th><label><?php _e( 'Icon Image', 'nfd-flashsale' ); ?></label></th>
						<td>
							<input type="hidden" name="_nfd_ctas_floating[<?php echo $i; ?>][icon]" id="_nfd_floating_icon_<?php echo $i; ?>" value="<?php echo esc_attr($cta['icon']); ?>" />
							<button type="button" class="button nfd-upload-btn" data-target="_nfd_floating_icon_<?php echo $i; ?>" data-preview="preview_floating_<?php echo $i; ?>"><?php _e( 'Select Icon', 'nfd-flashsale' ); ?></button>
							<div id="preview_floating_<?php echo $i; ?>" style="margin-top:10px; max-width:50px;">
								<?php if ( $cta['icon'] ) echo wp_get_attachment_image( $cta['icon'], 'thumbnail', false, array('style' => 'width:100%; height:auto;') ); ?>
							</div>
						</td>
					</tr>
					<tr>
						<th><label><?php _e( 'Link URL', 'nfd-flashsale' ); ?></label></th>
						<td><input type="url" name="_nfd_ctas_floating[<?php echo $i; ?>][link]" value="<?php echo esc_attr($cta['link']); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th><label><?php _e( 'Position', 'nfd-flashsale' ); ?></label></th>
						<td>
							<select name="_nfd_ctas_floating[<?php echo $i; ?>][position]">
								<option value="right" <?php selected($cta['position'], 'right'); ?>><?php _e( 'Right', 'nfd-flashsale' ); ?></option>
								<option value="left" <?php selected($cta['position'], 'left'); ?>><?php _e( 'Left', 'nfd-flashsale' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th></th>
						<td><button type="button" class="button button-link-delete nfd-remove-floating-cta"><?php _e( 'Remove this CTA', 'nfd-flashsale' ); ?></button></td>
					</tr>
				</table>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button" id="nfd-add-floating-cta"><?php _e( 'Add Floating CTA', 'nfd-flashsale' ); ?></button>

	<!-- Template for new Floating CTA -->
	<script type="text/template" id="tmpl-nfd-floating-cta">
		<div class="nfd-floating-cta-item" style="border:1px solid #ddd; padding:15px; margin-bottom:15px; background:#fafafa;">
			<table class="form-table">
				<tr>
					<th><label><?php _e( 'Font Icon Class', 'nfd-flashsale' ); ?></label></th>
					<td><input type="text" name="_nfd_ctas_floating[{{id}}][fonticon]" value="" class="regular-text" placeholder="e.g. fab fa-line" /><br><small><?php _e( 'Overrides image icon below if set.', 'nfd-flashsale' ); ?></small></td>
				</tr>
				<tr>
					<th><label><?php _e( 'Icon Image', 'nfd-flashsale' ); ?></label></th>
					<td>
						<input type="hidden" name="_nfd_ctas_floating[{{id}}][icon]" id="_nfd_floating_icon_{{id}}" value="" />
						<button type="button" class="button nfd-upload-btn" data-target="_nfd_floating_icon_{{id}}" data-preview="preview_floating_{{id}}"><?php _e( 'Select Icon', 'nfd-flashsale' ); ?></button>
						<div id="preview_floating_{{id}}" style="margin-top:10px; max-width:50px;"></div>
					</td>
				</tr>
				<tr>
					<th><label><?php _e( 'Link URL', 'nfd-flashsale' ); ?></label></th>
					<td><input type="url" name="_nfd_ctas_floating[{{id}}][link]" value="" class="regular-text" /></td>
				</tr>
				<tr>
					<th><label><?php _e( 'Position', 'nfd-flashsale' ); ?></label></th>
					<td>
						<select name="_nfd_ctas_floating[{{id}}][position]">
							<option value="right"><?php _e( 'Right', 'nfd-flashsale' ); ?></option>
							<option value="left"><?php _e( 'Left', 'nfd-flashsale' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th></th>
					<td><button type="button" class="button button-link-delete nfd-remove-floating-cta"><?php _e( 'Remove this CTA', 'nfd-flashsale' ); ?></button></td>
				</tr>
			</table>
		</div>
	</script>

	<hr>

	<div class="nfd-json-section" style="margin-top:30px; background:#fff; padding:15px; border:1px solid #ccc;">
		<h4><?php _e( 'Advanced: Data JSON (Export / Import)', 'nfd-flashsale' ); ?></h4>
		<p class="description"><?php _e( 'Copy this JSON to apply the exact same settings (positions, visibility, text, colors) to another flash sale. To import, paste the JSON here and click Apply.', 'nfd-flashsale' ); ?></p>
		<textarea id="nfd-json-data" rows="8" style="width:100%; font-family:monospace; margin-top:10px;"></textarea>
		<button type="button" class="button button-secondary" id="nfd-apply-json" style="margin-top:10px;"><?php _e( 'Apply JSON', 'nfd-flashsale' ); ?></button>
		<span id="nfd-json-msg" style="color:green; margin-left:10px; display:none;"><?php _e('Applied successfully!', 'nfd-flashsale'); ?></span>
	</div>
</div>
