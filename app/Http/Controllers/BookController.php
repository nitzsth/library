<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $books = Book::orderBy('name')->paginate('10');

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $book = new Book;
        $authors = Author::all();

        return view('books.create', compact('book', 'authors'));
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store(Constant::DIR_AVATAR);
            $data['avatar'] = "/storage/$path";
        }

        $book = Book::create($request->all());
        $book->authors()->sync($request->author_id);

        return redirect()->route('books.show', $book);
    }

    /**
     * Display the specified book.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\View\View
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\View\View
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  App\Http\Requests\BookRequest  $request
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->all();
        if(isset($data['isbn'])){
            unset($data['isbn']);
        }

        $book->update(array_except($data, ['avatar']));
        $book->authors()->sync($request->author_id);

        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }

    /**
     * Upload the specified image and replace existing image from storage if any.
     *
     * @param \Illuminate\Http\Request  $request
     * @param  \App\Model\Book  $book
     * q@return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, Book $book)
    {
        $this->validate($request, ['avatar' => 'required|image|max:1000']);

        $path = $request->file('avatar')->store(Constant::DIR_AVATAR);

        if ($book->avatar) {
            Storage::delete(str_replace("/storage/", "", $book->avatar));
        }

        $book->update(['avatar' => "/storage/$path"]);

        return redirect()->route('books.show', $book);
    }
}
