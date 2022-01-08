<?php

require_once __DIR__ . '/vendor/autoload.php';

define('CARTTHROB_SHIPPING_USPS_NAME', 'CartThrob USPS Shipping');
define('CARTTHROB_SHIPPING_USPS_VERSION', '1.0.0');
define('CARTTHROB_SHIPPING_USPS_DESC', 'CartThrob USPS Shipping Integration');
define('CARTTHROB_SHIPPING_USPS_SETTINGS_EXIST', false);

return [
    'author'         => 'Foster Made',
    'author_url'     => 'https://cartthrob.com',
    'docs_url'       => '',
    'name'           => CARTTHROB_SHIPPING_USPS_NAME,
    'description'    => CARTTHROB_SHIPPING_USPS_DESC,
    'version'        => CARTTHROB_SHIPPING_USPS_VERSION,
    'namespace'      => 'CartThrob\ShippingUsps',
    'settings_exist' => CARTTHROB_SHIPPING_USPS_SETTINGS_EXIST,
];
