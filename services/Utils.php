<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('welcome');
 */
class Utils
{
    public function __construct()
    {
        echo 'utils fonction';
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return bool
     */
    public static function user(): bool
    {
        // On vérifie que l'utilisateur est connecté.
        $userConnected = isset($_SESSION['user']) ? true : false;
                return $userConnected;
    }

    /**
     * Convertit une date vers le format de type "Samedi 15 juillet 2023" en francais.
     * @param DateTime $date : la date à convertir.
     * @return string : la date convertie.
     */
    public static function convertDateToFrenchFormat(DateTime $date): string
    {
        // Attention, s'il y a un soucis lié à IntlDateFormatter c'est qu'il faut
        // activer l'extention intl_date_formater (ou intl) au niveau du serveur apache. 
        // Ca peut se faire depuis php.ini ou parfois directement depuis votre utilitaire (wamp/mamp/xamp)
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
//        $dateFormatter->setPattern('EEEE d MMMM Y ');
        $dateFormatter->setPattern('dd.MM HH:mm:ss');
        return $dateFormatter->format($date);
    }

    /**
     * Cette méthode protège une chaine de caractères contre les attaques XSS.
     * De plus, elle transforme les retours à la ligne en balises <p> pour un affichage plus agréable.
     * @param string $string : la chaine à protéger.
     * @return string : la chaine protégée.
     */
    public static function format(string $string): string
    {
        // Etape 1, on protège le texte avec htmlspecialchars.
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        // Etape 2, le texte va être découpé par rapport aux retours à la ligne,
        $lines = explode("\n", $finalString);

        // On reconstruit en mettant chaque ligne dans un paragraphe (et en sautant les lignes vides).
        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }

        return $finalString;
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []): void
    {
        $url = "index.php?action=$action";

        foreach ($params as $paramName => $paramValue) {
            $extends =  is_string($paramName) ? "&$paramName=$paramValue" : $paramValue;
            $url .= $extends;
        }
        header("Location: $url");
        exit();
    }

    /**
     * Cette méthode retourne le code js a insérer en attribut d'un bouton.
     * pour ouvrir une popup "confirm", et n'effectuer l'action que si l'utilisateur
     * a bien cliqué sur "ok".
     * @param string $message : le message à afficher dans la popup.
     * @return string : le code js à insérer dans le bouton.
     */
    public static function askConfirmation(string $message): string
    {
        return "onclick=\"return confirm('$message');\"";
    }

    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null): mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    /**
     * Permet de gerer l'ajout de la class .active selon la colonne triée
     * @param string $refOrder : valeur asc/desc dans la vue
     * @param string $refCol : titre de la colonne dans la vue
     * @param string $col :  valeur asc/desc donnee par la db
     * @param string $order valeur de la colonne par la db
     * @return string
     */
    public static function addClassActive(string $refOrder, string $refCol, string $col, string $order): string
    {
        $refOrder = strtolower($refOrder);
        $order = strtolower($order);
        $refCol = strtolower($refCol);
        $col = strtolower($col);

        if ($refOrder == $order && $refCol == $col) {
            $refOrder .= " active";
        }
        return $refOrder;
    }

    /**
     * @param  $dateOrigin
     * @return string
     * @throws Exception
     */
    public static function dateIntervalDuration($dateOrigin)
    {
        $dateEnd = new DateTime(); // 'now' default
        $interval = $dateEnd->diff($dateOrigin);
        // params accepte par format '%y years, %d days, %H hours, %I minutes, %S seconds';
        if ($interval->y < 1) {
            return $interval->format('%d jour(s)');
        } else {
            return $interval->format('%y an(s)');
        }
    }

    /**
     * return a truncate sentence with limited nb words
     * @param string $text
     * @param int $limit
     * @return string
     */
    public static function limitText(string $text, int $limit): string
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

}