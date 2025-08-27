<?php

namespace Nanorocks\DatabaseNewsletter\Drivers;

use Nanorocks\Newsletter\Drivers\Driver;
use Illuminate\Support\Facades\DB;

class DatabaseDriver implements Driver
{
    public function subscribe(string $email, array $attributes = []): bool
    {
        return DB::table('newsletter_subscribers')->updateOrInsert(
            ['email' => $email],
            [
                'attributes' => json_encode($attributes),
                'subscribed' => true,
                'updated_at' => now(),
            ]
        );
    }

    public function unsubscribe(string $email): bool
    {
        return DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->update(['subscribed' => false, 'updated_at' => now()]);
    }

    public function isSubscribed(string $email): bool
    {
        return DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->where('subscribed', true)
            ->exists();
    }

    public function getMember(string $email): ?array
    {
        $row = DB::table('newsletter_subscribers')->where('email', $email)->first();

        if (! $row) {
            return null;
        }

        return [
            'email' => $row->email,
            'attributes' => json_decode($row->attributes, true),
            'subscribed' => (bool) $row->subscribed,
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
        ];
    }

    public function subscribeOrUpdate(string $email, array $attributes = []): bool
    {
        return $this->subscribe($email, $attributes);
    }
}
