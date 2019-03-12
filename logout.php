<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<?php
require_once("functions.php");
ControleerLogin();
session_destroy();

header('Location: ../');