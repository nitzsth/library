<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Helpers\Constant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	/**
     * Display the latest book added.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    	$books = Book::orderBy('created_at', 'desc')->take(Constant::SHOW_NUMBER_OF_LATEST_BOOK)->get();

    	return view('dashboard', compact('books'));
    }
}
