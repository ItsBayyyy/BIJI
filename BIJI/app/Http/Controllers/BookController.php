<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // public function showForm()
    // {
    //     return view('admin.book');
    // }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'synopsis' => 'required|string',
    //         'genre_1' => 'required|string',
    //         'genre_2' => 'nullable|string',
    //         'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'available_copies' => 'required|integer',
    //     ]);

    //     if ($request->hasFile('cover_image')) {
    //         $imagePath = $request->file('cover_image')->store('books', 'public');
    //         $book = new Book();
    //         $book->title = $validated['title'];
    //         $book->author = $validated['author'];
    //         $book->synopsis = $validated['synopsis'];
    //         $book->genre_1 = $validated['genre_1'];
    //         $book->genre_2 = $validated['genre_2'] ?? null;
    //         $book->cover_image = $imagePath;
    //         $book->available_copies = $validated['available_copies'];
    //         $book->save();
    //         return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    //     } else {
    //         $book = new Book();
    //         $book->title = $validated['title'];
    //         $book->author = $validated['author'];
    //         $book->synopsis = $validated['synopsis'];
    //         $book->genre_1 = $validated['genre_1'];
    //         $book->genre_2 = $validated['genre_2'] ?? null;
    //         $book->cover_image = null;
    //         $book->available_copies = $validated['available_copies'];
    //         $book->save();

    //         return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan tanpa gambar.');
    //     }
    // }

}
