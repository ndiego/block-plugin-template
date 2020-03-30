
/**
* External dependencies
*/
import classnames from 'classnames';

/**
 * Internal dependencies
 */
import Controls from './controls';
import Inspector from './inspector';
//import applyWithColors from './colors';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
/*import { compose } from '@wordpress/compose';*/
import { RichText } from '@wordpress/block-editor';

import { compose, ifCondition } from '@wordpress/compose';
import { registerFormatType } from '@wordpress/rich-text';
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { withSelect } from '@wordpress/data';

const MyCustomButton = props => {
	return <RichTextToolbarButton
		icon='editor-code'
		title='Sample output'
		onClick={ () => {
			console.log( 'toggle format' );
		} }
	/>
};

const ConditionalButton = compose(
	withSelect( function( select ) {
		return {
			selectedBlock: select( 'core/block-editor' ).getSelectedBlock()
		}
	} ),
	ifCondition( function( props ) {

		console.log( props.selectedBlock );

		return (
			props.selectedBlock &&
			props.selectedBlock.name === 'bpt/standard-block'
		);
	} )
)( MyCustomButton );

registerFormatType(
	'my-custom-format/sample-output', {
		title: 'Sample output',
		tagName: 'samp',
		className: null,
		edit: ConditionalButton,
	}
);

/**
 * Block edit function
 */
 class Edit extends Component {

 	render() {
 		const {
 			attributes,
 			className,
 			isSelected,
 			setAttributes,
 		} = this.props;

 		const {
 			textAlign,
 			title,
			enableTitle,
 			content,
 		} = attributes;

		console.log( 'this is working, maybe?' );

 		return (
 			<Fragment>
				{ isSelected && (
					<Controls
						{ ...this.props }
					/>
				) }
				{ isSelected && (
					<Inspector
						{ ...this.props }
					/>
				) }
 				<div
 					className={ classnames(
 						className, {
 							[ `has-text-align-${ textAlign }` ]: textAlign,
 						}
 					) }
 					style={ {

 					} }
 				>
 					{ ( ! RichText.isEmpty( title ) || isSelected ) && enableTitle && (
 						<RichText
 							/* translators: placeholder text for input box */
 							placeholder={ __( 'Write title…', 'bpt_textdomain' ) }
 							value={ title }
 							className="wp-block-bpt-notice__title"
 							onChange={ ( newTitle ) => setAttributes( { title: newTitle } ) }
							tagName="h3"
							/*isSelected="false"*/
							allowedFormats={ [
								'my-custom-format/sample-output',
								'core/italic',
								'core/link',
							] }
							keepPlaceholderOnFocus
 						/>
 					) }
 					<RichText
 						/* translators: placeholder text for input box */
 						placeholder={ __( 'Write text…', 'bpt_textdomain' ) }
 						value={ content }
 						className="wp-block-bpt-notice__content"
 						onChange={ ( newContent ) => setAttributes( { content: newContent } ) }
						tagName="div"
						allowedFormats={ [
							'core/bold',
							'core/italic',
							'core/link',
							'core/strikethrough',
							'core/code'
						] }
						multiline="p"
 						keepPlaceholderOnFocus
 					/>
 				</div>
 			</Fragment>
 		);
 	}
 }

 export default Edit;
