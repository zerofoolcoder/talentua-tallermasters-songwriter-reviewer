<?php
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tal-tm-swr-kreator.php';

	class Tal_Tm_Swr_Model {

		public function getCastingCandidates($form_id) {

      global $wpdb;

      $query = "SELECT `wppm`.`post_id` `_post_id`, `wpp`.`post_date` `_post_date`, `nff`.`id`, `nff`.`type`, SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(`nff`.`data`,'admin_label',-1), '\"', 3), '\"', -1) `column`, `wppm`.`meta_value` `value` FROM `wp_ninja_forms_fields` `nff`, `wp_postmeta` `wppm`, `wp_posts` `wpp` WHERE `wppm`.`post_id` = `wpp`.`ID` and `nff`.id = CAST(SUBSTRING_INDEX(`wppm`.`meta_key`, '_', -1) AS UNSIGNED) AND `nff`.`form_id` = $form_id AND `nff`.`type` not in ('_njf_close_block', '_njf_open_block', '_submit', '_desc') AND `wppm`.`meta_key` like '%field%' and `wpp`.`post_status` = 'publish' ORDER BY `wppm`.`meta_id` ASC";
      $result = $wpdb->get_results($query);
			$CastingKreator = new Tal_Tm_Swr_Kreator();
			$Casting = $CastingKreator->factoryMethod($result);

			return $Casting;

		}

		public function getCastingCandidate($form_id) {

      global $wpdb;

			$query = "SELECT `wppm`.`post_id` `_post_id`, `wpp`.`post_date` `_post_date`, `nff`.`id`, `nff`.`type`, SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(`nff`.`data`,'admin_label',-1), '\"', 3), '\"', -1) `column`, `wppm`.`meta_value` `value` FROM `wp_ninja_forms_fields` `nff`, `wp_postmeta` `wppm`, `wp_posts` `wpp`, ( select `wppm1`.`post_id` from `wp_postmeta` `wppm1`, `wp_posts` `wpp1`, (select `wppm2`.`post_id` from `wp_postmeta` `wppm2`, `wp_posts` `wpp2` where `wppm2`.`meta_key` = '_form_id' and `wppm2`.`meta_value` = $form_id and `wppm2`.`post_id` = `wpp2`.`ID` and `wpp2`.`post_status` = 'publish' ORDER BY `wpp2`.`ID` ) AS `t1` where `t1`.`post_id` = `wppm1`.`post_id` and `wppm1`.`meta_key` = '_field_69' and `wppm1`.`meta_value` = '' and `wppm1`.`post_id` = `wpp1`.`ID` and `wpp1`.`post_status` = 'publish' ORDER BY `wpp1`.`ID` LIMIT 1 ) as `t` WHERE `wppm`.`post_id` = `wpp`.`ID` and `nff`.id = CAST(SUBSTRING_INDEX(`wppm`.`meta_key`, '_', -1) AS UNSIGNED) AND `nff`.`type` not in ('_njf_close_block', '_njf_open_block', '_submit', '_desc') and `wppm`.`post_id` = `t`.`post_id` ORDER BY `wppm`.`meta_id` ASC";

      // $query = "SELECT `wppm`.`post_id` `_post_id`, `wpp`.`post_date` `_post_date`, `nff`.`id`, `nff`.`type`, SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(`nff`.`data`,'admin_label',-1), '\"', 3), '\"', -1) `column`, `wppm`.`meta_value` `value` FROM `wp_ninja_forms_fields` `nff`, `wp_postmeta` `wppm`, `wp_posts` `wpp`, ( ) as `t` WHERE `wppm`.`post_id` = `wpp`.`ID` and `nff`.id = CAST(SUBSTRING_INDEX(`wppm`.`meta_key`, '_', -1) AS UNSIGNED) AND `nff`.`type` not in ('_njf_close_block', '_njf_open_block', '_submit', '_desc') and `wppm`.`post_id` = `t`.`post_id` ORDER BY `wppm`.`meta_id` ASC";
      $result = $wpdb->get_results($query);
			$CastingKreator = new Tal_Tm_Swr_Kreator();
			$Casting = $CastingKreator->factoryMethod($result);

			return $Casting;

		}

		public function updateCandidate($_post_id, $status) {

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

		public static function get_forms() {
			$ninja_forms = ninja_forms_get_all_forms();
			$forms = Tal_Tm_Swr_Kreator::createCollection();

			foreach ($ninja_forms as $ninja_form) {
				$form = Tal_Tm_Swr_Kreator::createItem();
				$array = new RecursiveIteratorIterator(new RecursiveArrayIterator($ninja_form));

				foreach ($array as $key => $value) {
					$form->$key = $value;
				}

				$forms->add($form);
			}

			return $forms;
		}

		public static function get_submissions($form_id, $status = '') {
			$labels = array();
			$args = array('form_id' => $form_id,
  			'fields'    => array(
    			69      => $status,
  			),
			);
			$ninja_forms = Ninja_Forms()->subs()->get( $args );
			$submissions = Tal_Tm_Swr_Kreator::createCollection();

			$all_fields = ninja_forms_get_fields_by_form_id( $form_id );
			foreach($all_fields as $field) {
				$labels[(int)$field['id']]['id'] = $field['id'];
				$labels[(int)$field['id']]['type'] = $field['type'];
				$labels[(int)$field['id']]['label'] = $field['data']['label'];
				$labels[(int)$field['id']]['admin_label'] = $field['data']['admin_label'];
			}

			foreach ($ninja_forms as $ninja_form) {
				$submission = Tal_Tm_Swr_Kreator::createItem();
				$array = new RecursiveIteratorIterator(new RecursiveArrayIterator($ninja_form));

				foreach ($array as $key => $value) {
					$_key = (is_numeric($key)) ? $labels[$key]['admin_label'] : $key;
					$submission->$_key = $value;
				}

				$submissions->add($submission);
			}

			return $submissions;
		}
	}
