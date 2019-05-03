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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';

$route['departments'] = 'departments/index';
$route['departments/(:num)'] = 'departments/index/$1';

$route['categories'] = 'categories/index';
$route['categories/(:num)'] = 'categories/index/$1';
$route['categories/inproduct/(:num)'] = 'categories/inProduct/$1';
$route['categories/indepartment/(:num)'] = 'categories/inDepartment/$1';

$route['attributes'] = 'attributes/index';
$route['attributes/(:num)'] = 'attributes/index/$1';
$route['attributes/values/(:num)'] = 'attributes/values/$1';
$route['attributes/inproduct/(:num)'] = 'attributes/inProduct/$1';

$route['products'] = 'products/index';
$route['products/(:num)'] = 'products/index/$1';
$route['products/incategory/(:num)'] = 'products/inCategory/$1';
$route['products/indepartment/(:num)'] = 'products/inDepartment/$1';
$route['products/(:num)/details'] = 'products/details/$1';
$route['products/(:num)/locations'] = 'products/locations/$1';
$route['products/(:num)/reviews'] = 'products/reviews/$1';
@$route['products/(:num)/reviews']['POST'] = 'products/createReviews/$1';

$route['customer']['PUT'] = 'customers/updateCustomer';
$route['customer']['GET'] = 'customers/customer';
$route['customers']['POST'] = 'customers/index';
$route['customers/login'] = 'customers/login';
$route['customers/facebook'] = 'customers/facebook';
$route['customers/address'] = 'customers/address';
$route['customers/creditcard'] = 'customers/creditCard';

$route['orders']['POST'] = 'orders';
$route['orders/(:num)'] = 'orders/index/$1';
$route['orders/incustomer'] = 'orders/incustomer';
$route['orders/shortdetail/(:num)'] = 'orders/shortdetail/$1';

$route['shoppingcart/generateuniqueid'] = 'shoppingcart/generateuniqueid';
$route['shoppingcart/add']['POST'] = 'shoppingcart/add';
$route['shoppingcart/(:any)'] = 'shoppingcart/index/$1';
$route['shoppingcart/update/(:num)']['PUT'] = 'shoppingcart/update/$1';
$route['shoppingcart/empty/(:any)']['DELETE'] = 'shoppingcart/empty/$1';
$route['shoppingcart/movetocart/(:num)'] = 'shoppingcart/moveToCart/$1';
$route['shoppingcart/totalamount/(:any)'] = 'shoppingcart/totalAmount/$1';
$route['shoppingcart/saveforlater/(:num)'] = 'shoppingcart/saveForLater/$1';
$route['shoppingcart/getsaved/(:any)'] = 'shoppingcart/getSaved/$1';
$route['shoppingcart/removeProduct/(:num)'] = 'shoppingcart/removeProduct/$1';

$route['tax'] = 'tax/index';
$route['tax/(:num)'] = 'tax/index/$1';

$route['shipping/regions'] = 'shipping/regions';
$route['shipping/regions/(:num)'] = 'shipping/regions/$1';

$route['stripe/charge']['POST'] = 'stripe/charge';
$route['stripe/webhooks']['POST'] = 'stripe/webhooks';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
