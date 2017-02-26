<?php
include("../../internal/getjson.php");

$query = $_GET["q"];

$split = preg_split("/[\\/]+/", $query);
$names = $split;
foreach ($names as &$name) {// Convert IDs to names
    if (is_numeric($name)) {
        $json = getJson("http://api.spiget.org/v2/resources/$name");
        if ($json !== false) {
            $name = $json["name"];
        }
    }
}
$title = $names[0];

$author_info = getJson("http://api.spiget.org/v2/resources/" . $split[0] . "/author");
if ($author_info !== false) {
    $title .= " by " . $author_info["name"];
}

if (count($split) > 1) {
    $title .= " (and " . (count($split) - 1) . " more)";
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php include("../../internal/head.php"); ?>
    <title><?php echo $title; ?> | Spiget Resource</title>

    <!-- OG -->
    <meta property="og:title" content="<?php echo $title; ?> | Spiget Resource">
    <meta property="og:site_name" content="<?php echo $title; ?>">
    <meta property="og:image" content="<?php echo "https://api.spiget.org/v2/resources/" . $names[0] . "/icon"; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://x.spiget.org">

    <!-- Twitter -->
    <meta name="twitter:title" content="<?php echo $title; ?> | Spiget Resource">
    <meta name="twitter:description" content="<?php echo join(", ", $names); ?>">
    <meta name="twitter:url" content="https://x.spiget.org">
    <meta name="twitter:site" content="@Spiget_org">
    <meta name="twitter:creator" content="@Inventivtalent">
    <meta name="twitter:card" content="summary">

    <meta name="description" content="<?php echo join(", ", $names); ?>">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    var path = "https://api.spiget.org/v2/resources/%s/go";
    var queries =<?php echo json_encode($split);?>;
    var ref = "<?php echo $_SERVER["HTTP_REFERER"];?>";

    console.log(queries);
</script>
<script src="https://x.spiget.org/js/redirect.min.js"></script>
</body>
</html>