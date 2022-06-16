//Fonction servant à imprimé les 0 en dessous de 10
function paddedFormat(num) {
    return num < 10 ? "0" + num : num;
};

//Fonction de décompteur pour l'ouverture des précommandes
function startCountDown() {
    //Entrez la date du que vous voulez décompté
    var event = new Date("Jul 1 00:00:00 2022");
    //récupère la date du navigateur
    var today = new Date();
    //Fait conversion des 2 dates en milisecondes
    var total_secondes = (event - today) / 1000;
    //Fait la différence entre les 2 dates et les reconvertie selon leurs fréquences
    var jours = Math.floor(total_secondes / (60 * 60 * 24));
    var heures = Math.floor((total_secondes - (jours * 60 * 60 * 24)) / (60 * 60));
    var minutes = Math.floor((total_secondes - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
    var secondes = Math.floor(total_secondes - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));
    //Imprime la différence
    var content = document.querySelector('#count');
    content.innerHTML = paddedFormat(jours) + '-' + paddedFormat(heures) + ':' + paddedFormat(minutes) + ':' + paddedFormat(secondes)
    //fin du décompte
    if (total_secondes == 0) {
        content.textContent = "Décompte terminé"
    }
    return content;
};
//Met à jour la différence
setInterval(startCountDown, 1000)