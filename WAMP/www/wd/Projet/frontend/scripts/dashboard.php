<script>
    API_ROOT = <?php_API_ROOT?>
    function getDailyCalories(sex, sportLevel){
        //tab of daily calories values, first row women, second men
        //columns correspond to level (2 -> level 2)
        tabDailyValues = [1800, 2000, 2600, 
                        2100, 2600, 3250];
        x = sex == 'F' ? 0 : 1;
        y = sportLevel;
        return tabDailyValues[3*x+y]; 
    }

    function getTodaysValues(){
        $.ajax({
            url: API_ROOT . "/aliments/",
            method: 'GET',
            dataType: 'json'
        })
        .done((aliments) => {
            var aliment_liste = [];
            aliments.forEach(aliment => {
                aliment_liste.push(aliment['Nom']);
            });
        });
    }
</script>