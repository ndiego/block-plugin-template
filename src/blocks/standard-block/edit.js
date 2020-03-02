
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
import { compose } from '@wordpress/compose';
import { RichText } from '@wordpress/block-editor';

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
 					{ ( ! RichText.isEmpty( title ) || isSelected ) && (
 						<RichText
 							/* translators: placeholder text for input box */
 							placeholder={ __( 'Write title…', 'bpt_textdomain' ) }
 							value={ title }
 							className="wp-block-bpt-notice__title"
 							onChange={ ( newTitle ) => setAttributes( { title: newTitle } ) }
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
						multiline="p"
 						keepPlaceholderOnFocus
 					/>
 				</div>
 			</Fragment>
 		);
 	}
 }

 export default Edit;
