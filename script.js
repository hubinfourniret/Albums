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

