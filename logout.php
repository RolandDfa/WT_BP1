<?php
require_once("functions.php");
ControleerLogin();
session_destroy();

header('Location: ../');