<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class AppsResult {
	
	private $id;
	private $name;
	private $vendor;
	private $version;
	private $ar_id;
	private $issue;
	private $health_status;


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

		if($name=='health_status' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new HealthStatusResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}
		
		$this->{$name} = $value;
	}

}