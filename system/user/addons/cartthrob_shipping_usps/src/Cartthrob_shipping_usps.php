<?php if ( ! defined('CARTTHROB_PATH')) Cartthrob_core::core_error('No direct script access allowed');

use CartThrob\Plugins\Shipping\ShippingPlugin;
use Money\Money;

class Cartthrob_shipping_usps extends ShippingPlugin
{
    public $title = "usps_title";
    public $overview = 'usps_overview';
    public $html = '';
    public $settings = array(
        array(
            'name' => 'usps_user_id',
            'short_name' => 'userid',
            'type' => 'text',
            'default'	=> ''
        ),
        /// DEFAULTS FOR SHIPPING OPTIONS
        array(
            'name' => 'usps_origination_address',
            'short_name' => 'origination_address',
            'type' => 'text'
        ),
        array(
            'name' => 'usps_origination_address2',
            'short_name' => 'origination_address2',
            'type' => 'text'
        ),
        array(
            'name' => 'usps_origination_city',
            'short_name' => 'origination_city',
            'type' => 'text'
        ),
        array(
            'name' => 'usps_origination_state',
            'short_name' => 'origination_state',
            'type'			=> 'select',
            'attributes'		=> array(
                'class'	=> 'states_blank',
            ),

        ),

        array(
            'name' => 'usps_origination_zip',
            'short_name' => 'origination_zip',
            'type' => 'text'
        ),
        array(
            'name'			=> 'usps_origination_country_code',
            'short_name'	=> 'orig_country_code',
            'type'			=> 'select',
            'default'		=> 'USA',
            'attributes'		=> array(
                'class'	=> 'countries_blank',
            ),
        ),
        array(
            'name' => 'usps_service_default',
            'short_name' => 'product_id',
            'type' => 'select',
            'default' => 'PARCEL',
            'options' => array(
                ''		=> '--- Valid Domestic Values ---',
                'EXPRESS'				=> 'Express',
                'EXPRESS_SH'			=> 'Express SH',
                'EXPRESS COMMERCIAL'	=> 'Express Commercial',
                'PRIORITY'				=> 'Priority',
                'PARCEL'				=> 'Parcel',
                'PRIORITY_COMMERCIAL'	=> 'Priority Commercial',
                'MEDIA'					=> 'Media Mail',
            ),
        ),
        array(
            'name' =>  'usps_default_package_length',
            'short_name' => 'def_length',
            'type' => 'text',
            'default' => '15'
        ),
        array(
            'name' =>  'usps_default_package_width',
            'short_name' => 'def_width',
            'type' => 'text',
            'default' => '15'
        ),
        array(
            'name' =>  'usps_default_package_height',
            'short_name' => 'def_height',
            'type' => 'text',
            'default' => '15'
        ),
        // CUSTOMER CHOICES
        array(
            'name' => 'usps_customer_selectable_rate',
            'short_name' => 'selectable_rates',
            'type' => 'header',
        ),
        array(
            'name' => 'Parcel',
            'short_name' => 'PARCEL',
            'type' => 'radio',
            'default' => 'y',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'First-Class',
            'short_name' => 'FIRST_CLASS',
            'type' => 'radio',
            'default' => 'y',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Express',
            'short_name' => 'EXPRESS',
            'type' => 'radio',
            'default' => 'y',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Express SH',
            'short_name' => 'EXPRESS_SH',
            'type' => 'radio',
            'default' => 'n',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Express Commercial',
            'short_name' => 'EXPRESS_COMMERCIAL',
            'type' => 'radio',
            'default' => 'n',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Priority',
            'short_name' => 'PRIORITY',
            'type' => 'radio',
            'default' => 'y',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Priority Commercial',
            'short_name' => 'PRIORITY_COMMERCIAL',
            'type' => 'radio',
            'default' => 'n',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Media Mail',
            'short_name' => 'MEDIA',
            'type' => 'radio',
            'default' => 'n',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Express Mail International',
            'short_name' => 'EXPRESS_MAIL_INTERNATIONAL',
            'type' => 'radio',
            'default' => 'n',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'Priority Mail International',
            'short_name' => 'PRIORITY_MAIL_INTERNATIONAL',
            'type' => 'radio',
            'default' => 'n',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
        array(
            'name' => 'First-Class International',
            'short_name' => 'FIRST_CLASS_INTERNATIONAL',
            'type' => 'radio',
            'default' => 'y',
            'options' => array(
                'n' => 'No',
                'y' => 'Yes',
                )
        ),
    );

    public $required_fields = [];

    public $shipping_methods = [
        ''		=> '--- Valid Domestic Values ---',
        'PARCEL'	=> 'Parcel',
        'FIRST_CLASS'	=> 'First-Class',
        'EXPRESS'	=> 'Express',
        'EXPRESS_SH'	=> 'Express SH',
        'EXPRESS_COMMERCIAL'	=> 'Express Commercial',
        'PRIORITY'	=> 'Priority',
        'PRIORITY_COMMERCIAL'	=> 'Priority Commercial',
        'MEDIA'	=> 'Media Mail',
        ''		=> '--- Valid International Values ---',
        'FIRST_CLASS_INTERNATIONAL'	=> 'Express Mail International',
        'PRIORITY_MAIL_INTERNATIONAL'	=> 'Priority Mail International',
        'EXPRESS_MAIL_INTERNATIONAL'	=> 'First-Class International',
    ];

    /**
     * @param array $params
     * @param array $defaults
     * @return Cartthrob_shipping|void
     */
    public function initialize($params = [], $defaults = [])
    {
        if(is_callable('ini_set')) {
            ini_set("soap.wsdl_cache_enabled", "0");
        }
    }

    /**
     * @param string $option_value
     * @return array
     */
    function get_live_rates($option_value="ALL")
    {
        ee()->load->library('cartthrob_shipping_plugins');
        $this->core->cart->set_custom_data("shipping_error", "");
        $this->core->cart->save();

        $orig_state = 	($this->plugin_settings('origination_state'))? $this->plugin_settings('origination_state') : ee()->cartthrob_shipping_plugins->customer_location_defaults('state') ;
        $orig_zip = 	($this->plugin_settings('origination_zip'))? $this->plugin_settings('origination_zip') : ee()->cartthrob_shipping_plugins->customer_location_defaults("zip");
        $orig_country_code = ($this->plugin_settings('orig_country_code'))? ee()->cartthrob_shipping_plugins->alpha2_country_code($this->plugin_settings('orig_country_code')) : ee()->cartthrob_shipping_plugins->alpha2_country_code(ee()->cartthrob_shipping_plugins->customer_location_defaults("country_code"));
        $orig_res_com = ($this->plugin_settings('origination_res_com') == "RES")? 1: 0;
        $destination_res_com = ($this->plugin_settings('destination_res_com') == "RES")? 1: 0;


        // the following variables are set, so that we can maintain this code, and CT1's code easier. setting these variables allows us to keep some of the following code in parity
        $rate_chart = $this->plugin_settings('rate_chart');
        $shipping_address = ee()->cartthrob_shipping_plugins->customer_location_defaults('address') ;
        $shipping_address2 = ee()->cartthrob_shipping_plugins->customer_location_defaults('address2') ;
        $shipping_city = ee()->cartthrob_shipping_plugins->customer_location_defaults('city') ;
        $shipping_state = ee()->cartthrob_shipping_plugins->customer_location_defaults('state') ;
        $shipping_zip = ee()->cartthrob_shipping_plugins->customer_location_defaults('zip') ;
        $dest_country_code = ee()->cartthrob_shipping_plugins->alpha2_country_code(ee()->cartthrob_shipping_plugins->customer_location_defaults('country_code')) ;
        $container =  ee()->cartthrob_shipping_plugins->customer_location_defaults('container', $this->plugin_settings('container'));
        $dim_width = ee()->cartthrob_shipping_plugins->customer_location_defaults('width',$this->plugin_settings('def_width'));
        $dim_length = ee()->cartthrob_shipping_plugins->customer_location_defaults('length',$this->plugin_settings('def_length'));
        $dim_height = ee()->cartthrob_shipping_plugins->customer_location_defaults('height',$this->plugin_settings('def_height'));
        // set default weight
        $weight_total =  ($this->core->cart->weight() ? $this->core->cart->weight() : 1);


        if ($option_value == "ALL") {
            $product_id= $this->plugin_settings("product_id");
        } else {
            $product_id = $option_value;
        }

        $shipping = [
            'error_message'	=> null,
            'price'			=> [],
            'option_value'	=> [],
            'option_name'	=> [],
        ];

        if (!$this->plugin_settings('userid')) {
            $shipping['error_message'] = ee()->lang->line('shipping_settings_not_configured');
            return $shipping;
        }

        $api = "RateV4";
        $intl_api  = "IntlRateV2";

        $this->host = "http://production.shippingapis.com/ShippingAPI.dll?API=".$api."&XML=";
        $this->international_host ="http://production.shippingapis.com/ShippingAPI.dll?API=IntlRateV2&XML=";

        $container = "RECTANGULAR";

        if ($this->plugin_settings('def_width') > 12 || $this->plugin_settings('def_length') > 12  || $this->plugin_settings('def_height') >12) {
            $size = "LARGE";// large is any container over 12 on any side.
        } else {
            $size = "REGULAR";
            $container = "";
        }

        $ounces = number_format(16 * ($this->core->cart->weight()  - floor($this->core->cart->weight()  )), 1, '.', '');
        $pounds = intval(floor( $this->core->cart->weight()  )) ;

        ///////////////////////////////////////////////////////////////////
        // USPS uses 2 char codes. This is supposed to be this way
        if ($dest_country_code == "US")
        {
            $request = new SimpleXMLElement("<".$api."Request USERID='".$this->plugin_settings('userid')."'></".$api."Request>");
            $request->addChild("Revision", "2");

            foreach ($this->shipping_methods() as $key => $item)
            {
                if ($key == "EXPRESS_MAIL_INTERNATIONAL" || $key == "PRIORITY_MAIL_INTERNATIONAL" || $key == "FIRST_CLASS_INTERNATIONAL")
                {
                    continue;
                }

                switch (strtolower($item))
                {
                    case "express":
                    case "priority":
                        /*
                        // @NOTE only set this if you're sending via a flat rate envelope or other flat rate item
                        if ($size == "REGULAR")
                        {
                            $container = "FLAT RATE ENVELOPE";
                        }
                        break;
                        */
                    case "parcel":
                        if ($size == "REGULAR")
                        {
                            $container = "";
                        }
                        break;
                }

                $key = str_replace(' ', '_', $key);
                    $package = $request->addChild("Package");
                    $package->addAttribute('ID', $key);
                    $package->addChild("Service", $item);
                    $package->addChild('FirstClassMailType', 'PARCEL');
                    $package->addChild("ZipOrigination",substr($this->plugin_settings('origination_zip'), 0, 5) );
                    $package->addChild('ZipDestination', substr($shipping_zip, 0, 5));
                    $package->addChild('Pounds', $pounds);
                    $package->addChild('Ounces', $ounces);
                    $package->addChild('Container',$container);
                    $package->addChild('Size', $size);
                    $package->addChild('Width', $this->plugin_settings('def_width'));
                    $package->addChild('Length', $this->plugin_settings('def_length'));
                    $package->addChild('Height', $this->plugin_settings('def_height'));
                    $package->addChild('Machinable', 'true');
            }

            $xml = new SimpleXMLElement(ee()->cartthrob_shipping_plugins->curl_transaction($this->host. urlencode( (string) $request->asXML() ) ));

        } else {
            $request = new SimpleXMLElement("<".$intl_api."Request USERID='".$this->plugin_settings('userid')."'></".$intl_api."Request>");
            $request->addChild("Revision", "2");

            $package = $request->addChild("Package");
            $package->addAttribute('ID', "0");
            $package->addChild('Pounds', $pounds);
            $package->addChild('Ounces', $ounces);
            $package->addChild('MailType', "Package");
            $package->addChild('ValueOfContents', $this->core->cart->shippable_subtotal());
            $package->addChild('Country', $this->usps_country($dest_country_code)); // USPS insists on making us send the country NAME rather than code. LAME!
            $package->addChild('Container', "RECTANGULAR");
            $package->addChild('Size', $size);
            $package->addChild('Width', $this->plugin_settings('def_width'));
            $package->addChild('Length', $this->plugin_settings('def_length'));
            $package->addChild('Height', $this->plugin_settings('def_height'));
            $package->addChild('Girth', round($this->plugin_settings('def_width')+ $this->plugin_settings('def_length')));
            $package->addChild("OriginZip",substr($this->plugin_settings('origination_zip'), 0, 5) );

            $xml =   new SimpleXMLElement(ee()->cartthrob_shipping_plugins->curl_transaction($this->international_host. urlencode( (string) $request->asXML() ) ));
        }

        ///////////////////////////////////////////////////////////////////
        $shipping = [
            'error_message'	=> null,
            'price'			=> [],
            'option_value'	=> [],
            'option_name'	=> [],
        ];

        if (isset($xml->Number) && $xml->Number == "80040b1a") {
            $shipping['error_message']	= (string) $xml->Description;

            if ($shipping['error_message']) {
                $available_shipping['error_message'] = $shipping['error_message'];
                $this->core->cart->set_custom_data("shipping_error", $shipping['error_message']);
            }

            // update cart shipping hash
            $this->cart_hash($available_shipping);
            $this->core->cart->save();

            return $available_shipping;
        }

        $errors = [];

        if (isset($xml->Package)) {

            foreach ($xml->Package as $package) {

                if ($package->Error) {
                    $errors[] = (string) $package->Error[0]->Description;
                } else {
                    if ($dest_country_code== "US") {
                        $service_type = (string) $package->attributes()->ID;

                        foreach ($package->Postage as $postage) {

                            $shipping['error_message']	= NULL;

                            if ($product_id && !empty($postage->CommercialRate)) {
                                 $shipping['price'][] = number_format((string)$postage->CommercialRate,2,".",",");
                            } else {
                                 $shipping['price'][] = number_format((string)$postage->Rate,2,".",",");
                            }

                            $shipping['option_value'][]	= $service_type;
                            $shipping['option_name'][]  = $this->shipping_methods($service_type);
                        }
                    } else {
                        foreach ($package->Service as $service) {
                            $service_type = str_replace("&lt;sup&gt;&amp;reg;&lt;/sup&gt;", "",  (string)$service->SvcDescription) ;
                            $service_type = str_replace("&lt;sup&gt;&amp;trade;&lt;/sup&gt;","", $service_type);
                            $service_type = str_replace("**", "",  $service_type) ;

                            switch ($service_type) {
                                case "Express Mail International":
                                    $service_type = "EXPRESS_MAIL_INTERNATIONAL";
                                break;

                                case "Priority Mail International":
                                    $service_type = "PRIORITY_MAIL_INTERNATIONAL";

                                break;
                                case "First-Class Mail International Package":
                                    $service_type = "FIRST_CLASS_INTERNATIONAL";
                                break;
                            }

                            if ($this->shipping_methods($service_type) != "--") {
                                $shipping['error_message']	= null;

                                if ($product_id && !empty($service->Postage)) {
                                     $shipping['price'][] = number_format((string)$service->Postage,2,".",",");
                                } else {
                                     $shipping['price'][] = number_format((string)$service->Postage,2,".",",");
                                }

                                $shipping['option_value'][]	= $service_type;
                                $shipping['option_name'][]  = $this->shipping_methods($service_type);
                            }
                        }
                    }
                }
            }

            if (count($errors) > 0 ) {
                foreach ($errors as $item) {
                    $shipping['error_message'] .=$item.". ";
                }
            }


            // CHECKING THE PRESELECTED OPTIONS THAT ARE AVAILABLE
            $available_shipping = [];

            foreach ($shipping['option_value'] as $key => $value) {
                // REMOVE THE ONES THAT ARE NOT OPTIONS
                if ( $this->plugin_settings($value) !="n" ) {
                    $available_shipping['price'][$key]        = $shipping['price'][$key];
                    $available_shipping['option_value'][$key] = $shipping['option_value'][$key];
                    $available_shipping['option_name'][$key]  = $shipping['option_name'][$key];
                }
            }

            if ($shipping['error_message']) {
                $available_shipping['error_message'] = $shipping['error_message'];
                $this->core->cart->set_custom_data("shipping_error", $shipping['error_message']);
            }

            // update cart shipping hash
            $this->cart_hash($available_shipping);

            // if there's no errors, but we removed all of the shipping options, it's because none of the values were configured on the backend. We need to warn.
            if (empty($available_shipping['error_message']) && empty($available_shipping['price']) && !empty($available_shipping)) {
                $available_shipping['error_message'] = "Shipping options compatible with your location: (".$shipping_address ." ". $shipping_address2 ." ". $shipping_city." ". ($shipping_state?",".$shipping_state: "")." ". $shipping_zip ." ". $dest_country_code.") have not been configured in the cart settings. Please contact the webmaster";

                if ($dest_country_code != $orig_country_code) {
                    $available_shipping['error_message'] .= " International shipping options may need to be added. ";
                }

                $this->core->cart->set_custom_data("shipping_error", $available_shipping['error_message']);
            }

            $this->core->cart->save();

            return $available_shipping;
        }
    }

    /**
     * @param Cartthrob_cart $cart
     * @return Money
     */
    public function rate(Cartthrob_cart $cart): Money
    {
        $cart_hash = $this->core->cart->custom_data('cart_hash');

        if ($this->core->cart->count() <= 0 || $this->core->cart->shippable_subtotal() <= 0) {
            return ee('cartthrob:MoneyService')->fresh();
        }

        if ($cart_hash != $this->cart_hash()) {
            $this->core->cart->set_custom_data('shipping_requires_update', $this->title );
            $this->core->cart->save();
        } else {
            $this->core->cart->set_custom_data('shipping_requires_update', NULL );
            $this->core->cart->save();
        }

        $shipping_data =$this->core->cart->custom_data(ucfirst(get_class($this)));

        if (empty($shipping_data['option_value']) && empty($shipping_data['price'])) {
            $shipping_data = $this->get_live_rates();
        }

        if(!$this->core->cart->shipping_info('shipping_option')) {
            $temp_key = FALSE;

            // if no option has been set, we'll get the cheapest option, and set that as the customer's shipping option.
            if (!empty($shipping_data['price'])) {
                // this looks weird, but we're trying to get the key. we have to find the min value, then pull the key from that.
                $temp_key = array_search( min($shipping_data['price']), $shipping_data['price']);
            }

            if ($temp_key !== FALSE && !empty($shipping_data['option_value'][$temp_key])) {
                $this->shipping_option =  $shipping_data['option_value'][$temp_key];
                $this->core->cart->set_shipping_info("shipping_option",  $shipping_data['option_value'][$temp_key] );
            } else {
                $this->shipping_option =  $this->plugin_settings('product_id');
                $this->core->cart->set_shipping_info("shipping_option", $this->plugin_settings('product_id'));

            }
        } else {
            $this->shipping_option = $this->core->cart->shipping_info('shipping_option');
        }

        if (!empty($shipping_data['option_value']) && !empty($shipping_data['price'])) {
            if ($this->shipping_option && in_array($this->shipping_option, $shipping_data['option_value'])) {
                $key =array_pop(array_keys($shipping_data['option_value'], $this->shipping_option));

                if (!empty($shipping_data['price'][$key])) {
                    return ee('cartthrob:MoneyService')->toMoney($shipping_data['price'][$key]);
                }
            } elseif ( ! $this->shipping_option) {
                return ee('cartthrob:MoneyService')->fresh();
            } else {
                return ee('cartthrob:MoneyService')->toMoney(min($shipping_data['price']));
            }
        }
        
        return ee('cartthrob:MoneyService')->fresh();
    }

    /**
     * @param null $number
     * @param null $prefix
     * @return mixed|string
     */
    function shipping_methods($number = null, $prefix = null)
    {
        if (isset($this->prefix)) {
            $prefix = $this->prefix;
        }

        if ($number) {
            if (array_key_exists($number, $this->shipping_methods)) {
                return $this->shipping_methods[$number];
            } else {
                return "--";
            }
        }

        foreach ($this->shipping_methods as $key => $method) {
            if ($this->plugin_settings($prefix.$key) =="y") {
                $available_options[$key] = $method;
            }
 
        }
        return $available_options;
    }

    /**
     * @return array
     */
    public function plugin_shipping_options(): array
    {
        $options = array();
        // GETTING THE RATES FROM SESSION
        $shipping_data =$this->core->cart->custom_data(ucfirst(get_class($this)));
        $this->core->cart->save();

        /*
        if (!$shipping_data)
        {
            // IF NONE ARE IN SESSION, WE WILL *TRY* TO GET RATES BASED ON CURRENT CART CONTENTS
            $shipping_data = $this->get_live_rates();
        }
        */
        $shipping_data = $this->get_live_rates();

        if (!empty($shipping_data['option_value'] ))
        {
            foreach ($shipping_data['option_value'] as $key => $value)
            {
                $options[] = array(
                    'rate_short_name' => $value,
                    'price' => $shipping_data['price'][$key],
                    'rate_price' => $shipping_data['price'][$key],
                    'rate_title' => $shipping_data['option_name'][$key],
                );
            }
        }

        return $options;
    }

    /**
     * @param $code
     * @return mixed|null
     */
    protected function usps_country($code)
    {
        $country_list = [
            'AD' => 'Andorra',
            'AE' => 'United Arab Emirates',
            'AF' => 'Afghanistan',
            'AG' => 'Antigua and Barbuda',
            'AI' => 'Anguilla',
            'AL' => 'Albania',
            'AM' => 'Armenia',
            'AN' => 'Netherlands Antilles',
            'AO' => 'Angola',
            'AR' => 'Argentina',
            'AT' => 'Austria',
            'AU' => 'Australia',
            'AW' => 'Aruba',
            'AX' => 'Aland Island (Finland)',
            'AZ' => 'Azerbaijan',
            'BA' => 'Bosnia-Herzegovina',
            'BB' => 'Barbados',
            'BD' => 'Bangladesh',
            'BE' => 'Belgium',
            'BF' => 'Burkina Faso',
            'BG' => 'Bulgaria',
            'BH' => 'Bahrain',
            'BI' => 'Burundi',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BN' => 'Brunei Darussalam',
            'BO' => 'Bolivia',
            'BR' => 'Brazil',
            'BS' => 'Bahamas',
            'BT' => 'Bhutan',
            'BW' => 'Botswana',
            'BY' => 'Belarus',
            'BZ' => 'Belize',
            'CA' => 'Canada',
            'CC' => 'Cocos Island (Australia)',
            'CD' => 'Congo, Democratic Republic of the',
            'CF' => 'Central African Republic',
            'CG' => 'Congo, Republic of the',
            'CH' => 'Switzerland',
            'CI' => 'Cote d Ivoire (Ivory Coast)',
            'CK' => 'Cook Islands (New Zealand)',
            'CL' => 'Chile',
            'CM' => 'Cameroon',
            'CN' => 'China',
            'CO' => 'Colombia',
            'CR' => 'Costa Rica',
            'CU' => 'Cuba',
            'CV' => 'Cape Verde',
            'CX' => 'Christmas Island (Australia)',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DE' => 'Germany',
            'DJ' => 'Djibouti',
            'DK' => 'Denmark',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'DZ' => 'Algeria',
            'EC' => 'Ecuador',
            'EE' => 'Estonia',
            'EG' => 'Egypt',
            'ER' => 'Eritrea',
            'ES' => 'Spain',
            'ET' => 'Ethiopia',
            'FI' => 'Finland',
            'FJ' => 'Fiji',
            'FK' => 'Falkland Islands',
            'FM' => 'Micronesia, Federated States of',
            'FO' => 'Faroe Islands',
            'FR' => 'France',
            'GA' => 'Gabon',
            'GB' => 'Great Britain and Northern Ireland',
            'GD' => 'Grenada',
            'GE' => 'Georgia, Republic of',
            'GF' => 'French Guiana',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GL' => 'Greenland',
            'GM' => 'Gambia',
            'GN' => 'Guinea',
            'GP' => 'Guadeloupe',
            'GQ' => 'Equatorial Guinea',
            'GR' => 'Greece',
            'GS' => 'South Georgia (Falkland Islands)',
            'GT' => 'Guatemala',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HK' => 'Hong Kong',
            'HN' => 'Honduras',
            'HR' => 'Croatia',
            'HT' => 'Haiti',
            'HU' => 'Hungary',
            'ID' => 'Indonesia',
            'IE' => 'Ireland',
            'IL' => 'Israel',
            'IN' => 'India',
            'IQ' => 'Iraq',
            'IR' => 'Iran',
            'IS' => 'Iceland',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JO' => 'Jordan',
            'JP' => 'Japan',
            'KE' => 'Kenya',
            'KG' => 'Kyrgyzstan',
            'KH' => 'Cambodia',
            'KI' => 'Kiribati',
            'KM' => 'Comoros',
            'KN' => 'Saint Kitts (St. Christopher and Nevis)',
            'KP' => 'North Korea (Korea, Democratic People\'s Republic of)',
            'KR' => 'South Korea (Korea, Republic of)',
            'KW' => 'Kuwait',
            'KY' => 'Cayman Islands',
            'KZ' => 'Kazakhstan',
            'LA' => 'Laos',
            'LB' => 'Lebanon',
            'LC' => 'Saint Lucia',
            'LI' => 'Liechtenstein',
            'LK' => 'Sri Lanka',
            'LR' => 'Liberia',
            'LS' => 'Lesotho',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'LV' => 'Latvia',
            'LY' => 'Libya',
            'MA' => 'Morocco',
            'MC' => 'Monaco (France)',
            'MD' => 'Moldova',
            'MG' => 'Madagascar',
            'MK' => 'Macedonia, Republic of',
            'ML' => 'Mali',
            'MM' => 'Burma',
            'MN' => 'Mongolia',
            'MO' => 'Macao',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MS' => 'Montserrat',
            'MT' => 'Malta',
            'MU' => 'Mauritius',
            'MV' => 'Maldives',
            'MW' => 'Malawi',
            'MX' => 'Mexico',
            'MY' => 'Malaysia',
            'MZ' => 'Mozambique',
            'NA' => 'Namibia',
            'NC' => 'New Caledonia',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NI' => 'Nicaragua',
            'NL' => 'Netherlands',
            'NO' => 'Norway',
            'NP' => 'Nepal',
            'NR' => 'Nauru',
            'NZ' => 'New Zealand',
            'OM' => 'Oman',
            'PA' => 'Panama',
            'PE' => 'Peru',
            'PF' => 'French Polynesia',
            'PG' => 'Papua New Guinea',
            'PH' => 'Philippines',
            'PK' => 'Pakistan',
            'PL' => 'Poland',
            'PM' => 'Saint Pierre and Miquelon',
            'PN' => 'Pitcairn Island',
            'PT' => 'Portugal',
            'PY' => 'Paraguay',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RS' => 'Serbia',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'SA' => 'Saudi Arabia',
            'SB' => 'Solomon Islands',
            'SC' => 'Seychelles',
            'SD' => 'Sudan',
            'SE' => 'Sweden',
            'SG' => 'Singapore',
            'SH' => 'Saint Helena',
            'SI' => 'Slovenia',
            'SK' => 'Slovak Republic',
            'SL' => 'Sierra Leone',
            'SM' => 'San Marino',
            'SN' => 'Senegal',
            'SO' => 'Somalia',
            'SR' => 'Suriname',
            'ST' => 'Sao Tome and Principe',
            'SV' => 'El Salvador',
            'SY' => 'Syrian Arab Republic',
            'SZ' => 'Swaziland',
            'TC' => 'Turks and Caicos Islands',
            'TD' => 'Chad',
            'TG' => 'Togo',
            'TH' => 'Thailand',
            'TJ' => 'Tajikistan',
            'TK' => 'Tokelau (Union) Group (Western Samoa)',
            'TL' => 'East Timor (Indonesia)',
            'TM' => 'Turkmenistan',
            'TN' => 'Tunisia',
            'TO' => 'Tonga',
            'TR' => 'Turkey',
            'TT' => 'Trinidad and Tobago',
            'TV' => 'Tuvalu',
            'TW' => 'Taiwan',
            'TZ' => 'Tanzania',
            'UA' => 'Ukraine',
            'UG' => 'Uganda',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VA' => 'Vatican City',
            'VC' => 'Saint Vincent and the Grenadines',
            'VE' => 'Venezuela',
            'VG' => 'British Virgin Islands',
            'VN' => 'Vietnam',
            'VU' => 'Vanuatu',
            'WF' => 'Wallis and Futuna Islands',
            'WS' => 'Western Samoa',
            'YE' => 'Yemen',
            'YT' => 'Mayotte (France)',
            'ZA' => 'South Africa',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        ];

        if (isset($country_list[$code])) {
            return $country_list[$code];
        }

        return null;
    }

    /**
     * @param null $shipping
     * @return string
     */
    public function cart_hash($shipping = null)
    {
        // hashing the cart data, so we can check later if the cart has been updated
        $cart_hash = md5(serialize($this->core->cart->items_array()));

        if ($shipping) {
            $this->core->cart->set_custom_data('cart_hash', $cart_hash);
            $this->core->cart->set_custom_data(ucfirst(get_class($this)), $shipping);
        }

        $this->core->cart->save();

        return $cart_hash;
    }
}
