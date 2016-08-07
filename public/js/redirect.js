$(document).ready(function () {
    var amount = queries.length;
    if (amount == 0) {
        window.location = "https://x.spiget.org";
    }
    var count = 0;
    $.each(queries, function (index, query) {
        count++;
        setTimeout(function () {
            console.log("(" + (index + 1) + "/" + amount + ") " + query);
            window.open(path.replace("%s", query) + "?oref=" + ref, (index >= amount - 1 ? "_self" : "_blank"));
        }, count * 200);
    });
});
