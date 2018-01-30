<?php
session_start();
require_once("utils/connection.php");
$act=null;
if(isset($_GET["act"])) $act=$_GET["act"];
if ($act=="logout")
{
    unset($_SESSION["session_username"]);
    header("Location: /");
}
    if(isset($_SESSION["session_username"])){


        if(empty($act)|| $act=="index")
        {
            include_once('views/index.php');

        }else if ($act=="add")
        {
            include_once('views/add.php');

        }

    }
    else
    {
        include_once ("views/login.php");
    }
