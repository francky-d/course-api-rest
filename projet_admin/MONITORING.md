
#  Projet : API de Monitoring Serveur (HealthCheck API)

## Contexte et objectif

Vous êtes administrateur système dans une entreprise qui gère plusieurs serveurs. Votre responsable vous demande de développer une **API REST** qui permettra de surveiller l'état de santé des serveurs en temps réel. Cette API sera ensuite utilisée par un tableau de bord (dashboard) pour afficher les métriques de tous les serveurs de l'entreprise. L'objectif est de créer une **sonde de monitoring** qui expose les informations système (CPU, RAM, disque, uptime) via des endpoints REST accessibles en HTTP.

## Travail demandé

Développez une API REST (en **Python/Flask**, **Go**, ou **PHP**) qui expose les endpoints suivants : `GET /health` (état général : UP/DOWN), `GET /cpu` (pourcentage d'utilisation CPU), `GET /memory` (utilisation RAM en % et en Go), `GET /disk` (utilisation disque en % et en Go), et `GET /system` (toutes les métriques en une seule requête). Toutes les réponses doivent être au format **JSON**. Vous devez également créer une **collection Postman** documentant chaque endpoint avec des exemples de requêtes et réponses. **Bonus** : ajoutez un endpoint `GET /alerts` qui renvoie des alertes si CPU > 90%, RAM > 85%, ou Disque > 90%.

## Exemples de réponses JSON attendues

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

### GET /system (toutes les métriques)

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
