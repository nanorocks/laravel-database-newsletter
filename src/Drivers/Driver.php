<?php

namespace Nanorocks\DatabaseNewsletter\Drivers;

interface Driver
{
    /**
     * Subscribe a user or update existing attributes.
     *
     * @param string $email
     * @param array $attributes
     * @return bool
     */
    public function subscribe(string $email, array $attributes = []): bool;

    /**
     * Alias for subscribe (keeps API compatibility).
     *
     * @param string $email
     * @param array $attributes
     * @return bool
     */
    public function subscribeOrUpdate(string $email, array $attributes = []): bool;

    /**
     * Unsubscribe a user.
     *
     * @param string $email
     * @return bool
     */
    public function unsubscribe(string $email): bool;

    /**
     * Delete a subscriber.
     *
     * @param string $email
     * @return bool
     */
    public function delete(string $email): bool;

    /**
     * Get subscriber details.
     *
     * @param string $email
     * @return array|null
     */
    public function getMember(string $email): ?array;

    /**
     * Check if a user is subscribed.
     *
     * @param string $email
     * @return bool
     */
    public function isSubscribed(string $email): bool;

    /**
     * Get all members.
     *
     * @return array
     */
    public function getAllMembers(): array;
}
