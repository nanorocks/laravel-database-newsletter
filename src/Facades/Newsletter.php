<?php

namespace Nanorocks\DatabaseNewsletter\Facades;

use Nanorocks\DatabaseNewsletter\Drivers\DatabaseDriver;
use Illuminate\Support\Facades\Facade;

/**
 * Newsletter Facade
 *
 * @method static array|bool subscribe(string $email, array $properties = [], string $listName = '', array $options = [])
 * @method static array|bool subscribeOrUpdate(string $email, array $properties = [], string $listName = '', array $options = [])
 * @method static array|bool getMember(string $email, string $listName = '')
 * @method static bool hasMember(string $email, string $listName = '')
 * @method static bool isSubscribed(string $email, string $listName = '')
 * @method static array|bool unsubscribe(string $email, string $listName = '')
 * @method static array|bool delete(string $email, string $listName = '')
 * @method static DatabaseDriver getInstance()
 */
class Newsletter extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'newsletter';
    }
}