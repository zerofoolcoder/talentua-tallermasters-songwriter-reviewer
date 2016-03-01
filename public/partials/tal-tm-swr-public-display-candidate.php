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
          <h1>Evaluación</h1>
        </div>
      </div>
    </div>
    <div class="et_pb_fullwidth_header_overlay"></div>
    <div class="et_pb_fullwidth_header_scroll"></div>
  </section>
</div>

<!-- Candidate Summary -->
<div class="et_pb_section  et_pb_section_0 et_section_regular" style="padding: 1% 0 0;">
  <div class=" et_pb_row et_pb_row_0" style="padding: 1% 0 0;">
    <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
      <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_right  et_pb_text_0">
        <h4><?php echo $Casting->_CandidatesReviewed; ?> de <?php echo $Casting->_TotalCandidates; ?> candidatos evaluados</h4>
          [
            <span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #81d742; font-size: 10px; color: #d8d8d8; padding: 5px;"></span>
            ( <?php echo $Casting->_CandidatesAccepted; ?> )
          |
            <span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #dd3333; font-size: 10px; color: #d8d8d8; padding: 5px;"></span>
            ( <?php echo $Casting->_CandidatesRejected; ?> )
          |
            <span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #FF0; font-size: 10px; color: #d8d8d8; padding: 5px;"></span>
            ( <?php echo $Casting->_CandidatesStandBy; ?> )
          ]
      </div> <!-- .et_pb_text -->
		</div> <!-- .et_pb_column -->
	</div> <!-- .et_pb_row -->
</div>

<!-- No Candidates Message -->
<?php
  if (count($Casting->Candidates()) == 0) {
?>

    <div class="et_pb_section  et_pb_section_0 et_section_regular">
      <div class=" et_pb_row et_pb_row_0">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
          <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_center  et_pb_text_0">
            <h3>Por el momento no hay más candidatos para evaluar. Regresa más tarde.</h3>
          </div> <!-- .et_pb_text -->
    		</div> <!-- .et_pb_column -->
    	</div> <!-- .et_pb_row -->
    </div>

<!-- Review Candidate Section -->
<?php
  } else {
    $Candidate = $Casting->Candidates()->current();
?>

    <div class="et_pb_section  et_pb_section_0 et_section_specialty" style="padding-top: 0;">
      <div class="et_pb_row et_pb_row_1-4_3-4">
        <div class="et_pb_column et_pb_column_1_4  et_pb_column_0 et_pb_column_single">
          <!-- Person Module Begin -->
    		    <div class="et_pb_module et_pb_team_member  et_pb_team_member_0 et_pb_bg_layout_light clearfix" style="padding: 20px 3px 20px 3px;">
              <h5 class="et_pb_toggle_title" style="text-align: center;"><?php echo $Candidate->_NombreArtistico; ?></h5>
    		      <div class="et_pb_team_member_image et-waypoint et_pb_animation_fade_in et-animated" style="margin-top: 10px; padding: 0 20px 10px;">
    			      <img src="<?php echo $Candidate->_Imagen; ?>">
    		      </div>
    		      <div class="et_pb_team_member_image et-waypoint et_pb_animation_fade_in et-animated" style="border: 1px solid #d9d9d9;line-height: 2;padding: 15px 5px 0px;">
    			      <p class="et_pb_member_position" style="text-align: left; white-space: nowrap; overflow: hidden;">
                  <?php
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px;"></span>&nbsp;&nbsp;' . $Candidate->_Nombres . ' ' . $Candidate->_Apellidos . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px;"></span>&nbsp;&nbsp;' . $Candidate->_FechaDeNacimiento . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px;"></span>&nbsp;&nbsp;' . $Candidate->_TelefonoMovil . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px;"></span>&nbsp;&nbsp;' . $Candidate->_CorreoElectronico . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px;"></span>&nbsp;&nbsp;' . $Candidate->_Calle . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px; color: #ffffff;"></span>&nbsp;&nbsp;' . $Candidate->_Colonia . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px; color: #ffffff;"></span>&nbsp;&nbsp;' . $Candidate->_Delegacion . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px; color: #ffffff;"></span>&nbsp;&nbsp;' . $Candidate->_Estado . '<br>';
                    echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-animated" style="font-size: 14px; margin-left: 5px; color: #ffffff;"></span>&nbsp;&nbsp;' . $Candidate->_CodigoPostal;
                  ?>
                </p>
                <hr>
                <ul class="et_pb_member_social_links" style="margin-bottom: 15px;text-align: center;">
                  <?php if (!empty($Candidate->_SitioWebPersonal)) echo '<a href="' . ((empty(parse_url($Candidate->_SitioWebPersonal)['scheme'])) ? 'http://' . ltrim($Candidate->_SitioWebPersonal, '/') : $Candidate->_SitioWebPersonal) . '" target="_blank" class="icon"><li style="font-family: ETmodules; margin: 0 2px 0 2px;"></li></a>'; ?>
                  <?php if (!empty($Candidate->_Facebook)) echo '<li class="et-social-icon et-social-facebook" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Facebook . '" target="_blank" class="icon"><span>Facebook</span></a></li>'; ?>
                  <?php if (!empty($Candidate->_Twitter)) echo '<li class="et-social-icon et-social-twitter" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Twitter . '" target="_blank" class="icon"><span>Twitter</span></a></li>'; ?>
                  <?php if (!empty($Candidate->_Instagram)) echo '<li class="et-social-icon et-social-instagram" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Instagram . '" target="_blank" class="icon"><span>Instagram</span></a></li>'; ?>
                  <?php if (!empty($Candidate->_Youtube)) echo '<li class="et-social-icon et-social-youtube" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Youtube . '" target="_blank" class="icon"><span>Youtube</span></a></li>'; ?>
                  <?php if (!empty($Candidate->_Vimeo)) echo '<li class="et-social-icon et-social-vimeo" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Vimeo . '" target="_blank" class="icon"><span>Vimeo</span></a></li>'; ?>
                  <?php if (!empty($Candidate->_GooglePlus)) echo '<li class="et-social-icon et-social-google-plus" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_GooglePlus . '" target="_blank" class="icon"><span>GooglePlus</span></a></li>'; ?>
                </ul>
    		      </div> <!-- .et_pb_team_member_description -->
    	      </div> <!-- .et_pb_team_member -->
            <div class="et_pb_blurb et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_blurb_0 et_pb_blurb_position_top">
    	        <div class="et_pb_blurb_content">
    		        <div class="et_pb_main_blurb_image">
                  <span id="accepted" data-id="<?php echo $Candidate->sub_id; ?>" class="do-ajax et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #81d742; font-size: 24px; color: #d8d8d8; padding: 10px; cursor: pointer;"></span>
                  <span id="rejected" data-id="<?php echo $Candidate->sub_id; ?>" class="do-ajax et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #dd3333; font-size: 24px; color: #d8d8d8; padding: 10px; cursor: pointer;"></span>
                  <span id="standby" data-id="<?php echo $Candidate->sub_id; ?>" class="do-ajax et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #FF0; font-size: 24px; color: #d8d8d8; padding: 10px; cursor: pointer;"></span>
                </div>
    	        </div> <!-- .et_pb_blurb_content -->
            </div>
            <div id="divLoading"></div>
          <!-- Person Module End -->

        </div> <!-- .et_pb_column -->

        <div class="et_pb_column et_pb_column_3_4  et_pb_column_1 et_pb_specialty_column">
    	    <div class=" et_pb_row_inner et_pb_row_inner_0">
    	      <div class="et_pb_column et_pb_column_4_4 et_pb_column_inner  et_pb_column_inner_0">
              <div class="et_pb_module et_pb_accordion  et_pb_accordion_0">
                <div class="et_pb_module et_pb_toggle  et_pb_accordion_item_0 et_pb_toggle_open">
                  <h5 class="et_pb_toggle_title">Videos</h5>
                  <div class="et_pb_toggle_content clearfix" style="display: block;">
                    <!-- Video Slider Begin -->
      								<div class="et_pb_module et_pb_video_slider  et_pb_video_slider_0">
      				          <div class="et_pb_slider et_pb_slider_carousel et_pb_slider_no_pagination et_pb_controls_light et_pb_bg_layout_dark">
      					          <div class="et_pb_slides">
      						          <div class="et_pb_slide et_pb_bg_layout_dark et-pb-active-slide" data-image="//i.ytimg.com/vi/<?php echo $this->getYoutubeIdFromUrl($Candidate->_VideoPitch); ?>/hqdefault.jpg">
      				                <div class="et_pb_video_wrap">
      				                  <div class="et_pb_video_box">
      					                  <div class="fluid-width-video-wrapper" style="padding-top: 75%;">
                                    <iframe src="https://www.youtube.com/embed/<?php echo $this->getYoutubeIdFromUrl($Candidate->_VideoPitch); ?>?feature=oembed&amp;amp;wmode=opaque" frameborder="0" allowfullscreen id="fitvid0"></iframe>
                                  </div>
                                </div>
                              </div>
                            </div> <!-- .et_pb_slide -->
                            <div class="et_pb_slide et_pb_bg_layout_dark" data-image="//i.ytimg.com/vi/<?php echo $this->getYoutubeIdFromUrl($Candidate->_VideoInterpretacion); ?>/hqdefault.jpg">
                              <div class="et_pb_video_wrap">
                                <div class="et_pb_video_box">
                                  <div class="fluid-width-video-wrapper" style="padding-top: 75%;">
                                    <iframe src="https://www.youtube.com/embed/<?php echo $this->getYoutubeIdFromUrl($Candidate->_VideoInterpretacion); ?>?feature=oembed&amp;amp;wmode=opaque" frameborder="0" allowfullscreen id="fitvid1"></iframe>
                                  </div>
                                </div>
                              </div>
                            </div> <!-- .et_pb_slide -->
                          </div> <!-- .et_pb_slides -->
                          <div class="et-pb-slider-arrows">
                            <a class="et-pb-arrow-prev" href="#" style="color: inherit;"><span>Previous</span></a>
                            <a class="et-pb-arrow-next" href="#" style="color: inherit;"><span>Next</span></a>
                          </div>
                        </div>
                      </div> <!-- .et_pb_video_slider -->
                    <!-- Video Slider End -->
                  </div> <!-- .et_pb_toggle_content -->
                </div> <!-- .et_pb_toggle -->
                <div class="et_pb_module et_pb_toggle  et_pb_accordion_item_1 et_pb_toggle_close">
                  <h5 class="et_pb_toggle_title">Biografía</h5>
                  <div class="et_pb_toggle_content clearfix" style="display: none;">
                    <p><?php echo html_entity_decode($Candidate->_Biografia); ?></p>
                  </div> <!-- .et_pb_toggle_content -->
                </div> <!-- .et_pb_toggle -->
                <div class="et_pb_module et_pb_toggle  et_pb_accordion_item_2 et_pb_toggle_close">
                  <h5 class="et_pb_toggle_title">Cuestionario</h5>
                  <div class="et_pb_toggle_content clearfix" style="display: none;">
                    <h5>¿Por qué te interesa participar en Taller Masters?</h5>
                    <p style="color: #666; margin:0 0 10px 20px"><?php echo html_entity_decode($Candidate->_Pregunta1); ?></p><p></p>
                    <h5>¿Eres compositor o cantautor?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta2); ?></p><p></p>
                    <h5>¿Qué quieres ser? ¿Un autor de moda o un autor de éxito?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta3); ?></p><p></p>
                    <h5>¿Cuáles son las motivaciones que te llevan a componer?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta4); ?></p><p></p>
                    <h5>¿Te consideras un autor vivencial o que escribe por solicitud de otros?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta5); ?></p><p></p>
                    <h5>¿Cuáles son tus artistas favoritos?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta6); ?></p>
                    <h5>¿Cuál es el género que te gusta interpretar y por qué?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta7); ?></p>
                    <h5>¿Qué piensas de las letras de los nuevos compositores en todos sus géneros y qué aportan?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta8); ?></p>
                    <h5>¿Qué te hace diferente a los demás?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta9); ?></p>
                    <h5>Después de la música, ¿Qué otra profesión ejercerías?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta10); ?></p>
                    <h5>¿Qué tanto sabes de tus derechos editoriales (llámese Regalías autorales)?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta11); ?></p>
                    <h5>¿Estás firmado con alguna editora?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta12); ?></p>
                    <h5>¿Estas inscrito en la SACM (Sociedad de Autores y Compositores de México)?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta13); ?></p>
                    <h5>¿Cómo te enteraste de nosotros?</h5>
                    <p style="color: #666; margin:0 0 10px 20px;"><?php echo html_entity_decode($Candidate->_Pregunta14); ?></p>
                  </div> <!-- .et_pb_toggle_content -->
                </div> <!-- .et_pb_toggle -->
              </div> <!-- .et_pb_accordion -->
            </div> <!-- .et_pb_column -->
          </div> <!-- .et_pb_row_inner -->
        </div> <!-- .et_pb_column -->
      </div> <!-- .et_pb_row -->
    </div>

<?php
  }
