<?php

namespace App\Http\Controllers;

use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;
use Exception;

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
        try {
            $watchers = GitHub::me()->starring()->all();
        } catch (Exception $e) {
            $user = User::find(auth()->user()->id);
            $user->git_hub_token = null;
            $user->save();
            return response()->json($e->getMessage(), 500);
        }
        return $watchers;
    }
}
