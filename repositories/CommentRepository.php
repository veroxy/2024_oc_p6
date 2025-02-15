<?php

namespace repositories;

use models\entities\Comment;

/**
 * Cette classe sert à gérer les commentaires.
 */
class CommentRepository extends AbstractEntityRepository
{
    /**
     * Récupère tous les commentaires d'un book.
     * @param int $idBook : l'id de l'book.
     * @return array : un tableau d'objets Comment.
     */
    public function getAllCommentsByBookId(int $idBook): array
    {
        $sql      = "SELECT * FROM comment WHERE id_article = :idBook";
        $result   = $this->db->query($sql, ['idBook' => $idBook]);
        $comments = [];

        while ($comment = $result->fetch()) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }

    /**
     * Récupère un commentaire par son id.
     * @param int $id : l'id du commentaire.
     * @return Comment|null : un objet Comment ou null si le commentaire n'existe pas.
     */
    public function getCommentById(int $id): ?Comment
    {
        $sql     = "SELECT * FROM comment WHERE id = :id";
        $result  = $this->db->query($sql, ['id' => $id]);
        $comment = $result->fetch();
        if ($comment) {
            return new Comment($comment);
        }
        return null;
    }

    /**
     * Ajoute un commentaire.
     * @param Comment $comment : l'objet Comment à ajouter.
     * @return bool : true si l'ajout a réussi, false sinon.
     */
    public function addComment(Comment $comment): bool
    {
        $sql    = "INSERT INTO comment (pseudo, content, id_article, created_at) VALUES (:pseudo, :content, :idBook, NOW())";
        $result = $this->db->query($sql, [
            'pseudo' => $comment->getPseudo(),
            'content' => $comment->getContent(),
            'idBook' => $comment->getIdBook()
        ]);
        return $result->rowCount() > 0;
    }

    /**
     * Supprime un commentaire.
     * @param int $id : l'objet Comment à supprimer.
     * @return void : true si la suppression a réussi, false sinon.
     */
    public function deleteComment(int $id): void
    {
        $sql = "DELETE FROM comment WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }


}
