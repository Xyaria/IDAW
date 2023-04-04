$(document).ready(function () {
    const warmColor4 = $(":root").css("--secondary-warm-color-4");

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
        ], // récupérer aurjourd'hui et les 6 dates précédentes (potentiellement garder les jours, où mettre format jj/mm/aaaa)
        datasets: [{
            label: "grammes",
            data: [300, 50, 100, 150, 79, 230, 18], // à récupérer en fonction de la date d'aujourd'hui
            backgroundColor: warmColor4,
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

    // Paramétrage de la barre de progrès
        // - Récupérer l'ingestion de calorie de l'utilisateur
        // - Calculer le ratio (ici ?) en fonction de ses besoins journaliers
        // - Modifier la variable dynamiquement :
    
    var calories = 1800; // à récupérer
    var caloriesMax = 2500; // à calculer
    var progress = calories / caloriesMax * 100; // à calculer

    const progressBar = $("#bar");
    const calMessage = $("#calories-message");
    const calCount = $("#calories-count");

    $(progressBar).css('width', progress + "%");
    $(calCount).text(calories + "/" + caloriesMax + " kcal");

    // changer le message en fonction du progrès (<10 & <50 ?)

    // Message spécial si trop dépassé (à voir où mettre la limite, il y a des recommandations ?)
    if(progress > 100){
        $(progressBar).css('width', '100%');
        $(progressBar).css('background-image', 'linear-gradient(135deg, var(--secondary-cool-color-4) 0%, var(--accent-color) 100%)');
        $(progressBar).css('border', '3px solid var(--accent-color)');

        $(calMessage).text("Calories max dépassées !!");
        $(calMessage).css('color', 'var(--accent-color)');
        $(calCount).css('color', 'var(--accent-color)');
    }
    
});