<?php

namespace App\Http\Controllers;

use App\Mail\MagicLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MagicLinkController extends Controller
{
    public static int $EXPIRES_IN_MINUTES = 30;

    public function create() {
        return view('login');
    }

    public function store() {
        request()->validate(['email' => 'required|email']);

        // Find the user by their email
        $email = request()->email;
        $user = User::where('email', $email)->first();

        // Generate a temporary signed URL for the user to login.
        $url = url()->temporarySignedRoute(
            'login.token',
            now()->addMinutes(self::$EXPIRES_IN_MINUTES),
            ['email' => $email]
        );

        // Notify the user via email
        Mail::to($email)->send(new MagicLink($url, self::$EXPIRES_IN_MINUTES, $user));

        return back()->with('status', 'Un lien de connexion vous a été envoyé par mail.');
    }

    public function loginViaToken()
    {
        $user = User::createOrFirst(['email' => request()->email], ['name' => '', 'password' => '']);

        Auth::login($user, true);

        Log::info('User logged in via token.', ['email' => $user->email]);

        request()->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }
}
