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
     * @param int $idBook
     * @return array
     */
    public function getFirstAuthorsBookId(int|string $idBook):?Author
    {
        if (is_int($idBook)) {
            $sql = "SELECT a.*
                FROM book_has_author
                RIGHT JOIN author a 
                ON book_has_author.author_id = a.id
                WHERE book_id = $idBook
                ORDER by a.created_at DESC
                LIMIT 1";
        }
        if (is_string($idBook)) {
        $sql = "SELECT a.* FROM author as a WHERE a.fullname='$idBook';";
        }

        $result = $this->db->query($sql);
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
        $authors = $this->getRelationToMany($result, Author::class);
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

    /**
     * @param Author $author
     * @return bool
     */
    public function addUser(Author $author)
    {
        $sql    = "INSERT INTO author (fullname, created_at, modified_at) VALUES (:fullname, NOW(), NOW())";
        $result = $this->db->query($sql, [
            'fullname' => $author->getFullname(),
        ]);
        return $result->rowCount() > 0;
    }


}