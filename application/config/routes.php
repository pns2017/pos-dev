<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login_controller/index';
$route['404_override'] = '';
$route['error500'] = 'error_controller';
$route['translate_uri_dashes'] = TRUE;


// $route['log-user'] = 'login_controller/login_validation';


$route['dashboard'] = 'dashboard_controller/index';
$route['user-logout'] = 'login_controller/logout';

//************************************** CUSTOMER ROUTES
//**************************************

$route['customers-page'] = 'customers/customers_controller';

$route['showlist-customers'] = 'customers/customers_controller/ajax_list';

$route['edit-customer/(:num)'] = 'customers/customers_controller/ajax_edit/$1';

$route['add-customer/(:num)'] = 'customers/customers_controller/ajax_add/$1';

$route['update-customer/(:num)'] = 'customers/customers_controller/ajax_update/$1';

$route['delete-customer/(:num)'] = 'customers/customers_controller/ajax_delete/$1';


//************************************** SUPPLIER
//**************************************
$route['suppliers-page'] = 'suppliers/suppliers_controller';

$route['showlist-suppliers'] = 'suppliers/suppliers_controller/ajax_list';

$route['edit-supplier/(:num)'] = 'suppliers/suppliers_controller/ajax_edit/$1';

$route['add-supplier/(:num)'] = 'suppliers/suppliers_controller/ajax_add/$1';

$route['update-supplier/(:num)'] = 'suppliers/suppliers_controller/ajax_update/$1';

$route['delete-supplier/(:num)'] = 'suppliers/suppliers_controller/ajax_delete/$1';


//************************************** INVENTORY / PRODUCTS
//**************************************
$route['inventory-page'] = 'inventory/inventory_controller';

$route['showlist-inventory'] = 'inventory/inventory_controller/ajax_list';

$route['edit-product/(:num)'] = 'inventory/inventory_controller/ajax_edit/$1';

$route['add-product/(:num)'] = 'inventory/inventory_controller/ajax_add/$1';

$route['update-product/(:num)'] = 'inventory/inventory_controller/ajax_update/$1';

$route['delete-product/(:num)'] = 'inventory/inventory_controller/ajax_delete/$1';

$route['add-stock/(:num)'] = 'inventory/inventory_controller/ajax_add_stock/$1';

$route['damaged-items/(:num)'] = 'inventory/inventory_controller/ajax_damaged_items/$1';


//************************************** SUPPLY LOGS
//**************************************
$route['supply-logs-page'] = 'supply_logs/supply_logs_controller';

$route['showlist-supply-logs'] = 'supply_logs/supply_logs_controller/ajax_list';

$route['view-product/(:num)'] = 'inventory/inventory_controller/ajax_edit/$1';


//************************************** DAMAGED ITEMS
//**************************************
$route['damaged-items-page'] = 'damaged_items/damaged_items_controller';

$route['showlist-damaged_items'] = 'damaged_items/damaged_items_controller/ajax_list';


//************************************** USERS
//**************************************

$route['users-page'] = 'users/users_controller/index';

$route['showlist-users'] = 'users/users_controller/ajax_list';

$route['edit-user/(:num)'] = 'users/users_controller/ajax_edit/$1';

$route['add-user/(:num)'] = 'users/users_controller/ajax_add/$1';

$route['update-user/(:num)'] = 'users/users_controller/ajax_update/$1';

$route['edit-priveleges/(:num)'] = 'users/users_controller/ajax_edit/$1';

$route['update-priveleges/(:num)'] = 'users/users_controller/ajax_priveleges_update/$1';

$route['delete-user/(:num)'] = 'users/users_controller/ajax_delete/$1';


//************************************** CASHIER
//**************************************
$route['transaction-page'] = 'cashier/cashier_controller/index';

$route['view-product/(:num)'] = 'inventory/inventory_controller/ajax_edit/$1';

$route['delete-item/(:num)'] = 'cashier/cashier_controller/item_delete/$1';

$route['cashier-showitem-list'] = 'cashier/cashier_controller/ajax_list';




//************************************** REPORT
//**************************************
			//** SALES **//
$route['report/daily-sales'] = 'reports/report_controller/sales_daily_report';

$route['report/weekly-sales'] = 'reports/report_controller/sales_weekly_report';

$route['report/monthly-sales'] = 'reports/report_controller/sales_monthly_report';

$route['report/yearly-sales'] = 'reports/report_controller/sales_yearly_report';

			//** INVENTORY **//
$route['report/daily-inventory'] = 'reports/report_controller/inventory_daily_report';

$route['report/weekly-inventory'] = 'reports/report_controller/inventory_weekly_report';

$route['report/monthly-inventory'] = 'reports/report_controller/inventory_monthly_report';

$route['report/yearly-inventory'] = 'reports/report_controller/inventory_yearly_report';

