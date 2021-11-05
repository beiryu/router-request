<?php

namespace Fresher\Core;

interface RequestInterface 
{
   /**
	 * fetches the given parameter data.
	 * @param string $key the key to look for.
	 * @param mixed $default the default value to return, if the given parameter is not set.
	 */
	public function getParam($key);

    /**
	 * Returns a list of parameters given in the current request
	 * @return array the params given
	 */
	public function getAllParams();

	/**
	 * Returns a data json parse to array given in the current request
	 * @return array the params given
	 */
	public function getJson();

}