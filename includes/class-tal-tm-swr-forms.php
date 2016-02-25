<?php
	final class Tal_Tm_Swr_Forms extends Tal_Tm_Swr_Collection {
    public function load(){
      $ninja_forms = ninja_forms_get_all_forms();

      foreach ($ninja_forms as $ninja_form) {
        $form = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Form);
        $form->loadFormMetadata($ninja_form);
        $this->add($form);
      }
    }
  }
