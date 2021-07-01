<?php

namespace Tests\Feature\GitHubToken;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use App\Http\Controllers\GetGitHubWatcher;

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
            'git_hub_token' => Crypt::encrypt('xxxxadvweukdeuwweuwvegfewedosp32423jshhd')
        ]);

        GitHub::shouldReceive('me','starring','all')
            ->andReturn([
                ['name' => 'laravel']
            ]);

        $response = $this->actingAs($user)
            ->get('/getripowatcher');
    }
}
