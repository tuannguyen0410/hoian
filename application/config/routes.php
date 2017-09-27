<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['tags/(:any)'] = 'home/tags/$1';
$route['search'] = 'home/search';
$route['search/(:any)'] = 'home/search/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['blogs'] = 'home/news';
$route['blogs/(:any)'] = 'home/detail/$1';
$route['about-us'] = 'home/about';
$route['contact'] = 'home/contact';
$route['faqs'] = 'home/faqs';
$route['ourtour'] = 'home/ourtour';
$route['promotion'] = 'home/promotion';
$route['support'] = 'home/support';
$route['insurance'] = 'home/insurance';
$route['testimonials'] = 'home/testimonials';
$route['testimonials/(:num)'] = 'home/testimonials/$1';
$route['gallery'] = 'home/gallery';
$route['rss'] = 'home/rss';
$route['rss/(:num)'] = 'home/rss_detail/$1';
// $route['tour-detail/(:any)'] = 'home/tour_detail/$1';
$route['booking'] = 'home/booking';
$route['information'] = 'home/information';
$route['payment'] = 'home/payment';
$route['completed/(:num)'] = 'home/completed/$1';


$route['acp'] = "admincp";
$route['acp/login.html'] = "admincp/login";
$route['acp/logout'] = "admincp/logout";
$route['acp/reset-password'] = "admincp/changePassword";
$route['acp/reset-password/save'] = "admincp/changePassword";
$route['acp/checkPassword'] = "admincp/checkPassword";

$route['acp/categories/changeOrderBy'] = "categories/changeOrderBy";
$route['acp/categories/updateStatus'] = "categories/updateStatus";
$route['acp/categories/deleteImageContent'] = "categories/deleteImageContent";
$route['acp/categories/checkLinks'] = "categories/checkLinks";
$route['acp/categories'] = "categories/admincp";
$route['acp/categories/(:num)'] = "categories/admincp";
$route['acp/categories/add'] = "categories/addContent";
$route['acp/categories/edit/(:num)'] = "categories/addContent";
$route['acp/categories/del/(:num)'] = "categories/delete";
$route['acp/categories/del'] = "categories/delete";
$route['acp/categories/save'] = "categories/saveContent";
$route['acp/categories/search'] = "categories/searchContent";

$route['acp/article/categories/changeOrderBy'] = "article_categories/changeOrderBy";
$route['acp/article/categories/updateStatus'] = "article_categories/updateStatus";
$route['acp/article/categories/deleteImageContent'] = "article_categories/deleteImageContent";
$route['acp/article/categories/checkLinks'] = "article_categories/checkLinks";
$route['acp/article/categories'] = "article_categories/admincp";
$route['acp/article/categories/(:num)'] = "article_categories/admincp";
$route['acp/article/categories/add'] = "article_categories/addContent";
$route['acp/article/categories/edit/(:num)'] = "article_categories/addContent";
$route['acp/article/categories/del/(:num)'] = "article_categories/delete";
$route['acp/article/categories/del'] = "article_categories/delete";
$route['acp/article/categories/save'] = "article_categories/saveContent";
$route['acp/article/categories/search'] = "article_categories/searchContent";

$route['acp/product/categories/changeOrderBy'] = "product_categories/changeOrderBy";
$route['acp/product/categories/updateStatus'] = "product_categories/updateStatus";
$route['acp/product/categories/deleteImageContent'] = "product_categories/deleteImageContent";
$route['acp/product/categories/checkLinks'] = "product_categories/checkLinks";
$route['acp/product/categories'] = "product_categories/admincp";
$route['acp/product/categories/(:num)'] = "product_categories/admincp";
$route['acp/product/categories/add'] = "product_categories/addContent";
$route['acp/product/categories/edit/(:num)'] = "product_categories/addContent";
$route['acp/product/categories/del/(:num)'] = "product_categories/delete";
$route['acp/product/categories/del'] = "product_categories/delete";
$route['acp/product/categories/save'] = "product_categories/saveContent";
$route['acp/product/categories/search'] = "product_categories/searchContent";

$route['acp/banner/categories/changeOrderBy'] = "banner_categories/changeOrderBy";
$route['acp/banner/categories/updateStatus'] = "banner_categories/updateStatus";
$route['acp/banner/categories/deleteImageContent'] = "banner_categories/deleteImageContent";
$route['acp/banner/categories/checkLinks'] = "banner_categories/checkLinks";
$route['acp/banner/categories'] = "banner_categories/admincp";
$route['acp/banner/categories/(:num)'] = "banner_categories/admincp";
$route['acp/banner/categories/add'] = "banner_categories/addContent";
$route['acp/banner/categories/edit/(:num)'] = "banner_categories/addContent";
$route['acp/banner/categories/del/(:num)'] = "banner_categories/delete";
$route['acp/banner/categories/del'] = "banner_categories/delete";
$route['acp/banner/categories/save'] = "banner_categories/saveContent";
$route['acp/banner/categories/filter/(:num)'] = "banner_categories/searchContent/$1";

$route['acp/tour/categories/changeOrderBy'] = "tour_categories/changeOrderBy";
$route['acp/tour/categories/updateStatus'] = "tour_categories/updateStatus";
$route['acp/tour/categories/deleteImageContent'] = "tour_categories/deleteImageContent";
$route['acp/tour/categories/checkLinks'] = "tour_categories/checkLinks";
$route['acp/tour/categories'] = "tour_categories/admincp";
$route['acp/tour/categories/(:num)'] = "tour_categories/admincp";
$route['acp/tour/categories/add'] = "tour_categories/addContent";
$route['acp/tour/categories/edit/(:num)'] = "tour_categories/addContent";
$route['acp/tour/categories/del/(:num)'] = "tour_categories/delete";
$route['acp/tour/categories/del'] = "tour_categories/delete";
$route['acp/tour/categories/save'] = "tour_categories/saveContent";
$route['acp/tour/categories/filter/(:num)'] = "tour_categories/searchContent/$1";

$route['acp/testimonial/categories/changeOrderBy'] = "testimonial_categories/changeOrderBy";
$route['acp/testimonial/categories/updateStatus'] = "testimonial_categories/updateStatus";
$route['acp/testimonial/categories/deleteImageContent'] = "testimonial_categories/deleteImageContent";
$route['acp/testimonial/categories/checkLinks'] = "testimonial_categories/checkLinks";
$route['acp/testimonial/categories'] = "testimonial_categories/admincp";
$route['acp/testimonial/categories/(:num)'] = "testimonial_categories/admincp";
$route['acp/testimonial/categories/add'] = "testimonial_categories/addContent";
$route['acp/testimonial/categories/edit/(:num)'] = "testimonial_categories/addContent";
$route['acp/testimonial/categories/del/(:num)'] = "testimonial_categories/delete";
$route['acp/testimonial/categories/del'] = "testimonial_categories/delete";
$route['acp/testimonial/categories/save'] = "testimonial_categories/saveContent";
$route['acp/testimonial/categories/filter/(:num)'] = "testimonial_categories/searchContent/$1";

$route['acp/support/categories/changeOrderBy'] = "support_categories/changeOrderBy";
$route['acp/support/categories/updateStatus'] = "support_categories/updateStatus";
$route['acp/support/categories/deleteImageContent'] = "support_categories/deleteImageContent";
$route['acp/support/categories/checkLinks'] = "support_categories/checkLinks";
$route['acp/support/categories'] = "support_categories/admincp";
$route['acp/support/categories/(:num)'] = "support_categories/admincp";
$route['acp/support/categories/add'] = "support_categories/addContent";
$route['acp/support/categories/edit/(:num)'] = "support_categories/addContent";
$route['acp/support/categories/del/(:num)'] = "support_categories/delete";
$route['acp/support/categories/del'] = "support_categories/delete";
$route['acp/support/categories/save'] = "support_categories/saveContent";
$route['acp/support/categories/filter/(:num)'] = "support_categories/searchContent/$1";

$route['acp/faqs/categories/changeOrderBy'] = "faqs_categories/changeOrderBy";
$route['acp/faqs/categories/updateStatus'] = "faqs_categories/updateStatus";
$route['acp/faqs/categories/deleteImageContent'] = "faqs_categories/deleteImageContent";
$route['acp/faqs/categories/checkLinks'] = "faqs_categories/checkLinks";
$route['acp/faqs/categories'] = "faqs_categories/admincp";
$route['acp/faqs/categories/(:num)'] = "faqs_categories/admincp";
$route['acp/faqs/categories/add'] = "faqs_categories/addContent";
$route['acp/faqs/categories/edit/(:num)'] = "faqs_categories/addContent";
$route['acp/faqs/categories/del/(:num)'] = "faqs_categories/delete";
$route['acp/faqs/categories/del'] = "faqs_categories/delete";
$route['acp/faqs/categories/save'] = "faqs_categories/saveContent";
$route['acp/faqs/categories/search'] = "faqs_categories/searchContent";

$route['acp/article/changeOrderBy'] = "article/changeOrderBy";
$route['acp/article/updateStatus'] = "article/updateStatus";
$route['acp/article/checkLinks'] = "article/checkLinks";
$route['acp/article/deleteImageContent'] = "article/deleteImageContent";
$route['acp/article'] = "article/admincp";
$route['acp/article/(:num)'] = "article/admincp";
$route['acp/article/add'] = "article/addContent";
$route['acp/article/edit/(:num)'] = "article/addContent";
$route['acp/article/del/(:num)'] = "article/delete";
$route['acp/article/del'] = "article/delete";
$route['acp/article/save'] = "article/saveContent";
$route['acp/article/filter/(:num)'] = "article/searchContent/$1";

$route['acp/product/changeOrderBy'] = "product/changeOrderBy";
$route['acp/product/updateStatus'] = "product/updateStatus";
$route['acp/product/checkLinks'] = "product/checkLinks";
$route['acp/product/deleteImageContent'] = "product/deleteImageContent";
$route['acp/product'] = "product/admincp";
$route['acp/product/(:num)'] = "product/admincp";
$route['acp/product/add'] = "product/addContent";
$route['acp/product/edit/(:num)'] = "product/addContent";
$route['acp/product/del/(:num)'] = "product/delete";
$route['acp/product/del'] = "product/delete";
$route['acp/product/save'] = "product/saveContent";
$route['acp/product/filter/(:num)'] = "product/searchContent/$1";

$route['acp/testimonial/changeOrderBy'] = "testimonial/changeOrderBy";
$route['acp/testimonial/updateStatus'] = "testimonial/updateStatus";
$route['acp/testimonial/checkLinks'] = "testimonial/checkLinks";
$route['acp/testimonial/deleteImageContent'] = "testimonial/deleteImageContent";
$route['acp/testimonial'] = "testimonial/admincp";
$route['acp/testimonial/(:num)'] = "testimonial/admincp";
$route['acp/testimonial/add'] = "testimonial/addContent";
$route['acp/testimonial/edit/(:num)'] = "testimonial/addContent";
$route['acp/testimonial/del/(:num)'] = "testimonial/delete";
$route['acp/testimonial/del'] = "testimonial/delete";
$route['acp/testimonial/save'] = "testimonial/saveContent";
$route['acp/testimonial/search'] = "testimonial/searchContent";

$route['acp/support/changeOrderBy'] = "support/changeOrderBy";
$route['acp/support/updateStatus'] = "support/updateStatus";
$route['acp/support/checkLinks'] = "support/checkLinks";
$route['acp/support/deleteImageContent'] = "support/deleteImageContent";
$route['acp/support'] = "support/admincp";
$route['acp/support/(:num)'] = "support/admincp";
$route['acp/support/add'] = "support/addContent";
$route['acp/support/edit/(:num)'] = "support/addContent";
$route['acp/support/del/(:num)'] = "support/delete";
$route['acp/support/del'] = "support/delete";
$route['acp/support/save'] = "support/saveContent";
$route['acp/support/search'] = "support/searchContent";

$route['acp/booking/changeOrderBy'] = "booking/changeOrderBy";
$route['acp/booking/updateStatus'] = "booking/updateStatus";
$route['acp/booking/checkLinks'] = "booking/checkLinks";
$route['acp/booking/deleteImageContent'] = "booking/deleteImageContent";
$route['acp/booking'] = "booking/admincp";
$route['acp/booking/(:num)'] = "booking/admincp";
$route['acp/booking/add'] = "booking/addContent";
$route['acp/booking/edit/(:num)'] = "booking/addContent";
$route['acp/booking/del/(:num)'] = "booking/delete";
$route['acp/booking/del'] = "booking/delete";
$route['acp/booking/save'] = "booking/saveContent";
$route['acp/booking/search'] = "booking/searchContent";

$route['acp/banner/deleteImageContent'] = "banner/deleteImageContent";
$route['acp/banner/delGalleryImage'] = "banner/delGalleryImage";
$route['acp/banner/changeOrderBy'] = "banner/changeOrderBy";
$route['acp/banner/updateStatus'] = "banner/updateStatus";
$route['acp/banner/checkLinks'] = "banner/checkLinks";
$route['acp/banner'] = "banner/admincp";
$route['acp/banner/(:num)'] = "banner/admincp";
$route['acp/banner/add'] = "banner/addContent";
$route['acp/banner/edit/(:num)'] = "banner/addContent";
$route['acp/banner/del/(:num)'] = "banner/delete";
$route['acp/banner/del'] = "banner/delete";
$route['acp/banner/save'] = "banner/saveContent";
$route['acp/banner/filter/(:num)'] = "banner/searchContent/$1";

$route['acp/tour/deleteImageContent'] = "tour/deleteImageContent";
$route['acp/tour/delGalleryImage'] = "tour/delGalleryImage";
$route['acp/tour/changeOrderBy'] = "tour/changeOrderBy";
$route['acp/tour/updateStatus'] = "tour/updateStatus";
$route['acp/tour/checkLinks'] = "tour/checkLinks";
$route['acp/tour'] = "tour/admincp";
$route['acp/tour/(:num)'] = "tour/admincp";
$route['acp/tour/add'] = "tour/addContent";
$route['acp/tour/edit/(:num)'] = "tour/addContent";
$route['acp/tour/del/(:num)'] = "tour/delete";
$route['acp/tour/del'] = "tour/delete";
$route['acp/tour/save'] = "tour/saveContent";
$route['acp/tour/filter/(:num)'] = "tour/searchContent/$1";
$route['acp/tour/book'] = "tour/book";
$route['acp/tour/book/(:num)'] = "tour/book";
$route['acp/tour/book_view/(:num)'] = "tour/book_view";

$route['acp/order'] = "order/admincp";
$route['acp/order/(:num)'] = "order/admincp";
$route['acp/order/add'] = "order/addContent";
$route['acp/order/view/(:num)'] = "order/addContent";
$route['acp/order/del/(:num)'] = "order/delete";
$route['acp/order/del'] = "order/delete";
$route['acp/order/save'] = "order/saveContent";
$route['acp/order/search'] = "order/searchContent";
$route['acp/order/changeStatus/(:num)/(:num)'] = 'order/changeStatus/$1/$2';
$route['acp/order/printInvoice/(:num)'] = 'order/printInvoice/$1';

$route['acp/contact'] = "contact/admincp";
$route['acp/contact/(:num)'] = "contact/admincp";
$route['acp/contact/add'] = "contact/addContent";
$route['acp/contact/edit/(:num)'] = "contact/addContent";
$route['acp/contact/del/(:num)'] = "contact/delete";
$route['acp/contact/del'] = "contact/delete";
$route['acp/contact/save'] = "contact/saveContent";
$route['acp/contact/search'] = "contact/searchContent";

$route['acp/newsletter'] = "newsletter/admincp";
$route['acp/newsletter/(:num)'] = "newsletter/admincp";
$route['acp/newsletter/add'] = "newsletter/addContent";
$route['acp/newsletter/edit/(:num)'] = "newsletter/addContent";
$route['acp/newsletter/del/(:num)'] = "newsletter/delete";
$route['acp/newsletter/del'] = "newsletter/delete";
$route['acp/newsletter/save'] = "newsletter/saveContent";
$route['acp/newsletter/search'] = "newsletter/searchContent";

$route['acp/comments'] = "comments/admincp";
$route['acp/comments/(:num)'] = "comments/admincp";
$route['acp/comments/add'] = "comments/addContent";
$route['acp/comments/edit/(:num)'] = "comments/addContent";
$route['acp/comments/del/(:num)'] = "comments/delete";
$route['acp/comments/del'] = "comments/delete";
$route['acp/comments/save'] = "comments/saveContent";
$route['acp/comments/updateStatus'] = "comments/updateStatus";

$route['acp/faqs/changeOrderBy'] = "faqs/changeOrderBy";
$route['acp/faqs/updateStatus'] = "faqs/updateStatus";
$route['acp/faqs'] = "faqs/admincp";
$route['acp/faqs/(:num)'] = "faqs/admincp";
$route['acp/faqs/add'] = "faqs/addContent";
$route['acp/faqs/edit/(:num)'] = "faqs/addContent";
$route['acp/faqs/del/(:num)'] = "faqs/delete";
$route['acp/faqs/del'] = "faqs/delete";
$route['acp/faqs/save'] = "faqs/saveContent";
$route['acp/faqs/search'] = "faqs/searchContent";

$route['acp/page/changeOrderBy'] = "page/changeOrderBy";
$route['acp/page/updateStatus'] = "page/updateStatus";
$route['acp/page'] = "page/admincp";
$route['acp/page/(:num)'] = "page/admincp";
$route['acp/page/add'] = "page/addContent";
$route['acp/page/edit/(:num)'] = "page/addContent";
$route['acp/page/del/(:num)'] = "page/delete";
$route['acp/page/del'] = "page/delete";
$route['acp/page/save'] = "page/saveContent";
$route['acp/page/search'] = "page/searchContent";

$route['acp/menu/changeOrderBy'] = "menu/changeOrderBy";
$route['acp/menu/updateStatus'] = "menu/updateStatus";
$route['acp/menu'] = "menu/admincp";
$route['acp/menu/(:num)'] = "menu/admincp";
$route['acp/menu/add'] = "menu/addContent";
$route['acp/menu/edit/(:num)'] = "menu/addContent";
$route['acp/menu/del/(:num)'] = "menu/delete";
$route['acp/menu/del'] = "menu/delete";
$route['acp/menu/save'] = "menu/saveContent";
$route['acp/menu/search'] = "menu/searchContent";

$route['acp/translate/changeValue'] = "translate/changeValue";
$route['acp/translate'] = "translate/admincp";
$route['acp/translate/(:num)'] = "translate/admincp";
$route['acp/translate/add'] = "translate/addContent";
$route['acp/translate/edit/(:num)'] = "translate/addContent";
$route['acp/translate/del/(:num)'] = "translate/delete";
$route['acp/translate/del'] = "translate/delete";
$route['acp/translate/save'] = "translate/saveContent";
$route['acp/translate/search'] = "translate/searchContent";

$route['acp/feedback/changeOrderBy'] = "feedback/changeOrderBy";
$route['acp/feedback/updateStatus'] = "feedback/updateStatus";
$route['acp/feedback'] = "feedback/admincp";
$route['acp/feedback/(:num)'] = "feedback/admincp";
$route['acp/feedback/add'] = "feedback/addContent";
$route['acp/feedback/edit/(:num)'] = "feedback/addContent";
$route['acp/feedback/del/(:num)'] = "feedback/delete";
$route['acp/feedback/del'] = "feedback/delete";
$route['acp/feedback/save'] = "feedback/saveContent";
$route['acp/feedback/search'] = "feedback/searchContent";

$route['acp/users'] = "user/admincp";
$route['acp/users/(:num)'] = "user/admincp";
$route['acp/users/add'] = "user/addContent";
$route['acp/users/edit/(:num)'] = "user/addContent";
$route['acp/users/del/(:num)'] = "user/delete";
$route['acp/users/del'] = "user/delete";
$route['acp/users/save'] = "user/saveContent";
$route['acp/users/search'] = "user/searchContent";

$route['acp/setting'] = "setting/addContent";
$route['acp/setting/deleteImageContent'] = "setting/deleteImageContent";
$route['acp/setting/save'] = "setting/saveContent";



$route['c/(:any)'] = "home/category/$1";
$route['c/(:any)/(:any)'] = "home/category/$1/$2";
$route['(:any)'] = "home/tour_detail/$1";
