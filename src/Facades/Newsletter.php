<?php

namespace Nanorocks\DatabaseNewsletter\Facades;

use Illuminate\Support\Facades\Facade;
use Nanorocks\DatabaseNewsletter\Drivers\DatabaseDriver;

/**
 * Newsletter Facade
 *
 * @method static bool subscribe(string $email, array $attributes = [])
 * @method static bool subscribeOrUpdate(string $email, array $attributes = [])
 * @method static array|null getMember(string $email)
 * @method static bool isSubscribed(string $email)
 * @method static bool unsubscribe(string $email)
 * @method static bool delete(string $email)
 */
class Newsletter extends Facade
{
    /**
     * Get the registered name of the component in the container.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'newsletter';
    }
}
