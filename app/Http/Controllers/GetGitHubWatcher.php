<?php

namespace App\Http\Controllers;

use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;

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
            'github.connections.main.token' => auth()->user()->git_hub_token
        ]);
        try {
            $watchers = GitHub::me()->starring()->all();
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return response()->json($e->getMessage(), 500);
        } catch (\Exception $e) {
            if ($e->getCode() == 401) {
                $user = auth()->user();
                $user->git_hub_token = null;
                $user->save();
            }
            return response()->json($e->getMessage(), 500);
        }
        return $watchers;
    }
}
