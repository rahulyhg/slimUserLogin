<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 20:47
 */

namespace UserLogin\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class EmailAvailableException
 * @package UserLogin\Validation\Exceptions
 */
class EmailAvailableException extends ValidationException
{
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Email address is already registered'

		]
	];
}
