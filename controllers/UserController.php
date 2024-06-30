<?php


use controllers\AbstactController;
use repositories\BookRepository;
use repositories\UserRepository;

class UserController extends AbstactController
{
    /**
     * Affiche le profile utilisateur Connecté
     * @return void
     */
    public function showProfile(?int $profileId)
    {

        // On vérifie que l'utilisateur est connecté.
//        $this->checkIfUserIsConnected();

        // On récupère les books.
        $userRepo = new UserRepository();
        $booksRepo = new BookRepository();
        $books = [];

        if (isset($profileId)) {
            $user = $userRepo->getUserById($profileId);

        }

        if (isset($_SESSION['idUser'])) {
            $uid = $_SESSION['idUser'];
            $currentUser = $userRepo->getUserById($uid);
            // TODO gere books empty
            if (Utils::user() & $_SESSION['idUser'] == $currentUser->getId()) {
                $books = $booksRepo->getBooksByUserAsc($currentUser->getId());
            }
        } else {
            $books = $booksRepo->getBooksByUserAsc($user->getId());
        }
        $datas = ['user' => $user,
            'books' => $books];

        if (isset($currentUser)) {
            $datas['currentUser'] = $currentUser;
        }
        $view = new View('Profile');
        $view->render('profile',
            $datas
        );
    }

    /**
     * Ajout et modification d'un user.
     * On sait si un user est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateBook(): void
    {
        $this->checkIfUserIsConnected();


        // On récupère les données du formulaire.
        $id = Utils::request("id", -1);
        $title = Utils::request("title");
        $content = Utils::request("content");

        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Book.
        $book = new Book([
            'id' => $id, // Si l'id vaut -1, l'book sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser']
        ]);

        // On ajoute l'book.
        $bookRepository = new BookRepository();
        $bookRepository->addOrUpdateBook($book);

        // On redirige vers la page d'profile.
        Utils::redirect("profile");
    }

    /**
     * @return void
     */
    public function updateProfile()
    {
        $this->checkIfUserIsConnected();
    }


}