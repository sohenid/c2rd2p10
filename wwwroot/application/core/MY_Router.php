<?php
class MY_Router extends CI_Router { 
    function set_class($class) 
    {
        $this->class = str_replace('-', '_', $class);
    }

    function set_method($method) 
    {
        $this->method = str_replace('-', '_', $method);
    }

    function set_directory($dir) {
        $this->directory = $dir.'/';
    }

    function _validate_request($segments)
    {
        if (count($segments) == 0)
        {
            return $segments;
        }
        
        // Does the requested controller exist in the root folder?
        if (file_exists(APPPATH.'controllers/'.str_replace('-', '_', $segments[0]).'.php'))
        {
            return $segments;
        }

        // Is the controller in a sub-folder?
        if (is_dir(APPPATH.'controllers/'.$segments[0]))
        {
            // Set the directory and remove it from the segment array
            $this->set_directory($segments[0]);
            $segments = array_slice($segments, 1);


            while(count($segments) > 0 && is_dir(APPPATH.'controllers/'.$this->directory.$segments[0]))
            {
                // Set the directory and remove it from the segment array
                $this->set_directory($this->directory . $segments[0]);
                $segments = array_slice($segments, 1);
            }

            if (count($segments) > 0)
            {
                // Does the requested controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().str_replace('-', '_', $segments[0]).'.php'))
                {
                    if ( ! empty($this->routes['404_override']))
                    {
                        $x = explode('/', $this->routes['404_override']);

                        $this->set_directory('');
                        $this->set_class($x[0]);
                        $this->set_method(isset($x[1]) ? $x[1] : 'index');

                        return $x;
                    }
                    else
                    {
                        show_404($this->fetch_directory().$segments[0]);
                    }
                }
            }
            else
            {
                // Is the method being specified in the route?
                if (strpos($this->default_controller, '/') !== FALSE)
                {
                    $x = explode('/', $this->default_controller);

                    $this->set_class($x[0]);
                    $this->set_method($x[1]);
                }
                else
                {
                    $this->set_class($this->default_controller);
                    $this->set_method('index');
                }

                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.'.php'))
                {
                    $this->directory = '';
                    return array();
                }

            }

            return $segments;
        }


        // If we've gotten this far it means that the URI does not correlate to a valid
        // controller class.  We will now see if there is an override
        if ( ! empty($this->routes['404_override']))
        {
            $x = explode('/', $this->routes['404_override']);

            $this->set_class($x[0]);
            $this->set_method(isset($x[1]) ? $x[1] : 'index');

            return $x;
        }


        // Nothing else to do at this point but show a 404
        show_404($segments[0]);
    }
    
    /**
     *  Parse Routes
     *
     * This function matches any routes that may exist in
     * the config/routes.php file against the URI to
     * determine if the class/method need to be remapped.
     *
     * @access	private
     * @return	void
     */
    function _parse_routes()
    {
    	// Turn the segment array into a URI string
    	$uri = implode('/', $this->uri->segments);
    
    	log_message('debug', 'Client sent : ' . $uri);
    
    	// Is there a literal match?  If so we're done
    	if (isset($this->routes[$uri]))
    	{
    		log_message('debug', 'Route found : ' . $uri . '  --> ' . $this->routes[$uri]);
    		log_message('debug', 'Redirecting to : ' . $uri . '  --> ' . $uri);
    		return $this->_set_request(explode('/', $this->routes[$uri]));
    	}
    
    	// Loop through the route array looking for wild-cards
    	foreach ($this->routes as $key => $val)
    	{
    		$original_key = $key;
    		$original_val = $val;
    
    		// Convert wild-cards to RegEx
    		$key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));
    
    		// Does the RegEx match?
    		if (preg_match('#^'.$key.'$#', $uri))
    		{
    			// Do we have a back-reference?
    			if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE)
    			{
    				$val = preg_replace('#^'.$key.'$#', $val, $uri);
    			}
    
    			log_message('debug', 'Route found : ' . $original_key . '  --> ' . $original_val);
    			log_message('debug', 'Redirecting to : ' . $uri . '  --> ' . $val);
    			return $this->_set_request(explode('/', $val));
    		}
    	}
    
    	// If we got this far it means we didn't encounter a
    	// matching route so we'll set the site default route
    	$this->_set_request($this->uri->segments);
    }    
}