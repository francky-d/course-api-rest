# PROJET DE GROUPE ADMIN SYS

Créer un projet Bash pour consommer l’API de [Dev.to](https://developers.forem.com/api/v1).
Il doit être interactif en ligne de commande. C'est à dire que 
Le programme de me permettre de donner la main pour entrer les 
informations au besoin, pour faire la requête exemple, l'ID d'un article 
ou le token pour les endpoints  qui le requièrent. 

## Fonctions à implémenter

Rappel : **Je dois avoir la main dans le terminal pour entrer  les paramètres nécessaires**

- `get_articles`  
    Récupère la liste des articles.

- `get_single_article`
   Prend en paramètre l’ID de l’article et retourne l’article correspondant.
   Avant qu'un article ne puisse être récupéré, il faut qu'il  soit publié.

- `publish_article`  
    Publie un nouvel article (prend les paramètres nécessaires à la création).

- `update_article`  
    Mets à jour un article existant (prend en paramètre l’ID de l’article).

- `get_tags`  
    Récupère la liste des tags.
    
- `get_comments`  
    Récupères les commentaires d'un article (prend en paramètre l’ID de l’article)
