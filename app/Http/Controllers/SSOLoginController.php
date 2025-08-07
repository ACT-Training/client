<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SSOLoginController extends Controller
{
    /**
     * @throws ConnectionException
     */
    public function handle(Request $request)
    {
        $token = $request->query('token');
        abort_if(! $token, 403);

        $response = Http::withToken($token)
            ->get(config('services.passport.user_endpoint'));

        abort_if(! $response->successful(), 403);

        $userData = $response->json();

        $user = User::updateOrCreate(
            ['email' => $userData['email']],
            [
                'id' => $userData['id'],
                'name' => $userData['name'],
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
