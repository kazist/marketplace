/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

marketplace_navigation = function () {
    return {
        navigationClickPreviousEvent: function (this_element) {
            var last_image = this_element
                    .closest('.nav-advert-images')
                    .find('.nav-advert-pagination .nav-advert-image')
                    .first();

            this_element
                    .closest('.nav-advert-images')
                    .find('.nav-advert-pagination').append(last_image);

            // last_image.remove();

        }, navigationClickNextEvent: function (this_element) {

            var last_image = this_element
                    .closest('.nav-advert-images')
                    .find('.nav-advert-pagination .nav-advert-image')
                    .last();

            this_element
                    .closest('.nav-advert-images')
                    .find('.nav-advert-pagination').prepend(last_image);

        }
    };
}();