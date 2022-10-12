$(document).ready(function () {
    var updateOutput = function () {
        $("#nestable-output").val(
            JSON.stringify($("#nestable").nestable("serialize"))
        );
    };

    $("#nestable").nestable().on("change", updateOutput);

    updateOutput();

    $("#add-item").submit(function (e) {
        e.preventDefault();
        id = Date.now();
        var label = $("#add-item  [name='name']").val();
        console.log(label);
        //var url = $("#add-item > [name='url']").val();

        var custom_menu_id = $("#add-item  [name='custom_menu_id']").val();
        var url = custom_menu_id;
        var custom_menu_title = $(
            "#add-item > [name='custom_menu_id'] option[value='" +
                custom_menu_id +
                "']"
        ).html();
        console.log(custom_menu_id);
        console.log(custom_menu_title);
        if (custom_menu_id == "" || label == "") return;
        var item =
            '<li class="dd-item dd3-item" data-id="' +
            id +
            '" data-label="' +
            label +
            '" data-url="' +
            url +
            '">' +
            '<div class="dd-handle dd3-handle" > Drag</div>' +
            '<div class="dd3-content"><span>' +
            label +
            "</span>" +
            '<div class="item-edit"><i class="nav-icon fas fa-edit"></div>' +
            "</div>" +
            '<div class="item-settings d-none">' +
            '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' +
            label +
            '"></label></p>' +
            '<p><label for="">Navigation Url<br><select name="navigation_url" > <option value="' +
            custom_menu_id +
            '">' +
            custom_menu_title +
            "</option></select></label></p>" +
            '<p><a class="item-delete" href="javascript:;">Remove</a> |' +
            '<a class="item-close" href="javascript:;">Close</a></p>' +
            "</div>" +
            "</li>";

        $("#nestable > .dd-list").append(item);
        $("#nestable").find(".dd-empty").remove();
        $("#add-item > [name='name']").val("");
        $("#add-item > [name='url']").val("");
        $("#add-item > [name='custom_menu_id']").val("1");
        updateOutput();
    });

    $("body").delegate(".item-delete", "click", function (e) {
        $(this).closest(".dd-item").remove();
        updateOutput();
    });

    $("body").delegate(".item-edit, .item-close", "click", function (e) {
        var item_setting = $(this).closest(".dd-item").find(".item-settings");
        if (item_setting.hasClass("d-none")) {
            item_setting.removeClass("d-none");
        } else {
            item_setting.addClass("d-none");
        }
    });

    $("body").delegate(
        "input[name='navigation_label']",
        "change paste keyup",
        function (e) {
            $(this).closest(".dd-item").data("label", $(this).val());
            $(this)
                .closest(".dd-item")
                .find(".dd3-content span")
                .text($(this).val());
        }
    );

    $("body").delegate(
        "[name='navigation_url']",
        "change paste keyup",
        function (e) {
            console.log($(this).val());
            $(this).closest(".dd-item").data("url", $(this).val());
            updateOutput();
        }
    );
});
