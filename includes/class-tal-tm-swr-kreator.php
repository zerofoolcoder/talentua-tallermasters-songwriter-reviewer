<?php

	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-item.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-collection.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-casting.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-interface-kreator.php';

	class Tal_Tm_Swr_Kreator implements Tal_Tm_Swr_Interface_Kreator {

		public function __construct() {

//			$this->load_dependencies();

		}

		public function factoryMethod($Parameters) {

			$array = array();
			$Candidates = $this->createCandidates();

			foreach($Parameters as $Parameter) {
				$array[$Parameter->_post_id][] = $Parameter;
			}

			foreach($array as $key => $values) {
				$Candidates->add($this->createCandidate($values));
			}

			//create casting
			return $this->createCasting($Candidates);

		}

		public function createCandidate($Objects) {

			$key = key((array)($Objects[0]));
      $Candidate = new Tal_Tm_Swr_Item($key, $Objects[0]->$key);

      foreach($Objects as $Object) {
				$column = $Object->column;
        $Candidate->$column = $Object->value;
      }

      return $Candidate;

		}

		public function createCandidates() {

			return (new Tal_Tm_Swr_Collection());

		}

		public static function createCasting(Tal_Tm_Swr_Class_Abstract $Collection) {

			return (new Tal_Tm_Swr_Casting($Collection));

		}

		private function load_dependencies() {

			/**
			 * The function responsible for loading the classes needed by the public-facing side of the site
			 * core plugin.
			 */

		}

		public static function createItem() {

			return new Tal_Tm_Swr_Item();

		}

		public static function createCollection() {
			return new Tal_Tm_Swr_Collection();
		}
	}
