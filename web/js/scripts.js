$(document).ready(function() {

    $(".stylist-dropdown-list li").click(function(){
        //get value from list element
        var stylistId = $(this).attr("value");
        //put the value into the hidden input
        $("input[name='stylist_id']").val(stylistId);
    })

});
