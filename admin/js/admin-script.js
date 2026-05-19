jQuery(document).ready(function($) {
	// Color picker with live update
	$('.nffbc-color-picker').wpColorPicker({
		change: function(event, ui) {
			var color = ui.color.toString();
			$(event.target).val(color);
			
			if (typeof updateColors === 'function') {
				updateColors('pc');
				updateColors('mobile');
			}
			if (typeof updateDigitBackgrounds === 'function') {
				updateDigitBackgrounds('pc');
				updateDigitBackgrounds('mobile');
			}
			if (typeof generateJSON === 'function') generateJSON();
		}
	});

	// Icon select logic
	$('.nffbc-icon-select').on('change', function() {
		var btn = $(this).data('btn');
		var val = $(this).val();
		if (val === 'custom') {
			$('#nffbc_custom_icon_row_' + btn).show();
		} else {
			$('#nffbc_custom_icon_row_' + btn).hide();
		}
	});

	// Live update font sizes
	$('#_nffbc_font_size_pc').on('input', function() {
		var size = $(this).val() + 'px';
		$('.nffbc-timer-overlay[data-device="pc"]').css('font-size', size);
		$('.nffbc-timer-overlay[data-device="pc"] .nffbc-digit').css('font-size', size);
	});
	$('#_nffbc_font_size_mobile').on('input', function() {
		var size = $(this).val() + 'px';
		$('.nffbc-timer-overlay[data-device="mobile"]').css('font-size', size);
		$('.nffbc-timer-overlay[data-device="mobile"] .nffbc-digit').css('font-size', size);
	});

	// Digit visibility toggle
	$('.nffbc-digit-toggle').on('change', function() {
		var device = $(this).data('device');
		var digit = $(this).data('digit');
		var isChecked = $(this).is(':checked');
		var $digitEl = $('.nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit[data-digit="' + digit + '"]');
		if (isChecked) {
			$digitEl.show();
		} else {
			$digitEl.hide();
		}
	});

	// JSON Import / Export handling
	function generateJSON() {
		var data = $('[name^="_nffbc_"]').serializeArray();
		$('#nffbc-json-data').val(JSON.stringify(data, null, 2));
	}
	
	$('#nffbc-apply-json').on('click', function() {
		try {
			var data = JSON.parse($('#nffbc-json-data').val());
			// Uncheck all checkboxes first
			$('[name^="_nffbc_"][type="checkbox"]').prop('checked', false);
			
			data.forEach(function(item) {
				var $el = $('[name="' + item.name + '"]');
				if ($el.is(':checkbox') || $el.is(':radio')) {
					$el.filter('[value="' + item.value + '"]').prop('checked', true);
				} else {
					$el.val(item.value);
				}
			});
			
			// Trigger UI updates
			$('[name^="_nffbc_"]').trigger('change');
			$('.pos-input').trigger('input');
			$('.nffbc-color-picker').each(function() {
				// Re-init or set color if WP Color Picker supports it
				try { $(this).wpColorPicker('color', $(this).val()); } catch(err){}
			});
			
			$('#nffbc-json-msg').show().delay(2000).fadeOut();
		} catch(e) {
			alert('Invalid JSON');
		}
	});

	// Handle input changes
	$('.pos-input').on('input', function() {
		var device = $(this).data('device');
		var digit = $(this).data('digit');
		var isX = $(this).hasClass('pos-x');
		var val = $(this).val();
		
		var $digitEl = $('.nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit[data-digit="' + digit + '"]');
		if (isX) {
			$digitEl.css('left', val + '%');
		} else {
			$digitEl.css('top', val + '%');
		}
	});

	function updatePreviewFontSize(device) {
		var $img = $('#preview_' + device + ' img');
		if (!$img.length) return;
		if (!$img[0].complete) {
			$img.on('load', function() { updatePreviewFontSize(device); });
			return;
		}
		
		var displayWidth = $img.width();
		var naturalWidth = $img[0].naturalWidth;
		if (displayWidth === 0 || naturalWidth === 0) return;
		
		var fontSize = parseFloat($('input[name="_nffbc_font_size_' + device + '"]').val()) || (device === 'pc' ? 24 : 16);
		
		var targetWidth = naturalWidth; // default to actual image width
		if (device === 'pc') {
			var maxWidthVal = $('input[name="_nffbc_max_width_pc"]').val() || '1000px';
			if (maxWidthVal.indexOf('px') !== -1) {
				targetWidth = parseFloat(maxWidthVal);
			}
		}
		
		var ratio = displayWidth / targetWidth;
		$('.nffbc-timer-overlay[data-device="' + device + '"]').css('font-size', (fontSize * ratio) + 'px');
	}

	function updateDigitBackgrounds(device) {
		var enabled = $('#_nffbc_digit_bg_enable_' + device).is(':checked');
		if (enabled) {
			$('.nffbc-digit-bg-settings-' + device).show();
		} else {
			$('.nffbc-digit-bg-settings-' + device).hide();
		}
		
		var color = $('#_nffbc_digit_bg_color_' + device).val() || '#000000';
		var padding = $('#_nffbc_digit_bg_padding_' + device).val() || '5px 10px';
		var radius = $('#_nffbc_digit_bg_radius_' + device).val() || '5px';
		
		var $digits = $('.nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit').not('.nffbc-digit-sep1, .nffbc-digit-sep2');
		if (enabled) {
			$digits.css({
				'background-color': color,
				'padding': padding,
				'border-radius': radius,
				'line-height': '1'
			});
		} else {
			$digits.css({
				'background-color': 'transparent',
				'padding': '0',
				'border-radius': '0',
				'line-height': 'normal'
			});
		}
	}

	function updateColors(device) {
		var fontColor = $('#_nffbc_font_color_' + device).val() || '#ffffff';
		var sepColor = $('#_nffbc_sep_color_' + device).val() || '#ffffff';
		
		$('.nffbc-timer-overlay[data-device="' + device + '"]').css('color', fontColor);
		$('.nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit-sep1, .nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit-sep2').css('color', sepColor);
	}

	// Trigger generate on any field change
	$(document).on('change input', '[name^="_nffbc_"]', function() {
		updatePreviewFontSize('pc');
		updatePreviewFontSize('mobile');
		updateDigitBackgrounds('pc');
		updateDigitBackgrounds('mobile');
		updateColors('pc');
		updateColors('mobile');
		generateJSON();
	});
	$(window).on('resize', function() {
		updatePreviewFontSize('pc');
		updatePreviewFontSize('mobile');
	});
	
	// Initial generate
	setTimeout(function() {
		updatePreviewFontSize('pc');
		updatePreviewFontSize('mobile');
		updateDigitBackgrounds('pc');
		updateDigitBackgrounds('mobile');
		updateColors('pc');
		updateColors('mobile');
		generateJSON();
	}, 500);

	// Auto Align Logic
	$('.nffbc-auto-align-btn').on('click', function() {
		var device = $(this).data('device');
		var labels = ['h1', 'h2', 'sep1', 'm1', 'm2', 'sep2', 's1', 's2'];
		
		var h1x = parseFloat($('.pos-input.pos-x[data-device="' + device + '"][data-digit="h1"]').val()) || 0;
		var h1y = parseFloat($('.pos-input.pos-y[data-device="' + device + '"][data-digit="h1"]').val()) || 0;
		
		var $container = $('#preview_' + device);
		var containerWidth = $container.width() || 1;
		
		var currentX = h1x;
		
		labels.forEach(function(digit, index) {
			if (index === 0) return; // Skip H1
			
			var prevDigit = labels[index - 1];
			var $prevEl = $('.nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit[data-digit="' + prevDigit + '"]');
			var $currEl = $('.nffbc-timer-overlay[data-device="' + device + '"] .nffbc-digit[data-digit="' + digit + '"]');
			
			// Temporarily show to get accurate width if it's hidden
			var prevDisplay = $prevEl.css('display');
			$prevEl.css({display: 'block', visibility: 'hidden'});
			var prevWidthPx = $prevEl.outerWidth() || 20;
			$prevEl.css({display: prevDisplay, visibility: ''});
			var prevWidthPct = (prevWidthPx / containerWidth) * 100;
			
			var currDisplay = $currEl.css('display');
			$currEl.css({display: 'block', visibility: 'hidden'});
			var currWidthPx = $currEl.outerWidth() || 20;
			$currEl.css({display: currDisplay, visibility: ''});
			var currWidthPct = (currWidthPx / containerWidth) * 100;
			
			// Get Gap from input
			var gapInput = parseFloat($container.siblings('.nffbc-digit-positions-manual').find('.nffbc-auto-gap').val());
			var gap = isNaN(gapInput) ? 0.8 : gapInput;
			
			currentX = currentX + (prevWidthPct / 2) + gap + (currWidthPct / 2);
			
			var $inputX = $('.pos-input.pos-x[data-device="' + device + '"][data-digit="' + digit + '"]');
			var $inputY = $('.pos-input.pos-y[data-device="' + device + '"][data-digit="' + digit + '"]');
			
			$inputX.val(currentX.toFixed(2));
			$inputY.val(h1y.toFixed(2));
			
			// Trigger input to update preview
			$inputX.trigger('input');
			$inputY.trigger('input');
		});
		
		generateJSON();
	});

	// Media Uploader
	var file_frame;
	var current_target_id = '';
	var current_preview_id = '';

	$(document).on('click', '.nffbc-upload-btn', function(e) {
		e.preventDefault();
		var $button = $(this);
		current_target_id = $button.data('target');
		current_preview_id = $button.data('preview');

		if ( file_frame ) {
			file_frame.open();
			return;
		}

		file_frame = wp.media.frames.file_frame = wp.media({
			title: nffbc_flashsale_admin.upload_title,
			button: {
				text: nffbc_flashsale_admin.upload_button
			},
			multiple: false
		});

		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get('selection').first().toJSON();
			$('#' + current_target_id).val(attachment.id);
			
			var img_url = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
			if (current_preview_id === 'preview_pc' || current_preview_id === 'preview_mobile') {
				img_url = attachment.url; // Use full size for banner preview
				var $previewWrap = $('#' + current_preview_id);
				$previewWrap.find('img').remove();
				$previewWrap.find('.nffbc-no-image-text').remove(); // Remove "No image selected" text
				$previewWrap.prepend('<img src="' + img_url + '" style="width:100%; height:auto; display:block;" />');
			} else {
				$('#' + current_preview_id).html('<img src="' + img_url + '" style="width:100%; height:auto;" />');
			}
		});

		file_frame.open();
	});

	$(document).on('click', '.nffbc-remove-btn', function(e) {
		e.preventDefault();
		var target_id = $(this).data('target');
		var preview_id = $(this).data('preview');
		$('#' + target_id).val('');
		
		if (preview_id === 'preview_pc' || preview_id === 'preview_mobile') {
			var $previewWrap = $('#' + preview_id);
			$previewWrap.find('img').remove();
			$previewWrap.prepend('<div class="nffbc-no-image-text" style="padding:40px; text-align:center; background:#f1f1f1;">No image selected</div>');
		} else {
			$('#' + preview_id).empty();
		}
	});

	// Drag & Drop for digits
	var isDragging = false;
	var currentDigit = null;
	var startX, startY, startLeft, startTop;

	$('.nffbc-digit').on('mousedown', function(e) {
		isDragging = true;
		currentDigit = $(this);
		startX = e.clientX;
		startY = e.clientY;
		
		var wrapper = currentDigit.closest('.nffbc-preview-wrap');
		startLeft = parseFloat(currentDigit.css('left')) || 0;
		startTop = parseFloat(currentDigit.css('top')) || 0;
		
		// If left/top are in %, convert to px for dragging
		if (currentDigit[0].style.left && currentDigit[0].style.left.indexOf('%') !== -1) {
			startLeft = (parseFloat(currentDigit[0].style.left) / 100) * wrapper.width();
			startTop = (parseFloat(currentDigit[0].style.top) / 100) * wrapper.height();
		}

		e.preventDefault();
	});

	$(document).on('mousemove', function(e) {
		if (!isDragging || !currentDigit) return;

		var dx = e.clientX - startX;
		var dy = e.clientY - startY;

		var wrapper = currentDigit.closest('.nffbc-preview-wrap');
		var newLeft = startLeft + dx;
		var newTop = startTop + dy;

		// Convert back to %
		var percentX = (newLeft / wrapper.width()) * 100;
		var percentY = (newTop / wrapper.height()) * 100;

		// Constrain to 0-100%
		percentX = Math.max(0, Math.min(100, percentX));
		percentY = Math.max(0, Math.min(100, percentY));

		currentDigit.css({
			left: percentX + '%',
			top: percentY + '%'
		});

		// Update specific number inputs for this digit only
		var digitName = currentDigit.data('digit'); // e.g., 'h1'
		var overlay = currentDigit.closest('.nffbc-timer-overlay');
		var device = overlay.data('device'); // 'pc' or 'mobile'
		
		$('.pos-input.pos-x[data-device="' + device + '"][data-digit="' + digitName + '"]').val(percentX.toFixed(2));
		$('.pos-input.pos-y[data-device="' + device + '"][data-digit="' + digitName + '"]').val(percentY.toFixed(2));
		generateJSON();
	});

	$(document).on('mouseup', function() {
		isDragging = false;
		currentDigit = null;
	});

	// Bottom Bar Layout Toggle
	$('#_nffbc_ctas_bottom_layout').on('change', function() {
		var val = $(this).val();
		if (val === 'none') {
			$('#nffbc-bottom-btn1-settings, #nffbc-bottom-btn2-settings').hide();
		} else if (val === 'full') {
			$('#nffbc-bottom-btn1-settings').show();
			$('#nffbc-bottom-btn1-settings h4').text('Button 1 (Full Width)');
			$('#nffbc-bottom-btn2-settings').hide();
		} else if (val === 'split') {
			$('#nffbc-bottom-btn1-settings, #nffbc-bottom-btn2-settings').show();
			$('#nffbc-bottom-btn1-settings h4').text('Button 1 (Left)');
		}
	});

	// Floating CTAs Dynamic Add/Remove
	var floatingCtaIndex = $('.nffbc-floating-cta-item').length;
	$('#nffbc-add-floating-cta').on('click', function(e) {
		e.preventDefault();
		var template = $('#tmpl-nffbc-floating-cta').html();
		template = template.replace(/{{id}}/g, floatingCtaIndex);
		$('#nffbc-floating-ctas-container').append(template);
		floatingCtaIndex++;
	});

	$(document).on('click', '.nffbc-remove-floating-cta', function(e) {
		e.preventDefault();
		if(confirm('Are you sure you want to remove this CTA?')) {
			$(this).closest('.nffbc-floating-cta-item').remove();
		}
	});
});
