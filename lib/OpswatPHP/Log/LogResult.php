<?php
namespace OpswatPHP\Log;

use OpswatPHP\Util;

Class LogResult {

	private $logs;

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
		if($name=='logs' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new LogItemResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}
		$this->{$name} = $value;
	}

}