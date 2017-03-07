/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function () {
    advert_form.init();
});

advert_form = function () {
    return {
        init: function () {

            advert_form.addEvents(jQuery('body'));

        }, addEvents: function (html) {

            html.find('.latest_adverts_block .nav li a').click(function () {

                var category_id = jQuery(this).attr('category_id');

                advert_form.loadCategoryBlogs(category_id);
            });

            return html;

        }, loadCategoryBlogs: function (category_id) {

            var data_object = {category_id: category_id};

            var form = kazist.callAjaxByRoute('marketplace.adverts.ajaxloadcategoryadverts', data_object, true);

            jQuery('.category-adverts').html('Please Wait. Loading');
            kazist.addSpinningIcon(jQuery('.category-adverts'));

            jQuery('.category-adverts').html(form);

        }
    };
}();