<?php
    include("fonctions.php");
    //insert('albums',['idAlb'=>'NULL','nomAlb'=>'kjhdsqh']);
    //insert('photos',['nomPh'=>'NULL']);
    //update('photos',['nomPh'=>'ph_8.jpg'],2);
    //delete('photos',10);
    //delete('compoter',['idPh'=>12,'idAlb'=>4,'ordre'=>6]);
    //select('photos',4);
    //edit('photos',['nomPh'=>'ph_8.jpg'],2);
    //echo edit('albums',['idAlb'=>'NULL'],['nomAlb'=>$nomAlb]);
    //edit('photos',['nomPh'=>'']);
    //select(['photos','albums'],['photos.idPh'=>'comporter.idPh','idAlb'=>'id']);
    //echo select(['albums'],['idAlb'=>'id']);
    $id=1;
    $idAlb=1;
    //echo delete('comporter',['comporter.idAlb'=>$id, 'comporter.idPh'=>$id]);
   
    echo delete('comporter',['comporter.idAlb'=>$idAlb, 'comporter.idPh'=>$id]);
    echo delete('photos',$id);
?>