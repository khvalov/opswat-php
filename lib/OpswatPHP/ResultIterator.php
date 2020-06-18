<?php

namespace OpswatPHP;

Class ResultIterator extends \ArrayIterator {

	public function __construct($_array,$object){
		
		if(is_array($_array) && count($_array)>0) {
			foreach ($_array as $value) {
                $this->append(Util::ArrayToClass(clone $object, $value));
            }
        }
	}
}
