<?php
/**
  * Haulage Management System - Validator.php
  *
  * Form validator base class - validates forms using a given set of rules.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator{

	protected $errors;

	/**
    * Validate the form input using the provided set of rules
    * @param request - The request object
    * @param rules - A list of rules to enforce when validating
  */
	public function validate($request, array $rules){

		foreach($rules as $field => $rule){
			try{
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			}catch(NestedValidationException $e){
				$this->errors[$field] = $e->getMessages();
			}
		}

		$_SESSION['errors'] = $this->errors;
		return $this;
	}

	/**
    * Check if validation has failed
    * @return boolean - If there are errors or not (failed)
  */
	public function failed(){
		return !empty($this->errors);
	}
}
?>
