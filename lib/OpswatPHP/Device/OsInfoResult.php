<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class OsInfoResult {
	
	private $service_pack_version;
	private $vendor;
	private $family;
	private $os_language;
	private $name;
	private $architecture;
	private $version;
	private $type;
	private $user_password_set;


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