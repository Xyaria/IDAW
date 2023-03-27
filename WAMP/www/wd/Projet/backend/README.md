# Projet IDAW

## Présentation
bla  

## API

---

> :ROOT/aliments

```GET :ROOT/aliments```  
- Récupère la liste des aliments
- Body : none
- Output : liste de tous les aliments

```GET :ROOT/aliments?id=:ID```
- Récupère les détails de l'aliment à l'ID donnée
- Body : none
- Output : détails de l'aliment spécifié

```GET :ROOT/aliments?from=:ID&nb=:NB```
- Récupère une liste d'un nombre d'aliments donné et leur détails à partir de l'aliment à l'ID donnée
- Body : none
- Output : détails des :NB aliments spécifiés à partir de l'aliment :ID  

---

> :ROOT/users

```POST :ROOT/users```
- Ajoute un utilisateur sur le site
- Body : informations de l'utilisateur
- Output : message de confirmation

```PUT :ROOT/users?id=:ID```
- Modifie les informations de l'utilisateur à l'ID donnée
- Body : informations de l'utilisateur :ID
- Output : message de confirmation

```DELETE :ROOT/users?id=:ID```
- Supprime l'utilisateur à l'ID donnée
- Body : none
- Output : message de confirmation

---

> :ROOT/users/connect

```POST :ROOT/users/connect```
- Connecte un utilisateur sur le site
- Body : informations de l'utilisateur
- Output : message de confirmation

---

> :ROOT/users/consommation

```POST :ROOT/users/consommation```
- Ajoute un plat consommé par l'utilisateur connecté
- Body : informations du plat
- Output : message de confirmation

```PUT :ROOT/users/consommation?id=:ID```
- Modifie un plat renseigné par l'utilisateur connecté
- Body : informations du plat de la consommation :ID
- Output : message de confirmation

```GET :ROOT/users/consommation?last=:NB```
- Récupère la liste des derniers repas de l'utilisateur connecté
- Body : none
- Output : liste des :NB derniers repas

```GET :ROOT/users/consommation?from=:NB1&to=:NB2```
- Récupère une sous-liste de repas parmi les repas enregistrés
- Body : none
- Output : liste des repas de la consommation :NB1 à :NB2