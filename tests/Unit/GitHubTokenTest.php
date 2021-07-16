<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use DB;

class GitHubTokenTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIfGitHubTokenIsEncryptedOnSaving()
    {
        factory(\App\User::class)->create([
            'git_hub_token' => 'gcp_waHOh7fA2HXa44tDeMtSlD2atzAxaE071TVB'
        ]);
        $gitHubToken = DB::table('users')->first()->git_hub_token;
        $this->assertNotEquals('gcp_waHOh7fA2HXa44tDeMtSlD2atzAxaE071TVB',$gitHubToken);
    }
}
