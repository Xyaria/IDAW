# API Documentation  

## Méthode GET
### ```GET /users```
Renvoie la liste de tous les utilisateurs sous le format suivant :
```JSON
{
    "id": ":userID",
    "name": ":userName",
    "mail": ":userMail"
}
```

### ```GET /users/:id```
Renvoie l'utilisateur ayant l'ID correspondant :
```JSON
{
    "id": ":userID",
    "name": ":userName",
    "mail": ":userMail"
}
```
  
---

## Méthode POST
### ```POST /users```
*paramètre : chaîne JSON comportant un attribut 'nom' ET un attribut 'mail'*  
  
Ajoute à la base de donnée l'utilisateur envoyé.  
Renvoie sa localisation et les informations de l'utilisateur créé : 
```JSON
{
    "status": ":status",
    "message": ":message",
    "Location": ":userLocation",
    "User": {
        "id": ":userID",
        "name": ":userName",
        "mail": ":userMail"
    }
}
```
  
---

## Méthode PUT
### ```PUT /users/:id```
*paramètre : chaîne JSON comportant un attribut 'nom' OU un attribut 'mail'*  
  
Met à jour l'utilisateur ayant l'ID correspondant avec les informations envoyées  
Renvoie un message de confirmation avec la localisation de l'utilisateur ou un message d'erreur  
  
---

## Méthode DELETE
### ```DELETE /users/:id```
Supprimer l'utilisateur ayant l'ID correspondant  
Renvoie un message de confirmation ou un message d'erreur  

---

## Précisions
- Les ID doivent être numériques ; une ID non-numérique renverra une erreur 400, tandis qu'une ID inexistante renverra une erreur 404
- Lors de la modification des informations d'un utilisateur, un message spécial sera renvoyé si les nouvelles informations sont identiques aux précédentes