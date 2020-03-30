/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
//import { compose } from '@wordpress/compose';
import {
	InspectorControls,
	ContrastChecker,
	PanelColorSettings
} from '@wordpress/block-editor';
import {
	//withFallbackStyles
	PanelBody,
	PanelRow,
	ToggleControl,
	Toolbar
} from '@wordpress/components';

/**
 * Inspector controls
 */
class Inspector extends Component {
	render() {
		const {
			attributes,
			setAttributes,
		} = this.props;

		const {
			enableTitle,
			titleHeadingTag
		} = attributes;

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody
						title={ __( 'Content Settings', 'bpt_textdomain' ) }
					>
						<ToggleControl
							label={ __( 'Notice Title', 'bpt_textdomain' ) }
							checked={ enableTitle }
							help={
								enableTitle ?
									__( 'Showing the notice title.', 'bpt_textdomain' ) :
									__( 'Toggle to show the notice title.', 'bpt_textdomain' )
							}
							onChange={ () => setAttributes( { enableTitle: ! enableTitle } ) }
						/>
						<Toolbar
							className='fcb-heading-tag-control'
							controls={
								'123456'.split( '' ).map( ( tag ) => ( {
									icon: 'heading',
									title: sprintf( __( 'Heading %s' ), tag ),
									isActive: 'h' + tag === titleHeadingTag,
									onClick: () => setAttributes( { titleHeadingTag: 'h' + tag } ),
									subscript: tag,
								} ) )
							}
						/>
					</PanelBody>
					<PanelBody
						title={ __( 'Color Settings', 'bpt_textdomain' ) }
					>
						Test
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	}
}

export default Inspector;
