<?php

use controllers\AbstactController;
use repositories\BookRepository;

class BookController extends AbstactController
{
    /**
     * @return void
     */
    public function all()
    {
        $bookRepo = new BookRepository();
        $books = $bookRepo->getAllBooks();
        $view = new View("Nos Livres à l'échanges");
        $view->render('books', ['books' => $books]);
    }

    public function showBook(int $bookId)
    {
        $bookRepo = new BookRepository();
        $book = $bookRepo->getBookById($bookId);
        $view = new View($book->title);
        $view->render('book', ['book' => $book]);


    }

}