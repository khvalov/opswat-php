<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class ThreatsResult {
	
	private $critical;
	private $scan_time;
	private $file;
	private $hash;
	private $threat_name;
	private $details;
	private $product_name;
	private $product_vendor;
	private $product_version;
	private $severity;
	private $action;
	private $existing;
	private $geo_info;
	private $network_address;
	private $status;
	private $total_source;
	private $threats;


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

		if($name=='details') {
			$value=Util::ArrayToClass(new DetailsResult(),$value);
		}

		if($name=='geo_info') {
			$value=Util::ArrayToClass(new GeoInfoResult(),$value);
		}

		if($name=='threats') {
			$value=Util::ArrayToClass(new ThreatsThreatsResult(),$value);
		}

		$this->{$name} = $value;
	}

}