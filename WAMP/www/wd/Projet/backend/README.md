# Projet IDAW - BackEnd

## API

Note : Les informations facultatives sont indiquées entre crochets []

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

```POST :ROOT/aliments```
- Crée un aliment à partir des informations données
- Body : informations de l'aliment
    ```JSON
    {
        "label": {$label},
        "type": {$id_type}
    }
    ```
- Output : Message de confirmation et ID du nouvel aliment 

```PUT :ROOT/aliments?id=:ID```
- Modifie un aliment à partir des informations données
- Body : informations de l'aliment
    ```JSON
    {
        ["label": {$label},]
        ["type": {$id_type}]
    }
    ```
- Output : Message de confirmation et aliment modifié

```DELETE :ROOT/aliments?id=:ID```
- Supprime un aliment correspondant à l':ID donné
- Body : none
- Output : Message de confirmation

---

> :ROOT/users

```POST :ROOT/users```
- Ajoute un utilisateur sur le site
- Body : informations de l'utilisateur
    ```JSON
    {
        "login": {$login},
        "mdp": {$mdp},
        "niveau": {$niveau},
        "sexe": {$sexe},
        "naissance": {$naissance}
    }
    ```
- Output : message de confirmation

```PUT :ROOT/users?id=:ID```
- Modifie les informations de l'utilisateur à l'ID donnée
- Body : informations de l'utilisateur :ID
    ```JSON
    {
        ["login": {$login},]
        ["mdp": {$mdp},]
        ["niveau": {$niveau},]
        ["sexe": {$sexe},]
        ["naissance": {$naissance}]
    }
    ```
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
    ```JSON
    {
        "login": {$login},
        "mdp": {$mdp}
    }
    ```
- Output : message de confirmation

---

> :ROOT/users/consommation

```POST :ROOT/users/consommation```
- Ajoute un plat consommé par l'utilisateur connecté
- Body : informations du plat
    ```JSON
    {
        "id_user": {$id_user},
        "id_aliment": {$id_aliment},
        "quantite": {$quantite},
        "date": {$date}
    }
    ```
- Output : message de confirmation

```PUT :ROOT/users/consommation?id=:ID```
- Modifie un plat renseigné par l'utilisateur connecté
- Body : informations du plat consommatié :ID
    ```JSON
    {
        "id_user": {$id_user},
        "id_aliment": {$id_aliment},
        ["quantite": {$quantite},]
        ["date": {$date}]
    }
    ```
- Output : message de confirmation

```GET :ROOT/users/consommation?last=:NB```
- Récupère la liste des derniers repas de l'utilisateur connecté
- Body : none
- Output : liste des :NB derniers repas

```GET :ROOT/users/consommation?from=:NB1&to=:NB2```
- Récupère une sous-liste de repas parmi les repas enregistrés
- Body : none
- Output : liste des repas de la consommation :NB1 à :NB2