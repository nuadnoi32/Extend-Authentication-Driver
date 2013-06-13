<?php namespace Nuad\Auther;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\UserInterface;

class AutherUserProvider extends EloquentUserProvider {
    
	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Auth\UserInterface  $user
	 * @param  array  $credentials
	 * @return bool
	 */
        
	public function validateCredentials(UserInterface $user, array $credentials)
	{
		$plain = $credentials['member_password'];
		return $this->hasher->check($plain, $user->getAuthPassword());
	}
}