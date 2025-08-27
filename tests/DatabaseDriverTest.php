<?php

namespace Nanorocks\DatabaseNewsletter\Tests;

use Nanorocks\DatabaseNewsletter\Drivers\DatabaseDriver;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\Test;

class DatabaseDriverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('newsletter_subscribers');

        Schema::create('newsletter_subscribers', function ($table) {
            $table->id();
            $table->string('email')->unique();
            $table->json('attributes')->nullable();
            $table->boolean('subscribed')->default(true);
            $table->timestamps();
        });
    }

    #[Test]
    public function it_can_subscribe_and_retrieve_member(): void
    {
        $driver = new DatabaseDriver();

        $driver->subscribe('test@example.com', ['name' => 'Nano']);
        $member = $driver->getMember('test@example.com');

        $this->assertTrue($driver->isSubscribed('test@example.com'));
        $this->assertEquals('test@example.com', $member['email']);
        $this->assertEquals(['name' => 'Nano'], $member['attributes']);
    }

    #[Test]
    public function it_can_update_subscriber_with_subscribe_or_update(): void
    {
        $driver = new DatabaseDriver();

        $driver->subscribe('update@example.com', ['name' => 'Old Name']);
        $driver->subscribeOrUpdate('update@example.com', ['name' => 'New Name']);

        $member = $driver->getMember('update@example.com');

        $this->assertEquals(['name' => 'New Name'], $member['attributes']);
    }

    #[Test]
    public function it_can_unsubscribe_a_user(): void
    {
        $driver = new DatabaseDriver();

        $driver->subscribe('unsub@example.com');
        $this->assertTrue($driver->isSubscribed('unsub@example.com'));

        $driver->unsubscribe('unsub@example.com');
        $this->assertFalse($driver->isSubscribed('unsub@example.com'));
    }

    #[Test]
    public function it_can_delete_a_user(): void
    {
        $driver = new DatabaseDriver();

        $driver->subscribe('delete@example.com');
        $this->assertNotNull($driver->getMember('delete@example.com'));

        $driver->delete('delete@example.com');
        $this->assertNull($driver->getMember('delete@example.com'));
    }

    #[Test]
    public function it_can_get_all_members(): void
    {
        $driver = new DatabaseDriver();

        $driver->subscribe('a@example.com', ['name' => 'A']);
        $driver->subscribe('b@example.com', ['name' => 'B']);

        $all = $driver->getAllMembers();

        $this->assertCount(2, $all);
        $emails = array_column($all, 'email');
        $this->assertContains('a@example.com', $emails);
        $this->assertContains('b@example.com', $emails);
    }
}
