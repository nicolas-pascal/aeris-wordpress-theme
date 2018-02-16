# Wordpress - Thème Aeris 
===

## Change logs

### 1.8.2

- Correctifs CSS
    - Menu qui dépasse sur Template catalogue corrigé X
    - figcaption, suppression des marges top et bottom X
    - padding-top sur template Fullwidth X
    - padding-top sur [id="masterhead"] X
    - cookie notice button
    - .feedzy-rss ul {margin: 0;} X

- Bricole CSS sur template catalogue pour le déploiement top menu admin, via plugin Auto Hide Admin Bar, afin qu'il ne passe pas sur le menu

- Affichage Titre sans logo X

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

Ajout d'une condition sur les items de menu pour l'utilisation du modèle de page "Catalogue / application Webcomponents" > inc/custom-nav.php

    1.7.9 >> FAIL sur numéro de version dans CSS

### 1.7.8

    Ajout du modèle de page "Catalogue / application Webcomponents" > template-catalogue.php
    CSS pour redimensionner le header et supprimer le footer
    Suppression du modèle de page "Page vierge pour divi builder" > template-blank.php

### 1.7.7

    ajout gestion des nouvelles couleurs dans le customizer avec color picker > inc/customizer.php


---------------


