/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function () {
    marketplace.init();
});

marketplace = function () {
    return {
        init: function () {
            marketplace.addEvents(jQuery('body'));
        },
        addEvents: function (html) {

            html = marketplace.addPhotosEvents(html);
            html = marketplace.addNavigationEvents(html);

            html.find("textarea").each(function () {
                marketplace_general.autoResizeTextarea(jQuery(this));
            });

            html.find(".package_input input").on('ifChecked', function (event) {
                //  html.find(".package_input input").click(function () {
                marketplace.showPackagePrice(jQuery(this), html);
            });

            return html;

        }, addNavigationEvents: function (html) {
            html.find(".nav-advert-images-left").click(function () {
                marketplace_navigation.navigationClickNextEvent(jQuery(this));
            });

            html.find(".nav-advert-images-right").click(function () {
                marketplace_navigation.navigationClickPreviousEvent(jQuery(this));
            });

            return html;

        }, addPhotosEvents: function (html) {

            html.find('.photos .photo').each(function () {
                marketplace_photos.photoClickEvent(jQuery(this));
            });

            return html;

        }, showPackagePrice: function (this_element, html) {

            var package_id = this_element.val();

            // Reset Previous Selection
            html.find('.package_price_id .package_price_input').hide();
            html.find('.package_price_id .package_price_input input').iCheck('uncheck');

            //Show Appropriates
            html.find('.package_price_id .package_price_input_' + package_id)
                    .show()
                    .first()
                    .find('input')
                    .iCheck('check');

            console.log(html.find('.package_price_id .package_price_input_' + package_id)
                    .show()
                    .first()
                    .find('input'));
            jQuery('.package_changed').show();
        }

    };
}();









