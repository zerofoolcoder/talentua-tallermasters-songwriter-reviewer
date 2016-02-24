<?php

  final class Tal_Tm_Swr_Casting {

  	//property declaration
  	private $_Candidates = null;
    public $_CandidatesReviewed = 0;
    public $_CandidatesUnreviewed = 0;
    public $_TotalCandidates = 0;
    public $_CandidatesAccepted = 0;
    public $_CandidatesRejected = 0;
    public $_CandidatesStandBy = 0;

  	public function __construct(Tal_Tm_Swr_Class_Abstract $Candidates) {

      $this->_Candidates = $Candidates;
      $this->load_dependencies();

    }

    public function Candidates() {

      return $this->_Candidates;

    }

    private function load_dependencies() {

      /**
       * The function responsible for loading the classes needed by the public-facing side of the site
       * core plugin.
       */
      require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-item.php';
      require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-collection.php';

    }

    public function getCastingCandidatesSummary() {

      global $wpdb;

      $query = "select `t1`.`unreviewed`, `t2`.`reviewed`, `t3`.`accepted`, `t4`.`rejected`, `t5`.`standby` from (select count(`meta_id`) `unreviewed` from `wp_postmeta` where `meta_key` = '_field_69' and `meta_value` = '') `t1`, (select count(`meta_id`) `reviewed` from `wp_postmeta` where `meta_key` = '_field_69' and `meta_value` != '') `t2`, (select count(`meta_id`) `accepted` from `wp_postmeta` where `meta_key` = '_field_69' and `meta_value` = 'accepted') `t3`, (select count(`meta_id`) `rejected` from `wp_postmeta` where `meta_key` = '_field_69' and `meta_value` = 'rejected') `t4`, (select count(`meta_id`) `standby` from `wp_postmeta` where `meta_key` = '_field_69' and `meta_value` = 'standby') `t5`";
      $result = $wpdb->get_results($query);

      $this->_CandidatesUnreviewed = $result[0]->unreviewed;
      $this->_CandidatesReviewed = $result[0]->reviewed;
      $this->_CandidatesAccepted = $result[0]->accepted;
      $this->_CandidatesRejected = $result[0]->rejected;
      $this->_CandidatesStandBy = $result[0]->standby;
      $this->_TotalCandidates = $this->_CandidatesReviewed + $this->_CandidatesUnreviewed;

      return $Casting;

    }

  }
