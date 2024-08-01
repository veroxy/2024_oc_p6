<?php

namespace repositories;
//
use models\entities\Book;
use models\entities\User;
use PDOStatement;

/**
 * Classe qui gère les books.
 */
class BookRepository extends AbstractEntityRepository
{

//    TRAIT
    /**
     * Récupère tous les books par ordre décroissant d'ajout
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM book ORDER BY created_at DESC";
        return $this->baseGetBooks($sql);
    }

    /**
     * @param $sql
     * @return array
     */
    public function baseGetBooks($sql)
    {
        $result     = $this->db->query($sql);
        $authorRepo = new AuthorRepository();
        $books      = [];

        while ($book = $result->fetch()) {

            $arr_authors = $authorRepo->getAllAuthorsByBookId($book['id']);
            $users       = $this->getUsersByBook($book['id']);
            $post        = new Book($book);
            $post->setAuthors($arr_authors);
            foreach ($users as $user) {
                $post->setUser($user);
            }
            $books[] = $post;
        }
        return $books;
    }

    /**
     * get only user(s) from refered book id
     * @param int $bookId
     * @return array
     */
    public function getUsersByBook(int $bookId): array
    {
        $sql    = "SELECT *
                FROM user
                         JOIN user_has_book ub
                              ON ub.user_id = user.id
                WHERE ub.book_id = $bookId;";
        $result = $this->db->query($sql);
        $users  = $this->getRelationToMany($result, User::class);
        return $users;

    }

    /**
     * get only book(s) from refered user id
     * @param int $bookId
     * @return array
     */
    public function getBooksByUserAsc(int $userId): array
    {
        $sql = "SELECT *, ub.stock
                FROM book
                         JOIN user_has_book ub
                              ON ub.book_id = book.id
                WHERE ub.user_id = $userId
                ORDER BY book.id ASC;";
//        $result = $this->db->query($sql);
        $books = $this->baseGetBooks($sql);
        return $books;

    }
    /*public function getBookByUser(int $userId): array
    {
        $sql        = "SELECT b.*
                        FROM user_has_book
                                 right join `2024_oc_p6_tomtroc`.user u on user_has_book.user_id = u.id
                        right join `2024_oc_p6_tomtroc`.book b on b.id = user_has_book.book_id
                        WHERE u.id = $userId
                        ORDER BY u.created_at DESC;";
        $result     = $this->db->query($sql);
        $authorRepo = new AuthorRepository();

        while ($book = $result->fetch()) {
            $authors = $authorRepo->getAllAuthorsByBookId($book['id']);
            $post    = new Book($book);
            $post->setAuthors($authors);
            $books[] = $post;
        }
        return $books;
    }*/

    /**
     * Récupère tous les books par ordre décroissant d'ajout
     * @return array : un tableau d'objets Book.
     */
    public function getFouthLastBooks(int $limit = 4): array
    {
        $sql = "SELECT DISTINCT book.*,
               (SELECT author.fullname
                 FROM book_has_author ba
                          JOIN author ON ba.author_id = author.id
                 WHERE ba.book_id = book.id limit 1) AS fullname,

                (SELECT user.username
                 FROM user_has_book ub
                          JOIN user ON ub.user_id = user.id
                 WHERE ub.book_id = book.id limit 1) AS username
                 
            FROM book
            ORDER BY book.created_at DESC
            LIMIT 4;";

        $result     = $this->db->query($sql);
        $authorRepo = new AuthorRepository();
        $userRepo   = new UserRepository();
        $books      = [];

        while ($book = $result->fetch()) {
            $author = $authorRepo->getFirstAuthorsBookId($book['fullname']);
            $user   = $userRepo->getUserByBookId($book['username']);
            $post   = new Book($book);
            $post->setUser($user);
            $post->setAuthor($author);
            $books[] = $post;
        }
        return $books;
    }

    /**
     * Ajoute ou modifie un book.
     * On sait si l'book est un nouvel book car son id sera -1.
     * @param Book book : l'book à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateBook(Book $book): void
    {
        if ($book->getId() == -1) {
            $this->addBook($book);
        } else {
            $this->updateBook($book);
        }
    }

    /**
     * Ajoute un book.
     * @param Book $book : l'book à ajouter.
     * @return void
     */
    public function addBook(Book $book): void
    {
        $sql = "INSERT INTO book (id_user, title, content, created_at, modified_at) VALUES (:id_user, :title, :content, NOW(), NOW())";

        $this->db->query($sql, [
            'id_user' => $book->getUser(),
            'title' => $book->getTitle(),
            'content' => $book->getContent()
        ]);
    }

    /**
     * Modifie un book.
     * @param Book $book : l'book à modifier.
     * @return Book
     */
    public function updateBook(Book|array $bookDatas): ?Book
    {
        $datas = [];
        if (is_object($bookDatas)) {
            $datas = [
                'title' => $bookDatas->getTitle(),
                'content' => $bookDatas->getContent(),
                'stock' => $bookDatas->getStock(),
                'id' => $bookDatas->getId()
            ];
        }
        if (is_array($bookDatas)) {
            $book = $this->getBookByTitle($bookDatas['current-title']);
            if ($bookDatas['current-stock'] !== $book->getStock()) {
                $d          = [];
                $d['stock'] = $bookDatas['current-stock'];
                $d['uid']   = $book->getUser()->getId();
                $d['id']    = $book->getId();
                $sql        = "UPDATE user_has_book SET stock= :stock where user_id= :uid and book_id= :id";
                $result     = $this->db->query($sql, $d);
            }
            $datas = [
                'title' => $bookDatas['current-title'],
                'content' => $bookDatas['current-content'],
                'id' => $book->getId()];
        }

        $sql = "UPDATE book SET thumb='test', title= :title, content= :content, modified_at=NOW() WHERE id= :id";
        $this->db->query($sql, $datas);

        if ($book) {
            return $this->getBookById($book->getId());
        }
        return null;
    }

    /**
     * @param string $title
     * @return Book | null
     */
    public function getBookByTitle(string $title): ?Book
    {
        $uid  = $_SESSION["uid"];
        $sql  = "SELECT *
        FROM user
                 JOIN user_has_book ub
                      ON ub.user_id = user.id
                 JOIN book
                      ON book.id = ub.book_id
        WHERE ub.user_id = $uid 
        AND book.title= '$title'";
        $r    = $this->db->query($sql);
        $book = $this->baseGetBooks($sql);

        if ($book) {
            return $book[0];
        }

        return null;
    }

    /**
     * Récupère un book par son id.
     * @param int $id : l'id de l'book.
     * @return Book|null : un objet Book ou null si l'book n'existe pas.
     */
    public function getBookById(int $id): ?Book
    {


        $vendorId = $_REQUEST["vendor"]?: $_SESSION['uid'] ;
        $sql = "SELECT *
                FROM user
                         JOIN user_has_book ub
                              ON ub.user_id = user.id
                         JOIN book
                              ON book.id = ub.book_id
                WHERE book.id = $id
                  AND ub.user_id = $vendorId";


        /*        $result = $this->db->query($sql, ['id' => $id]);
                $book = $result->fetch();
        */
        $book = $this->baseGetBooks($sql);
        if ($book) {
            return $book[0];
        }


        return null;
    }

    /**
     * Update nb views in bdd - every refresh page articleDetails
     * @param Book $book
     * @return Book
     */
    public function updateViewsBook(Book $book): Book
    {
        $views = $book->getViews() + 1;
        $sql   = "UPDATE book SET views = :views WHERE id = :id";
        $this->db->query($sql, [
            'views' => $views,
            'id' => $book->getId()
        ]);
        $book = $this->getBookById($book->getId());
        return $book;

    }

    /**
     * Supprime un $book.
     * @param int $id : l'id de l'$boo à supprimer.
     * @return void
     */
    public function deleteBook(int $id): void
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     *
     * Request Order By Asc/Desc selon la colonne à ordoner
     * @param string $order Asc/Desc
     * @param string $db_column views/title/date/comments
     * @return array
     */
    public function orderBy(string $db_column, string $order): ?array
    {


        // selectionner tous les books pocédant 0/+ comments
        $sql    = "SELECT a.*, count(c.id_article) as comments
                            FROM book a
                            LEFT JOIN comment c 
                            ON a.id = c.id_article
                            GROUP BY a.id  
                            ORDER BY $db_column $order";
        $result = $this->db->query($sql);
        $books  = $this->getRelationToMany($result);
        return $books;


    }

    public function searchBookBytitle($search)
    {
        $sql = "SELECT * FROM book WHERE title LIKE '%$search%'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Result: " . $row["title"] . "<br>";
            }
        } else {
            echo "RIEN TROUVE";
        }
    }

    /**
     * Récupère la relation One To Many Book -> Comments
     * @param PDOStatement $result
     * @return array
     */
    private function getComments(PDOStatement $result): array
    {
        $commentRepository = new CommentRepository();
        $book              = [];
        while ($book = $result->fetch()) {
            $comments = $commentRepository->getAllCommentsByBookId($book['id']);
            $post     = new Book($book);
            $post->setComments($comments);
            $books[] = $post;
        }
        return $books;
    }
}

