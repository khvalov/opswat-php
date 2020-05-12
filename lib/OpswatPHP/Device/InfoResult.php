<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class InfoResult {

	private $device_id;
	private $severity;
	private $enrolled_at;
	private $status;
	private $device_name;
	private $nickname;
	private $device_type;
	private $last_seen;
	private $last_reboot;
	private $agent_version;
	private $remediation_link;
	private $group_name;
	private $issue;
	private $geo_info;
	private $network_info;
	private $os_info;

	private $cves;
	private $link_user;

	private $user_info;


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
		
		if($name=='issue') {
			$value=Util::ArrayToClass(new IssueResult(),$value);
		}
		if($name=='geo_info') {
			$value=Util::ArrayToClass(new GeoInfoResult(),$value);
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

		if($name=='user_info') {
			$value=Util::ArrayToClass(new UserInfoResult(),$value);
		}
		if($name=='os_info') {
			$value=Util::ArrayToClass(new OsInfoResult(),$value);
		}
		if($name=='link_user') {
			$value=Util::ArrayToClass(new LinkUserResult(),$value);
		}
		if($name=='cves') {
			$value=Util::ArrayToClass(new CvesResult(),$value);
		}

		$this->{$name} = $value;
	}

}