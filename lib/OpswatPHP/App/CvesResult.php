<?php
namespace OpswatPHP\App;

use OpswatPHP\Util;

Class CvesResult {

	private $cve_id;
	private $severity;
	private $summary;
	private $update_date;
	private $opswat_score;
	private $cvss2_score;
	private $cvss3_score;

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