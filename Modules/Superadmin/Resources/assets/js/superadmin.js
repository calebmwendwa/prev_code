$(document).ready(function(){
    $(document).on('change', '#package_category_id', function(){
        var package_category_id = $(this).val();
        $.ajax({
            method: 'GET',
            url: "/superadmin/get-package",
            dataType: 'json',
            data:{
                'package_category_id' : package_category_id
            },
            success: function(result){
                if (result.success){
                    $('select#package_id').html('');
                    $('select#package_id').html(result.package_html);
                }
            }
        });
    });
});

