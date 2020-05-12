<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class AntivirusResult {
	
	private $last_scan;
	private $total;
	private $issue;
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
		
		if($name=='threats' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new ThreatsResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		$this->{$name} = $value;
	}

}