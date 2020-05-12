<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class CategoriesResult {
	
	private $category_id;
	private $issue;
	private $apps;

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

		if($name=='apps' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new AppsResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		$this->{$name} = $value;
	}

}