<?php 

require 'config/constants.php';

//Destruir secion

session_destroy();
header('location: ' . ROOT_URL);
die();