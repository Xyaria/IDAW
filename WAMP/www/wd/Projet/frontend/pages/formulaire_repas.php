<div class="layer hidden">
    <div class="bloc">
        <span onclick="$('.layer').addClass('hidden');">
            <i class="fa-solid fa-xmark"></i>
        </span>
        <h3>Ajouter un aliment consommé</h3>
        <form onsubmit="event.preventDefault();">
            <table>
                <tr>
                    <td colspan=2>
                        <label>Aliment consommé <br>(écrire pour rechercher, cliquer pour valider le choix)</label>
                        <br>
                        <input list="db_aliments" name="aliment_label">
                        <datalist id="db_aliments">
                            <script>
                                $.ajax({
                                    url: API_PATH + '/aliments',
                                    method: 'GET',
                                    dataType: 'json'
                                })
                                .done((aliments) => {
                                    aliments.forEach(aliment => {
                                        $("#db_aliments").append('<option id="' + aliment['ID'] + '" value="'+ aliment['Nom'] +'">');
                                    });
                                });
                            </script>
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Quantité (g)</label>
                        <br>
                        <input type="number" name="aliment_quantity">
                    </td>
                    <td>
                        <label>Date de consommation</label>
                        <br>
                        <input type="date" name="aliment_date">
                    </td>
                </tr>
            </table>
            <input type="submit">
        </form>
    </div>
</div>