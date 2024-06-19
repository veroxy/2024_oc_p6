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
