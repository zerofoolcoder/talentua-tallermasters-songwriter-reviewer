<?php
  //TODO:60 try to update a candidate in updateCandidate function with this ninja-forms function: Ninja_Forms()->sub( $_post_id )->update_field( 69, 'rejected' );

  final class Tal_Tm_Swr_Candidate extends Tal_Tm_Swr_Item {
    public function loadMetadata($data, Tal_Tm_Swr_Form $form) {
      $array = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));

      foreach ($array as $key => $value) {
        $_key = (is_numeric($key)) ? $form->getField($key)['admin_label'] : $key;
        $this->$_key = $value;
      }
    }

    public function load($sub_id) {
      $submission = Ninja_Forms()->sub( $sub_id )->get_all_fields();
      $this->form_id = Ninja_Forms()->sub( $sub_id )->form_id;
      $this->user_id = Ninja_Forms()->sub( $sub_id )->user_id;
      $this->action = Ninja_Forms()->sub( $sub_id )->action;
      $this->date_submitted = Ninja_Forms()->sub( $sub_id )->date_submitted;
      $this->date_modified = Ninja_Forms()->sub( $sub_id )->date_modified;
      $this->sub_id = $sub_id;

      $form = Tal_Tm_Swr_Kreator::create(Tal_Tm_Swr_Abstract_Factory_Items_Enum::Form);
      $form->load(Ninja_Forms()->sub( $sub_id )->form_id);
      $this->loadMetadata($submission, $form);
    }

    public function update($_post_id, $status) {
      //Ninja_Forms()->sub( $_post_id )->update_field( 69, 'rejected' );
      global $wpdb;
      $wpdb->update(
        'wp_postmeta', // Table
        array('meta_value' => $status), // Array of key(col) => val(value to update to)
        array(
          'post_id' => $_post_id,
          'meta_key' => '_field_69'
        ) // Where
      );
    }
  }
