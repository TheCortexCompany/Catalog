<?php
namespace Library\Cortex\Config;

class PhpConfigLoader extends Configurator
{
    public function load( $file )
    {
        $file       = str_replace( '//', DIRECTORY_SEPARATOR, $file );
        $realFile   = $file . '.php';

        if ( ! is_file( $realFile ) || ! is_readable( $realFile ) ) {
            throw new \InvalidArgumentException( sprintf( '"%s" is not a valid config file.', $file ) );
        }

        $configs = require $realFile;

        return new self( $configs );
    }
}