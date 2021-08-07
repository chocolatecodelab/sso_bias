<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = [];
        // DB or query builder for interact with database 
        if(DB::table('oauth_clients')->where('revoked', 1)->delete()) {
            // DB Oauth_access_tokens update to 1 if oauth_client that value 1
            DB::table('oauth_access_tokens')->where('revoked', 0)
            ->update(['revoked' => 1]);
            // DB Oauth_tokens
            if(auth()->user()->token != null) {
            DB::table('oauth_tokens')->where('user_id', auth()->user()->token->user_id)->delete();
            // DB Oauth_auth_codes
            DB::table('oauth_auth_codes')->where('revoked', 1)->delete();
            }
            return view('welcome');
        };
            // DB if delete oauth_access_token, we're going to delete token login user
            if(DB::table('oauth_access_tokens')->where('revoked', 1)->delete()) {
                if(auth()->user()->token != null) {
                    DB::table('oauth_tokens')->where('user_id', auth()->user()->token->user_id)->delete();
                   return view('welcome');
                   }
                   return view('welcome');       
               };

        if (auth()->user()->token) {

            if (auth()->user()->token->hasExpired()) {
                return redirect('/oauth/refresh');
            }

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->token->access_token
            ])->get(config('services.oauth_server.uri') . '/api/posts');

            if ($response->status() === 200) {
                $posts = $response->json();
            }
        }

        return view('home', [
            'posts' => $posts,
        ]);
    }
}