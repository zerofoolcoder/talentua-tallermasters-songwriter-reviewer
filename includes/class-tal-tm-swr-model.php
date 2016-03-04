<?php
	class Tal_Tm_Swr_Model {
		public static function updateCandidate($_post_id, $key, $value) {
			$form = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Form);
			$form->load(Ninja_Forms()->sub( $_post_id )->form_id);

			$Candidate = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidate);
			$Candidate->update($_post_id, $form->getFieldID($key), $value);
		}

		public static function get_forms() {
			$forms = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Forms);
			$forms->load();
			return $forms;
		}

		public static function get_candidates($form_id, $status = '') {
			$candidates = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidates);
			$candidates->load($form_id, $status);

			return $candidates;
		}
	}
