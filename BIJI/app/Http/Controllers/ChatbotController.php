<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Faq;
use Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $input = $this->sanitizeInput($request->input('message'));

        if ($this->isGreeting($input)) {
            return response()->json(['response' => "Halo! Ada yang bisa saya bantu?"]);
        }

        $response = "Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda.";

        if ($this->isProductQuery($input)) {
            $response = $this->searchProduct($input);
        } else {
            $response = $this->handleGeneralQuestions($input);
        }

        if ($response === "Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda.") {
            $response = $this->handleChatSession($input);
        }

        return response()->json(['response' => $response]);
    }

    private function searchProduct($input)
    {
        $genres = $this->extractGenres($input);
        if ($genres) {
            return $this->searchByGenre($genres);
        }

        $matchedProducts = $this->fuzzySearch($input);
        if (empty($matchedProducts)) {
            return "Maaf, kami tidak menemukan produk yang Anda cari.";
        }

        if (count($matchedProducts) == 1) {
            $product = $matchedProducts[0];
            return "<strong>" . $product->title . "</strong><br>" .
                "Author: " . $product->author . "<br>" .
                "Available: " . $product->available_copies . "<br>" .
                "Lihat disini: <a href=\"" . url('/book/detail/' . $product->id) . "\">Lihat Detail</a><br>";
        }

        $response = "Kami menemukan beberapa buku yang mirip dengan pencarian Anda:<br>";
        foreach ($matchedProducts as $product) {
            $response .= "<strong>" . $product->title . "</strong><br>" .
                "Author: " . $product->author . "<br>" .
                "Available: " . $product->available_copies . "<br>" .
                "Lihat disini: <a href=\"" . url('/book/detail/' . $product->id) . "\">Lihat Detail</a><br><br>";
        }
        return $response;
    }

    private function fuzzySearch($input)
    {
        $products = Book::all();
        $bestMatch = [];
        $input = strtolower($input);

        foreach ($products as $product) {
            if (stripos($input, $product->title) !== false) {
                $bestMatch[] = $product;
            }
        }
        if (empty($bestMatch)) {
            $bestMatch = $this->getBooksByLevenshteinDistance($input, $products);
        }

        return $bestMatch;
    }

    private function getBooksByLevenshteinDistance($input, $products)
    {
        $bestMatch = [];
        $minDistance = PHP_INT_MAX;

        $input = strtolower($input);

        foreach ($products as $product) {
            $levDistance = levenshtein($input, strtolower($product->title));

            if ($levDistance < $minDistance) {
                $bestMatch = [$product];
                $minDistance = $levDistance;
            } elseif ($levDistance == $minDistance) {
                $bestMatch[] = $product;
            }
        }

        if (empty($bestMatch)) {
            return "Maaf, kami tidak menemukan buku yang sesuai.";
        }

        return $bestMatch;
    }

    private function searchByGenre($genres)
    {
        $books = Book::where(function ($query) use ($genres) {
            foreach ($genres as $genre) {
                $query->orWhere('genre_1', 'like', '%' . $genre . '%')
                    ->orWhere('genre_2', 'like', '%' . $genre . '%');
            }
        })->get();

        if ($books->isEmpty()) {
            return "Maaf, kami tidak menemukan buku dengan genre yang Anda cari.";
        }

        $response = "Kami menemukan beberapa buku dengan genre yang Anda cari:<br>";
        foreach ($books as $book) {
            $response .= "<strong>" . $book->title . "</strong><br>" .
                "Author: " . $book->author . "<br>" .
                "Available: " . $book->available_copies . "<br>" .
                "Lihat disini: <a href=\"" . url('/book/detail/' . $book->id) . "\">Lihat Detail</a><br><br>";
        }
        return $response;
    }

    private function extractGenres($input)
    {
        $genreKeywords = ['romance', 'fiksi', 'sejarah', 'fantasi', 'klasik', 'sihir', 'novel', 'petualangan'];

        $input = strtolower($input);
        $foundGenres = [];

        foreach ($genreKeywords as $genre) {
            if (stripos($input, $genre) !== false) {
                $foundGenres[] = $genre;
            }
        }

        return $foundGenres;
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
