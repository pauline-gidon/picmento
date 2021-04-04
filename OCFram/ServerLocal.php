<?php 
namespace OCFram;


trait ServerLocal {

    function interogServerLocal(){

        if($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
            return true;
        }else{
            return false;
        }
    }
}
