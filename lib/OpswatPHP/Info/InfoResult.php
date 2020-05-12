<?php
namespace OpswatPHP\Info;

use OpswatPHP\Util;

Class InfoResult {

	private $device_id;
	private $device_name;
	private $severity;
	private $status;
	private $categories;


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


		if($name=='categories' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new CategoriesResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}
		

		$this->{$name} = $value;
	}

}