/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.toolbar_Basic =
        [
             [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ],
             [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
             '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
             [ 'Link','Unlink','Anchor' ] ,
             [ 'Image','Table','HorizontalRule' ],
            [ 'Styles','Format','Font','FontSize' ] ,
            [ 'TextColor','BGColor' ],
            [ 'ShowBlocks' ],
            [ 'PasteText','PasteFromWord','-','Undo','Redo' ]
        ];
    config.toolbar = 'ImuzikBasic';
    config.toolbar_Imuzik =
        [
                ['imuziksong'],
                [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ],
                [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                    '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                [ 'Link','Unlink','Anchor' ] ,
                [ 'Image','Table','HorizontalRule'],'/',
                [ 'Styles','Format','Font','FontSize'] ,
                [ 'TextColor','BGColor' ],
                [ 'ShowBlocks' ],
                [ 'PasteText','PasteFromWord','-','Undo','Redo' ]
        ];
    config.extraPlugins = 'imuziksong';

    config.toolbar_simple =[];
};

