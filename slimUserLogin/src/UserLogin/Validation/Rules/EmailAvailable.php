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

class EmailAvailable extends AbstractRule
{

	public function validate($input)
	{
		return User::where('email', $input)->count() === 0;
	}
}
