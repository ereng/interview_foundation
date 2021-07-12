<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PostGitHubToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'git_hub_token' => 'required',
        ]);
        try {
            $user = auth()->user();
            $user->git_hub_token = $request->git_hub_token;
            $user->save();
            return response()->json($user->git_hub_token);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
