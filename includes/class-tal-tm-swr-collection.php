<?php
	class Tal_Tm_Swr_Collection extends Tal_Tm_Swr_Class_Abstract {

		public function add(Tal_Tm_Swr_Class_Abstract $Item) {
			$this->_Items[] = $Item;
			$this->_Count++;
		}

		public function remove(Tal_Tm_Swr_Class_Abstract $Item) {
			$index = array_search($Item, $this->_Items);
			if ($index >= 0) {
				unset($this->_Items[$index]);
				$this->_Count--;
			}
		}

		public function current() {
			return $this->_Items[$this->_Index];
		}

		public function valid()	{
			return isset($this->_Items[$this->_Index]);
		}
  }
