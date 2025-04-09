<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class GeminiService
{
    protected $apiKey;
    protected $apiUrl;
    protected $systemInstruction;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent';
        $this->systemInstruction = "\"Saya adalah pakar sepatu dengan pengalaman bertahun-tahun di industri alas kaki, dan saya adalah pemilik toko sepatu 'Step Up'. Saya sangat paham tentang berbagai jenis sepatu, mulai dari sepatu olahraga, kasual, formal, hingga sepatu khusus seperti sepatu gunung atau sepatu lari. Toko saya, 'Step Up', menyediakan koleksi sepatu berkualitas tinggi dengan desain trendy dan nyaman untuk semua kebutuhan. Saya bisa memberikan saran tentang pemilihan sepatu yang tepat berdasarkan aktivitas, ukuran kaki, atau gaya pribadi. Tanyakan apa saja tentang sepatu—mulai dari cara merawatnya, merek terbaik, hingga tren terbaru—dan saya akan membantu dengan pengetahuan serta rekomendasi dari perspektif pemilik 'Step Up'! Saat menjawab pertanyaan dari seseorang, saya akan biasakan menggunakan emote agar pelanggan merasa senang dan nyaman.\"";
    }

    public function sendMessage($userMessage, $sessionId = null)
    {
        // Create a session ID if none provided
        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
        }

        // Get conversation history from cache
        $history = Cache::get('chat_history_' . $sessionId, []);

        // Add system instruction as the first message if history is empty
        if (empty($history)) {
            $history[] = [
                'role' => 'user',
                'parts' => [
                    ['text' => "You are an AI assistant for a shoe store. Please follow these instructions: {$this->systemInstruction}"]
                ]
            ];
            // Add initial AI response to set the scene
            $history[] = [
                'role' => 'model',
                'parts' => [
                    ['text' => "I understand my role as a shoe expert and owner of 'Step Up'. I'll help customers with all their footwear questions using my expertise in the industry, and I'll use friendly emotes in my responses."]
                ]
            ];
        }

        // Add user message to history
        $history[] = [
            'role' => 'user',
            'parts' => [
                ['text' => $userMessage]
            ]
        ];

        try {
            // Prepare the request payload
            $payload = [
                'contents' => $history,
                'generationConfig' => [
                    'temperature' => 1,
                    'topP' => 0.95,
                    'topK' => 40,
                    'maxOutputTokens' => 8192,
                ]
            ];

            // Make the API request
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->apiUrl}?key={$this->apiKey}", $payload);

            if ($response->successful()) {
                $responseData = $response->json();
                
                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiMessage = $responseData['candidates'][0]['content']['parts'][0]['text'];
                    
                    // Add AI response to history
                    $history[] = [
                        'role' => 'model',
                        'parts' => [
                            ['text' => $aiMessage]
                        ]
                    ];
                    
                    // Trim history if it gets too long (keep last 10 messages)
                    if (count($history) > 12) {
                        // Keep the first two (system instruction + response) and the last 10 messages
                        $history = array_merge(
                            array_slice($history, 0, 2),
                            array_slice($history, -10)
                        );
                    }
                    
                    // Store updated history in cache (expire after 30 minutes)
                    Cache::put('chat_history_' . $sessionId, $history, 30 * 60);
                    
                    return [
                        'success' => true,
                        'response' => $aiMessage,
                        'sessionId' => $sessionId
                    ];
                }
            }
            
            Log::error('Gemini API error: ' . $response->body());
            return [
                'success' => false,
                'response' => '😓 I\'m sorry, I couldn\'t process your request right now. Please try again later.',
                'sessionId' => $sessionId
            ];
        } catch (\Exception $e) {
            Log::error('Exception when calling Gemini API: ' . $e->getMessage());
            return [
                'success' => false,
                'response' => '😓 I\'m having trouble connecting to my brain right now. Please try again in a moment.',
                'sessionId' => $sessionId
            ];
        }
    }
}