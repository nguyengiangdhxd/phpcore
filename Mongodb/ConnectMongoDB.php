<?php

namespace Mongodb;

use Flywheel\Config\ConfigHandler;
use Mandango\Cache\FilesystemCache;
use Mandango\Connection;
use Mandango\Mandango;
use Mongodb\Mapping\Metadata;

/**
 * mongodb\connect.
 */
class ConnectMongoDB
{
    protected static $_conn;

    /**
     * @param null $configKey
     * @return Mandango
     */
    public static function getConnection( $configKey = null )
    {
        $config = ConfigHandler::get( 'mongodb' );
        if ( !$configKey || !isset( $config[ $configKey ] ) ) {
            $configKey = $config[ '__default__' ];
        }
        $config = $config[ $configKey ];
        if ( !isset( self::$_conn[ $configKey ] ) ) {
            if ( isset( $config[ 'dsn' ] ) && isset( $config[ 'db_name' ] ) ) {
                $metadataFactory = new Metadata();
                $cache = new FilesystemCache( ROOT_PATH.'/runtime/CacheQuery' );
                $mandango = new Mandango( $metadataFactory, $cache );
                $connection = new Connection( $config[ 'dsn' ], $config[ 'db_name' ] );
                $mandango->setConnection( 'my_connection', $connection );
                $mandango->setDefaultConnectionName( 'my_connection' );
                self::$_conn[ $configKey ] = $mandango;
            } else {

                return false;
            }
        }
        return self::$_conn[ $configKey ];

    }
}