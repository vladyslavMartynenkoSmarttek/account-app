<?php

    namespace App\Http\Controllers;

    use App\Events\NewChat;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Http\Request;
    use Inertia\Inertia;
    use Inertia\Response;

    class ChatController extends Controller
    {
        //

        public function index(Request $request): Response
        {
            return Inertia::render('Chat/Index', [
                'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
                'status' => session('status'),
                'errors' => session('errors') ? session('errors')->getBag('default')->getMessages() : (object)[],
            ]);
        }

        //send
        public function send(Request $request)
        {
            $message = $request->input('message');
            event(new NewChat($message));
        }
    }
