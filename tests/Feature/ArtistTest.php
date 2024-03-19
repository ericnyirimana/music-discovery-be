<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test GET ALL favorites ARTIST.
     */
    public function test_unauthenticated_user_trying_to_access_artist_api(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/v1/artists');
        
        $response->assertJson([
            "message" => "Unauthenticated."
        ]);
        
        $response->assertStatus(401);
    }
    /**
     * Test STORE favorite ARTIST.
     */
    public function test_store_favorite_artist(): void
    {
        $user = User::factory()->create();
        $authUser = $this->actingAs($user, 'sanctum');
        $response = $authUser->postJson('/api/v1/artists', [
            'mbid' => fake()->uuid(),
        ]);

        $this->assertJson($response->getContent());
    
        $response->assertStatus(201);
    }
    /**
     * Test GET ALL favorites ARTIST.
     */
    public function test_get_all_favorite_artist(): void
    {
        $user = User::factory()->create();
        $authUser = $this->actingAs($user, 'sanctum');
        $authUser->postJson('/api/v1/artists', [
            'mbid' => fake()->uuid(),
        ]);
        $authUser->postJson('/api/v1/artist', [
            'mbid' => fake()->uuid(),
        ]);
        $response = $authUser->actingAs($user, 'sanctum')
                         ->get('/api/v1/artists');

        $this->assertJson($response->getContent());
    
        $response->assertOk();
    }
    /**
     * Test GET ALL favorites ARTIST.
     */
    public function test_get_single_favorite_artist(): void
    {
        
        $user = User::factory()->create();
        $authUser = $this->actingAs($user, 'sanctum');
        $newFavorite = $authUser->postJson('/api/v1/artists', [
            'mbid' => fake()->uuid(),
        ]);
        $newArtistId = json_decode($newFavorite->getContent(), true);
        $response = $authUser->actingAs($user, 'sanctum')
                         ->get('/api/v1/artists/' . $newArtistId['id']);
        $this->assertJson($response->getContent());
    
        $response->assertOk(); // Or assertOk
    }
    /**
     * Test UPDATE favorites ARTIST.
     */
    public function test_update_favorite_artist(): void
    {
        
        $user = User::factory()->create();
        $authUser = $this->actingAs($user, 'sanctum');
        $newFavorite = $authUser->postJson('/api/v1/artists', [
            'mbid' => fake()->uuid(),
        ]);
        $newArtistId = json_decode($newFavorite->getContent(), true);
        $response = $authUser->actingAs($user, 'sanctum')
            ->put('/api/v1/artists/' . $newArtistId['id'], [
            'mbid' => fake()->uuid(),
        ]);
        $this->assertJson($response->getContent());
    
        $response->assertOk(200);
    }
    /**
     * Test UPDATE favorites ARTIST.
     */
    public function test_remove_favorite_artist(): void
    {
        
        $user = User::factory()->create();
        $authUser = $this->actingAs($user, 'sanctum');
        $newFavorite = $authUser->postJson('/api/v1/artists', [
            'mbid' => fake()->uuid(),
        ]);
        $newArtistId = json_decode($newFavorite->getContent(), true);
        $response = $authUser->actingAs($user, 'sanctum')
            ->delete('/api/v1/artists/' . $newArtistId['id'], [
            'mbid' => fake()->uuid(),
        ]);
        $this->assertJson($response->getContent());
    
        $response->assertOk(200);
    }
}
