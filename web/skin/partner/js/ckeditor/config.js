/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	protocol	=	location.protocol;
	host		=	location.host;
	//alert(protocol+'//'+host+"/admin/js/");
	
	base_url							=	protocol+'//'+host+"/admin/js/";
	config.filebrowserBrowseUrl 		= 	base_url+'ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl 	= 	base_url+'ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl 	= 	base_url+'ckfinder/ckfinder.html?type=Flash';
	//config.filebrowserUploadUrl = 'ckfindercore/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl 	= 	base_url+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl 	= 	base_url+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
