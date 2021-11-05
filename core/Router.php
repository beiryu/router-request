<?php

namespace Fresher\Core;

class Router
{
	/**
	 * @var namespaceController is prefix to initial a new controller
	 * @var controller is the controller is initialized
	 * @var action is the function is called in controller
	 * @var request contains all params for all methods
	 * @var params is params in uri. Ex. localhost/hello/{hello}/vietnam/{vietnam} 
	 */
	protected $namespaceController = "Fresher\\Source\\Controllers\\";
	protected $controller = null;
	protected $action = null;
	protected $request = null;
	protected $params = null;

	/**
	 * Construct the system routing
	 */
	public function __construct()
	{
		// initialize request object
		$this->request = new Request();
	}

	/**
	 * Execute the sys routing
	 * @param routes is array
	 */
	public function execute($routes)
	{
		// fetches the URI
		$uri = $this->getUri();

		// parse params and reform uri
		if ($this->hasParameters($uri))
		{
			// split all id digit
			preg_match_all('!\d+!', $uri, $matches);
			$this->params = $matches[0];
			
			// replace id to {id} string form
			$uri = preg_replace('/(\/\d+)/', "/{id}", $uri);
		}

		// forward to properly route
		$method = $this->request->getMethod(); 
		if (isset($routes[$method][$uri]))
		{
			// parse name of controller
			$name = $this->parseRoute($routes[$method][$uri]);
			
			// initializes the controller
			$this->controller = $this->initializeController($name);
		}
	}

	/**
	 * Parse a string route 
	 * @param string $route the string contains controller and action
	 * @return string $name is controller'name
	 */
	public function parseRoute($route)
	{
		// parse controller and action
		list($name, $this->action) = explode('@', $route);
		return $name;	
	}

	/**
	 * Check if it have any parameters 
	 * @param string $route is uri 
	 * @return boolean
	 */
	public function hasParameters($route)
	{
		return preg_match('/(\/\d+)/', $route); 
	}

	/**
	 * Fetches the current URI called
	 * @return string the URI called
	 */
	protected function getUri()
	{
		$uri = explode('?',$_SERVER['REQUEST_URI']);
		$uri = $uri[0];
		$uri = substr($uri, strlen(WEB_ROOT));
		return $uri;
	}


	/**
	 * Initializes the given controller
	 * @param string $name the name of the controller
	 * @return mixed null if error, else a controller
	 */
	protected function initializeController($name)
	{
		// initializes the controller
		$controller = $this->namespaceController . ucfirst($name) . 'Controller';

		// constructs the controller
		return new $controller($this->request, $this->params, $this->action);
	}

	
	public function getController()
	{
		return $this->controller;
	}
}