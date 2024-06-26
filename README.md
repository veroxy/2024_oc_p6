# BASE PROJECT base_project_from_scracth_poo - 2024_oc_p6
--- 
## Initier un nouveau Projet

- [ ] Cloner le projet "git clone"
- [ ] Verifier le [.gitignore](.gitignore) er renomer en `.gitignore`
- [ ] Initier un nouveau repo 'git init"
   > - it init 
   > - git add README.md 
   > - git commit -m "first commit"
   > - git branch -M main 
   > - git remote add origin https://github.com/username/remote_repository.git
   > - git push -u origin main
   > - ou
   > - git remote add origin https://github.com/veroxy/base_project_from_scracth_poo.git
   > - git branch -M main 
   > - git push -u origin main

[//]: # (- [ ] Lancer la command "php [createproject.php]&#40;createproject.php&#41; nom-projet")

## 

## modifier l'[autoload](config/autoload.php)

autoload files
1. fonctions Utils / ft_
2. model class/entity
3. repositories
4. controllers
5. views

## modifier [config](config/config.php)
1. démarrer une session
2. definir les constantes
    - routes
    - index.php
    - dossier des [layouts](views/layouts)
   > /!\ créer une model View pour pouvoir générer chaque vue
3. parametre de bdd - datas
   - lancer le script sql pour la migration 
   - migrer les fixtures des tables simples ()
   - migrer dans un 3e temps les fixtures des tables de liaison (user_has_book, book_has_author, etc)

---

 - BDD : 2024_oc_p6_tomtroc

## design
1. font :
   - Playfair Display
2. couleur :
   - vert : #00AC66
   - gris-beige : #F5F3EF


## TODO specifificites 
Spécifications pour le site TomTroc
Le but de ce projet est de réaliser un site permettant la mise en contact de
lecteurs, afin qu’ils puissent partager et échanger leurs livres.
Ce projet est un MVP, c'est-à-dire “Minimal Viable Product”, une première
version qui doit fonctionner mais sera rapidement améliorée à l’avenir.
Le but est, dans un premier temps, d’implémenter les fonctionnalités
principales du projet. Elles seront amenées à évoluer par la suite ; c’est
pourquoi le choix d’une architecture Modèle-Vue-Contrôleur est important.
En particulier, deux points peuvent être laissés en suspens pour l’instant :
● Il n’est pas nécessaire de réaliser de partie admin pour modérer les
utilisateurs ou les livres.
● La partie responsive est un plus (les maquettes sont fournies), mais
reste facultative.
Voici la liste des fonctionnalités qui devront être implémentées :
1. [x] Inscription et connexion des membres :
   Les utilisateurs pourront s’inscrire directement. Il n’est pas nécessaire
   de faire une validation par mail ou par un administrateur. Une fois
   l’utilisateur inscrit, il pourra se connecter.
2. [ ] Page de profil des utilisateurs :
   L’utilisateur pourra modifier son propre profil et consulter celui des
   autres utilisateurs.
   - [ ] Il n’y a pas de pages listant l’intégralité des profils
      des utilisateurs. 
   - [ ] La mise en relation se fera uniquement par
      l'intermédiaire de la bibliothèque. *sendMessage()*
3. [ ] La bibliothèque personnelle présente dans la page “Mon
   compte” :
      - Les utilisateurs pourront se créer une bibliothèque personnelle pour
   décrire leurs livres ; chaque livre possède en particulier : 
        - a. Un champ titre.
        - b. Un champ “auteur” : pour cette V1, nous pouvons nous
   contenter d’un simple champ texte, mais si vous voulez aller
   plus loin en séparant nom, prénom, pseudo, ou en ajoutant
   carrément une table “auteur”, c’est parfaitement envisageable ;
   faites juste attention à rester cohérent et à ne pas perdre trop
   de temps !
         - c. Une image : ce champ peut rester vide lorsqu’un livre est créé.
         - d. Une description : le commentaire peut être un très long texte.
         - e. Un statut de disponibilité : est-ce que ce livre est disponible à
   l’échange ? Vous pouvez ajouter d’autres statuts si vous
   l’estimez nécessaire.
4. [ ] La page “Nos livres à l’échange”
   Cette page permet de consulter les livres qui sont disponibles à
   l’échange. Il faut également y incorporer un champ de recherche.
   Pour la V1, filtrer en fonction du titre du livre est suffisant. Libre à
   vous d’implémenter une recherche plus complexe si vous voulez,
   mais là encore, veillez à rester cohérent dans le design et à ne pas
   perdre trop de temps !
5. [ ] Détail d’un livre :
   Cette page permet de voir le détail d’un livre. 
   - [ ] Elle possède aussi un lien vers le profil de la personne qui possède ce livre, et un lien pour
      pouvoir envoyer un message à cette personne.
6. [ ] La messagerie :
   Il faudra au minimum :
   ○ pouvoir consulter la liste des messages reçus ;
   ○ pouvoir voir un fil de discussion ;
   ○ pouvoir envoyer un message et répondre.
   Pour la messagerie elle-même, je vous laisse décider jusqu’où aller
   pour les fonctionnalités pour la V1, il n’est pas requis d’avoir de mise
   en forme.