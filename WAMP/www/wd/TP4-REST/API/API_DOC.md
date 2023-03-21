# API Documentation  

## Méthode GET
### ```GET /users```
Renvoie la liste de tous les utilisateurs

### ```GET /users/:id```
Renvoie l'utilisateur ayant l'ID correspondant
  
---

## Méthode POST
### ```POST /users```
*paramètre : chaîne JSON comportant un attribut 'nom' ET un attribut 'mail'*  
  
Ajoute à la base de donnée l'utilisateur envoyé.  
Renvoie sa localisation  
  
---

## Méthode PUT
### ```PUT /users/:id```
*paramètre : chaîne JSON comportant un attribut 'nom' OU un attribut 'mail'*  
  
Met à jour l'utilisateur ayant l'ID correspondant avec les informations envoyées  
  
---

## Méthode DELETE
### ```DELETE /users/:id```
Supprimer l'utilisateur ayant l'ID correspondant