<?php
if(!function_exists("getView"))
{
    function getView($views=['view'])
    {
        include_once ("views/header.php");
        foreach ($views as $view)
        {
            if(file_exists("views/".$view.".php"))
            include_once ("views/".$view.".php");
        }
        include_once ("views/footer.php");
    }
}