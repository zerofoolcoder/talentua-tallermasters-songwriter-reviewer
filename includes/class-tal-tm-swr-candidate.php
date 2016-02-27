<?php
  //TODO:70 try to update a candidate in updateCandidate function with this ninja-forms function: Ninja_Forms()->sub( $_post_id )->update_field( 69, 'rejected' );

  final class Tal_Tm_Swr_Candidate extends Tal_Tm_Swr_Item {
    public function loadMetadata($data, Tal_Tm_Swr_Form $form) {
      $array = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));

      foreach ($array as $key => $value) {
        $_key = (is_numeric($key)) ? $form->getField($key)['admin_label'] : $key;
        $this->$_key = $value;
      }
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
