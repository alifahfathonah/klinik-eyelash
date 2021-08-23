<?php 

// INSTAGRAM 
$ig1 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 01 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig1 = mysqli_fetch_array($ig1);

$ig2 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 02 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig2 = mysqli_fetch_array($ig2);

$ig3 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 03 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig3 = mysqli_fetch_array($ig3);

$ig4 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 04 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig4 = mysqli_fetch_array($ig4);

$ig5 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 05 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig5 = mysqli_fetch_array($ig5);

$ig6 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 06 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig6 = mysqli_fetch_array($ig6);

$ig7 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 07 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig7 = mysqli_fetch_array($ig7);

$ig8 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 08 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig8 = mysqli_fetch_array($ig8);

$ig9 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 09 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig9 = mysqli_fetch_array($ig9);

$ig10 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 10 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig10 = mysqli_fetch_array($ig10);

$ig11 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 11 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig11 = mysqli_fetch_array($ig11);

$ig12 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 12 AND YEAR(start) = '$tahun' AND sumber = 'IG'");
$ig12 = mysqli_fetch_array($ig12);



// TEMAN
$teman1 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 01 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman1 = mysqli_fetch_array($teman1);

$teman2 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 02 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman2 = mysqli_fetch_array($teman2);

$teman3 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 03 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman3 = mysqli_fetch_array($teman3);

$teman4 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 04 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman4 = mysqli_fetch_array($teman4);

$teman5 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 05 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman5 = mysqli_fetch_array($teman5);

$teman6 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 06 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman6 = mysqli_fetch_array($teman6);

$teman7 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 07 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman7 = mysqli_fetch_array($teman7);

$teman8 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 08 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman8 = mysqli_fetch_array($teman8);

$teman9 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 09 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman9 = mysqli_fetch_array($teman9);

$teman10 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 10 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman10 = mysqli_fetch_array($teman10);

$teman11 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 11 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman11 = mysqli_fetch_array($teman11);

$teman12 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 12 AND YEAR(start) = '$tahun' AND sumber = 'Teman'");
$teman12 = mysqli_fetch_array($teman12);


// Iklan
$iklan1 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 01 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan1 = mysqli_fetch_array($iklan1);

$iklan2 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 02 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan2 = mysqli_fetch_array($iklan2);

$iklan3 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 03 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan3 = mysqli_fetch_array($iklan3);

$iklan4 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 04 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan4 = mysqli_fetch_array($iklan4);

$iklan5 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 05 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan5 = mysqli_fetch_array($iklan5);

$iklan6 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 06 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan6 = mysqli_fetch_array($iklan6);

$iklan7 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 07 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan7 = mysqli_fetch_array($iklan7);

$iklan8 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 08 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan8 = mysqli_fetch_array($iklan8);

$iklan9 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 09 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan9 = mysqli_fetch_array($iklan9);

$iklan10 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 10 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan10 = mysqli_fetch_array($iklan10);

$iklan11 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 11 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan11 = mysqli_fetch_array($iklan11);

$iklan12 = mysqli_query($link,"SELECT COUNT(id) as jumlah FROM events WHERE MONTH(start) = 12 AND YEAR(start) = '$tahun' AND sumber = 'Iklan'");
$iklan12 = mysqli_fetch_array($iklan12);