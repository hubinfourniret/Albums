<?php
    function isAdmin(){
        if (isset($_SESSION['admin'])){
            if($_SESSION['admin']==true){
                return true;
            }
        }else {
            return false;
        }
    }
?>