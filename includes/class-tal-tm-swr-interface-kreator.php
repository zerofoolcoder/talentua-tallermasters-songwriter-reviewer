<?php
	interface Tal_Tm_Swr_Interface_Kreator {
		public function factoryMethod($Parameters);
		public function createCandidate($Objects);
		public function createCandidates();
		public static function createCasting(Tal_Tm_Swr_Class_Abstract $Collection);
		public function __construct();
	}
