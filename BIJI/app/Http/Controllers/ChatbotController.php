<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Knowledge;
use Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $input = $this->sanitizeInput($request->input('message'));
        Log::info('User input: ' . $input);
        if ($this->isGreeting($input)) {
            Log::info('Detected as greeting');
            return response()->json(['response' => "Halo! Ada yang bisa saya bantu?"]);
        }
        $response = "Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda.";

        if ($this->isProductQuery($input)) {
            $response = $this->searchProduct($input);
            Log::info('Product search response: ' . $response);
        } else {
            $response = $this->handleGeneralQuestions($input);
            Log::info('General question response: ' . $response);
        }

        if ($response === "Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda.") {
            $response = $this->handleChatSession($input);
            Log::info('Chat session response: ' . $response);
        }

        return response()->json(['response' => $response]);
    }

    private function searchProduct($input)
    {
        $matchedProducts = $this->fuzzySearch($input);
        if (empty($matchedProducts)) {
            return "Maaf, kami tidak menemukan produk yang Anda cari.";
        }

        $response = "Produk yang kami temukan:<br>";
        foreach ($matchedProducts as $product) {
            $response .= "<strong>" . $product->title . "</strong><br>" .
                "Author: " . $product->author . "<br>" .
                "Avaible: " . $product->available_copies . "<br>" .
                "Lihat disini: <a href=\"" . url('/book/detail/'.$product->id, $product->id) . "\">Lihat Detail</a><br><br>";
        }
        return $response;
    }


    private function fuzzySearch($input)
    {
        $products = Book::all();
        $bestMatch = [];
    
        foreach ($products as $product) {
            if (stripos($input, $product->title) !== false) { 
                $bestMatch[] = $product;
            }
        }
        if (empty($bestMatch)) {
            foreach ($products as $product) {
                $levDistance = levenshtein(strtolower($input), strtolower($product->title));
                if ($levDistance <= 3) { 
                    $bestMatch[] = $product;
                }
            }
        }
    
        return $bestMatch;
    }
    

    private function handleGeneralQuestions($input)
    {
        $faqs = Faq::all();
        $bestMatch = null;
        $shortestDistance = -1;
        $threshold = 5;

        foreach ($faqs as $faq) {
            $levDistance = levenshtein(strtolower($input), strtolower($faq->question));
            if ($levDistance == 0) {
                return $faq->answer;
            }
            if ($levDistance < $shortestDistance || $shortestDistance < 0) {
                $bestMatch = $faq;
                $shortestDistance = $levDistance;
            }
        }

        if ($shortestDistance <= $threshold) {
            return $bestMatch->answer;
        }
        return "Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda.";
    }


    private function handleChatSession($input)
    {
        $chatHistory = session('chat_history', []);
        $chatHistory[] = ['user' => $input];
        session(['chat_history' => $chatHistory]);

        $response = $this->processChat($input);

        $chatHistory[] = ['bot' => $response];
        session(['chat_history' => $chatHistory]);

        return $response;
    }

    private function processChat($input)
    {
        return "Terima kasih telah bertanya. Silakan beri tahu saya jika Anda membutuhkan bantuan lebih lanjut.";
    }

    private function isProductQuery($input)
    {
        $keywords = ['buku', 'produk', 'judul', 'cari', 'tentang'];
        foreach ($keywords as $keyword) {
            if (stripos($input, $keyword) !== false) {
                return true;
            }
        }

        $products = Book::all();
        foreach ($products as $product) {
            if (stripos($input, $product->title) !== false) {
                return true;
            }
        }

        return false;
    }


    private function isGreeting($input)
    {
        $greetings = ['hai', 'halo', 'hi', 'hello', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam'];
        foreach ($greetings as $greeting) {
            if (stripos($input, $greeting) !== false) {
                return true;
            }
        }
        return false;
    }

    private function sanitizeInput($input)
    {
        return trim(strtolower($input));
    }
}
