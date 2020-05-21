<?php
namespace OpswatPHP\Group;

use OpswatPHP\Util;

Class GroupResult {

	private $group_id;
	private $group_name;
	private $domain_name;
	private $auto_join;
	private $policy_id;
	private $policy_name;
	private $number_of_devices;
	private $description;
	private $created_date;
	private $last_modified;

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