# Projet : API de Monitoring Serveur (HealthCheck API)

---
**Note**: [*/20 + bonus (1 à  3points en réserve)]

## Contexte et objectif

Vous êtes administrateur système dans une entreprise qui gère plusieurs serveurs. Votre responsable vous demande de développer une **API REST** qui permettra de surveiller l'état de santé des serveurs en temps réel. Cette API sera utilisée par un tableau de bord (dashboard) pour afficher les métriques de tous les serveurs de l'entreprise.

L'objectif est de créer une **sonde de monitoring** qui expose les informations système (CPU, RAM, disque, etc.) via des endpoints REST accessibles en HTTP.

**Technologies :** Libre choix (Python, Go, PHP, Node.js, Rust, Java, etc.)

---

## Organisation du projet

Le projet est divisé en **4 niveaux de difficulté**. Chaque niveau s'appuie sur le précédent.

| Niveau | Nom | Difficulté | Points |
|--------|-----|------------|--------|
| 🟢 | Base | Obligatoire | /20 |
| 🟡 | Intermédiaire | Bonus | +1 |
| 🔴 | Avancé | Bonus | +2 |
| ⭐ | Expert | Bonus | +3 |

---

# 🟢 NIVEAU 1 : BASE (Obligatoire)

## Objectif

Créer une API REST simple qui expose les métriques de base du serveur **sans authentification**.

## Endpoints à implémenter

| Endpoint | Méthode | Description |
|----------|---------|-------------|
| `/health` | GET | État général du serveur (UP/DOWN) |
| `/cpu` | GET | Utilisation du CPU (%) |
| `/memory` | GET | Utilisation de la RAM (%) |
| `/disk` | GET | Utilisation du disque (%) |
| `/system` | GET | Toutes les métriques en une seule requête |

## Exemples de réponses JSON

### GET /health

```json
{
  "status": "UP",
  "hostname": "serveur-prod-01",
  "checked_at": "2025-01-08T15:30:00Z"
}
```

### GET /cpu

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "cpu": {
    "usage_percent": 45.2,
    "cores": 4
  }
}
```

### GET /memory

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "memory": {
    "total_gb": 16.0,
    "used_gb": 10.5,
    "free_gb": 5.5,
    "usage_percent": 65.6
  }
}
```

### GET /disk

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "disk": {
    "total_gb": 500.0,
    "used_gb": 320.0,
    "free_gb": 180.0,
    "usage_percent": 64.0
  }
}
```

### GET /system

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "hostname": "serveur-prod-01",
  "status": "UP",
  "cpu": {
    "usage_percent": 45.2,
    "cores": 4
  },
  "memory": {
    "total_gb": 16.0,
    "used_gb": 10.5,
    "free_gb": 5.5,
    "usage_percent": 65.6
  },
  "disk": {
    "total_gb": 500.0,
    "used_gb": 320.0,
    "free_gb": 180.0,
    "usage_percent": 64.0
  },
  "uptime": {
    "days": 45,
    "hours": 12,
    "minutes": 30,
    "formatted": "45 jours, 12 heures, 30 minutes"
  }
}
```

## Livrables Niveau 1

- [ ] Code source de l'API
- [ ] Collection Postman avec tous les endpoints testés
- [ ] README avec instructions d'installation et d'exécution

---

# 🟡 NIVEAU 2 : INTERMÉDIAIRE

## Objectif

Ajouter des endpoints supplémentaires et un système d'alertes.

## Nouveaux endpoints

| Endpoint | Méthode | Description |
|----------|---------|-------------|
| `/os` | GET | Informations sur le système d'exploitation |
| `/load` | GET | Charge système (load average) |
| `/network` | GET | Statistiques réseau |
| `/processes` | GET | Nombre de processus actifs |
| `/processes/top` | GET | Top 5 des processus (CPU/RAM) |
| `/services` | GET | État des services (nginx, mysql...) |
| `/alerts` | GET | Liste des alertes si seuils dépassés |

## Seuils d'alertes

Pour le niveau 2, les seuils peuvent être codés en dur dans le code. Ils deviendront configurables au niveau 3.

| Ressource | Warning 🟡 | Critical 🔴 |
|-----------|------------|-------------|
| CPU | > 70% | > 90% |
| RAM | > 70% | > 85% |
| Disque | > 80% | > 90% |

## Exemples de réponses JSON

### GET /os

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "os": {
    "name": "Ubuntu",
    "version": "22.04.3 LTS",
    "architecture": "x86_64",
    "kernel": "5.15.0-91-generic"
  }
}
```

### GET /load

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "load_average": {
    "1_min": 0.52,
    "5_min": 0.48,
    "15_min": 0.45
  }
}
```

### GET /network

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "network": {
    "interfaces": [
      {
        "name": "eth0",
        "ip_address": "192.168.1.100",
        "mac_address": "00:1A:2B:3C:4D:5E",
        "bytes_sent_mb": 1250.5,
        "bytes_recv_mb": 3420.8
      }
    ],
    "total_connections": 42
  }
}
```

### GET /processes/top

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "top_processes": [
    { "pid": 1234, "name": "mysql", "cpu_percent": 25.4, "memory_percent": 15.2 },
    { "pid": 5678, "name": "nginx", "cpu_percent": 12.1, "memory_percent": 8.5 },
    { "pid": 9012, "name": "python", "cpu_percent": 8.7, "memory_percent": 6.3 }
  ],
  "total_processes": 156
}
```

### GET /services

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "services": [
    { "name": "nginx", "status": "running", "uptime": "5 days" },
    { "name": "mysql", "status": "running", "uptime": "5 days" },
    { "name": "redis", "status": "stopped", "uptime": null }
  ]
}
```

### GET /alerts

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "alerts": [
    {
      "type": "CPU",
      "level": "critical",
      "message": "CPU usage is at 94%",
      "value": 94,
      "threshold": 90
    },
    {
      "type": "DISK",
      "level": "warning",
      "message": "Disk usage is at 87%",
      "value": 87,
      "threshold": 85
    }
  ],
  "total_alerts": 2
}
```

> **Note :** Le champ `threshold` représente le **seuil** (la limite) à partir duquel une alerte est déclenchée.

## Livrables Niveau 2

- [ ] Tous les nouveaux endpoints fonctionnels
- [ ] Collection Postman mise à jour
- [ ] Tests des alertes avec différents seuils

---

# 🔴 NIVEAU 3 : AVANCÉ

## Objectif

Ajouter une couche d'authentification pour sécuriser l'API et rendre les seuils d'alertes configurables. Seul un administrateur peut créer des utilisateurs et modifier les seuils.

## Partie A : Seuils configurables

Les seuils d'alertes ne sont plus codés en dur dans le code. Ils sont stockés en base de données et modifiables par un admin via l'API.

### Table des seuils (SQLite)

```
TABLE: thresholds
├── id              (INTEGER, PRIMARY KEY)
├── resource        (TEXT: cpu/memory/disk)
├── warning_level   (INTEGER: pourcentage)
├── critical_level  (INTEGER: pourcentage)
├── updated_at      (TIMESTAMP)
└── updated_by      (INTEGER, FK vers users)
```

### Valeurs par défaut (créées au premier lancement)

| Ressource | Warning 🟡 | Critical 🔴 |
|-----------|------------|-------------|
| CPU | 70% | 90% |
| RAM | 70% | 85% |
| Disque | 80% | 90% |

### Endpoints de configuration des seuils

| Endpoint | Méthode | Description | Accès |
|----------|---------|-------------|-------|
| `/config/thresholds` | GET | Voir les seuils actuels | 🔒 Token |
| `/config/thresholds` | PUT | Modifier les seuils | 🔴 Admin |

### GET /config/thresholds

**Réponse :**

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "thresholds": {
    "cpu": {
      "warning": 70,
      "critical": 90
    },
    "memory": {
      "warning": 70,
      "critical": 85
    },
    "disk": {
      "warning": 80,
      "critical": 90
    }
  }
}
```

### PUT /config/thresholds

**Requête :**

```
PUT /config/thresholds
Headers:
  Authorization: Bearer <token_admin>
```

```json
{
  "cpu": {
    "warning": 60,
    "critical": 85
  },
  "memory": {
    "warning": 75,
    "critical": 90
  },
  "disk": {
    "warning": 70,
    "critical": 85
  }
}
```

**Réponse :**

```json
{
  "message": "Seuils mis à jour avec succès",
  "thresholds": {
    "cpu": { "warning": 60, "critical": 85 },
    "memory": { "warning": 75, "critical": 90 },
    "disk": { "warning": 70, "critical": 85 }
  },
  "updated_at": "2025-01-08T15:35:00Z",
  "updated_by": "admin"
}
```

> **Important :** L'endpoint `GET /alerts` doit maintenant utiliser les seuils de la base de données, et non des valeurs codées en dur.

---

## Partie B : Système d'authentification

## Principes

1. **Admin par défaut** : Au premier lancement, un compte admin est créé automatiquement
   - Username : `admin`
   - Password : `admin123`
   - ⚠️ Ce mot de passe doit être changé immédiatement

2. **Création d'utilisateurs** : Seul un admin peut créer de nouveaux utilisateurs

3. **Authentification par token** : Après login, l'utilisateur reçoit un token à utiliser dans le header `Authorization: Bearer <token>`

### Rôles et permissions

| Rôle | Permissions |
|------|-------------|
| `viewer` | Lecture seule (GET sur les métriques) |
| `technicien` | Lecture + exécution de commandes |
| `admin` | Accès total + gestion des utilisateurs |

### Base de données (SQLite)

```
TABLE: users
├── id              (INTEGER, PRIMARY KEY)
├── username        (TEXT, UNIQUE)
├── password_hash   (TEXT)
├── role            (TEXT: viewer/technicien/admin)
├── token           (TEXT)
├── token_expires   (TIMESTAMP)
├── created_at      (TIMESTAMP)
├── last_login      (TIMESTAMP)
└── must_change_password (BOOLEAN)
```

## Nouveaux endpoints

| Endpoint | Méthode | Description | Accès |
|----------|---------|-------------|-------|
| `/login` | POST | Se connecter et obtenir un token | 🟢 Public |
| `/logout` | POST | Se déconnecter | 🔒 Token |
| `/me` | GET | Voir mon profil | 🔒 Token |
| `/change-password` | POST | Changer mon mot de passe | 🔒 Token |
| `/users` | GET | Liste des utilisateurs | 🔴 Admin |
| `/users` | POST | Créer un utilisateur | 🔴 Admin |
| `/users/{id}` | GET | Détails d'un utilisateur | 🔴 Admin |
| `/users/{id}` | PUT | Modifier un utilisateur | 🔴 Admin |
| `/users/{id}` | DELETE | Supprimer un utilisateur | 🔴 Admin |

## Exemples de réponses JSON

### POST /login

**Requête :**

```json
{
  "username": "admin",
  "password": "admin123"
}
```

**Réponse (succès) :**

```json
{
  "message": "Connexion réussie",
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "user": {
    "id": 1,
    "username": "admin",
    "role": "admin",
    "permissions": ["read", "execute", "config", "users"]
  },
  "expires_at": "2025-01-09T15:30:00Z",
  "must_change_password": true
}
```

**Réponse (erreur) :**

```json
{
  "error": "Connexion échouée",
  "message": "Nom d'utilisateur ou mot de passe incorrect"
}
```

### POST /users (Admin crée un utilisateur)

**Requête :**

```
POST /users
Headers:
  Authorization: Bearer <token_admin>
```

```json
{
  "username": "jean.dupont",
  "password": "TempPassword123!",
  "role": "technicien"
}
```

**Réponse :**

```json
{
  "message": "Utilisateur créé avec succès",
  "user": {
    "id": 5,
    "username": "jean.dupont",
    "role": "technicien",
    "permissions": ["read", "execute"],
    "created_at": "2025-01-08T15:30:00Z"
  }
}
```

### GET /users (Liste des utilisateurs)

**Requête :**

```
GET /users
Headers:
  Authorization: Bearer <token_admin>
```

**Réponse :**

```json
{
  "checked_at": "2025-01-08T15:30:00Z",
  "users": [
    {
      "id": 1,
      "username": "admin",
      "role": "admin",
      "created_at": "2025-01-01T10:00:00Z",
      "last_login": "2025-01-08T14:00:00Z"
    },
    {
      "id": 2,
      "username": "jean.dupont",
      "role": "technicien",
      "created_at": "2025-01-05T09:00:00Z",
      "last_login": "2025-01-08T08:30:00Z"
    }
  ],
  "total": 2
}
```

### POST /change-password

**Requête :**

```json
{
  "current_password": "admin123",
  "new_password": "MonNouveauMotDePasse!456",
  "confirm_password": "MonNouveauMotDePasse!456"
}
```

**Réponse :**

```json
{
  "message": "Mot de passe modifié avec succès"
}
```

### Requête sans token (erreur 401)

```json
{
  "error": "Token manquant",
  "message": "Header 'Authorization: Bearer <token>' requis"
}
```

### Requête avec permission insuffisante (erreur 403)

```json
{
  "error": "Accès refusé",
  "message": "Permission 'admin' requise pour cette action"
}
```

## Livrables Niveau 3

- [ ] Seuils d'alertes stockés en BDD et configurables
- [ ] Endpoint `/config/thresholds` (GET et PUT)
- [ ] Système d'authentification fonctionnel
- [ ] Base de données SQLite avec tables `users` et `thresholds`
- [ ] Admin par défaut créé au premier lancement
- [ ] Tous les endpoints de gestion des utilisateurs
- [ ] Collection Postman avec exemples d'authentification

---

# ⭐ NIVEAU 4 : EXPERT (Bonus)

## Objectif

Créer un système de surveillance automatique qui envoie des alertes sur Discord quand les seuils sont dépassés.

## Fonctionnement

```
┌─────────────────────────────────────────────────────────────────┐
│                                                                 │
│   SERVEUR                              DISCORD                  │
│                                                                 │
│   ┌──────────────┐                     ┌─────────────────┐      │
│   │  Cron Job    │   Webhook           │  #alertes       │      │
│   │  (toutes les │ ─────────────────►  │                 │      │
│   │   5 minutes) │                     │  🔴 ALERTE !    │      │
│   └──────────────┘                     │  CPU à 94%      │      │
│          │                             └─────────────────┘      │
│          ▼                                                      │
│   Appelle GET /alerts                                           │
│          │                                                      │
│          ▼                                                      │
│   Si alertes > 0                                                │
│          │                                                      │
│          ▼                                                      │
│   Envoie vers Discord                                           │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

## Étape 1 : Créer un Webhook Discord

1. Aller dans votre serveur Discord
2. Paramètres du canal > Intégrations > Webhooks
3. Créer un webhook et copier l'URL

L'URL ressemble à :

```
https://discord.com/api/webhooks/1234567890/abcdefghijklmnop
```

## Étape 2 : Endpoint de configuration

### POST /config/discord

**Requête :**

```json
{
  "webhook_url": "https://discord.com/api/webhooks/1234567890/abcdefghijklmnop",
  "enabled": true,
  "notify_on": ["critical", "warning"]
}
```

**Réponse :**

```json
{
  "message": "Configuration Discord sauvegardée",
  "webhook_configured": true,
  "notify_on": ["critical", "warning"]
}
```

## Étape 3 : Script de monitoring (Cron Job)

Créez un script (dans le langage de votre choix) qui :

1. Appelle l'endpoint `GET /alerts` de votre API
2. Si des alertes existent, envoie une notification vers le webhook Discord
3. Est exécuté automatiquement via un cron job (toutes les 5 minutes par exemple)

### Configuration du Cron Job

```bash
# Ouvrir l'éditeur crontab
crontab -e

# Exemple : exécuter toutes les 5 minutes
*/5 * * * * /chemin/vers/votre/script >> /var/log/monitoring.log 2>&1
```

> **Indice :** Votre script doit faire une requête HTTP GET vers votre API, parser le JSON de réponse, et si `total_alerts > 0`, faire une requête HTTP POST vers le webhook Discord.

## Exemple de notification Discord

```
┌─────────────────────────────────────────────────────────────┐
│  🖥️ Monitoring Bot                           Aujourd'hui    │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  🚨 ALERTE MONITORING - serveur-prod-01                     │
│                                                             │
│  ┌─────────────────────────────────────────────────────┐    │
│  │ ⚠️ CPU - CRITICAL                                   │    │
│  │ CPU usage is at 94%                                 │    │
│  │                                                     │    │
│  │ Valeur actuelle    Seuil                            │    │
│  │ 94%                90%                              │    │
│  └─────────────────────────────────────────────────────┘    │
│                                                             │
│  ┌─────────────────────────────────────────────────────┐    │
│  │ ⚠️ DISK - WARNING                                   │    │
│  │ Disk usage is at 87%                                │    │
│  │                                                     │    │
│  │ Valeur actuelle    Seuil                            │    │
│  │ 87%                85%                              │    │
│  └─────────────────────────────────────────────────────┘    │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

## Livrables Niveau 4

- [ ] Endpoint `/config/discord` pour configurer le webhook
- [ ] Script `monitor.py` fonctionnel
- [ ] Documentation pour configurer le cron job
- [ ] Capture d'écran d'une notification Discord reçue

---

# 📦 Livrables finaux

## Barème de notation

| Niveau | Points | Description |
|--------|--------|-------------|
| 🟢 Niveau 1 (Base) | /20 | Projet complet pour les débutants |
| 🟡 Niveau 2 (Intermédiaire) | +1 | Bonus pour les motivés |
| 🔴 Niveau 3 (Avancé) | +2 | Bonus supplémentaire |
| ⭐ Niveau 4 (Expert) | +3 | Bonus final |

## Livrables

- [ ] Code source du projet
- [ ] Collection Postman

---

# 📚 Ressources utiles

## Frameworks Web par langage

| Langage | Frameworks suggérés |
|---------|---------------------|
| Python | Flask, FastAPI, Django REST |
| Go | Gin, Echo, Fiber |
| PHP | Laravel, Symfony, Slim |
| Node.js | Express, Fastify, NestJS |
| Java | Spring Boot |
| Rust | Actix, Rocket |

## Librairies pour métriques système

| Langage | Librairie |
|---------|-----------|
| Python | `psutil` |
| Go | `gopsutil` |
| PHP | `shell_exec()` avec commandes Linux |
| Node.js | `systeminformation` |

## Documentation API

- Postman : <https://www.postman.com/>
- Codes HTTP : <https://developer.mozilla.org/fr/docs/Web/HTTP/Status>

## Discord Webhooks

- Documentation : <https://discord.com/developers/docs/resources/webhook>

## Commandes Linux utiles

- `top`, `htop` : Utilisation CPU/RAM
- `free -m` : Mémoire disponible
- `df -h` : Espace disque
- `uptime` : Temps de fonctionnement
- `cat /etc/os-release` : Informations OS

---

**<Bon courage/>**
