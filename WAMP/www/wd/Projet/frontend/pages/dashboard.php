<?php 
function dashboard($isConnected){
    if(!$isConnected){
        echo '<div class="wrapper dashboard hidden">';
    }
    else{
        echo '<script>$(document).ready(function() {updatePage_dashboard();});</script>';
        echo '<div class="wrapper dashboard">';
    }
    echo   
        '<div class="bloc progress">
            <div class="bar-container">
                <div id="bar"></div>
            </div>
            <div class="text">
                <p id="calories-count"></p>
                <p id="calories-message"></p>
            </div>
        </div>
        <div class="bloc chart">
            <h2>Nutriments du jour</h2>
            <canvas id="global-chart"></canvas>
        </div>
        <div class="bloc table">
            <h2>Résumé des derniers repas</h2>
            <table id="conso-summary" class="hover row-border">
                <thead>
                    <th>Aliment</th>
                    <th>Quantité</th>
                    <th>Date</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>';
}
?>