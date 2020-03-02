/**
* External dependencies
*/
import classnames from 'classnames';

/**
* WordPress dependencies
*/
import { RichText, getColorClassName } from '@wordpress/block-editor';

const save = ( { attributes } ) => {
   const {
	   textAlign,
	   title,
	   content,
   } = attributes;

   const classes = classnames( {
	   [ `has-text-align-${ textAlign }` ]: textAlign,
   } );

   return (
	   	<div
	   		className={ classes }
	    >
		   	{ ! RichText.isEmpty( title ) &&
			<RichText.Content
			   	tagName="h2"
			   	className="wp-block-bpt-notice__title"
			   	value={ title }
		   	/>
		   	}
		   	{ ! RichText.isEmpty( content ) &&
		    <RichText.Content
				value={ content }
				className="wp-block-bpt-notice__content"
			    tagName="div"
				multiline="p"
		    />
		    }
	    </div>
	);
};

export default save;
