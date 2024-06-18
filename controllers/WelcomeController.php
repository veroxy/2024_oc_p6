<?php

class WelcomeController
{
    /**
     * @return void
     */
    public function welcome()
    {
        // On affiche la page d'accueil.de
        $bookRepo = new repositories\BookRepository();
        $books    = $bookRepo->getFouthLastBooks();
        $view     = new View("Accueil");
        $view->render("welcome", ["books" =>$books]);
    }
}