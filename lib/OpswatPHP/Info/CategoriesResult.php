<?php
namespace OpswatPHP\Info;

use OpswatPHP\Util;

Class CategoriesResult {
	
	private $id;
	private $severity;

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