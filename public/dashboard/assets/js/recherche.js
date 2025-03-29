if (document.querySelector("#recherche") != null) {

    document.querySelector("#recherche").onkeyup = function() {
        var search = this.value.toLowerCase();
        var elements = document.querySelectorAll(".element");


        for (var i = 0; i < elements.length; i++) {
            var datas = elements[i].querySelectorAll(".data");
            var chaine = '';

            for (var j = 0; j < datas.length; j++) {
                chaine = chaine + datas[j].textContent + ' ';
            }

            chaine = chaine.toLowerCase();

            if (chaine.indexOf(search) == -1) {
                elements[i].style = "display: none;";
            } else {
                elements[i].style = "display: ;";
            }
        }
    }
}