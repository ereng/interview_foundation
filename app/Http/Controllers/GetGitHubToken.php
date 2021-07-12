<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GetGitHubToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->git_hub_token) {
            return auth()->user()->git_hub_token;
        } else {
            return 'no_token';
        }
    }
}
