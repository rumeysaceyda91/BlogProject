<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class BlogTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_post()
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'First Post Test',
            'content' => 'I love to do this',
            'user_id' => $user->id
        ];
    
        $response = $this->actingAs($user)
            ->post('/post-store', $data);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');     
    }
}
