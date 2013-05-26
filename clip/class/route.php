<?php

/**
 * Route system for CLI programming
 *
 * @author Nimit Suwannagate <ethaizone@hotmail.com>
 * @package CLIP
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @version 1.1.0
 */
class Route
{

	protected static $route_list = array();
	protected static $init = FALSE;
	protected static $breadcrumb = array();
	protected static $processed_route = array();
	protected static $hook = array();

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
	 * @param  array  $parameters parameter for pass to function in route
	 * @param  boolean $subRoute   Assign TRUE when you run sub route
	 * @return array             Route name and parameter for next call
	 */
	public static function run($routeName, $parameters = array(), $subRoute = FALSE)
	{
		if(empty(static::$route_list[$routeName]) || ! is_callable(static::$route_list[$routeName]['callback']))
		{
			static::error('Route "'.$routeName.'" didn\'t exist!');
		}

		//Return route name and parameters for next call
		return array($routeName, (array) $parameters, (boolean) $subRoute);
	}

	/**
	 * Init route system to run first route and loop another route. (Until you call die or exit)
	 * @param  string $routeName  Route name
	 * @param  array  $parameters parameter for pass to function in route
	 * @return null
	 */
	public static function init($routeName, $parameters = array())
	{
		//Protect to run more than 1 loop.
		if(static::$init === FALSE)
		{
			static::$init = $routeName;

			while(true)
			{
				//Add route to processed list
				if($routeName != static::$init)
					static::$processed_route[] = $routeName;
				else
					static::$processed_route = array($routeName);

				//Call function in route name
				$nextCall = static::call($routeName, $parameters);
				if(!is_array($nextCall) || count($nextCall) !== 3)
					static::error('Can\'t find route name for next call!');

				//Add new route and parameter for next call.
				$routeName = $nextCall[0];
				$parameters = $nextCall[1];
				$subRoute = $nextCall[2];

				if($subRoute !== TRUE)
					array_pop(static::$processed_route);

			}
		}
	}

	/**
	 * Return breadcrumb text
	 * @param  string $glue Text as glue for breadcrumb
	 * @return string       Breadcrumb text
	 */
	public static function breadcrumb($glue = ' > ')
	{
		$text = '';
		foreach (static::$processed_route as $key => $routeName) {
			if(!empty($text))
				$text .= $glue;
			$text .= static::$route_list[$routeName]['label'];
		}
		return $text;
	}

	/**
	 * Pause - Wait any keyboard to continue
	 */
	public static function pause()
	{
		echo "Press any key to continue..";
		exec('pause');
	}

	/**
	 * Add callback to hook and run on every route.
	 * @param  string $method   When or where to run this hook.
	 * @param  mixed $callback Callback function
	 */
	public static function hook($method, $callback)
	{
		/*
		$allow_method = array('before', 'after', 'beforeExceptSub', 'afterExceptSub', 'beforeSubOnly', 'afterSubOnly');
		if(in_array($method, $allow_method))
			static::$hook[$method] = $callback;
			*/
	}

	/**
	 * Call function in Route
	 * @param  string $routeName Route name
	 * @param  array $parameters parameter for pass to function in route
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