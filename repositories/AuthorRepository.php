<?php

namespace repositories;

use models\entities\Author;

/**
 * Classe AuthorRepository pour gérer les requêtes liées aux users et à l'authentification.
 */
class AuthorRepository extends AbstractEntityRepository
{
    /**
     * Récupère un author connecté
     * @param int $id
     * @return ?Author
     */
    public function getUserById(?int $id): ?Author
    {
        $sql    = "SELECT * FROM author WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $author = $result->fetch();
        if ($author) {
            return new Author($author);
        }
        return null;
    }

    /**
     * Récupère tous les commentaires d'un book.
     * @param int $idBook : l'id de l'book.
     * @return array : un tableau d'objets Comment.
     */
    public function getAllAuthorsByBookId(int $idBook): array
    {
//        $sql = "SELECT * FROM book_has_author WHERE book_id = :idBook";

        $sql = "SELECT a.fullname
                FROM book_has_author
                RIGHT JOIN author a 
                ON book_has_author.author_id = a.id
                WHERE book_id = $idBook";


        $result  = $this->db->query($sql);
        $authors   = $this->getArrayObjBook($result, Author::class);


//        $result  = $this->db->query($sql, ['book_id' => $idBook]);
//        $authors = [];

//        while ($author = $result->fetch()) {
//            $authors[] = new Author($author);
//        }
        return $authors;
    }

    /**
     * Récupère un author par son nom entier.
     * @param string $fullname
     * @return ?Author
     */
    public function getUserByFullname(string $fullname): ?Author
    {
        $sql    = "SELECT * FROM author WHERE fullname = :fullname";
        $result = $this->db->query($sql, ['fullname' => $fullname]);
        $author = $result->fetch();
        if ($author) {
            return new Author($author);
        }
        return null;
    }

    public function addUser(Author $author)
    {
        $sql    = "INSERT INTO author (fullname, created_at, modified_at) VALUES (:fullname, NOW(), NOW())";
        $result = $this->db->query($sql, [
            'fullname' => $author->getFullname(),
        ]);
        return $result->rowCount() > 0;
    }


}