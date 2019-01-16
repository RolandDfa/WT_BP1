<?php
require("functions.php");
CheckSession();
session_destroy();

header('Location: ../');