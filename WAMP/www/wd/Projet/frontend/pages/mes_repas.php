<div class="wrapper mes-repas hidden">
    <div class="bloc btns">
        <button id="add-conso" onclick="addConso()">Ajouter un repas consommé</button>
        <button id="modify-conso" onclick="modifyConso()">Modifier le repas sélectionné</button>
        <button id="delete-conso" onclick="deleteConso()">Supprimer le repas sélectionné</button>
    </div>
    <div class="bloc liste-repas">
        <table id="repas" class="hover row-border" style="width:100%;">
            <thead>
                <th>ID</th>
                <th style="max-width:50%;">Aliment</th>
                <th style="max-width:25%;">Quantité (g)</th>
                <th style="max-width:25%;">Date</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>