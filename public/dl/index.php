<?php
$query = $_GET["q"];
header("Location: https://api.spiget.org/v2/resources/$query/download");


