function DynamicSubCategory() {
    var cat_id = $('#inputCategory').val();
    $('#inputSubCategory').empty(); //remove all existing options

    jQuery.ajax({
        url: "classes/DynamicSubCategory.php",
        data: 'checkID=' + cat_id,
        type: "GET",
        dataType: 'json',
        success: function(returned_data) {
            console.log(returned_data);
            $.each(returned_data.data, function(key, value) {
                //console.log("HELLO");
                $("#inputSubCategory").append("<option value='" + value.sub_id + "'>" + value.sub_name + "</option>");
            });
        },
        error: function() {}
    });
}