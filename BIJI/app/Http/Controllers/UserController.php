<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\LoanHistory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showBeranda()
    {
        $userId = session('paramId');
        $books = Book::inRandomOrder()->take(6)->get();
        foreach ($books as $book) {
            $book->isFavorite = Favorite::where('user_id', $userId)
                ->where('book_id', $book->id)
                ->exists();
        }

        return view('book.beranda', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('author', 'LIKE', '%' . $query . '%')
            ->get();
        return view('book.beranda', compact('books'))->with('searchQuery', $query);
    }

    public function toggle(Request $request)
    {
        $userId = session('paramId');
        $bookId = $request->input('book_id');

        if ($userId) {
            $favorite = Favorite::where('user_id', $userId)->where('book_id', $bookId)->first();

            if ($favorite) {
                $favorite->delete();
                return response()->json(['status' => 'removed']);
            } else {
                Favorite::create([
                    'user_id' => $userId,
                    'book_id' => $bookId,
                ]);
                return response()->json(['status' => 'added']);
            }
        }

        return response()->json(['status' => 'unauthenticated'], 401);
    }

    public function show($book_id)
    {
        $book = Book::findOrFail($book_id);
        $otherBooks = Book::where('id', '!=', $book_id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('book.detail', compact('book', 'otherBooks'));
    }

    public function showFavorite()
    {
        $userId = session('paramId');
        $favoriteBooks = Favorite::where('user_id', $userId)
            ->with('book')
            ->get();
        foreach ($favoriteBooks as $favorite) {
            $favorite->isFavorite = true;
        }
        return view('book.favorite', compact('favoriteBooks'));
    }

    public function showRiwayat()
    {
        $userId = session('paramId');
        $loanHistory = LoanHistory::where('user_id', $userId)->get();

        return view('book.part.riwayat', compact('loanHistory'));
    }
    
    
}
