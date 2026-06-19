document.addEventListener('DOMContentLoaded', function() {
	if (typeof nffbc_flashsale_data === 'undefined') return;

	var wrapper = document.getElementById('newfolder-flashsale-banner-with-counter-wrapper');
	if (!wrapper) return;

	var baseEndTime = new Date(nffbc_flashsale_data.endTime).getTime();
	var loopHours = parseInt(nffbc_flashsale_data.loopHours, 10) || 0;
	var loopMs = loopHours * 3600 * 1000;

	// No valid end date configured: hide the banner instead of showing NaN.
	if (isNaN(baseEndTime)) {
		wrapper.style.display = 'none';
		return;
	}

	function calculateEndTime() {
		var now = new Date().getTime();
		if (now < baseEndTime) {
			return baseEndTime;
		}

		if (loopHours > 0) {
			var diff = now - baseEndTime;
			var loopsPassed = Math.floor(diff / loopMs) + 1;
			return baseEndTime + (loopsPassed * loopMs);
		}

		return 0; // Expired
	}

	var currentEndTime = calculateEndTime();

	if (currentEndTime === 0) {
		// Expired and no loop
		wrapper.style.display = 'none';
		return;
	}

	// Show wrapper
	wrapper.style.display = '';

	var elements = {
		h1: document.querySelectorAll('.nffbc-digit-h1'),
		h2: document.querySelectorAll('.nffbc-digit-h2'),
		m1: document.querySelectorAll('.nffbc-digit-m1'),
		m2: document.querySelectorAll('.nffbc-digit-m2'),
		s1: document.querySelectorAll('.nffbc-digit-s1'),
		s2: document.querySelectorAll('.nffbc-digit-s2')
	};

	function updateDigits(nodeList, val) {
		for (var i = 0; i < nodeList.length; i++) {
			if (nodeList[i].getAttribute('data-val') !== val) {
				nodeList[i].innerText = val;
				nodeList[i].setAttribute('data-val', val);
			}
		}
	}

	function tick() {
		var now = new Date().getTime();
		var distance = currentEndTime - now;

		if (distance < 0) {
			// Time's up, recalculate loop
			currentEndTime = calculateEndTime();
			if (currentEndTime === 0) {
				wrapper.style.display = 'none';
				return;
			}
			distance = currentEndTime - now;
		}

		var hours = Math.floor(distance / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Format to 2 digits max for hours (or we can cap at 99)
		if (hours > 99) hours = 99;

		var hStr = hours < 10 ? '0' + hours : '' + hours;
		var mStr = minutes < 10 ? '0' + minutes : '' + minutes;
		var sStr = seconds < 10 ? '0' + seconds : '' + seconds;

		updateDigits(elements.h1, hStr.charAt(0));
		updateDigits(elements.h2, hStr.charAt(1));
		updateDigits(elements.m1, mStr.charAt(0));
		updateDigits(elements.m2, mStr.charAt(1));
		updateDigits(elements.s1, sStr.charAt(0));
		updateDigits(elements.s2, sStr.charAt(1));

		requestAnimationFrame(tick);
	}

	requestAnimationFrame(tick);
});
