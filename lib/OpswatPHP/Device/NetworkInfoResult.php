<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class NetworkInfoResult {
	
	private $description;
	private $mac;
	private $ipv4;
	private $ipv6;
	private $subnet_mask;
	private $media_state;
	private $dhcp_enabled;
	private $dhcp_obtained;
	private $dhcp_expires;
	private $dhcp_server;
	private $adapter_enabled;
	private $default_gateway;
	private $dns_addresses;

	public function __construct(array $_settings=null){

	}

	public function __get($name) {
		if(!empty($this->{$name})) {
		    return $this->{$name};
		} else {
		   return null;
		}
	}

	public function __set($name, $value) {

		$this->{$name} = $value;
	}

}