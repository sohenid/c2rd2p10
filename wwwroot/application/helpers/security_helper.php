<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Security Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/security_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Prep data for form
 *
 * This function allows HTML to be safely shown in a form.
 * Special characters are converted.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('prep_for_form'))
{
	function prep_for_form($data = '')
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				$data[$key] = prep_for_form($val);
			}
			return $data;
		}
		else{
			/* se é uma data */
			if (preg_match('/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]$/', $data))
			{
				$arrayData = explode('/', $data);
				return $arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0];
			}
			else{
				if ($data === '')
				{
					return $data;
				}
				else{
					return str_replace(array("'", '"', '<', '>', '&nbsp;'), array("&#39;", "&quot;", '&lt;', '&gt;', ' '), stripslashes($data));
			
				}
			}	
		}
	}
}


if ( ! function_exists('value_null'))
{
	function value_null($data)
	{
		if (!isset($data) || $data == '')
		{
			return NULL;
		}
		else
		{
			return $data;
		}
	}
}	

/* End of file security_helper.php */
/* Location: ./aplication/helpers/security_helper.php */