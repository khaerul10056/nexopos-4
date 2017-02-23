var customersMain          =   function( customersTextDomain, $scope, $http, customersResource, $location, validate, table, customersTable, paginationFactory, sharedTableActions, sharedAlert ) {

    $scope.textDomain       =   customersTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   customersTable.columns;
    $scope.table.actions    =   sharedTableActions;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        customersResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    /**
     *  Table Delete
     *  @param object query
     *  @return void
    **/

    $scope.table.delete     =   function( params ){
        customersResource.delete( params, function( data ) {
            $scope.table.get();
        },function(){
            sharedAlert.warning( '<?php echo _s(
                'Une erreur s\'est produite durant l\'operation',
                'nexopos_advanced'
            );?>' );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);
}

customersMain.$inject    =   [ 'customersTextDomain', '$scope', '$http', 'customersResource', '$location', 'validate', 'table', 'customersTable', 'paginationFactory', 'sharedTableActions', 'sharedAlert' ];

tendooApp.controller( 'customersMain', customersMain );
