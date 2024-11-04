<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_post()
    {
        $data = [
            'title' => 'First Post Test',
            'content' => 'I love to do this',
            'user_id' => 1
        ];
    
        $this->post(route('post.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
