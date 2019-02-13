<?php

namespace App\Http\Controllers;

use App\Models\BookCopy;
use App\Models\Book;
use Illuminate\Http\Request;

class BookCopyController extends Controller
{
    /**
     * Display the specified book copy.
     *
     * @param  \App\Model\BookCopy  $bookCopy
     * @return \Illuminate\View\View
     */
    public function show(BookCopy $bookCopy)
    {
        return view('bookCopies.show', compact('bookCopy'));
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
