<?php
	class Tal_Tm_Swr_Data_Filter extends FilterIterator implements Countable {
		private $_Filter = "";
		private $_Key = "";
		private $_Count = 0;

		private function init() {
			foreach ($this as $item) {
				$this->_Count++;
			}
		}

		public function __construct(Iterator $Data, $Key, $Filter) {
			parent::__construct($Data);
			$this->_Filter = $Filter;
			$this->_Key = $Key;
			$this->init();
		}

		public function accept() {
			$Data = $this->getInnerIterator()->current();

			if (strcasecmp($Data->{$this->_Key}, $this->_Filter) == 0) {
			  return true;
			}
			return false;
		}

		public function count() {
			return $this->_Count;
		}
	}
