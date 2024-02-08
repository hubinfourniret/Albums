<?php
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }
    
    function isAdmin(){
        if (isset($_SESSION['admin'])){
            if($_SESSION['admin']==true){
                return true;
            }
        }else {
            return false;
        }
    }

    function getIdName($table){
        global $cnx;
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'albums' AND COLUMN_KEY = 'PRI' AND TABLE_NAME='".$table."'";
        $res=mysqli_query($cnx, $sql);
        return mysqli_fetch_array($res)[0];
    }

    function edit($table, $data, $id=0){
        global $cnx;
        if ($id==0){
            $sql="INSERT INTO $table (".implode(",",array_keys($data)).") VALUES (".str_replace("'NULL'", "NULL","'".implode("','",array_values($data))."'").")";
            mysqli_query($cnx, $sql);
            echo $sql;
            return mysqli_insert_id($cnx);
        }else {
            $idNom=getIdName($table);
            $sql="UPDATE $table SET ";
            foreach($data AS $champ=>$val){
                $sql.=$champ."='".$val."',";
            }
            $sql=substr($sql,0,-1);
            $sql.=" WHERE ".$idNom."=".$id;
            echo $sql;
            return mysqli_query($cnx, $sql);
        }
    }

    function delete($table,$id){
        global $cnx;
        if(is_numeric($id)){
            $idNom=getIdName($table);
            $sql="DELETE FROM $table WHERE $idNom ='$id'";
            echo $sql;
        }elseif(is_array($id)){
            $sql="DELETE FROM $table WHERE ";
            foreach($id AS $champ=>$val){
                $sql.=$champ."='".$val."' AND ";
            }
            $sql=substr($sql,0,-5);
            echo $sql;
        }
        return mysqli_query($cnx, $sql);
    }

    function select($table, $id){
        global $cnx;
        $idNom=getIdName($table);
        $sql = "SELECT * FROM ".$table." WHERE ".$idNom." = ".$id;
        echo $sql;
    }
?>