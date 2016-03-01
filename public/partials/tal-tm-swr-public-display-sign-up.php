<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://twitter.com/zerofoolcoder
 * @since      1.0.0
 *
 * @package    Tal_Tm_Swr
 * @subpackage Tal_Tm_Swr/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- Header -->
<div class="et_pb_section et_pb_fullwidth_section  et_pb_section_0 et_section_regular" style="background-color: #2b0049;">
  <section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left  et_pb_fullwidth_header_0">
    <div class="et_pb_fullwidth_header_container left">
      <div class="header-content-container center">
        <div class="header-content">
          <h1>Registro</h1>
          <p> </p>
        </div>
      </div>
    </div>
    <div class="et_pb_fullwidth_header_overlay"></div>
    <div class="et_pb_fullwidth_header_scroll"></div>
  </section>
</div>

<?php
  if ( empty ( $image_url ) ) {
    $url = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    ?>

    <!-- The data encoding type, enctype, MUST be specified as below -->
    <div class="et_pb_section  et_pb_section_0 et_pb_with_background et_section_regular" style="background-color: #ffffff;">
      <div class=" et_pb_row et_pb_row_0">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
          <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_0">
            <form enctype="multipart/form-data" action="<?php echo $url; ?>" method="POST">
              <!-- MAX_FILE_SIZE must precede the file input field -->
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
              <!-- Name of input element determines name in $_FILES array -->
              <label><strong>Proporciona tu foto <span class="ninja-forms-req-symbol">*</strong></span></label>
                <input name="userfile" type="file" />
              <input class="et_pb_promo_button et_pb_button" type="submit" value="Continuar" />
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
  } else {
?>

    <div class="et_pb_section et_pb_section_1 et_pb_with_background et_section_regular" style="background-color: #ffffff;">
      <!-- display image -->
      <div class=" et_pb_row et_pb_row_0" style="padding: 0 0 15px 0;">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et_pb_row_sticky" style="margin-bottom: 0;">
          <div class="et_pb_module et-waypoint et_pb_image et_pb_animation_right et_pb_image_0 et_always_center_on_mobile et_pb_image_sticky et-animated">
            <img src="<?php echo $image_url; ?>" style="max-width: 150px; max-height: 150px;">
          </div>
        </div> <!-- .et_pb_column -->
      </div>

      <div class=" et_pb_row et_pb_row_1">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
          <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_0">

            <?php
              if( function_exists( 'ninja_forms_display_form' ) ) { ninja_forms_display_form( $this->tal_tm_swr_options['selected_ninja_form'] ); }
            ?>
              <script type="text/javascript">
                document.getElementById("ninja_forms_field_67").setAttribute('value','<?php echo $image_url; ?>');
              </script>
          </div>
        </div>
      </div>
    </div>

    <?php
  }
