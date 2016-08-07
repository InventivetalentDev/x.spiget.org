<!DOCTYPE html>
<html>
<head>
    <?php include("../internal/head.php"); ?>
    <title>URL Shortener | Spiget</title>

    <!-- OG -->
    <meta property="og:title" content="URL Shortener | Spiget">
    <meta property="og:site_name" content="URL Shortener">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://x.spiget.org">

    <!-- Twitter -->
    <meta name="twitter:title" content="Spiget URL Shortener">
    <meta name="twitter:description" content="Shortener for Spigot Resources and Authors">
    <meta name="twitter:url" content="https://x.spiget.org">
    <meta name="twitter:site" content="@Spiget_org">
    <meta name="twitter:creator" content="@Inventivtalent">
    <meta name="twitter:card" content="summary">

    <meta name="keywords" content="spiget,spigot,url,shortener,minecraft,server,bukkit,api,plugin,author,resource,spigotmc">
    <meta name="description" content="URL Shortener for Spigot Resources and Authors">
    <meta name="author" content="inventivetalent">

    <style>
        div.cntnr {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            width: 75%;
        }

        .textContainer {
            font-size: 30px;
            text-align: center;
        }

        div.input-group {
            width: 100%;
        }

        input.notFound {
            color: red;
            font-weight: bold;
        }
    </style>
    <style>
        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: orange;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }
    </style>


</head>
<body>
<div class="cntnr">
    <div>
        <h1 class="page-header">Spiget URL Shortener
            <small>Combine multiple resources/authors in a single link</small>
        </h1>

        <div class="input-group">
            <select id="type-select" name="type-select" class="form-control">
                <option value="resources">Resource</option>
                <option value="authors">Author</option>
            </select>
        </div>

        <div class="input-group">
            <input type="text" id="text-value" placeholder="Start typing the name..." class="form-control">
        </div>

        <hr/>

        <div class="input-group">
            <input type="text" id="names-output" class="form-control" placeholder="Name Link" readonly>
            <span class="input-group-btn">
                        <button class="btn btn-success" id="names-go-button" disabled><span class="glyphicon glyphicon-chevron-right"></span></button>
                    </span>
        </div>
        <div class="input-group">
            <input type="text" id="ids-output" class="form-control" placeholder="ID Link" readonly>
            <span class="input-group-btn">
                        <button class="btn btn-success" id="ids-go-button" disabled><span class="glyphicon glyphicon-chevron-right"></span></button>
                    </span>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://x.spiget.org/js/jquery.autocomplete.min.js"></script>
<script src="https://spiget.org/js/bootstrap.min.js"></script>
<script src="https://x.spiget.org/js/shortener.min.js"></script>

</body>
</html>

