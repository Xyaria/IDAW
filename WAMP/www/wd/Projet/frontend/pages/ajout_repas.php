<div class="layer hidden">
    <div class="bloc">
        <h3>Ajouter un aliment consommé</h3>
        <form onsubmit="event.preventDefault();">
            <table>
                <tr>
                    <td colspan=2>
                        <label>Aliment consommé (choisir parmi la liste)</label>
                        <br>
                        <input list="db_aliments">
                        <datalist id="db_aliments">
                            <script>
                                $.ajax({
                                    url: '../backend/api/aliments',
                                    method: 'GET',
                                    dataType: 'json'
                                })
                                .done((aliments) => {
                                    aliments.forEach(aliment => {
                                        $("#db_aliments").append('<option value="'+ aliment['Nom'] +'">');
                                    });
                                });
                            </script>
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Quantité</label>
                        <br>
                        <input type="number">
                    </td>
                    <td>
                        <label>Date de consommation</label>
                        <br>
                        <input type="date">
                    </td>
                </tr>
            </table>
            <input type="submit" onclick="validateConso();">
        </form>
    </div>
</div>