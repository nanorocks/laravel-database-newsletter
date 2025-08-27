<?php

namespace Nanorocks\DatabaseNewsletter\Drivers;

use Illuminate\Support\Facades\DB;

class DatabaseDriver implements Driver
{
    /**
     * Subscribe a user or update existing attributes.
     */
    public function subscribe(string $email, array $attributes = []): bool
    {
        return DB::table('newsletter_subscribers')->updateOrInsert(
            ['email' => $email],
            [
                'attributes' => json_encode($attributes),
                'subscribed' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    /**
     * Unsubscribe a user.
     */
    public function unsubscribe(string $email): bool
    {
        return DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->update([
                'subscribed' => false,
                'updated_at' => now(),
            ]) > 0;
    }

    /**
     * Check if a user is subscribed.
     */
    public function isSubscribed(string $email): bool
    {
        return DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->where('subscribed', true)
            ->exists();
    }

    /**
     * Get subscriber details.
     */
    public function getMember(string $email): ?array
    {
        $row = DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->first();

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

    /**
     * Alias for subscribe (keeps API compatibility).
     */
    public function subscribeOrUpdate(string $email, array $attributes = []): bool
    {
        return $this->subscribe($email, $attributes);
    }

    /**
     * Delete a subscriber.
     */
    public function delete(string $email): bool
    {
        return DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->delete() > 0;
    }
    
    /**
     * Get all members.
     */
    public function getAllMembers(): array
    {
        $rows = DB::table('newsletter_subscribers')->get();

        return $rows->map(function ($row) {
            return [
                'email' => $row->email,
                'attributes' => json_decode($row->attributes, true),
                'subscribed' => (bool) $row->subscribed,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            ];
        })->toArray();
    }
}
