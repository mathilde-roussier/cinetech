<?php

if(isset($_POST['inscription']))
{
    $user->inscription($_POST['login'],$_POST['email'],$_POST['password'],$_POST['password_conf']);
}

if(isset($_POST['connexion']))
{
    
}