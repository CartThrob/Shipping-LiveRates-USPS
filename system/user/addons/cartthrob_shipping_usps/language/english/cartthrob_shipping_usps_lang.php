<?php

$lang = [
    'usps_title'		  => 'United States Postal Servcice (USPS) Live Rates',
    'usps_overview'	=> '<h3 style="display:block">Use of This Plugin</h3>
	
	<p>LiveRates shipping costs are not updated automatically when the cart contents are modified. LiveRates shipping plugins requires that you manually request a shipping quote at some point during your checkout process. If you do not use the <a href="http://cartthrob.com/docs/tags_detail/get_live_rates_form">{exp:cartthrob:get_live_rates_form}</a> tag, your shipping costs may not be set for checkout.</p> 
	
	<h3 style="display:block">Estimate Accuracy Warning</h3>
	<p>If your actual packing and shipping methods differ from the information you use to request the cost estimate, your shipping costs may vary from the estimated value. By default the entire cart weight is used to calculate shipping costs, along with default length, width, and height values set below. If you require more specialized packaging, please post a request in the CartThrob forums. If modifications to this plugin are required, additional fees may be incurred. </p>
	
	<p>Each time items in the cart are added, updated, or removed, shipping costs are reset to zero when using a LiveRates shipping plugin. It is recommended that you check to see that shipping costs are set before allowing a customer to check out. For example: {if "{exp:cartthrob:cart_shipping prefix=""}" = "0.00"}show live rates{if:else}show checkout{/if}</p>',
    'usps_user_id'		                => 'User ID',
    'usps_origination_address'	     => 'Origination Address',
    'usps_origination_city'	        => 'Origination City',
    'usps_origination_state'	       => 'Origination State',
    'usps_origination_zip'	         => 'Origination Zip',
    'usps_origination_address2'     => 'Origination Address (line 2)',
    'usps_origination_country_code'	=> 'Origination Country',
    'usps_service_default'			       => 'Service Default',
    'usps_default_package_length'	  => 'Default Package Length',
    'usps_default_package_width'	   => 'Default Package Width',
    'usps_default_package_height'	  => 'Default Package Height',
    'usps_customer_selectable_rate'	=> 'Customer Selectable Rate Options',
    ];
