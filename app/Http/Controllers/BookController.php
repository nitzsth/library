<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Instantiate a new BookController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except([ 'index', 'show' ]);
    }

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
        $book       = new Book;
        $authors    = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('book', 'authors', 'categories'));
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  App\Http\Requests\BookRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $path           = $request->file('avatar')
                ->store(Constant::DIR_AVATAR);
            $data['avatar'] = "/storage/$path";
        }

        $book = Book::create($data);
        $book->authors()->attach($request->author_id);
        $book->categories()->attach($request->category_id);

        return redirect()->route('books.show', $book);
    }

    /**
     * Show the specified book.
     *
     * @param  \App\Model\Book $book
     *
     * @return \Illuminate\View\View
     */
    public function show(Book $book)
    {
        $bookCopies = $book->bookCopies()->orderBy('id')->paginate('10');

        $bookCopies->each(function ($bookCopy)
        {
            $bookCopy['available'] = $bookCopy->users()
                ->whereNull('returned_date')
                ->get()
                ->isEmpty();
        });

        return view('books.show', compact('book', 'bookCopies'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Model\Book $book
     *
     * @return \Illuminate\View\View
     */
    public function edit(Book $book)
    {
        $authors    = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  App\Http\Requests\BookRequest $request
     * @param  \App\Model\Book               $book
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->all();
        if (isset($data['isbn'])) {
            unset($data['isbn']);
        }

        $book->update(array_except($data, [ 'avatar' ]));
        $book->authors()->sync($request->author_id);
        $book->categories()->sync($request->category_id);

        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Book $book
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }

    /**
     * Upload the specified image and replace existing image from storage if
     * any.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Model\Book         $book
     * q@return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, Book $book)
    {
        $this->validate($request, [ 'avatar' => 'required|image|max:1000' ]);

        $path = $request->file('avatar')->store(Constant::DIR_AVATAR);

        if ($book->avatar) {
            Storage::delete(str_replace("/storage/", "", $book->avatar));
        }

        $book->update([ 'avatar' => "/storage/$path" ]);

        return redirect()->route('books.show', $book);
    }

    /**
     * Store the bookCopy id of a specified book.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Model\Book         $book
     * q@return \Illuminate\Http\RedirectResponse
     */
    public function addCopy(Request $request, Book $book)
    {
        $this->validate($request, [ 'id' => 'required|alpha_dash|unique:book_copies' ]);
        $book->bookCopies()->create($request->all());

        return redirect()->route('books.show', $book);
    }
}
