<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 21:15
 */

namespace UserLogin\Auth;


use UserLogin\Models\User;

/**
 * Class Auth
 * @package UserLogin\Auth
 */
class Auth
{
	protected $user;

	/**
	 * Attempt to authenticate user with the provided credentials
	 * @param $email
	 * @param $password
	 * @return bool
	 */
	public function attempt($email, $password)
	{
		$user = User::where('email', $email)->first();

		$success = false;

		if (!empty($user) && password_verify($password, $user->password)) {
			$_SESSION['user.id'] = $user->id;
			$success = true;
		}

		return $success;
	}

	/**
	 * Verify if a User is currently authenticated
	 * @return bool
	 */
	public function isAuthenticated()
	{
		return isset($_SESSION['user.id']);
	}

	/**
	 * Returns the currently authenticated User
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->isAuthenticated() && (empty($this->user) || !($this->user instanceof User))) {
			$this->setUser(User::find($_SESSION['user.id']));
		}

		return $this->user;
	}

	/**
	 * Set User property
	 * @param User $user
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Terminate Authenticated Session
	 */
	public function terminate()
	{
		unset($_SESSION['user.id']);
		unset($this->user);
	}


}
