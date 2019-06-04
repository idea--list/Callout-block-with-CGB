/**
 * BLOCK: callout-cgb
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

// Copy&pasted ES5 code from the original plugin made without any toolkit
var { __ } = wp.i18n;
wp.blocks.registerBlockType(
	'callout-cgb/rtext',
	{
		title: __('Callout block with RichText component', 'callout-cgb'),
		category: 'widgets',
		icon: 'buddicons-activity',
		keywords: [ 'akarmi', 'valami' ],
		attributes:
			{
				content: {
					source: 'html',
					selector: 'h2',
				},
				backgroundColor: {
					type: 'string',
					default: 'blue',
				},
				textColor: {
					type: 'string',
					default: '#ffffff',
				},
			},
		edit: function(props){
			return wp.element.createElement(
				wp.editor.RichText,
				{
					tagName: 'h2',
					className: props.className,
					placeholder: __('Type something here...', 'callout-cgb'),
					value: props.attributes.content,
					style: {
						backgroundColor: props.attributes.backgroundColor,
						color: props.attributes.textColor
					},
					onChange: function(newContent){
						props.setAttributes( {content:newContent} );
					}
				}
			);
			
		},
		save: function(props){
			return wp.element.createElement(
				wp.editor.RichText.Content,
				{
					tagName: 'h2',
					value: props.attributes.content,
					style: {
						backgroundColor: props.attributes.backgroundColor,
						color: props.attributes.textColor
					}
				}
			);
		}
	}
);