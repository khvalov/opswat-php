<?php
namespace OpswatPHP\Activity;

use OpswatPHP\Util;

Class ActivityResult {

	private $timestamp;
	private $action;
	private $device_id;
	private $device_name;
	private $device_status;
	private $device_group;
	private $app_user;
	private $access_rule;
	private $app_name;

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