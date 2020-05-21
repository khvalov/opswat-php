<?php
namespace OpswatPHP\App;

use OpswatPHP\Util;

Class DetailsResult {

	private $product_id;
	private $name;
	private $version;
	private $vendor;
	private $total_devices;
	private $total_cves;
	private $total_critical;
	private $total_important;
	private $total_moderate;
	private $total_low;
	private $total_unknown;
	private $cves;

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

		if($name=='cves' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new CvesResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		$this->{$name} = $value;
	}

}