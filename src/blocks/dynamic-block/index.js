/**
 * Internal dependencies
 */
import edit from './edit';
import icon from './icon';
//import metadata from './block.json';
import transforms from './transforms';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Block constants
 */
//const { name, category } = metadata;

const settings = {
	/* translators: block name */
	title: __( 'Posts', 'sample_plugin_textdomain' ),
	/* translators: block description */
	description: __( 'Display posts or an RSS feed as stacked or horizontal cards.', 'sample_plugin_textdomain' ),
	icon,
	keywords: [
		/* translators: block keyword */
		__( 'posts', 'sample_plugin_textdomain' ),
		/* translators: block keyword */
		__( 'blog', 'sample_plugin_textdomain' ),
		/* translators: block keyword */
		__( 'latest', 'sample_plugin_textdomain' ),
		/* translators: block keyword */
		__( 'rss', 'sample_plugin_textdomain' ),
	],
	supports: {
		align: [ 'wide', 'full' ],
		html: false,
	},
	//transforms,
	//edit,
	save() {
		return null;
	},
};

const name = 'bpt/dynamicBlock';
const category = 'bpt';

export { name, category, settings };
