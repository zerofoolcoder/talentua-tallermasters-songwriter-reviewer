<?php
  final class Tal_Tm_Swr_Casting extends Tal_Tm_Swr_Collection {
  	private $_Candidates = null;
    public $_CandidatesReviewed = 0;
    public $_CandidatesUnreviewed = 0;
    public $_TotalCandidates = 0;
    public $_CandidatesAccepted = 0;
    public $_CandidatesRejected = 0;
    public $_CandidatesStandBy = 0;

    public function loadCandidates($form_id, $status = '') {
      $this->_Candidates = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidates);
      $this->_Candidates->load($form_id, $status);
      $this->getCastingCandidatesSummary();
    }

    public function loadCandidate($sub_id) {
      $Candidate = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidate);
      $Candidate->load($sub_id);
      $this->_Candidates = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidates);
      $this->_Candidates->add($Candidate);
      $this->getCastingCandidatesSummary();
    }

    public function Candidates() {
      return $this->_Candidates;
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

      /*
        $statuses = Tal_Tm_Swr_Abstract_Status_Enum::enum();

  			foreach ($statuses as $status) {
  				$Filter = new Tal_Tm_Swr_Data_Filter($this->_Candidates, '_Status', $status);
  				$this->_CandidatesStatuses[$status] = $Filter->count();
  			}

        var_dump($this->_CandidatesStatuses); die;
        $this->_CandidatesStatuses['reviewed'] = $this->_CandidatesStatuses[Tal_Tm_Swr_Abstract_Factory_Items_Enum::Accepted] +
                                                 $this->_CandidatesStatuses[Tal_Tm_Swr_Abstract_Factory_Items_Enum::Rejected] +
                                                 $this->_CandidatesStatuses[Tal_Tm_Swr_Abstract_Factory_Items_Enum::StandBy];
        $this->_TotalCandidates = $this->_Candidates->count();
      */
    }
  }
