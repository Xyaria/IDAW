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

    function getTodaysValues(id){
        var nutriment_liste = [];
        $.ajax({
            url: API_ROOT + "/users/consommation/daily?id=" + id,
            method: 'GET',
            dataType: 'json'
        })
        .done((nutriment) => {
            nutriment.forEach(nutriment => {
                nutriment_liste.push(nutriment);
            });
        });

    }
</script>