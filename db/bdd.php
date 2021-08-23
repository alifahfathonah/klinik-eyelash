<?php
try
{
	$bdd = new PDO('mysql:host=onyx.cloudns.io;dbname=sitesidadmin_klinik;charset=utf8', 'sitesidadmin_klinik', 'Admin1234@yx##');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
