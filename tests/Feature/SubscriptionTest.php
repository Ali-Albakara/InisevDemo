<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * @test
     */
    public function can_subscribe_to_website()
    {
        $this->actingAs(User::find(1));
        $response = $this->post(route('website.subscribe', 6, []));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannot_subscribe_to_a_website_that_does_not_exist()
    {
        $this->actingAs(User::find(1));
        $response = $this->post(route('website.subscribe', 100, []));
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function cannot_subscribe_to_a_website_when_already_subscribed()
    {
        $this->actingAs(User::find(1));
        $response = $this->post(route('website.subscribe', 1, []));
        $response->assertStatus(400);
    }
}
