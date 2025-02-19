<?php

namespace Tests\Feature\GitHubToken;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostGitHubTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testPostGitHubToken()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)
            ->post('/githubtoken',['git_hub_token' => 'PMpFQ)dsfG%;eyq[EQL}Kwv.GhM3wR!']);
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testPostEmptyGitHubToken()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/githubtoken',['git_hub_token' => '']);
        $this->assertEquals(422,$response->getStatusCode());
    }
}
