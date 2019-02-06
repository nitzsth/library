<?php

namespace App\Helpers;

class Constant {
	/**
	 * Auth related constants
	 */
	const REDIRECT_AUTHENTICATED = '/';

	/**
	 * User roles
	 */
	const ADMIN = 'admin';
	const STUDENT = 'student';

	/**
	 * User status
	 */
	const BLOCKED = 'blocked';
	const VERIFIED = 'verified';

	/**
	 * Directories related constants
	 */
	const DIR_AVATAR = 'avatars';

	public static function getRoles(): array
	{
		return [
			self::ADMIN,
			self::STUDENT,
		];
	}
}