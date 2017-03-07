/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
marketplace_general = function () {
    return {
        autoResizeTextarea: function (this_element) {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function (el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };

            this_element.on('keyup input', function () {
                resizeTextarea(this);
            });
        }
    };
}();