CKEDITOR.editorConfig = function( config ) {
	//----------------------------------------------------
	//ASPECT DU WYSIWYG
	//----------------------------------------------------
	config.language 			= 'fr';
	config.width 					= '100%';
	config.uiColor 				= '#fffcf8';


	//----------------------------------------------------
	//CE QUE L'ON VA GARDER DANS LA TOOLBAR
	//----------------------------------------------------
	config.toolbar = [
		['Undo','Redo'],
		['NumberedList','BulletedList'],
		['Bold','Italic','Subscript','Superscript','-','RemoveFormat'],
		['Link','Unlink'],
		['Format','Styles','Source']
	];

	//----------------------------------------------------
	//CE QUE L'ON SOUHAITE VOIR APPARAITRE DANS Formats
	//----------------------------------------------------
	CKEDITOR.config.format_tags= 'p;h3;h4';

	//----------------------------------------------------
	//CE QUE L'ON SOUHAITE VOIR APPARAITRE DANS Styles
	//----------------------------------------------------
	CKEDITOR.stylesSet.add('my_styles',[
		{
			name: 		'Surlignage',
			element: 	'span',
			styles: 	{
				'background-color': 'yellow'
			}
		}
	]);

	config.stylesSet = 'my_styles';

	/*
	config.toolbar  = [
		[ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ],
		[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
		[ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ],
		[ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ],
		[ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ],
		[ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
		[ 'Link','Unlink','Anchor' ],
		[ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ],
		[ 'Styles','Format','Font','FontSize' ],
		[ 'TextColor','BGColor' ],
		[ 'Maximize', 'ShowBlocks','-','About' ]
	];
	*/

};
