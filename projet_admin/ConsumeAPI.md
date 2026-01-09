# PROJET DE GROUPE ADMIN SYS (*/20)

Créer un projet Bash pour consommer l’API de [Dev.to](https://developers.forem.com/api/v1).
Il doit être interactif en ligne de commande. C'est à dire que
Le programme de me permettre de donner la main pour entrer les
informations au besoin, pour faire la requête exemple, l'ID d'un article
ou le token pour les endpoints  qui le requièrent.

## Fonctions à implémenter

Rappel : **Je dois avoir la main dans le terminal pour entrer  les paramètres nécessaires**

- `get_articles`  **(1 point)**
    Récupère la liste des articles.

- `get_single_article` **(2 points)**
   Prend en paramètre l’ID de l’article et retourne l’article correspondant.
   Avant qu'un article ne puisse être récupéré, il faut qu'il  soit publié.

- `publish_article` **(3,5 points)**
    Publie un nouvel article (prend les paramètres nécessaires à la création).

- `update_article`   **(3,5 points)**
    Mets à jour un article existant (prend en paramètre l’ID de l’article).

- `get_tags`  **(1 point)**
    Récupère la liste des tags.

- `get_comments` **(2 points)**
    Récupère les commentaires d'un article.

- `my_published_articles` **(2 points)**
   récupère uniquement mes articles que j'ai créé et qui sont publiés

- `my_unpublised_articles` **(2 points)**
   récupère uniquement mes articles que j'ai créé mais qui ne sont publiés

**NB** `cohésion de groupe` : (réponse aux questions, participation, collaboration) **(3 points - c'est individuel)**
