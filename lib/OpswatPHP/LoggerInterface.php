<?php

namespace OpswatPHP;

Interface LoggerInterface {
	public function __construct($target);

	public function log($array);
}