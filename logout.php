<?php
require_once("functions.php");
CheckSession();
session_destroy();

header('Location: ../');