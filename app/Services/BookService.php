<?php

namespace App\Services;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import the Log facade

class BookService
{
    /*
     * Create a new book.
     *
     * @param array $data The data for the new book.
     * @return Book|false The newly created book object or false if an error occurred.
     */
    public function createBook(array $data)
    {
        try {
            // Create the book using the provided data
            $Book = Book::create($data);

            // Return the newly created book object
            return $Book;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to create book: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Update an existing book.
     *
     * @param Book $book The book object to update.
     * @param array $data The data to update the book with.
     * @return Book|false The updated book object or false if an error occurred.
     */
    public function updateBook(Book $book, array $data)
    {
        try {
            // Update the book with the provided data
            $book->update($data);

            // Return the updated book object
            return $book;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to update book: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Delete a book.
     *
     * @param Book $Book The book object to delete.
     * @return bool True if the book was deleted successfully, false if an error occurred.
     */
    public function deleteBook(Book $Book)
    {
        try {
            // Delete the book from the database
            $Book->delete();

            // Return true to indicate successful deletion
            return true;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to delete book: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }
}
