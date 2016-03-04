<?php
  final class Tal_Tm_Swr_Form extends Tal_Tm_Swr_Item {
    private $_form_fields = array();

    public function loadFormMetadata(array $data) {
      $array = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));

      foreach ($array as $key => $value) {
        $this->$key = $value;
      }

      $this->loadFormFields();
    }

    public function loadFormFields() {
      $form_fields = ninja_forms_get_fields_by_form_id($this->id);

			foreach($form_fields as $field) {
				$this->_form_fields[(int)$field['id']]['id'] = $field['id'];
				$this->_form_fields[(int)$field['id']]['type'] = $field['type'];
				$this->_form_fields[(int)$field['id']]['label'] = $field['data']['label'];
				$this->_form_fields[(int)$field['id']]['admin_label'] = $field['data']['admin_label'];
			}
    }

    public function getField($id) {
      return $this->_form_fields[$id];
    }

    public function getFieldID($label) {
      foreach($this->_form_fields as $key => $value) {
        if($value['admin_label'] == $label) return $key;
      }
      return null;
    }

    public function load($id) {
      $ninja_form = ninja_forms_get_form_by_id($id);
      $this->loadFormMetadata($ninja_form);
    }
  }
