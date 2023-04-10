function profile_modifyUser(){
    $(".modify #warning_message").empty();
    var userLogin = $(".modify input[name=userLogin]").val();
    var userPassword_old = $(".modify input[name=userPassword_old]").val(); 
    var userSurname = $(".modify input[name=userSurname]").val(); 
    var userName = $(".modify input[name=userName]").val(); 
    var userMail = $(".modify input[name=userMail]").val(); 
    var userBirthday = $(".modify input[name=userBirthday]").val(); 
    var userSex = $(".modify input[type=radio][name=userSex]:checked").val(); 
    var userLevel = $(".modify select[name=userLevel] option:checked").val(); 

    if(userPassword_old == userPassword){
        var userPassword = $(".modify input[name=userPassword]").val(); 
    }
    else{
        $(".modify #warning_message").html("Mot de passe incorrect");
        return;
    }
    
    var user = {
        login: userLogin, 
        mdp: userPassword,
        nom: userSurname,
        prenom: userName,
        mail: userMail,
        date_naissance: userBirthday,
        sexe: userSex,
        niveau: userLevel
    };
    return user;
}

$(".delete .red").on("click", function(){
    var confirm = window.confirm("Etes-vous sûr de vouloir supprimer votre compte ?");
    if(confirm){
        $.ajax({
            url: API_PATH + "/users?id=" + $(".userInfo#userId").text(),
            method: 'DELETE',
            data_type: 'json'
        })
        .done(() => {
            $("#disconnect").submit();
        })
    }
})

function deleteUser(){

}

function updatePage_profile(){
    
}