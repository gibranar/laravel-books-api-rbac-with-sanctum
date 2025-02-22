<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Utils\JSendFormatter;
use App\Utils\ResponseFormatter;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    use AuthorizesRequests;
    protected $data = [];

    public function index()
    {
        try {
            $this->authorize('read book', Book::class);
        } catch (AuthorizationException $e) {
            return JSendFormatter::fail('Unauthorized: You do not have permission for this action"', null, 403);
        }

        $books = Book::paginate(request('per_page', 10));

        return ResponseFormatter::paginatedCollection('books', $books, 200, 'Success get all books');
    }

    public function store(Request $request)
    {
        try {
            $this->authorize('create book', Book::class);
        } catch (AuthorizationException $e) {
            return JSendFormatter::fail('Unauthorized', null, 403);
        }

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer',
            'description' => 'required|string',
        ]);

        $book = Book::create($request->all());

        $this->data['book'] = $book;

        return JSendFormatter::success('Book created', $this->data, 201);
    }

    public function show($id)
    {
        try {
            $this->authorize('read book', Book::class);
        } catch (AuthorizationException $e) {
            return JSendFormatter::fail('Unauthorized: You do not have permission for this action"', null, 403);
        }

        $book = Book::find($id);

        if (!$book) {
            return JSendFormatter::fail('Book not found', null, 404);
        }

        return ResponseFormatter::singleton('book', $book, 200, 'Book found');
    }

    public function update(Request $request, $id)
    {
        try {
            $this->authorize('update book', Book::class);
        } catch (AuthorizationException $e) {
            return JSendFormatter::fail('Unauthorized', null, 403);
        }

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer',
            'description' => 'required|string',
        ]);

        $book = Book::find($id);

        if (!$book) {
            return JSendFormatter::fail('Book not found', null, 404);
        }

        $book->update($request->all());

        $this->data['book'] = $book;

        return JSendFormatter::success('Book updated', $this->data, 200);
    }

    public function destroy($id)
    {
        try {
            $this->authorize('delete book', Book::class);
        } catch (AuthorizationException $e) {
            return JSendFormatter::fail('Unauthorized', null, 403);
        }

        $book = Book::find($id);

        if (!$book) {
            return JSendFormatter::fail('Book not found', null, 404);
        }

        $book->delete();

        return JSendFormatter::success('Book deleted', null, 200);
    }
}
