<?php

	/**
	 * Provide a admin area view for the plugin
	 *
	 * This file is used to markup the admin-facing aspects of the plugin.
	 *
	 * @link       https://twitter.com/zerofoolcoder
	 * @since      1.0.0
	 *
	 * @package    Tal_Tm_Swr
	 * @subpackage Tal_Tm_Swr/admin/partials
	 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<h2 class="nav-tab-wrapper">Ninja Form Selection</h2>
	<form method="post" name="tallermasters_options" action="options.php">

		<?php
		//Grab all options

			$options = get_option($this->plugin_name);

			// Selected Ninja Form
			$ninja_form = $options['selected_ninja_form'];
		?>

		<?php
			settings_fields( $this->plugin_name );
			do_settings_sections( $this->plugin_name );
		?>

	<!-- remove some meta and generators from the <head> -->
		<p>
			<fieldset>
				<legend class="screen-reader-text"><span><?php _e('Select Ninja Form', $this->plugin_name);?></span></legend>
				<label for="<?php echo $this->plugin_name;?>-selected_ninja_form"><span><?php esc_attr_e( 'Select Ninja Form', $this->plugin_name ); ?></span>
					<select id="<?php echo $this->plugin_name;?>-selected_ninja_form" name="<?php echo $this->plugin_name;?>[selected_ninja_form]" />
						<?php
							foreach($this->tal_tm_swr_forms as $form) {
								echo '<option value = "' . $form->id . '" ' . selected( $options['selected_ninja_form'], $form->id, false ) . '>' . $form->name . '</option>';
							}
						?>
					</select>
				</label>
			</fieldset>
		</p>

    <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

  </form>

</div>
