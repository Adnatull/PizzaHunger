function checkEmailAvailability() {
    $("#emailLoaderIcon").show();
    jQuery.ajax({
        url: "classes/checkEmail.php",
        data: 'checkEmail=' + $("#email").val(),
        type: "POST",
        success: function(data) {
            $("#email-availability-status").html(data);
            $("#emailLoaderIcon").hide();
        },
        error: function() {}
    });
}