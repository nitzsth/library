<?php

namespace App\Helpers;

class Constant
{
    /**
     * Auth related constants
     */
    const REDIRECT_AUTHENTICATED = '/';

    /**
     * User roles
     */
    const ADMIN   = 'admin';
    const STUDENT = 'student';

    /**
     * User status
     */
    const BLOCKED  = 'blocked';
    const VERIFIED = 'verified';

    /**
     * Directories related constants
     */
    const DIR_AVATAR = 'avatars';

    /**
     * Borrowing related constants
     */
    const BOOK_BORROW_DAYS      = 30;
    const MAX_BOOK_BORROW_LIMIT = 5;

    /**
     * Get an array of all available roles
     *
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ADMIN,
            self::STUDENT,
        ];
    }
}
