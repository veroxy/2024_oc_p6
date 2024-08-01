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
        $view = new View($book->getTitle());
        $view->render('book', ['book' => $book]);
    }

    public function deleteBook(int $bookId)
    {
        $bookRepo = new BookRepository();
        $bookRepo->deleteBook($bookId);
        Utils::redirect('profile');
    }

    public function updateBook(int $bookId){
        $bookRepo = new BookRepository();
        $book =  $bookRepo->getBookById($bookId);
        $view = new View('update '.$book->getTitle());
        $view->render('updateBookForm', ['book' => $book]);
    }

    public function updateBookScript($datas)
    {
        $bookRepo = new BookRepository();
        $bookRepo->updateBook($datas);
        Utils::redirect('profile');
    }

    public function search(string $search)
    {
        if(isset($_GET['search'])) {

           $repo = new BookRepository();
           $repo->searchBookBytitle($search);

        }

    }
}