<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BookService; // Import the BookService class
use App\Http\Requests\Book\StoreRequest; // Import the StoreRequest for validation
use App\Http\Requests\Book\UpdateRequest; // Import the UpdateRequest for validation

class BookController extends Controller
{
    protected $BookService; // Declare the BookService property

    // Dependency Injection of UserService
    public function __construct(BookService $BookService)
    {
        $this->BookService = $BookService; // Assign the injected BookService
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all books with their associated category
        return response()->json(Book::with('category')->get()); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Validate the incoming request using the StoreRequest
        $data = $request->validated();

        // Create a new book using the BookService
        $book = $this->BookService->createBook($data);

        // Check if book creation was successful
        if (!$book) {
            return response()->json(['error' => 'Created failed'], 422); // Return an error response if creation failed
        }

        // Return the newly created book with a 201 Created status code
        return response()->json($book, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Return the requested book as JSON
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Book $book)
    {
        // Validate the incoming request using the UpdateRequest
        $data = $request->validated();

        // Update the book using the BookService
        $book_update = $this->BookService->updateBook($book, $data);

        // Check if update was successful
        if (!$book_update) {
            return response()->json(['error' => 'Updated failed'], 422); // Return an error response if update failed
        }

        // Return the updated book with a 201 Created status code
        return response()->json($book, 201); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete the book using the BookService
        $deleted = $this->BookService->deleteBook($book);

        // Check if deletion was successful
        if (!$deleted) {
            return response()->json(['error' => 'Deleted failed'], 422); // Return an error response if deletion failed
        }

        // Return a 204 No Content status code to indicate successful deletion
        return response()->json(null, 204); 
    }

    /**
     * Get books by category ID.
     */
    public function indexByCategory($categoryId)
    {
        // Find the category by ID
        $category = Category::findOrFail($categoryId); 

        // Get all books associated with the category
        $books = $category->books; 

        // Return the books as JSON
        return response()->json($books);
    }
}