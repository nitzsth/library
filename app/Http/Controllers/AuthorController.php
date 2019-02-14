<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\Author;
use App\Models\Category;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Show the form for creating a new author.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $authors = Author::orderBy('name')->paginate('40');

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $author = new Author;
        $categories = Category::orderBy('name')->get();

        return view('authors.create', compact('author', 'categories'));
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  App\Http\Requests\AuthorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthorRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store(Constant::DIR_AVATAR);
            $data['avatar'] = "/storage/$path";
        }

        $author = Author::create($data);
        $author->categories()->attach($request->category_id);

        return redirect()->route('authors.show', $author);
    }

    /**
     * Display the specified author.
     *
     * @param  \App\Model\Author  $author
     * @return \Illuminate\View\View
     */
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified author.
     *
     * @param  \App\Model\Author  $author
     * @return \Illuminate\View\View
     */
    public function edit(Author $author)
    {
        $categories = Category::orderBy('name')->get();

        return view('authors.edit', compact('author', 'categories'));
    }

    /**
     * Update the specified author in storage.
     *
     * @param  App\Http\Requests\AuthorRequest  $request
     * @param  \App\Model\Author  $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update(array_except($request->all(), ['avatar']));
        $author->categories()->sync($request->category_id);

        return redirect()->route('authors.show', $author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Author  $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index');
    }

    /**
     * Upload the specified image and replace existing image from storage if any.
     *
     * @param \Illuminate\Http\Request  $request
     * @param  \App\Model\Author  $author
     * q@return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, Author $author)
    {
        $this->validate($request, ['avatar' => 'required|image|max:1000']);

        $path = $request->file('avatar')->store(Constant::DIR_AVATAR);

        if ($author->avatar) {
            Storage::delete(str_replace("/storage/", "", $author->avatar));
        }

        $author->update(['avatar' => "/storage/$path"]);

        return redirect()->route('authors.show', $author);
    }
}
