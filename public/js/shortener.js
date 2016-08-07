$(document).ready(function () {
    window.Shortener = {
        type: "resources",
        findValue: function (done) {
            $value = $("#text-value").val();

            if ($value.trim().length < 1) {
                if (done) {
                    done([]);
                }
                return;
            }

            console.log("Searching " + Shortener.type + "/" + $value);
            $.ajax({
                url: "https://api.spiget.org/v2/search/" + Shortener.type + "/" + $value + "?callback=?",
                dataType: "jsonp",
                success: function (s) {
                    if (!("error" in s)) {
                        //Found muliple
                        console.info("Found multiple");
                        console.info(s);

                        Shortener.availableValues = [];
                        $.each(s, function (k, v) {
                            var contains = false;
                            $.each(Shortener.values, function (vK, vV) {
                                if (vV.id == v.id) {
                                    contains = true;
                                }
                            });
                            if (contains)return;

                            if (v.name !== undefined && v.id !== undefined) {
                                Shortener.availableValues.push({
                                    value: v.name,
                                    data: v.id
                                });
                            }
                        });

                        if (done) {
                            done();
                        }

                        $("#text-value").removeClass("notFound");
                    } else {
                        Shortener.valueFound = false;
                        console.log("Not Found");
                        console.info(s);

                        $("#text-value").addClass("notFound");
                    }
                },
                error: function (e) {
                    Shortener.valueFound = false;
                    console.log("Not Found")
                    console.info(e)

                    $("#text-value").addClass("notFound");
                }
            });
            /*}
             }
             }*/

            /*setTimeout(function(){
             Shortener.findValue();
             },500)*/
        },
        lastValue: null,
        valueFound: false,
        isTyping: false,
        isTypingTimer: null,
        firstSearch: true,
        availableValues: [],
        values: [],
        makeUrl: function () {
            var base = (Shortener.type == "resources" ? "r" : "a") + ".spiget.org";
            var names = "";
            var ids = "";
            $.each(Shortener.values, function (k, v) {
                names += "/" + v.name;
                ids += "/" + v.id;
            });
            names = base + names;
            ids = base + ids;

            console.info(names)
            $("#names-output").val(names);
            console.info(ids)
            $("#ids-output").val(ids);

            $("#names-go-button").prop("disabled", false);
            $("#ids-go-button").prop("disabled", false);
        }
    };

    $("#type-select").on("change", function () {
        Shortener.type = $(this).val();
    });

    $("#text-value").on("keyup", function () {
        isTypingTimer = setTimeout(function () {
            Shortener.isTyping = false;
        }, 100);
    })
    $("#text-value").on("keydown", function () {
        clearTimeout(Shortener.isTypingTimer);
        Shortener.isTyping = true;
    })

    $("#text-value").autocomplete({
        /*
         * IMPORTANT: This needs to be disabled,
         * since true causes onSelect to trigger whenever a name matches,
         * which is REALLY annoying when you're trying to search something
         */
        triggerSelectOnValidInput: false,

        lookup: function (query, done) {
            Shortener.findValue(function () {
                console.log(Shortener.availableValues);
                done({
                    suggestions: Shortener.availableValues
                });
            })
        },
        onSelect: function (suggestion) {
            console.info("On select: " + suggestion);
            Shortener.values.push({
                name: suggestion.value,
                id: suggestion.data
            });

            Shortener.makeUrl();

            $("#text-value").fadeOut(function () {
                $("#text-value").val("");
                $("#text-value").fadeIn();
            });

            $("#type-select").prop("disabled", true);
            //Disable further selection
        }
    });

    $("#add-button").click(function (e) {
        e.preventDefault();

        if (!Shortener.valueFound)
            return;
    });

    $("#names-go-button").click(function () {
        if ($("#names-output").val().length > 5) {
            open("https://" + $("#names-output").val(), "_blank");
        }
    });
    $("#ids-go-button").click(function () {
        if ($("#ids-output").val().length > 5) {
            open("https://" + $("#ids-output").val(), "_blank");
        }
    });

    Shortener.findValue();
});
