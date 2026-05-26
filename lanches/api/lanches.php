<?php
require_once("../class/Lanches.php");
$lanche=new Lanches();
$periodo=$_GET['periodo'];
echo json_encode($lanche->lanchesdodia($periodo));


