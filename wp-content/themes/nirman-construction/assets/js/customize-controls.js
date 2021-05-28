( function( api ) {

	// Extends our custom "nirman-construction" section.
	api.sectionConstructor['nirman-construction'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );