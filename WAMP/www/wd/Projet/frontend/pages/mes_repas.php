<div class="wrapper mes_repas hidden">
    <div class="bloc add-btn">
        <button id="add-conso" onclick="addConso()">Ajouter un repas consommé</button>
    </div>
    <div class="bloc liste-repas">
        <table id="repas" class="hover row-border" style="width:100%;">
            <thead>
                <th style="max-width:50%;">Aliment</th>
                <th style="max-width:25%;">Quantité (g)</th>
                <th style="max-width:25%;">Date</th>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
function addConso(){
    $(".layer").removeClass("hidden");
}

function validateConso(){
    $(".layer").addClass("hidden");
}
</script>