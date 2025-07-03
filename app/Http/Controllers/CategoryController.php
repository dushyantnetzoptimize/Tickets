<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return to_route('categories.index');
    }

    public function show(Category $category) {}

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return to_route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index');
    }

    public function createSubcategory()
    {
        // Only main categories (no parent) can be selected as parent
        $mainCategories = Category::whereNull('parent_id')->get();
        return view('categories.create_subcategory', compact('mainCategories'));
    }

    public function storeSubcategory(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_visible' => 'boolean',
            'parent_id' => 'required|exists:categories,id',
        ]);

        Category::create([
            'name' => $request->name,
            'is_visible' => $request->is_visible ?? false,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index');
    }
}