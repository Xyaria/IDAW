$(document).ready(function () {

    const nav = document.querySelectorAll(".nav");
    const pages = document.querySelectorAll(".wrapper");
    const warmColor4 = $(":root").css("--secondary-warm-color-4");

    function goToPage(pageLink){
        $(".active").removeClass("active");
        $(".wrapper:not(hidden)").addClass("hidden");

        $(pageLink).addClass("active");
        pageToShow = pageLink.classList[1];
        $(".wrapper."+pageToShow).removeClass("hidden");

        //updatePage(pageToShow);
    }

    $("ul.nav a").click(function() {goToPage(this)});

    function updatePage(page){
        switch (page) {
            case "dashboard":
                updatePage_dashboard();
                break;
            case "mes-repas":
                updatePage_mesRepas();
                break;
            case "aliments":
                updatePage_aliments();
                break;
            case "profile":
                updatePage_profile();
                break;    
            default:
                break;
        }
    }
});