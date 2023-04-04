<div class="wrapper dashboard">
    <div class="bloc progress">
        <div class="bar-container">
            <div id="bar"></div>
        </div>
        <div class="text">
            <p id="calories-count">1950/2500 kcal</p>
            <p id="calories-message">Continue comme ça !</p>
        </div>
        <!--Progression de l'utilisateur dans son ingestion de calorie-->
    </div>
    <div class="bloc chart">
        <canvas id="global-chart"></canvas> 
        <!--Mettre un graphique de la consommation en fonction du temps ?
         Du genre, taux d'un certain nutriment (soit fixe mais peu pertinent, soit variable mais complexe) 
         ou rappel des calories ?-->
    </div>
    <div class="bloc table">
        <table id="aliment" class="hover row-border">
            <thead>
                <th></th>
                <!--Noms de colonnes-->
            </thead>
            <tbody>
                <tr>
                    <td></td>
                </tr>
                <!--Données-->
            </tbody>
        </table>
    </div>
</div>