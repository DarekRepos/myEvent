//get function from global scope
const { registerBlockType } = wp.blocks;

registerBlockType('myeventblock/custom-myevent-js', {
	title: 'Add Event',
	description: 'Block to Add events',
	icon: 'format-image',
	category: 'layout',

	// custom attributes
	attributes: {},

	// custom functions

	edit: () => {

	},
	save: () => {

	}
});
