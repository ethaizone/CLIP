<?php


class Route
{

	protected static $route_list = array();
	protected static $init = FALSE;
	protected static $breadcrumb = array();
	protected static $processed_route = array();

	/**
	 * Add function to Route for call later
	 * @param string $routeName Route name
	 * @param mixed $callback   Callback function
	 */
	public static function add($routeName, $callback, $label = "")
	{
		$label = empty($label) ? $routeName : $label;
		static::$route_list[$routeName] = array('callback' => $callback, 'label' => ucfirst($label));
	}



	/**
	 * Run other route. Must use in another route and return result of this method.
	 * @param  string $routeName Route name
	 * @param  array  $parameters parameter for pass to function
	 * @return array             Route name and parameter for next call
	 */
	public static function run($routeName, $parameters = array())
	{
		if(empty(static::$route_list[$routeName]) || ! is_callable(static::$route_list[$routeName]['callback']))
		{
			static::error('Route "'.$routeName.'" didn\'t exist!');
		}
		//Return route name and parameters for next call
		return array($routeName, $parameters);
	}

	public static function init($routeName, $parameters = array())
	{
		//Protect to run more than 1 loop.
		if(static::$init === FALSE)
		{
			static::$init = $routeName;

			//add init route to processed list
			static::$processed_route[] = $routeName;

			while(true)
			{
				//Add route to processed list
				if($routeName != static::$init)
					static::$processed_route[] = $routeName;

				//Call function in route name
				$nextCall = static::call($routeName, $parameters);
				if(!is_array($nextCall) || count($nextCall) != 2)
					static::error('Can\'t find route name for next call!');

				//array_pop(static::$processed_route);

				//if(end(static::$processed_route))


				//Add new route and parameter for next call.
				$routeName = $nextCall[0];
				$parameters = $nextCall[1];
			}
		}
	}

	/**
	 * Call function in Route
	 * @param  string $routeName Route name
	 * @param  array $parameters parameter for pass to function
	 * @return array             Route name and parameter for next call
	 */
	private static function call($routeName, $parameters)
	{
		if(! is_array($parameters))
		{
			static::error('You must call Route with parameters that can be array only.');
		}
		return call_user_func_array(static::$route_list[$routeName]['callback'], $parameters);
	}


	/**
	 * Show error and exit
	 * @param  string $string Description
	 * @return null
	 */
	private static function error($string)
	{
		echo Draw::box("Route error: ".$string);
		exit;
	}

}

?>