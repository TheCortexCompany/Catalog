<?php
use Cortex\Util\Registry;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Library\Cortex\Router\Router;
use Library\Cortex\Config\PhpConfigLoader;

class Application
{
    private static $instance;

    protected function __construct()
    {
        $this->setupDoctrine();
    }

    private function setupDoctrine()
    {
        $configurator   = new PhpConfigLoader;
        $dbConfig       = $configurator->load( ROOT_PATH . 'application/src/cortex/config/database' );
        $entities   = array( 'Cortex/Model/Entity' );
        $isDevMode  = true;

        $dbParams = [
            'driver'   => $dbConfig->driver,
            'user'     => $dbConfig->user,
            'password' => $dbConfig->pswd,
            'dbname'   => $dbConfig->name,
        ];


        $config = Setup::createAnnotationMetadataConfiguration( $entities, $isDevMode );

        $entityManager = EntityManager::create( $dbParams, $config );

        Registry::getInstance()->set( 'EntityManager', $entityManager );
    }

    public static function getInstance()
    {
        if ( null == self::$instance ) {
            self::$instance = new Application();
        }

        return self::$instance;
    }

    public function handle()
    {
        $configs    = new PhpConfigLoader;
        $routes     = $configs->load( ROOT_PATH . 'application/src/cortex/config/routes' );
        $router     = new Router( $routes );
        $router->execute();
    }

    public static function run()
    {
        try {

            return self::getInstance()->handle();

        } catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }
}