<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Favorite;
use App\Models\LoanHistory;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function showAdminBook()
    {
        $books = Book::all();
        return view('admin.book', compact('books'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'genre_1' => 'required|string',
            'genre_2' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_copies' => 'required|integer',
        ]);

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');
            $book = new Book();
            $book->title = $validated['title'];
            $book->author = $validated['author'];
            $book->synopsis = $validated['synopsis'];
            $book->genre_1 = $validated['genre_1'];
            $book->genre_2 = $validated['genre_2'] ?? null;
            $book->cover_image = $imagePath;
            $book->available_copies = $validated['available_copies'];
            $book->save();
            return response()->json([
                'error' => false,
                'redirect_url' => url('/admin/book')
            ]);
        } else {
            $book = new Book();
            $book->title = $validated['title'];
            $book->author = $validated['author'];
            $book->synopsis = $validated['synopsis'];
            $book->genre_1 = $validated['genre_1'];
            $book->genre_2 = $validated['genre_2'] ?? null;
            $book->cover_image = null;
            $book->available_copies = $validated['available_copies'];
            $book->save();

            return response()->json([
                'error' => false,
                'redirect_url' => url('/admin/book')
            ]);
        }
    }

    public function showBook($id)
    {
        $book = Book::find($id);

        if ($book) {
            return view('admin.book_crud.show', compact('book'));
        } else {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['success' => true]);
    }

    public function getBookData($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.book_crud.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->synopsis = $request->input('synopsis');
        $book->genre_1 = $request->input('genre_1');
        $book->genre_2 = $request->input('genre_2');
        $book->available_copies = $request->input('available_copies');
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $path = $coverImage->store('public/books');
            $book->cover_image = $path;
        }
        $book->save();

        return response()->json(['success' => 'Book updated successfully!']);
    }

    public function showAdminData()
    {
        $data = Faq::all();
        return view('admin.training', compact('data'));
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        if ($request->hasFile('cover_image')) {
            $book = new Faq();
            $book->title = $validated['title'];
            $book->answer = $validated['answer'];
            $book->save();
            return response()->json([
                'error' => false,
                'redirect_url' => url('/admin/data')
            ]);
        } else {
            $book = new Faq();
            $book->question = $validated['question'];
            $book->answer = $validated['answer'];
            $book->save();

            return response()->json([
                'error' => false,
                'redirect_url' => url('/admin/data')
            ]);
        }
    }

    public function deleteFaq($id)
    {
        $book = Faq::findOrFail($id);
        $book->delete();
        return response()->json(['success' => true]);
    }

    public function showAdminLoan()
    {
        $data = LoanHistory::all();
        return view('admin.pinjam', compact('data'));
    }

    public function approveLoan($loanHistoryId)
    {
        $loanHistory = LoanHistory::find($loanHistoryId);
        if ($loanHistory) {
            $book = $loanHistory->book;
            if ($book->available_copies > 0) {
                $book->available_copies -= 1;
                $loanHistory->status = 'approved';
                $book->save();
                $loanHistory->save();

                return response()->json(['success' => true, 'message' => 'Buku berhasil disetujui']);
            } else {
                return response()->json(['success' => false, 'message' => 'Tidak ada salinan buku yang tersedia']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Pinjaman tidak ditemukan']);
    }

    public function rejectedLoan($loanHistoryId)
    {
        $loanHistory = LoanHistory::find($loanHistoryId);
        $loanHistory->status = 'rejected';
        $loanHistory->save();
        return response()->json(['success' => true, 'message' => 'Buku berhasil disetujui']);
    }
}
