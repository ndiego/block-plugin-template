/**
 * Internal dependencies
 */
import metadata from './block.json';
import icon from './icon';
import transforms from './transforms';
import edit from './edit';
import save from './save';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Block constants
 */
const { name, category, attributes } = metadata;

const settings = {
	/* translators: block name */
	title: __( 'Standard Notice Block', 'bpt_textdomain' ),
	/* translators: block description */
	description: __( 'Display a simple notice.', 'bpt_textdomain' ),
	icon,
	keywords: [
		/* translators: block keyword */
		__( 'notice', 'bpt_textdomain' ),
		/* translators: block keyword */
		__( 'alert', 'bpt_textdomain' ),
		/* translators: block keyword */
		__( 'message', 'bpt_textdomain' ),
		/* translators: block keyword */
		__( 'note', 'bpt_textdomain' ),
	],
	supports: {
		align: [ 'wide', 'full' ],
		//html: false,
	},
	attributes,
	//transforms,
	edit,
	save,
};

export { name, category, settings };
