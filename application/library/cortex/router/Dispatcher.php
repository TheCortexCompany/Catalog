<?php
namespace Library\Cortex\Dispatcher;

class Dispatcher
{
	private $controller;
	private $action;
	private $params;

	public function __construct( $controller, $action, $params )
	{
		$this->setController( $controller );
		$this->setAction( $action );
		$this->params = $params;
	}

	private function setController( $controller )
	{
		$controllerName = ucwords( $controller );
		$controller 	= sprintf( 'Webmotors\Controller\%s\%sController', $controllerName, $controllerName );

		if ( true !== class_exists( $controller ) ) {
			throw new \InvalidArgumentException( 'Invalid request.' );
		}

		$this->controller = $controller;

		return $this;
	}

	private function setAction( $action )
	{
		$reflector = new \ReflectionClass( $this->controller );		

		if ( true !== $reflector->hasMethod( $action ) ) {
			throw new \InvalidArgumentException( 'Invalid action.' );
		}

		$this->action = $action;

		return $this;
	}

	public function dispatch()
	{
		$controller = new $this->controller;
		$action 	= $this->action;

		return $controller->$action( $this->params );
	}
}