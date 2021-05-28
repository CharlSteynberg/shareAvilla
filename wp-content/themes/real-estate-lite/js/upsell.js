/**
 * Upsell notice for theme
 */

( function( $ ) {

	// Add Upgrade Message
	if ('undefined' !== typeof real_estate_liteL10n) {
		upsell = $('<a class="real-estate-lite-upsell-link"></a>')
			.attr('href', real_estate_liteL10n.real_estate_liteURL)
			.attr('target', '_blank')
			.text(real_estate_liteL10n.real_estate_liteLabel)
			.css({
				'display' : 'inline-block',
				'background-color' : '#f1572f',
				'color' : '#fff',
				'text-transform' : 'uppercase',
				'margin-top' : '6px',
				'padding' : '10px 10px',
				'font-size': '9px',
				'letter-spacing': '1px',
				'line-height': '1.5',
				'clear' : 'both',
				'width' : '100%'
			})
		;

		setTimeout(function () {
			$('#accordion-section-themes h3').append(upsell);
		}, 200);

		// Remove accordion click event
		$('.real-estate-lite-upsell-link').on('click', function(e) {
			e.stopPropagation();
		});
	}

} )( jQuery );