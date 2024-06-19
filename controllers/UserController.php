<?php


use controllers\AbstactController;
use repositories\UserRepository;

class UserController extends AbstactController
{
    /**
     * Affiche le profile utilisateur Connecté
     * @return void
     */
    public function showProfile()
    {

        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère les books.
        $userRepo = new UserRepository();
        $booksRepo = new \repositories\BookRepository();
        $books    = [];
        if (isset($_SESSION['idUser'])) {
            $uid  = $_SESSION['idUser'];
            $user = $userRepo->getUserById($uid);
        }

        // TODO gere books empty
        if (Utils::user() & $_SESSION['idUser'] == $user->getId()) {
                $books = $booksRepo->getBookByUser( $user->getId());

        }


        $view = new View('Profile');
        $view->render('profile', [
            'user' => $user,
            'books' => $books
        ]);
    }
}