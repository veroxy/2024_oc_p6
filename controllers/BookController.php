<?php

use controllers\AbstactController;
use repositories\BookRepository;

class BookController extends AbstactController
{
    public function showBook(int $bookId)
    {
        $bookRepo = new BookRepository();
        $book     = $bookRepo->getBookById($bookId);
        $view     = new View($book->getTitle());
        $view->render('book', ['book' => $book]);
    }

    public function deleteBook(int $bookId)
    {
        $bookRepo = new BookRepository();
        $bookRepo->deleteBook($bookId);
        Utils::redirect('profile');
    }

    public function updateBookScript($datas)
    {
        $bookRepo = new BookRepository();
        $bookRepo->updateBook($datas);
        Utils::redirect('profile');
    }

    public function updateBook(int $bookId)
    {
        $bookRepo = new BookRepository();
        $book     = $bookRepo->getBookById($bookId);
        $view     = new View('update ' . $book->getTitle());
        $view->render('updateBookForm', ['book' => $book]);
    }

    public function searchBook(?string $search = null)
    {
        var_dump('avant');
        if (isset($search)) {
            $repo  = new BookRepository();
            $books = $repo->searchBookBytitle($search);
        }else{
            var_dump('cca');
            $books = $search;
        }
//        var_dump('apres');
        die('49');
//

//        $view = new View("Nos Livres à l'échanges");
//        $view->render('books', ['books' => $books]);
        $this->all($books);

    }

    /**
     * @return void
     */
    public function all(?array $params = null)
    {
        $bookRepo = new BookRepository();
        if (isset($params)) {
            $books = $params;
        } else {
            $books = $bookRepo->getAllBooks();
        }
        $view = new View("Nos Livres à l'échanges");
        $view->render('books', ['books' => $books]);
    }
}