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

/**
 * Class Validator
 * @package UserLogin\Validation
 */
class Validator
{
	/**
	 * @var array
	 */
	protected $errors;

	/**
	 * Validates Form Fields
	 * @param Request $request
	 * @param array   $rules
	 * @return $this
	 */
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

	/**
	 * Returns true if validation failed
	 * @return bool
	 */
	public function failed()
	{
		return !empty($this->errors);
	}

}
