<?php

namespace Fresher\Core;

class Request implements RequestInterface
{

	protected $method = null;
	
	/**
	 * Construct the request
	 * Define the method of request
	 */
	public function __construct()
	{
		$this->method = $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * Get method
	 * @return string method
	 */
	public function getMethod()
	{
		return $this->method; 
	}

    /**
	 * Factory request
	 * @return object property request method 
	 */
	protected function factoryRequest()
    {
        if ($this->method === 'POST') {
			return new PostRequest;
		}
		else if ($this->method === 'GET') {
			return new GetRequest;
		}
		else if ($this->method === 'PUT') {
			return new PutRequest;
		}
    }

    /**
	 * fetches the given parameter data.
	 * @param string $key the key to look for.
	 * @param mixed $default the default value to return, if the given parameter is not set.
	 */
	public function getParam($key)
	{
        $data = null;
        $data = $this->factoryRequest()->getParam($key);
        return $data;		
	}
    
	/**
	 * Returns a list of parameters given in the current request
	 * @return array the params given
	 */
	public function getAllParams()
	{
        return $this->factoryRequest()->getAllParams();
	}
    
	/**
	 * Returns a data json given in the current request
	 * @return array the params given
	 */
	public function getJson() {
		// Takes raw data from the request
		$json = file_get_contents('php://input');

		// Converts it into a PHP object
		$data = json_decode($json);
		return $data;
	}
}


class GetRequest extends Request implements RequestInterface
{
    public function getAllParams()
    {
        return $_GET;
    }
    public function getParam($key)
    {
        if(isset($_GET[$key])) {
            return $_GET[$key];
        }
    }
}

class PostRequest extends Request implements RequestInterface
{
    public function getAllParams()
    {
        return $_POST;
    }
    public function getParam($key)
    {
        if(isset($_POST[$key])) {
            return $_POST[$key];
        }
    }
}

class PutRequest extends Request implements RequestInterface
{
    public function getAllParams()
    {
        parse_str(file_get_contents("php://input"),$putData); 
		return $putData;
    }
    public function getParam($key)
    {
        parse_str(file_get_contents("php://input"),$putData); 
        return $putData[$key];
    }
}

// viet class request
