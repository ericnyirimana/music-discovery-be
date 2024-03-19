<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class GoogleLoginTest extends TestCase
{
    
    /**
     * Test Google redirect to Auth.
     */
    public function test_google_redirection_to_auth(): void
    {
        $response = $this->getJson('/api/v1/google/redirect');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('url')
        );
    }
}
