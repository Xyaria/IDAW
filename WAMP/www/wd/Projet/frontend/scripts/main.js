$(document).ready(function () {

    const nav = document.querySelectorAll(".nav");
    const pages = document.querySelectorAll(".wrapper");

    function goToPage(pageLink){
        $(".active").removeClass("active");
        $(".wrapper:not(hidden)").addClass("hidden");

        $(pageLink).addClass("active");
        pageToShow = pageLink.classList[1];
        $(".wrapper."+pageToShow).removeClass("hidden");

        //updatePage(pageToShow);
    }

    $("ul.nav a").click(function() {goToPage(this)});

    const warmColor4 = $(":root").css("--secondary-warm-color-4");

    // Paramétrage de DataTable pour la liste des consommations
    $('#conso-summary').DataTable({
        pageLength: 6,
        lengthChange: false,
        bInfo: false,
        paging: false,
        bFilter: false
    });

    // Paramétrage de Chart.js pour l'affichage d'un graphique
    const dataNutriment = {
        labels: [
            'Protéines',
            'Lipides',
            'Glucides',
            'Eau'
        ],
        datasets: [{
            label: "%",
            data:[100, 92, 57, 100, 83, 68, 28],
            backgroundColor: warmColor4,
            hoverOffset: 4
        }]
    }

    const chart = $("#global-chart");
    new Chart(chart, { // chart "nutriments de la journée"
        type: 'bar',
        data: dataNutriment,
        options :{
            responsive: true,
            aspectRatio: 14 / 3,
            maintainAspectRatio: true,
            plugins: {
                legend : false
            }
        }
    });    
});