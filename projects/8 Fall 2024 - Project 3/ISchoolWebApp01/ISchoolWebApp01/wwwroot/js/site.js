// Please see documentation at https://learn.microsoft.com/aspnet/core/client-side/bundling-and-minification
// for details on configuring this project to bundle and minify static web assets.

// Write your JavaScript code.
$(function () {
    $("#peopleTab").tabs();
    $("[id=collapseDescription]").accordion({ collapsible: true, active: false, heightStyle: "content"})
    new DataTable('table.display');
})

jQuery(function () {
    jQuery(".player").YTPlayer();
});

$(document).ready(function () {
    $(".newsDate").on("click", function () {
        const title = $(this).data("title");
        const description = $(this).data("description");
        $("#newsTitle").text(title);
        $("#newsDescription").text(description);
    });
});