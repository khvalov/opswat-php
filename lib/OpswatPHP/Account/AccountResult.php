<?php
namespace OpswatPHP\Account;

use OpswatPHP\Util;

Class AccountResult {

	private $name;
	private $email;
	private $last_login;
	private $date_created;
	private $devices_allowed;
	private $devices_used;
	private $license_key;
	private $devices_by_status;	
	private $devices_by_issue_severity;
	private $devices_by_vulnerability_severity;

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
		
		if($name=='devices_by_status' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new DevicesByStatusResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		if($name=='devices_by_issue_severity' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new DevicesBySeverityResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		if($name=='devices_by_vulnerability_severity' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new DevicesBySeverityResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		$this->{$name} = $value;
	}

}