<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 20:40
 */

namespace UserLogin\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;
use UserLogin\Models\User;

/**
 * Class EmailAvailable
 * @package UserLogin\Validation\Rules
 */
class EmailAvailable extends AbstractRule
{
	/**
	 * Validates that the email address provided does not already exist in the database.
	 * @param $input
	 * @return bool
	 */
	public function validate($input)
	{
		return User::where('email', $input)->count() === 0;
	}
}
