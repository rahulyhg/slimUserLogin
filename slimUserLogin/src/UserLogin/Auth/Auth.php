<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 21:15
 */

namespace UserLogin\Auth;


use UserLogin\Models\User;

class Auth
{
	protected $user;

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


	public function isAuthenticated()
	{
		return isset($_SESSION['user.id']);
	}

	public function getUser()
	{
		if ($this->isAuthenticated() && (empty($this->user) || !($this->user instanceof User))) {
			$this->setUser(User::find($_SESSION['user.id']));
		}

		return $this->user;
	}

	public function setUser(User $user)
	{
		$this->user = $user;
	}

	public function terminate(){
		unset($_SESSION['user.id']);
		unset($this->user);
	}


}
