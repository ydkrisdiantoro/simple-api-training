<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_see_about_us_page()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    public function test_user_can_see_contact_page()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
}
