function connexion_getValues(){
    var userLogin = $(".connect input[name=userLogin]").val();
    var userPassword = $(".connect input[name=userPassword]").val();
    var user = {
        login: userLogin, 
        mdp: userPassword
    };

    $.ajax({
        url: API_PATH + "/users.php/connect",
        method: 'POST',
        dat_type:'application/json',
        data: JSON.stringify(user)
    }).done((returnedUser) => {
        if(returnedUser['status'] == 200){
            $_SESSION['userSurname'] = returnedUser['user']['prenom'];
            $_SESSION['userName'] = returnedUser['user']['nom'];
            $_SESSION['userMail'] = returnedUser['user']['mail'];
            $_SESSION['userLogin'] = returnedUser['user']['login'];
            $_SESSION['userBirthday'] = returnedUser['user']['date_naissance'];
            $_SESSION['userLevel'] = returnedUser['user']['id_niveau'];
            $_SESSION['userSex'] = returnedUser['user']['sexe'];
            $_SESSION['id'] = returnedUser['user']['id_user'];
            $_SESSION['mdp'] = returnedUser['user']['mdp'];
            
        }

    }
    );
    //location.reload();
}

function inscription_getValues(){
    $(".signin #warning_message").empty();
    var userLogin = $(".signin input[name=userLogin]").val();
    var userPassword = $(".signin input[name=userPassword]").val(); 
    var userPassword_confirm = $(".signin input[name=userPassword_confirm]").val(); 
    var userSurname = $(".signin input[name=userSurname]").val(); 
    var userName = $(".signin input[name=userName]").val(); 
    var userMail = $(".signin input[name=userMail]").val(); 
    var userBirthday = $(".signin input[name=userBirthday]").val(); 
    var userSex = $(".signin input[type=radio][name=userSex]:checked").val(); 
    var userLevel = $(".signin select[name=userLevel] option:checked").val(); 

    if(userPassword != userPassword_confirm){
        $(".signin #warning_message").html("Les mots de passes ne sont pas identiques");
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

    if (Object.values(user).some((el) => el == "" || el === null)) {
        $(".signin #warning_message").html("Certaines valeurs ne sont pas renseignées");
        return
    }
    return user;
}