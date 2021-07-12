<?php

namespace Tests\Feature\GitHubToken;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use App\Http\Controllers\GetGitHubWatcher;
use Exception;

class GetGitHubWatcherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetGitHubWatcher()
    {
        $user = factory(\App\User::class)->create([
            'git_hub_token' => 'xxxxadvweukdeuwweuwvegfewedosp32423jshhd'
        ]);

        GitHub::shouldReceive('me->starring->all')
            ->once()
            ->andReturn([
                ['name' => 'laravel']
            ]);

        $response = $this->actingAs($user)
            ->get('/getstaredripo');
        $this->assertEquals($response->original[0]['name'],'laravel');
    }

    public function testGetGitHubWatcherBadToken()
    {
        $user = factory(\App\User::class)->create([
            'git_hub_token' => 'xxxxadvweukdeuwweuwvegfewedosp32423jshhd'
        ]);

        GitHub::shouldReceive('me->starring->all')
            ->once()
            ->andThrow(new Exception());

        $response = $this->actingAs($user)
            ->get('/getstaredripo');
        $this->assertEquals(500,$response->getStatusCode());
    }
}
