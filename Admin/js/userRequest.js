function checkUserAvailability() {
    $("#userLoaderIcon").show();
    jQuery.ajax({
        url: "classes/checkUsername.php",
        data: 'checkUsername=' + $("#username").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#userLoaderIcon").hide();
        },
        error: function() {}
    });
}