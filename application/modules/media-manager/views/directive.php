<script type="text/javascript">
    tendooApp.config(function(dropzoneOpsProvider){
        dropzoneOpsProvider.setOptions({
            url             : '<?php echo site_url([ 'dashboard', 'media-manager', 'upload' ] );?>',
            maxFilesize     : '10'
        });
    });

    tendooApp.directive('mediaModal', function(){
        return {
             
            restrict: 'A',
            replace: true,
            template: '<span class="input-group-btn"> <button class="btn btn-default" ng-click="showMedia()" type="button"><i class="fa fa-search"></i></button> </span>',
            scope: {
                model : '=model',
            },
            transclude : true,
            controller : [
                '$scope',
                '$http',
                '$attrs',
                '$compile',

                function( $scope, $http, $attrs, $compile ){
                    $scope.mediaEntries   = {};
                    var model = $attrs.model;
                    $scope.mediaSize = "full";
                    $scope.dzCallbacks          =   new Object;
                    
                    $scope.dzCallbacks.sending  =   function( file, XHR, formData ) {
                        var csrf_code           =   '<?php echo $this->security->get_csrf_hash(); ?>';
                        formData.append( '<?php echo $this->security->get_csrf_token_name(); ?>' , csrf_code );
                    }

                    /**
                     *  Load Assets 
                     *  @param
                     *  @return
                    **/

                    $scope.loadAssets = function(){
                        alert('call load');
                        $http.get( '<?php echo site_url( [ 'dashboard', 'media-manager', 'get' ] );?>' ).then(function( returned ) {
                            $scope.mediaEntries = returned.data;
                        });
                    }
                    
                    /**
                     *  Show media (trigger the modal for the file selection) 
                     *  @param
                     *  @return
                    **/

                    $scope.showMedia = function(){
                        $scope.loadAssets();
                        var tpl     = <?php echo json_encode( $this->load->module_view( 'media-manager', 'media-window', null, true ) );?>;
                        var message = $compile(tpl)($scope);
                        
                        bootbox.alert({ 
                            size: "large",
                            title: "<?php echo _s('Select a file','media-manager');?>",
                            message: message,
                            callback: function(){ 
                                $scope.modalHide();
                                $scope.$apply();
                            }
                        });

                        $scope.$parent.item[ $scope.model ] = "inMediaUse"; 

                        angular.element( '.modal-dialog' ).css({
                            width           :   '95%'
                        });

                        // timeout before the window appear
                        setTimeout( () => {
                            let height      =   
                            window.innerHeight - 
                            60 - // is the modal-dialog margin
                            30 - // is the modal-body padding
                            angular.element( '.modal-header' ).outerHeight() -
                            angular.element( '.modal-footer' ).outerHeight();
                            angular.element( '.modal-body' ).height( 
                                height
                            );
                        }, 200 );
                    }

                    /**
                     *  Select Entry
                     *  @param
                     *  @return
                    **/

                    $scope.selectEntry      =   function( entry ) {
                        _.each( $scope.mediaEntries, function( entry ) {
                            entry.selected  =   false;
                        });

                        if( angular.isUndefined( entry.selected ) ) {
                            entry.selected      =   true;
                        } else {
                            entry.selected     =   !  entry.selected;
                        }
                    }

                    /**
                     *  modalHide 
                     *  @param
                     *  @return
                    **/

                    $scope.modalHide = function(){
                        if( $scope.mediaSize == null){
                            $scope.mediaSize = 'full';
                        }
                        _.each( $scope.$parent.item, function( value, key ){
                            if( value == "inMediaUse" ){
                                _.each( $scope.mediaEntries, function( entry ){
                                    if( entry.selected == true ){
                                        var url = entry.url;
                                        var newUrl = url.replace("#NAMESPACE#",'-' + $scope.mediaSize );
                                        $scope.$parent.item[ key ] = newUrl;
                                    }
                                });
                            }
                        });

                        _.each( $scope.$parent.item, function( value, key ){
                            if( value == "inMediaUse"){
                                $scope.$parent.item[ key ] = "";
                            }
                        });
                    }
                    
                /* Controller end */
                }
            ]    
        };
    });
</script>