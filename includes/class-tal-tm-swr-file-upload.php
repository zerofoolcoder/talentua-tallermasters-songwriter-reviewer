<?php
  //DONE:0 Cambiar las etiquetas de los mensajes de error a español
  class Tal_Tm_Swr_File_Upload {
    /**
     * Index key from upload form
     * @var string
    */
    public $index_key = '';

    /**
     * Copy of superglobal array $_FILES
     * @var array
     */
    public $files = array();

    /**
     * Array with url, filepath and mimetype after uploading
     * @var array
     */
    public $filedata = array();

    /**
     * Error object containing errors as WP_Error
     * @var onject
     */
    public $errors = null;

    /**
     * Constructor
     * Setup files array and guess index key
     */
    public function __construct(){
      if ( isset( $_FILES ) && ! empty( $_FILES ) ) {
        $this->files = $_FILES;
        $this->guess_index_key();
        $this->files[$this->index_key]['name'] = uniqid() . '.' . pathinfo($this->files[$this->index_key]['name'], PATHINFO_EXTENSION);
      }
    }

    /**
     * Set/overwrites the index key
     * Converts $name with type casting (string)
     *
     * @param	string	$name	Name of the index key
     * @return	string	::name	Name of the stored index key
     */
    public function set_field_name_for_file( $name = '' ) {
      $this->index_key = ( ! empty( $name ) ) ? (string) $name : '';
      return $this->index_key;
    }

    /**
     * Converts uploaded file into WordPress attachment
     *
     * @return	boolean		Whether if the attachment was created (true) or not (false)
     */
    public function create_attachment() {
      // move the uploaded file from temp folder and create basic data
      $this->filedata = $this->handle_uploaded_file();
      // if moving fails, stop here

      if ( empty( $this->filedata ) || is_wp_error( $this->filedata ) ) {
        $code = 'createerror';
        $msg  = 'No es posible crear un archivo adjunto';

        if ( is_wp_error( $this->filedata ) ) {
          $this->errors = $this->filedata;
          $this->filedata = array();
          $this->errors->add( $code, $msg );
        }

        else {
          $this->errors = new WP_Error( $code, $msg );
        }
        return $this->errors;
      }

      /*
       * For Production
       * Check if $imagedata contains the expected (and needed)
       * values. Every method could fail and return malicious data!!
       */
      extract( $this->filedata );
      // create the attachment data array
      $attachment = array(
        'guid'           => $url,
        'post_mime_type' => $type,
        'post_title'     => sanitize_key( basename( $file ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
      );

      // insert attachment (posttype attachment)
      $attach_id = wp_insert_attachment( $attachment, $file );
      // you must first include the image.php file
      // for the function wp_generate_attachment_metadata() to work
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      /*
       * For Production
       * Check $attach_data, wp_generate_attachment_metadata() could fail
       * Check if wp_update_attachment_metadata() fails (returns false),
       * return an error object with WP_Error()
       */
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      return $attach_id;
    }

    /**
     * Handles the upload
     *
     * @return	array|object	$return_data	Array with informations about the uploaded file on success. WP_Error object on failure
     */
    protected function handle_uploaded_file() {
      // stop if something went wrong
      if ( ! isset( $this->files[$this->index_key]['tmp_name'] ) || empty( $this->files[$this->index_key]['tmp_name'] ) ) {
        $code = ( isset( $this->files[$this->index_key]['error'] ) ) ? $this->files[$this->index_key]['error'] : 0;
        $msg = $this->guess_upload_error( $code );
        return new WP_Error( 'uploaderror', 'Error de carga con mensaje: ' . $msg );
      }

      /*
       * For Production
       * You should really, really check the file extension and filetype ($movedfile['type'])
       * on EVERY upload. If you do not, it is possible to upload EVERY kind of
       * file including malicious code.
       *
       */
      if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
      $movedfile = wp_handle_upload( $this->files[$this->index_key], array( 'test_form' => false ) );
      return $movedfile;
    }

    /**
     * Try to fetch the first index from $_FILES
     *
     * @return	boolean		Whether if a key was found or not
     */
    protected function guess_index_key() {
      $keys = array_keys( $_FILES );
      if ( ! empty( $keys ) ) {
        $this->index_key = $keys[0];
        return true;
      }
      return false;
    }

    protected function guess_upload_error( $err = 0 ) {
      $errcodes = array(
        'Error desconocido.',
        'El archivo excede el tamaño máximo definido.',
        'El archivo excede el tamaño máximo definido.',
        'No pudo cargarse el archivo completamente.',
        'No se cargó ningún archivo.',
        'No existe un directorio temporal.',
        'No se pudo salvar el archivo en disco.',
        'No fue posible cargar el archivo.'
      );
      return ( isset( $errcodes[$err] ) ) ? $errcodes[$err] : 'Error desconocido.';
    }
  }
