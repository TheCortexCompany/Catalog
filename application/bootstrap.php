<?php
define( 'PS', PATH_SEPARATOR );
define( 'DS', DIRECTORY_SEPARATOR );
define( 'ROOT_APP', __DIR__ );
define( 'ROOT_PATH', realpath( dirname( __DIR__ ) ) . DS );

ini_set( 'error_reporting', -1 );
ini_set( 'display_errors', 'On' );

date_default_timezone_set( 'America/Sao_Paulo' );

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path() . PATH_SEPARATOR .
    ROOT_PATH . 'application/src/'
);

spl_autoload_register(
    function( $className ) {
        $classPath = str_replace( '\\', DIRECTORY_SEPARATOR, sprintf( '%s', $className ) ) . '.php';

        if ( stream_resolve_include_path( $classPath ) !== false ) {
            require_once ROOT_PATH . 'application/src/'.$classPath;
        }
    }
);

