<?php

if(isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])){
    include_once('mkenny-admin-refer-list-edit.php');
}else{
    include_once('mkenny-admin-refer-list-page.php');
}