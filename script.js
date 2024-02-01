function ouvrirImage(src) {
    // Ouvrir une nouvelle fenêtre avec l'image
    let win=window.open('','_blank');
    
    let head=win.document.getElementsByTagName("head")[0];
    head.innerHTML='<link rel="stylesheet" href="style.css">';
    let body=win.document.getElementsByTagName("body")[0];
    body.innerHTML= '<img id="image" src="photos/'+src+'" />';
    body.onclick=function(){
        win.close();
    }
}

/*<script>
            function validateForm() {
                var retourButton = document.getElementsByName("retour")[0];
                var enregistrerButton = document.getElementsByName("enregistrer")[0];

                // Si le bouton "Retour" a été cliqué, désactivez la validation
                if (retourButton && retourButton.clicked) {
                    document.getElementById('nomAlb').removeAttribute('required');
                }

                return true;
            }

            // Fonction pour détecter quel bouton a été cliqué
            document.addEventListener("click", function (event) {
                var target = event.target;

                if (target.type === "submit") {
                    target.form.clicked = target.name;
                }
            });
        </script>*/