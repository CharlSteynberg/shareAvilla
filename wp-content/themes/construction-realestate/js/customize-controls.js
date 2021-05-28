( function( api ) {

	// Extends our custom "construction-realestate" section.
	api.sectionConstructor['construction-realestate'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );