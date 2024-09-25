<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_at' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'author' => 'nullable|string|max:20', 
            'published_at' =>'nullable|date',
            'category_id' =>'nullable|exist:categories,id'
        ]);
        
        $book->update($request->all());

        return response()->json($book, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }

    public function indexByCategory($categoryId)
{
    $category = Category::findOrFail($categoryId);
    $books = $category->books;

    return response()->json($books);
}

}
