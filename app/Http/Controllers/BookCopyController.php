<?php

namespace App\Http\Controllers;

use App\Models\BookCopy;
use Illuminate\Http\Request;

class BookCopyController extends Controller
{
    /**
     * Instantiate a new BookCopyController instance.
     *
     *@return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['index','show']);
    }

    /**
     * Show the specified book copy.
     *
     * @param  \App\Model\BookCopy  $bookCopy
     * @return \Illuminate\View\View
     */
    public function show(BookCopy $bookCopy)
    {
        $available = true;
        $users = $bookCopy->users()->orderBy('returned_date')->orderBy('borrowed_date', 'desc')->get();

        if ($users->isNotEmpty()) {
            $available = !!$users->first()->pivot->returned_date;
        }
        return view('bookCopies.show', compact('available', 'bookCopy', 'users'));
    }

    /**
     * Update the id of specified book copy in storage.
     *
     * @param  App\Http\Requests\Request  $request
     * @param  \App\Model\BookCopy  $bookCopy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BookCopy $bookCopy)
    {
        $this->validate($request, ['id' => 'required|alpha_dash|unique:book_copies']);
        $bookCopy->update($request->all());

        return redirect()->route('book-copies.show', $bookCopy);
    }
}
