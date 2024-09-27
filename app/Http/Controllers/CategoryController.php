<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService; // Import the CategoryService class
use App\Http\Requests\Category\StoreRequest; // Import the StoreRequest for validation
use App\Http\Requests\Category\UpdateRequest; // Import the UpdateRequest for validation

class CategoryController extends Controller
{
    protected $CategoryService; // Declare the CategoryService property

    // Dependency Injection of CategoryService
    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService; // Assign the injected CategoryService
    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories
        return response()->json(Category::all()); 
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Validate the incoming request using the StoreRequest
        $data = $request->validated();

        // Create a new category using the CategoryService
        $category = $this->CategoryService->createCategory($data);

        // Check if category creation was successful
        if (!$category) {
            return response()->json(['error' => 'Created failed'], 422); // Return an error response if creation failed
        }

        // Return the newly created category with a 201 Created status code
        return response()->json($category, 201); 
    }

    /*
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Return the requested category as JSON
        return response()->json($category);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        // Validate the incoming request using the UpdateRequest
        $data = $request->validated();

        // Update the category using the CategoryService
        $category_update = $this->CategoryService->updateCategory($category, $data);

        // Check if update was successful
        if (!$category_update) {
            return response()->json(['error' => 'Updated failed'], 422); // Return an error response if update failed
        }

        // Return the updated category with a 201 Created status code
        return response()->json($category_update, 201); 
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete the category using the CategoryService
        $deleted = $this->CategoryService->deleteCategory($category);

        // Check if deletion was successful
        if (!$deleted) {
            return response()->json(['error' => 'Deleted failed'], 422); // Return an error response if deletion failed
        }

        // Return a 204 No Content status code to indicate successful deletion
        return response()->json(null, 204); 
    }
}
