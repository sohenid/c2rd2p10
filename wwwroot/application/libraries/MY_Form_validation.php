<?php
class MY_Form_validation extends CI_Form_validation
{
     function __construct($config = array())
     {
          parent::__construct($config);
     }
 
    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function error_array()
    {
        if (count($this->_error_array) === 0)
        {
                return FALSE;
        }
        else{
        	$var = $this->_error_array;
        	foreach($var as $k => $v){
        		$fe[$k] = $v;	
        	}
        }
        return $fe;
		#return $this->_error_array;
    }
    
	/**
	 * Alpha
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
		#return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
		return ( ! preg_match("/^([A-Za-zá-úÁ=Ú.\s])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric($str)
	{
	#return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
	return ( ! preg_match("/^([A-Za-zá-úÁ=Ú0-9.\s_-])+$/i", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	// http://www.michaelwales.com/2010/02/basic-pattern-matching-form-validation-in-codeigniter/
	// matches_pattern()
	// Ensures a string matches a basic pattern
	// # numeric, ? alphabetical, ~ any character
	public function matches_pattern($str, $pattern) {
		$characters = array(
				'#', '?', '~', '/'
		);
	
		$regex_characters = array(
				'[0-9]', '[a-zA-Z]', '.', '\/'
		);
	
		$pattern = str_replace($characters, $regex_characters, $pattern);
		if (preg_match('/^' . $pattern . '$/', $str)) return TRUE;
		return FALSE;
	}
	
	public function valid_date($str, $format = FALSE) {
		/*
		if (preg_match("/^(0[1-9]|[12][0-9]|3[01])[-\/.](0[1-9]|1[012])[-\/.](19|20)[0-9]{2}$/", $str)) {
			$arr = explode("/", $str);
			$yyyy = $arr[0];
			$mm = $arr[1];
			$dd = $arr[2];
			if (is_numeric($yyyy) && is_numeric($mm) && is_numeric($dd)) {
				return checkdate($mm, $dd, $yyyy);
			} else {
				return false;
			}
		} else {
			return false;
		}*/
		$pattern = '/^(?<day>0?[1-9]|[12][0-9]|3[01])[- \/.](?<month>0?[1-9]|1[012])[- \/.](?<year>(19|20)[0-9]{2})$/';
		if( preg_match($pattern, $str, $match) && checkdate($match['month'], $match['day'], $match['year']) )
		{                    // pattern and date are valid
		if ( $format )
		{                // prep date
		return date($format, mktime(0, 0, 0, $match['month'], $match['day'], $match['year']));
		}
		return TRUE;    // don't prep date
		}
		return FALSE;
		
		
	}	
	
	/**
	 * Verifica se o CNPJ é valido
	 * @param     string
	 * @return     bool
	 */
	function valid_cnpj($str)
	{
		if (strlen($str) <> 18) return FALSE;
		$soma1 = ($str[0] * 5) +
		($str[1] * 4) +
		($str[3] * 3) +
		($str[4] * 2) +
		($str[5] * 9) +
		($str[7] * 8) +
		($str[8] * 7) +
		($str[9] * 6) +
		($str[11] * 5) +
		($str[12] * 4) +
		($str[13] * 3) +
		($str[14] * 2);
		$resto = $soma1 % 11;
		$digito1 = $resto < 2 ? 0 : 11 - $resto;
		$soma2 = ($str[0] * 6) +
		($str[1] * 5) +
		($str[3] * 4) +
		($str[4] * 3) +
		($str[5] * 2) +
		($str[7] * 9) +
		($str[8] * 8) +
		($str[9] * 7) +
		($str[11] * 6) +
		($str[12] * 5) +
		($str[13] * 4) +
		($str[14] * 3) +
		($str[16] * 2);
		$resto = $soma2 % 11;
		$digito2 = $resto < 2 ? 0 : 11 - $resto;
		return (($str[16] == $digito1) && ($str[17] == $digito2));
	}
	
	/**
	 * Verifica se o CPF informado é valido
	 * @param     string
	 * @return     bool
	 */
	function valid_cpf($cpf)
	{
		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
	
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 ||
				$cpf == '00000000000' ||
				$cpf == '11111111111' ||
				$cpf == '22222222222' ||
				$cpf == '33333333333' ||
				$cpf == '44444444444' ||
				$cpf == '55555555555' ||
				$cpf == '66666666666' ||
				$cpf == '77777777777' ||
				$cpf == '88888888888' ||
				$cpf == '99999999999') {
			return FALSE;
		} else {
			// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
	
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return FALSE;
				}
			}
			return TRUE;
		}
	}
}