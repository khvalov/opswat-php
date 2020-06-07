<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class DeviceResult {

	private $device_id;
	private $linked_id;
	private $status;
	private $status_detail;
	private $severity;
	private $issue;
	private $group_name;
	private $agent_type;
	private $device_name;
	private $nick_name;
	private $device_type;
	private $agent_version;
	private $oesis_version;
	private $enrolled_at;
	private $last_seen;
	private $last_reboot;
	private $public_ip;
	private $country;
	private $user_identity;
	private $user_info;
	private $remediation_link;
	private $categories;
	private $unclassified;
	private $os_info;
	private $network_info;
	private $link_user;
	private $mobile_apps;
	private $detected_processes;
	private $detected_packages;
	private $detected_patches;
	private $infection;


	public function __construct(array $_settings=null){

	}

	public function __get($name) {
		if(!empty($this->{$name})) {
		    return $this->{$name};
		} else {
		   return null;
		}
	}

	public function getCategory($key){
		$categories=$this->categories;
		
		if(is_iterable($categories)){
			foreach ($categories as $value){
				if($value->category_id==$key){
					return $value;
				}
			}
		}
		return null;
		
	}

	public function __set($name, $value) {
		if($name=='issue') {
			$value=Util::ArrayToClass(new IssueResult(),$value);
		}
		if($name=='user_info') {
			$value=Util::ArrayToClass(new UserInfoResult(),$value);
		}
		if($name=='os_info') {
			$value=Util::ArrayToClass(new OsInfoResult(),$value);
		}
		if($name=='link_user') {
			$value=Util::ArrayToClass(new LinkUserResult(),$value);
		}
		if($name=='mobile_apps') {
			$value=Util::ArrayToClass(new MobileAppsResult(),$value);
		}
		if($name=='detected_processes') {
			$value=Util::ArrayToClass(new DetectedProcessesResult(),$value);
		}
		if($name=='detected_packages') {
			$value=Util::ArrayToClass(new DetectedPackagesResult(),$value);
		}
		if($name=='detected_patches') {
			$value=Util::ArrayToClass(new DetectedPatchesResult(),$value);
		}

		if($name=='categories' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new CategoriesResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}
		
		if($name=='network_info' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new NetworkInfoResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		if($name=='unclassified' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new UnclassifiedResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		if($name=='infection' && count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new InfectionResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}
		$this->{$name} = $value;

		return $this;
	}

}
