<?php

namespace Fresher\Core;

abstract class Base
{
	abstract protected function _getRefParams();

	protected $method = null;

	/**
	 * Get method
	 * @return string method
	 */
	public function getMethod()
	{
		return $this->method; 
	}
	
    public function getParams($default, $key = null)
	{
        $data = $this->_getRefParams();
        return $key ? ($data[$key] ?? $default) : $data;
	}
    
	
	/**
	 * Returns a data json given in the current request
	 * @return array the params given
	 */
	public function getJson($default, $key = null) {
		// Takes raw data from the request
		$json = file_get_contents('php://input');
		// Converts it into a PHP object
		$data = (array)json_decode($json);
		
        return $key ? ($data[$key] ?? $default) : $data;
	}

}

class GetRequest extends Base
{
    protected function _getRefParams()
    {
        return $_GET;
    }
}

class PostRequest extends Base
{
    protected function _getRefParams()
    {
        return $_POST;
    }
}

class PutRequest extends Base
{
    protected function _getRefParams()
    {
        parse_str(file_get_contents("php://input"),$data); 
		return $data;
    }
}

class DeleteRequest extends Base
{
    protected function _getRefParams()
    {
        parse_str(file_get_contents("php://input"),$data); 
		return $data;
    }
}