<?php

  require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-class-abstract.php';

  final class Tal_Tm_Swr_Item extends Tal_Tm_Swr_Class_Abstract {

    function __construct($key = null, $value = null) {

      if(!is_null($key) && !is_null($value)) $this->$key = $value;

    }

  	public function add(Tal_Tm_Swr_Class_Abstract $ClassAbstract) {

  		return FALSE;

  	}

  	public function remove(Tal_Tm_Swr_Class_Abstract $ClassAbstract) {

  		return FALSE;

  	}

  	public function current() {

  		return FALSE;

  	}

  	public function valid() {

  		return FALSE;

  	}

  }
