$(document).ready(function () {
    const cssColor = $(":root").css("--secondary-warm-color-4");

    // Paramétrage de DataTable pour la liste des consommations
    $('#aliment').DataTable({
        pageLength: 6,
        lengthChange: false
    });

    // Paramétrage de Chart.js pour l'affichage d'un graphique temporel
    const data = {
        labels: [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi',
            'Dimanche'
        ],
        datasets: [{
            label: "grams",
            data: [300, 50, 100, 150, 79, 230, 18],
            backgroundColor: cssColor,
            hoverOffset: 4
        }]
      };

    const chart = $("#global-chart");
    new Chart(chart, {
        type: 'line',
        data: data,
        options :{
            responsive: true,
            aspectRatio: 7 / 2,
            maintainAspectRatio: true,
            plugins: {
                legend : false
            }
        }
    });

    // Paramétrage de la barre de progrès (fait maison !)
        // - Récupérer le ratio de progression de l'ingestion de calorie en fonction des besoins de l'utilisateur
        // - Modifier la variable dynamiquement :
    var progress = "50%";
    const progressBar = $("#bar");
    $(progressBar).css('width', progress);
    
});