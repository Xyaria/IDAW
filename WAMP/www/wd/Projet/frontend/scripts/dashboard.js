function getDailyCalories(sex, sportLevel){
    //tab of daily calories values, first row women, second men
    //columns correspond to level (2 -> level 2)
    tabDailyValues = [1800, 2000, 2600, 
                    2100, 2600, 3250];
    x = sex == 'Femme' ? 0 : 1;
    y = 0;
    switch (sportLevel) {
        case 'Bas':
            y = 0;
            break;
        case 'Moyen':
            y = 1;
            break;
        case 'Elevé':
            y = 2;
            break;
    }
    return tabDailyValues[3*x+y]; 
}

async function getTodaysValues(id){
    return new Promise((resolve, reject) => {
        var nutriment_liste = [];
        $.ajax({
            url: API_PATH + "/users/consommation/daily?id=" + id,
            method: 'GET',
            dataType: 'json'
        })
        .done((nutriment) => {
            nutriment.forEach(nutriment => {
                nutriment_liste.push(nutriment);
            });
            resolve(nutriment_liste);
        });
    })
}

async function getNutrimentQuantity(){
    var id = $(".userInfo#userId").text();
    var nutriment_liste = await getTodaysValues(id);
    var nutriment_label = ['Protéines', 'Lipides', 'Glucides', 'Fibres alimentaires'];
    var nutriment_quantity = [];

    nutriment_label.forEach(label => {
        nutriment_liste.forEach(nutriment => {
            if(nutriment.label == label){
                nutriment_quantity.push(nutriment.quantite);
            }
        });
    });
    return nutriment_quantity;
}

async function dashboard_initProgressBar(){ // Paramétrage de la barre de progression des apports en calories
    var id = $(".userInfo#userId").text();
    var nutriment_liste = await getTodaysValues(id);
    var calories;
    nutriment_liste.forEach((nutriment) => {
        if(nutriment['label'] == 'Energie'){
            calories = nutriment['quantite'];
        }
    });

    var caloriesMax = getDailyCalories($(".userInfo#userSex").text(), $(".userInfo#userLevel").text());
    var progress = calories / caloriesMax * 100;

    const progressBar = $("#bar");
    const calMessage = $("#calories-message");
    const calCount = $("#calories-count");

    $(progressBar).css('width', progress + "%");
    $(calCount).text(calories + "/" + caloriesMax + " kcal");
    $(calMessage).text("Continue comme ça !");

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

async function dashboard_initChart(){ // Paramétrage de Chart.js pour l'affichage d'un graphique 
    var dataNutriment = await getNutrimentQuantity();
    var caloriesMax = getDailyCalories($(".userInfo#userSex").text(), $(".userInfo#userLevel").text());
    var recommendedNutriment = [50/2000, 70/2000, 270/2000, 25/2000];
    const warmColor4 = $(":root").css("--secondary-warm-color-4");
    const alertColor = $(":root").css("--accent-color");
    var colors = [];
    
    for (let i = 0; i < dataNutriment.length; i++) {
        dataNutriment[i] = (dataNutriment[i]/caloriesMax)/recommendedNutriment[i] *100;
        colors[i] = dataNutriment[i] >= 100 ? alertColor : warmColor4;
        dataNutriment[i] = dataNutriment[i] > 100 ? 100 : dataNutriment[i];
    }


    const chart = $("#global-chart");
    new Chart(chart, { // chart "nutriments de la journée"
        type: 'bar',
        data: {
            labels: [
                'Protéines',
                'Lipides',
                'Glucides',
                'Fibres'
            ],
            datasets: [{
                label: "%",
                data: dataNutriment,
                backgroundColor: colors,
                hoverOffset: 4
            }]
        },
        options :{
            responsive: true,
            aspectRatio: 14 / 3,
            maintainAspectRatio: true,
            scales: {
                y: {
                    max: 100
                }
            },
            plugins: {
                legend : false
            }
        }
    });   
}

function dashboard_initTable(){ // Paramétrage de DataTable pour la liste des consommations
    var conso_summary = $('#conso-summary').DataTable({
        pageLength: 6,
        lengthChange: false,
        bInfo: false,
        paging: false,
        bFilter: false,
        ajax: {
            url: API_PATH + "/users/consommation?last=6&id=" + $(".userInfo#userId").text(),
            method: 'GET',
            dataSrc: ''
        },
        columns: [
            {
                data: 'label',
                width: '50%',
                defaultContent: '0'
            },
            {
                data: 'quantite',
                width: '25%',
                defaultContent: '0'
            },
            {
                data: 'date',
                width: '25%',
                defaultContent: '1970-01-01'
            }
        ]
    })
}

function updatePage_dashboard(){
    dashboard_initChart();
    dashboard_initProgressBar();

    if(!$.fn.DataTable.isDataTable('#conso-summary')){
        dashboard_initTable();
    }
    else{
        conso_summary.ajax.reload();
    }
}