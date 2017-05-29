<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 11:11
 */

namespace UserLogin\Validation;


use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;

class Validator
{
	protected $errors;

	public function validate(Request $request, array $rules)
	{
		foreach ($rules as $field => $rule) {
			try {
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch (NestedValidationException $exception) {
				$this->errors[$field] = $exception->getMessages();
			}
		}

		$_SESSION['validation_errors'] = $this->errors;

		return $this;
	}

	public function failed(){
		return !empty($this->errors);
	}

}
