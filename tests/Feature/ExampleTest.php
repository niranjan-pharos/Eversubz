<?php

namespace Tests\Feature;

use App\Models\AdPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');

        AdPost::factory()
            ->count(6)
            ->create(['status' => 1]);
    }

    public function test_homepage_shows_active_ads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(AdPost::first()->title);
    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
