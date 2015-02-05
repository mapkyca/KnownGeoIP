<?php

namespace IdnoPlugins\GeoIP {

    class Main extends \Idno\Common\Plugin {

	function registerEventHooks() {
	    
	    \Idno\Core\site()->addEventHook('geoip/lookup', function(\Idno\Core\Event $event) {
		if ($ip = $event->data()['ip']) {
		    $event->setResponse($this->lookup($ip));
		}
	    });
	}

	/**
	 * Return country details for a given IP address or hostname.
	 * @param type $ip_or_host
	 * @param type $country_only If true, only the country name is returned, if false more details are returned.
	 */
	function lookup($ip_or_host, $country_only = true) {
	    
	    
	    if (is_callable('geoip_record_by_name')) {
		if ($result = geoip_record_by_name($ip_or_host)) {
		    
		    if ($country_only)
			return $result['country_name'];
		    
		    return $result;
		}
	    }
	    
	    return false;
	}
    }

}
