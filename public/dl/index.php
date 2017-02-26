<?php
$query = $_GET["q"];

if (empty($query)) {
    header("Location: https://x.spiget.org");
    return;
}

header("Location: https://api.spiget.org/v2/resources/$query/download");


