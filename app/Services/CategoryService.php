<?php

namespace App\Services;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import the Log facade

class CategoryService
{
    /*
     * Create a new category.
     *
     * @param array $data The data for the new category.
     * @return Category|false The newly created category object or false if an error occurred.
     */
    public function createCategory(array $data)
    {
        try {
            // Create the category using the provided data
            $Category = Category::create($data);

            // Return the newly created category object
            return $Category;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to create category: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Update an existing category.
     *
     * @param Category $Category The category object to update.
     * @param array $data The data to update the category with.
     * @return Category|false The updated category object or false if an error occurred.
     */
    public function updateCategory(Category $Category, array $data)
    {
        try {
            // Update the category with the provided data
            $Category->update($data);

            // Return the updated category object
            return $Category;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to update category: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Delete a category.
     *
     * @param Category $Category The category object to delete.
     * @return bool True if the category was deleted successfully, false if an error occurred.
     */
    public function deleteCategory(Category $Category)
    {
        try {
            // Delete the category from the database
            $Category->delete();

            // Return true to indicate successful deletion
            return true;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to delete category: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }
}
