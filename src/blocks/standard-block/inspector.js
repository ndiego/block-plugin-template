/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
//import { compose } from '@wordpress/compose';
import { InspectorControls, ContrastChecker, PanelColorSettings } from '@wordpress/block-editor';
//import { withFallbackStyles } from '@wordpress/components';

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
		} = attributes;

		return (
			<Fragment>
				<InspectorControls>
					<div>
						Testing
					</div>
				</InspectorControls>
			</Fragment>
		);
	}
}

export default Inspector;
