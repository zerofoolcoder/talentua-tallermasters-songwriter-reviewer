<?php
	abstract class Tal_Tm_Swr_Class_Abstract implements Countable, Iterator {
    //property declaration
		private $_data = array();
		public $_Count = 0;
		public $_Index = 0;

		//abstract methods
		abstract public function add(Tal_Tm_Swr_Class_Abstract $ClassAbstract);
		abstract public function remove(Tal_Tm_Swr_Class_Abstract $ClassAbstract);
		abstract public function current();
		abstract public function valid();

    //concrete methods
		public function count() {
			return $this->_Count;
		}

		public function rewind() {
			$this->_Index = 0;
		}

		public function key() {
			return $this->_Index;
		}

		public function next() {
			$this->_Index++;
		}

    public function __set($name, $value) {
      $this->_data[$name] = $value;
    }

    public function __get($name) {
      if (array_key_exists($name, $this->_data)) {
          return $this->_data[$name];
      }

      return null;
    }

		public function __isset($name) {
      if (isset($this->_data[$name])) {
        return (false === empty($this->_data[$name]));
      } else {
        return null;
      }
    }
	}
