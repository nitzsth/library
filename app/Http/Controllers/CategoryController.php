<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('name')->paginate('15');
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $category = new Category;

        return view('categories.create', compact('category'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::create($data);

        return redirect()->route('categories.show', $category);
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        $books = $category->books()->orderBy('name')->paginate(10);
        $authors = $category->authors()->orderBy('name')->paginate(40);

        return view('categories.show', compact('category', 'authors', 'books'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update($request->all());

        return redirect()->route('categories.show', $category);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
