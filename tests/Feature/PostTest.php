<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * @test
     */
    public function can_create_post_for_website()
    {
        $response = $this->post(route('posts.create', 1), [
            'title' => 'Test Post',
            'description' => 'This is a test post'
        ]);

        $response->assertStatus(200);
    }

        /**
     * @test
     */
    public function cannot_create_post_for_non_existing_website()
    {
        $response = $this->post(route('posts.create', 100), [
            'title' => 'Test Post',
            'description' => 'This is a test post'
        ]);

        $response->assertStatus(404);
    }
}
