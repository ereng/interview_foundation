<?php

namespace App\Http\Controllers;

use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class GetGitHubWatcher extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        config([
            'github.connections.main.token' => substr(Crypt::decryptString(auth()->user()->git_hub_token), -42, 40)
        ]);
        $watchers = GitHub::me()->starring()->all();
        return $watchers;
    }
}
