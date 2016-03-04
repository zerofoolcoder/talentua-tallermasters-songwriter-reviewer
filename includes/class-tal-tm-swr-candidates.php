<?php
	class Tal_Tm_Swr_Candidates extends Tal_Tm_Swr_Collection {
		public function load($form_id, $status = '') {
			$form = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Form);
			$form->load($form_id);
			$id = $form->getFieldID('_Status');

			if(is_null($status)) {
				$args = array('form_id' => $form_id);
			} else {
				$args = array('form_id' => $form_id,
					'fields'    => array(
						$id      	=> $status,
					),
				);
			}

			$ninja_forms_submissions = Ninja_Forms()->subs()->get( $args );

			foreach ($ninja_forms_submissions as $ninja_form_submission) {
				$candidate = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidate);
				$candidate->loadMetadata($ninja_form_submission, $form);
				$this->add($candidate);
			}
		}
  }
