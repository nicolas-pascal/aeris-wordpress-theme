# Wordpress - Thème Aeris 

## Licence Creative Commons, CC-by-nc-sa. 
> https://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr 

===

## Change logs

### 2.2.0
- add thumbnail support on RSS feeds
- translation fix on 404 page
- remove post_author on post

### 2.0.2
- update theme_aeris_show_categories() function for polylang URL

### 2.0.1
- Correctif script toc.js pour Theia-wpth-child
- Ajout du template author.php
- Ajout du lien vers author.php dans single.php

### 2.0.0
- Correctif CSS 
  - padding sur le template catalogue
  - footer des articles en mode "embedé"
  - modif bouton categorie, arrondi, et :hover à la couleur dominante choisi
- Ajout Google font "Open Sans" pour tous les headers html (h1 > h6)
- Ajout Google font "Roboto" pour les textes
- Ajout du template TOC , page avec table des matières en "sticky menu" à gauche
- Modifs templates des posts embarqués (positionnement des catégories / date)

### 1.9.1
- correctif sur la couleur par défaut du footer (background + typo)

### 1.9.0
> les utilisateurs sont rois, je rajoute des options de personnalisation, préparez les lunettes de protections...
- option "Black theme" 
- option Footer background + text color 
- option background image ( c'est ici que les sites s'auto-détruiront, adieu sobriété... )
- correction CSS sur homepage custom, section de droite pour le display "Tous en boite"
- suppression de la feuille de style boxes.css (inclus maintenant dans style.css), ajout d'attribut dans <body> 
- Passage des font-size en rem dans les menus
- correctif CSS du widget FooGallery sur la taille du figcaption en hover
- correctif CSS bouton "See all" plugin Aeris widget Taxonomies list article
- correctif condition affichage breadcrumb sur homepage custom
- Modification de la page 404. Ajout du texte si pas de droits suffisants pour accèder à la recherche.


### 1.8.5
- update readme file licence creative commons

### 1.8.3
- Option breadcrumb
    - Ajout d'une option dans l'outil de personnalisation pour afficher ou pas le breadcrumb (defaut : non affiché)

- désactivation des liens "login /logout" dans l'emplacement de menu header (liens générés incorrects)
    - function *"function theme_aeris_add_login_logout_register_menu()"* dans custom-nav.php à adapter pour iThemes security

### 1.8.2

- Correctifs CSS
    - Menu qui dépasse sur Template catalogue corrigé
    - figcaption, suppression des marges top et bottom
    - padding-top sur template Fullwidth
    - padding-top sur [id="masterhead"]
    - cookie notice button, couleur en fonction du thème
    - .feedzy-rss ul {margin: 0;}

-  Masquage la barre d'admin pour les utilisateurs n'ayant aucun droit d'édition
    - Ajout de la fonction *"function theme_aeris_hide_admin_bar()"* dans inc/custom-rights
    - Correctifs css
    - Le plugin "Auto Hide Admin Bar" n'est plus nécessaire.

- Affichage Titre sans logo

- Ajout des liens "log in" "log out" dans l'emplacement de menu header
    - ajout de la fonction *"function theme_aeris_add_login_logout_register_menu()"* dans custom-nav.php

- Correction du copyright par défaut

### 1.8.1

- Correctifs CSS 
    - [id="content-area"].default > main pour pallier bug dans webcomponent
    - Line height fil d'ariane
    - Gestion des débordements, césure (td,th,p,a,input)
    - suppression de l'opacité sur l'image d'en-tête
    - ajout d'un wrapper-content sur le widget texte en display "tous en boite"
    - Suppression des légendes des images widget dans la zone de widget "Foire aux logos"

- Correctif du fichier home.php , retour à la normale
    les pages d'acceuil custom sont à utiliser avec une page de modèle "homepage custom"

- ajout d'une condition d'affichage sur l'emplacement de menu header (pas d'affichage si pas de menu affecté à la zone)
- Editeur caché pour le modèle de page "homepage custom" (extras.php)

### 1.8.0

- Correctif sur l'image des posts: ajout de l'image size "single-article"
- Nouvelle page d'accueil par défaut home.php, intégrant les zones de widgets "homepage", en remplacement de homepage custom (template-homepage.php)
- add template pour les posts embarqués (figure / titre / date / tags )
- correctifs css sur les zones de widgets "homepage"


### 1.7.10

Ajout d'une condition sur les items de menu (plugin If Menu) pour filtrer sur le modèle de page "Catalogue / application Webcomponents" 
    - inc/custom-nav.php : *theme_aeris_menu_conditions()*

    1.7.9 >> FAIL sur numéro de version dans CSS

### 1.7.8

    Ajout du modèle de page "Catalogue / application Webcomponents" > template-catalogue.php
    CSS pour redimensionner le header et supprimer le footer
    Suppression du modèle de page "Page vierge pour divi builder" > template-blank.php

### 1.7.7

    ajout gestion des nouvelles couleurs dans le customizer avec color picker > inc/customizer.php


---------------


