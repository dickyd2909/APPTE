CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'document', 'doctools', 'mode' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] }
	];

	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,About,ShowBlocks,Maximize,Language,BidiRtl,BidiLtr,Replace,SelectAll,Find,Blockquote,CreateDiv,Anchor,PageBreak,Styles,Font,SpecialChar,InsertHorizontalLine,Outdent,Indent,RemoveFormat,CopyFormatting,Subscript,Superscript,Strike,HorizontalRule,Undo,Cut,Copy,Paste,PasteText,PasteFromWord,Redo';
	
	// Set the most common block elements.
	config.format_tags = 'h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.enterMode = CKEDITOR.ENTER_BR // pressing the ENTER KEY input <br/>
	config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER KEYS input <p>
	config.autoParagraph = false; // stops automatic insertion of <p> on focus
};