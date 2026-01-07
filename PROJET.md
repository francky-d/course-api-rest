# Clone de DEV.to

## Diagramme de Classes

```mermaid
classDiagram
    class User {
        +int id
        +string nom
        +string prenom
        +string email
        +string password
        +text bio
        +string role
        +timestamp created_at
        +timestamp updated_at
    }

    class Post {
        +int id
        +string titre
        +text contenu
        +string slug
        +int views_count
        +int user_id
        +int category_id
        +timestamp created_at
        +timestamp updated_at
    }

    class Category {
        +int id
        +string nom
        +text description
        +string slug
        +timestamp created_at
        +timestamp updated_at
    }

    class Comment {
        +int id
        +text contenu
        +int user_id
        +int post_id
        +timestamp created_at
        +timestamp updated_at
    }

    class Series {
        +int id
        +string nom
        +text description
        +string slug
        +int user_id
        +timestamp created_at
        +timestamp updated_at
    }

    class Like {
        +int id
        +int user_id
        +int post_id
        +timestamp created_at
    }

    class Favorite {
        +int id
        +int user_id
        +int post_id
        +timestamp created_at
    }

    class Follower {
        +int id
        +int follower_id
        +int following_id
        +timestamp created_at
    }

    class PostSeries {
        +int id
        +int post_id
        +int series_id
        +timestamp created_at
    }

    %% Relations
    User "1" --> "0..*" Post : écrit
    User "1" --> "0..*" Comment : écrit
    User "1" --> "0..*" Series : crée
    User "1" --> "0..*" Like : aime
    User "1" --> "0..*" Favorite : favori
    User "1" --> "0..*" Follower : suit (follower)
    User "1" --> "0..*" Follower : suivi par (following)
    
    Category "1" --> "0..*" Post : contient
    
    Post "1" --> "0..*" Comment : contient
    Post "1" --> "0..*" Like : reçoit
    Post "1" --> "0..*" Favorite : mis en favori
    Post "0..*" --> "0..*" Series : appartient à
    
    PostSeries --> Post
    PostSeries --> Series
```

## Fonctionnalités (CRUD)

### C=Create | R=Read | U=Update | D=Delete

#### C.R.U.D DE CATEGORY

- Gestion complète des catégories

#### C.R.U.D DE POST

- Dans la liste des postes, renvoyer 5 posts de même catégories
- Gérer le nombre de vues du post
- Recherche globale sur les posts par mot clés

#### C.R.U.D DE COMMENTS

- Renvoyer la liste des commentaires par post

#### C.R.U.D DE FOLLOWERS

- Suivre/Ne plus suivre des utilisateurs

#### C.R.U.D DE SERIES

- Renvoyer la liste des posts pour une série

### Fonctionnalités supplémentaires

- Ajouter un post en favoris
- Supprimer un post des favoris
- Liker un post
- Unlike un post

## Notes Techniques

### Relations importantes

1. **User ↔ Post** : Un utilisateur peut créer plusieurs posts (1:N)
2. **Category ↔ Post** : Une catégorie contient plusieurs posts, un post appartient à une seule catégorie (1:N)
3. **Post ↔ Series** : Un post peut appartenir à plusieurs séries (N:N via table pivot PostSeries)
4. **User ↔ User (Followers)** : Relation réflexive many-to-many pour le système de suivi
5. **User ↔ Post (Likes)** : Un utilisateur peut liker plusieurs posts (N:N)
6. **User ↔ Post (Favorites)** : Un utilisateur peut avoir plusieurs posts en favoris (N:N)
