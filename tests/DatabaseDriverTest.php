<?php

namespace Nanorocks\DatabaseNewsletter\Tests;

use Nanorocks\DatabaseNewsletter\Drivers\DatabaseDriver;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Schema;

class DatabaseDriverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('newsletter_subscribers');

        include __DIR__ . '/../database/migrations/2025_08_27_000000_create_newsletter_subscribers_table.php';
        (new class extends \Illuminate\Database\Migrations\Migration {
            public function up(): void {
                Schema::create('newsletter_subscribers', function ($table) {
                    $table->id();
                    $table->string('email')->unique();
                    $table->json('attributes')->nullable();
                    $table->boolean('subscribed')->default(true);
                    $table->timestamps();
                });
            }
            public function down(): void {}
        })->up();
    }

    /** @test */
    public function it_can_subscribe_and_retrieve_member()
    {
        $driver = new DatabaseDriver();

        $driver->subscribe('test@example.com', ['name' => 'Nano']);
        $member = $driver->getMember('test@example.com');

        $this->assertTrue($driver->isSubscribed('test@example.com'));
        $this->assertEquals('test@example.com', $member['email']);
    }
}
