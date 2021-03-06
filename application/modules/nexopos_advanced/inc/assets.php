<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NexoPOS_Assets extends Tendoo_Module
{
    public function __construct()
    {
        global $Options;
        parent::__construct();
        $bower_url      =   '../modules/nexopos_advanced/bower_components/';
        $js_url         =   '../modules/nexopos_advanced/js/';
        $css_url        =   '../modules/nexopos_advanced/css/';
        $root_url       =   '../bower_components/';

        $this->enqueue->css_namespace( 'dashboard_header' );
        $this->enqueue->css( $bower_url . 'angular-ui-notification/dist/angular-ui-notification.min' );
        $this->enqueue->css( $root_url . 'angular-bootstrap-datetimepicker/src/css/datetimepicker' );
        $this->enqueue->css( $bower_url . 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min' );

        $this->enqueue->css( 'css/nexopos', module_url( 'nexopos_advanced' ) );
        // Amo Multiselect CSS
        $this->enqueue->css( $bower_url . 'amo-angular-multiselect/dist/multiselect');

        // Sweet Alert CSS
        $this->enqueue->css( $bower_url . 'sweetalert/dist/sweetalert' );

        $this->enqueue->js_namespace( 'dashboard_footer' );
        $this->enqueue->js( 'js/string.format', module_url( 'nexopos_advanced' ) );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_factories', 'currency' ]), '' );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_factories', 'moment' ]), '' );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_factories', 'resource-loader' ]), '' );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_factories', 'hooks' ]), '' );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_factories', 'validate' ]), '' );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_directives', 'spinner' ]), '' );
        $this->enqueue->js( site_url([ 'dashboard', 'nexopos', 'shared_factories', 'media' ]), '' );

        $this->enqueue->js( '../bower_components/angular-route/angular-route.min' );
        $this->enqueue->js( '../bower_components/angular-resource/angular-resource.min' );
        $this->enqueue->js( '../bower_components/angular-animate/angular-animate.min' );
        $this->enqueue->js( $bower_url . 'oclazyload/dist/ocLazyLoad.min' );
        $this->enqueue->js( $bower_url . 'angular-ui-notification/dist/angular-ui-notification.min' );
        $this->enqueue->js( $bower_url . 'moment/min/moment.min' );
        $this->enqueue->js( $bower_url . 'moment-timezone/builds/moment-timezone-with-data-2010-2020.min' );

        if( @$Options[ 'site_language' ] == 'en_US') {
            $this->enqueue->js( $bower_url . 'moment/locale/en-gb' );
        } else if( @$Options[ 'site_language' ] == 'fr_FR') {
            $this->enqueue->js( $bower_url . 'moment/locale/fr' );
        } else if( @$Options[ 'site_language' ] == 'es_ES') {
            $this->enqueue->js( $bower_url . 'moment/locale/es' );
        }

        $this->enqueue->js( $bower_url . 'angular-numeraljs/dist/angular-numeraljs.min' );
        $this->enqueue->js( $bower_url . 'angular-bootstrap/ui-bootstrap.min' );
        $this->enqueue->js( $bower_url . 'angular-bootstrap/ui-bootstrap-tpls.min' );
        $this->enqueue->js( $root_url . 'angular-bootstrap-datetimepicker/src/js/datetimepicker' );
        $this->enqueue->js( $root_url . 'angular-bootstrap-datetimepicker/src/js/datetimepicker.templates' );

        // bootstrap datetime picker
        $this->enqueue->js( $bower_url . 'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min' );
        $this->enqueue->js( $bower_url . 'angular-eonasdan-datetimepicker/dist/angular-eonasdan-datetimepicker.min' );

        // Sweeet Alert
        $this->enqueue->js( $bower_url . 'ngSweetAlert/SweetAlert.min' );
        $this->enqueue->js( $bower_url . 'sweetalert/dist/sweetalert.min' );

        // Amo Multiselect
        $this->enqueue->js( $bower_url . 'amo-angular-multiselect/dist/multiselect.min');

        // Numeral JS
        $this->enqueue->js( $bower_url . 'numeral/min/numeral.min');

        // Local Storage
        $this->enqueue->js( $bower_url . 'angular-local-storage/dist/angular-local-storage.min');
    }
}
