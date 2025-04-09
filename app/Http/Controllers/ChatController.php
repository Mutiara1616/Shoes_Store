<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;

class ChatController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $sessionId = $request->session()->get('chat_session_id');
        $result = $this->geminiService->sendMessage($request->message, $sessionId);
        
        // Store session ID for future requests
        if ($result['success'] && isset($result['sessionId'])) {
            $request->session()->put('chat_session_id', $result['sessionId']);
        }
        
        return response()->json([
            'response' => $result['response'],
            'success' => $result['success']
        ]);
    }
}