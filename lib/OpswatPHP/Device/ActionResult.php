<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class ActionResult {
	
	private $id;
	private $status;
	private $command_id;


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