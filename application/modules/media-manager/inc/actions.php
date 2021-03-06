<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/controller.php' );
include_once( dirname( __FILE__ ) . '/assets.php' );
include_once( dirname( __FILE__ ) . '/install.php' );

class Media_Manager_Actions extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
        $this->install          =   new Media_Manager_Install;
    }

    /**
     *  Load Dashboard
     *  @param void
     *  @return void
    **/

    public function load_dashboard()
    {
        $this->Gui->register_page_object( 'media-manager', new Media_Manager_Controller );
    }

    /**
     *  Do Enable Module
     *  @param string module namespace
     *  @return void
    **/

    public function enable_module( $module_namespace )
    {
        global $Options;
        if( $module_namespace == 'media-manager' && @$Options[ 'media-manager-installed' ] == null ) {
            $this->install->tables();
            $this->options->set( 'media-manager-installed', true, true );
        }
    }

    /**
     *  Media Manager Footer
     *  @param void
     *  @return void
    **/

    public function media_footer()
    {
        $this->load->module_view( 'media-manager', 'media-footer' );
    }
}
