<script>
    var API_ROOT = "../backend/api";
    function getDailyCalories(sex, sportLevel){
        //tab of daily calories values, first row women, second men
        //columns correspond to level (2 -> level 2)
        tabDailyValues = [1800, 2000, 2600, 
                        2100, 2600, 3250];
        x = sex == 'Femme' ? 0 : 1;
        y = 0;
        switch (sportLevel) {
            case 'Bas':
                y=1
                break;
            case 'Moyen':
                y=2
                break;
            case 'Elevé':
                y=3
                break;
        }
        return tabDailyValues[3*x+y]; 
    }

    function getTodaysValues(id){
        var nutriment_liste = [];
        $.ajax({
            url: API_ROOT + "/users/consommation/daily?id=" + id,
            method: 'GET',
            dataType: 'json'
        })
        .done((nutriment) => {
            console.log("got list");
            nutriment.forEach(nutriment => {
                nutriment_liste.push(nutriment);
            });
        });
        return nutriment_liste;
    }

    function getNutrimentQuantity(){
        var nutriment_liste = getTodaysValues(userId);
        var nutriment_label = ['Protéines', 'Lipides', 'Glucides', 'Eau'];
        var nutriment_quantity = [];
        nutriment_label.forEach(label => {
            nutriment_liste.forEach(nutriment => {
                if(nutriment['label'] == label){
                    nutriment_quantity.push(nutriment['quantite']);
                }
            });
        });

        return nutriment_quantity;
    }

    function dashboard_initProgressBar(){ // Paramétrage de la barre de progression des apports en calories
        var nutriment_liste = getTodaysValues(userId);
        var calories;
        nutriment_liste.forEach(nutriment => {
            if(nutriment['label'] == 'Energie'){
                calories = nutriment['quantite'];
            }
        });
        var id = $("#userId").html;
        var caloriesMax = getDailyCalories($("#userSex").html, $("#userLevel").html);
        var progress = calories / caloriesMax * 100;

        const progressBar = $("#bar");
        const calMessage = $("#calories-message");
        const calCount = $("#calories-count");

        $(progressBar).css('width', progress + "%");
        $(calCount).text(calories + "/" + caloriesMax + " kcal");
        $(calMessage).text("Continue comme ça !");
    
        // changer le message en fonction du progrès (<10 & <50) ?

        // Message spécial si trop dépassé (à voir où mettre la limite, il y a des recommandations ?)
        if(progress > 90 && progress <= 110){
            $(calMessage).text("Calories max atteintes !");
        }
        
        if(progress > 110){
            $(progressBar).css('width', '100%');
            $(progressBar).css('background-image', 'linear-gradient(135deg, var(--secondary-cool-color-4) 0%, var(--accent-color) 100%)');
            $(progressBar).css('border', '3px solid var(--accent-color)');

            $(calMessage).text("Calories max dépassées !!!");
            $(calMessage).css('color', 'var(--accent-color)');
            $(calCount).css('color', 'var(--accent-color)');
        }
    }

    function dashboard_initChart(){ // Paramétrage de Chart.js pour l'affichage d'un graphique 
        const dataNutriment = getNutrimentQuantity();
            labels: [
                'Protéines',
                'Lipides',
                'Glucides',
                'Eau'
            ],
            datasets: [{
                label: "%",
                data: calculateData(),
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
    }

    function dashboard_initTable(){ // Paramétrage de DataTable pour la liste des consommations
        $('#conso-summary').DataTable({
            pageLength: 6,
            lengthChange: false,
            bInfo: false,
            paging: false,
            bFilter: false
        });
    }

    function updatePage_dasboard(){
        dashboard_initChart();
        dashboard_initProgressBar();
        dashboard_initTable();
    }
</script>