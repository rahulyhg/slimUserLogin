<?php

/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-27
 * Time: 17:09
 */

namespace UserLogin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package UserLogin\Models
 */
class User extends Model
{
	protected $fillable =['name', 'email', 'password'];

}
