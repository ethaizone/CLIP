<?php


class Route {

	protected static $route_list = array();
	protected static $init = FALSE;

	/**
	 * Add function to Route for call later
	 * @param string $route_name Route name
	 * @param mixed $callback   Callback function
	 */
	public static function add($route_name, $callback)
	{
		static::$route_list[$route_name] = $callback;
	}


	private static function call($route_name, $parameters)
	{
		if(! is_array($parameters))
		{
			static::error('You must call Route with parameters that can be array only.');
		}
		return call_user_func_array(static::$route_list[$route_name], $parameters);
	}


	public static function run($route_name, $parameters = array())
	{
		if(empty(static::$route_list[$route_name]) || ! is_callable(static::$route_list[$route_name]))
		{
			static::error('Route "'.$route_name.'" didn\'t exist!');
		}
		return array($route_name, $parameters);
	}

	public static function init($route_name, $parameters = array())
	{
		if(static::$init === FALSE)
		{
			static::$init = TRUE;
			while(true)
			{
				list($route_name, $parameters) = static::call($route_name, $parameters);
			}
		}
	}

	private static function error($string)
	{
		Typing::typewriter(Draw::box("Route Error: ".$string), 0.05);
		exit;
	}

}

?>