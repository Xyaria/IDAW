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
$(document).ready(function() {
    console.log("am in");
    
    var nutriment_liste = getTodaysValues(1);
    var calories; // à récupérer
    nutriment_liste.forEach(nutriment => {
        console.log(nutriment['label']);
        if(nutriment['label'] = 'Energie'){
            calories = nutriment['quantite'];
        }
    });
    var id = $("#userId").html;
    var caloriesMax = getDailyCalories($("#userSex").html, $("#userLevel").html); // à calculer
    var progress = calories / caloriesMax * 100; // à calculer

    const progressBar = $("#bar");
    const calMessage = $("#calories-message");
    const calCount = $("#calories-count");

    $(progressBar).css('width', progress + "%");
    $(calCount).text(calories + "/" + caloriesMax + " kcal");
    $(calMessage).text("Continue comme ça !");
 
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
</script>