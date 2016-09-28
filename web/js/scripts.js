$(document).ready(function() {

    $(".stylist-dropdown-list li:not(.divider)").click(function(){
        //get value from list element
        var stylistId = parseInt($(this).attr("value"));
        var stylistName = $(this).attr("id");
        //put the value into the hidden input

        $("input[name=stylist_id]").val(stylistId);
        //display the value as the dropdown button text
        $("#stylist-dropdown .dropdown-button-text p").text(stylistName);
    })

});
