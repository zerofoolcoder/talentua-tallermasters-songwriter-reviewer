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
<div class="et_pb_section et_pb_fullwidth_section  et_pb_section_0 et_section_regular" style="background-color: #000000;">
  <section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left  et_pb_fullwidth_header_0">
    <div class="et_pb_fullwidth_header_container left">
      <div class="header-content-container center">
        <div class="header-content">
          <h1>Listado</h1>
        </div>
      </div>
    </div>
    <div class="et_pb_fullwidth_header_overlay"></div>
    <div class="et_pb_fullwidth_header_scroll"></div>
  </section>
</div>

<!-- No Candidates Message -->
<?php
  if (count($Casting->Candidates()) == 0) {
?>

    <div class="et_pb_section  et_pb_section_0 et_section_regular">
      <div class=" et_pb_row et_pb_row_0">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
          <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_center  et_pb_text_0">
            <h3>Por el momento no hay candidatos para mostrar. Regresa más tarde.</h3>
          </div> <!-- .et_pb_text -->
    		</div> <!-- .et_pb_column -->
    	</div> <!-- .et_pb_row -->
    </div>

<!-- Review Candidate Section -->
<?php
  } else {
?>

<!-- Print Table Headers -->
    <div class="et_pb_section  et_pb_section_0 et_section_regular">
      <div class=" et_pb_row et_pb_row_0">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
          <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_center  et_pb_text_0">
            <div class="rg-container">
              <div class="rg-header">
                <div class="rg-hed">Listado de Candidatos</div>
                <div class="rg-subhed">Taller Masters</div>
              </div>
              <div class="rg-content">
                <table class="rg-table zebra">
                  <thead>
                    <th class="text rg-th">Foto</th>
                    <th class="text rg-th">Status</th>
                    <th class="text rg-th">Nombre</th>
                    <th class="text rg-th">Domicilio</th>
                    <th class="text rg-th">Contacto</th>
                    <th class="text rg-th">Videos</th>
                    <th class="text rg-th">Redes Sociales</th>
                  </thead>
                  <tbody>

                  <?php
                    foreach ($Casting->Candidates() as $Candidate) {
                  ?>
                      <tr>
                        <td class="text" data-title="Foto" style="text-align: center;"><a href="<?php echo $Candidate->_Imagen; ?>" class="et_pb_lightbox_image" title=""><img src="<?php echo $Candidate->_Imagen; ?>" style="max-width: 80px; max-height: 80px; vertical-align: top;"></a></td>
                        <td class="text" data-title="Status" style="text-align: center; vertical-align: middle;">
                          <?php
                            switch ($Candidate->_Status) {
                              case 'accepted':
                                echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #81d742; font-size: 14px; color: #d8d8d8; padding: 6px; font-family: ETmodules;"></span>';
                                break;
                              case 'rejected':
                                echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #dd3333; font-size: 14px; color: #d8d8d8; padding: 6px; font-family: ETmodules;"></span>';
                                break;
                              case 'standby':
                                echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #FF0; font-size: 14px; color: #d8d8d8; padding: 6px; font-family: ETmodules;"></span>';
                                break;
                              case '':
                                echo '<span class="et-pb-icon et-waypoint et_pb_animation_top et-pb-icon-circle et-animated" style="background-color: #999; font-size: 14px; color: #d8d8d8; padding: 6px; font-family: ETmodules;"></span>';
                                break;
                              default:
                            }
                          ?>
                        </td>
                        <td class="text" data-title="Nombre"><?php echo $Candidate->_Nombres . ' ' . $Candidate->_Apellidos . '<br>(' . $Candidate->_NombreArtistico; ?>)</td>
                        <td class="text" data-title="Domicilio"><?php echo $Candidate->_Calle . '<br>' . $Candidate->_Colonia . '<br>' . $Candidate->_Delegacion . '<br>' . $Candidate->_Estado . '<br>' . $Candidate->_CodigoPostal; ?></td>
                        <td class="text" data-title="Contacto"><?php echo $Candidate->_TelefonoMovil . '<br>' . $Candidate->_CorreoElectronico; ?></td>
                        <td class="text" data-title="Videos"><a href="<?php echo $Candidate->_VideoPitch; ?>" target="_blank" style="color: #2ea3f2; text-decoration: underline;">Pitch</a><br><a href="<?php echo $Candidate->_VideoInterpretacion; ?>" target="_blank" style="color: #2ea3f2; text-decoration: underline;">Interpretación</a></td>
                        <td class="text" data-title="Redes Sociales">
                          <ul class="et_pb_member_social_links" style="margin-bottom: 15px;text-align: center;">
                            <?php if (!empty($Candidate->_SitioWebPersonal)) echo '<a href="' . ((empty(parse_url($Candidate->_SitioWebPersonal)['scheme'])) ? 'http://' . ltrim($Candidate->_SitioWebPersonal, '/') : $Candidate->_SitioWebPersonal) . '" target="_blank" class="icon"><li style="font-family: ETmodules; margin: 0 2px 0 2px;"></li></a>'; ?>
                            <?php if (!empty($Candidate->_Facebook)) echo '<li class="et-social-icon et-social-facebook" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Facebook . '" target="_blank" class="icon"><span>Facebook</span></a></li>'; ?>
                            <?php if (!empty($Candidate->_Twitter)) echo '<li class="et-social-icon et-social-twitter" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Twitter . '" target="_blank" class="icon"><span>Twitter</span></a></li>'; ?>
                            <?php if (!empty($Candidate->_Instagram)) echo '<li class="et-social-icon et-social-instagram" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Instagram . '" target="_blank" class="icon"><span>Instagram</span></a></li>'; ?>
                            <?php if (!empty($Candidate->_Youtube)) echo '<li class="et-social-icon et-social-youtube" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Youtube . '" target="_blank" class="icon"><span>Youtube</span></a></li>'; ?>
                            <?php if (!empty($Candidate->_Vimeo)) echo '<li class="et-social-icon et-social-vimeo" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_Vimeo . '" target="_blank" class="icon"><span>Vimeo</span></a></li>'; ?>
                            <?php if (!empty($Candidate->_GooglePlus)) echo '<li class="et-social-icon et-social-google-plus" style="margin: 0 2px 0 2px;"><a href="' . $Candidate->_GooglePlus . '" target="_blank" class="icon"><span>GooglePlus</span></a></li>'; ?>
                          </ul>
                        </td>
                      </tr>
                  <?php
                    }
                  ?>

                  </tbody>
                </table>
              </div>
              <div class="rg-source-and-credit">
                <div class="rg-source"><span class="pre-colon">FUENTE</span>: <span class="post-colon">Taller Masters</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  }
