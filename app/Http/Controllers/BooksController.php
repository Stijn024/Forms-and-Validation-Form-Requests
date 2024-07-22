<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', [
            'books' => Book::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('books')->where(function ($query) use ($request) {
                    return $query->where('title', $request->input('title'))
                                 ->where('author', $request->input('author'));
                }),
            ],
            'author' => ['required', 'string'],
        ], [
            'title.unique' => 'This book is already in your library'
        ]);

        Book::create($input);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $input = $request->validate([
            'title' => ['required', 'string'],
            'author' => ['required', 'string'],
            'read_at' => ['nullable', 'date'],
        ]);

        $book->update($input);

        return redirect()->route('books.index')->with('alert', "'{$input['title']}' has been saved.");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('alert', "'$book->title' has been deleted.");
    }

    /**
     * Mark a book as read or remove that mark.
     */
    public function toggleRead(Request $request)
    {
        $book = Book::findOrFail($request->input('id'));

        $book->read_at = $request->boolean('isRead') ? date('Y-m-d') : null;
        $book->save();

        return ['success' => "$book->title has been updated."];
    }    
}
