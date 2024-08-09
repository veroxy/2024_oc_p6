<?php

namespace repositories;

use models\entities\User;

/**
 * Classe UserRepository pour gérer les requêtes liées aux users et à l'authentification.
 */
class UserRepository extends AbstractEntityRepository
{

    public function getUserByBookId(int|string $idBook): ?User
    {
        if (is_string($idBook)) {
            $sql = "SELECT u.* FROM user as u WHERE u.username='$idBook';";
        }
        if (is_int($idBook)) {
            $sql = "SELECT u.*
                    FROM user_has_book
                             RIGHT JOIN user u
                                        ON user_has_book.user_id = u.id
                    WHERE book_id = $idBook
                    ORDER by u.created_at DESC
                    LIMIT 1;";
        }
        $result = $this->db->query($sql);
        $user   = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère un user connecté
     * @param int $id
     * @return ?User
     */
    public function getUserById(?int $id): ?User
    {
        $sql    = "SELECT * FROM user WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user   = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère un user par son login.
     * @param string $email
     * @return ?User
     */
    public function getUserByLogin(string $username): ?User
    {
        $sql    = "SELECT * FROM user WHERE username = :username";
        $result = $this->db->query($sql, ['username' => $username]);
        $user   = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function addUser(User $user)
    {
        // On hash le mot de passe
        $hashPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $sql    = "INSERT INTO user (username, email, password, created_at) VALUES (:username, :email, :password, NOW())";
        $result = $this->db->query($sql, [
            'username' => $user->getUsername(),
            'password' => $hashPassword,
            'email' => $user->getEmail()
        ]);

        return $result->rowCount() > 0;
    }

    public function updateUser(User $user)
    {

        $hashPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $sql          = "UPDATE user SET  (username, email, password, created_at) VALUES (:username, :email, :password, NOW()) where id= :id";

        $result       = $this->db->query($sql, [
            'username' => $user->getUsername(),
            'password' => $hashPassword,
            'email' => $user->getEmail(),
            'id' => $user->getId()
        ]);
    }
}