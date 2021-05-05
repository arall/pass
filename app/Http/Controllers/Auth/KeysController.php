<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Key;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    /**
     * Get the user keys.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->key;
    }

    /**
     * Store public and private keys.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'context' => 'required',
            'public' => 'required',
            'private' => 'required',
        ]);

        $user = $request->user();
        $key = $user->key ?: new Key;

        $key->context = $request->input('context');
        $key->public = $request->input('public');
        $key->private = $request->input('private');

        $user->key()->save($key);

        return response()->json([
            'status' => 'Keys stored successfully.'
        ]);
    }
}
