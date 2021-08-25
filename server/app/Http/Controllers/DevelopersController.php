<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevelopersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // middleware
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        // if admin redirect to route developer
        if(auth()->user()->name === 'admin') {
            $arr['tokens'] = DB::table('oauth_tokens')->orderBy('user_id', 'asc')->get();
            return view('developers.index')->with($arr);
        }

        return redirect()->route('home')->with('wrong-role', 'Anda Bukan Admin');
    }

    public function delete($user_id) 
    {
        
        DB::table('oauth_tokens')->where('user_id', $user_id)->delete();
        DB::table('oauth_access_tokens')->where('user_id', $user_id)->delete();
        DB::table('oauth_auth_codes')->where('user_id', $user_id)->delete();
        return redirect()->route('developers')->with('message', 'Data Berhasil Dihapus');
    }
}