var loadFile = function(event) {
    var output = document.getElementById('categoryImageShow');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
$(document).ready(function () {
    // Current Password Chack
    $("#current_pwd").keyup(function () {
        var getCurrentPwd = $("#current_pwd").val();
        //alert(getCurrentPwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd: getCurrentPwd},
            success:function (resp) {
                //alert(resp);
                if(resp=="False")
                {
                    $('#checkCurrentPwdError').html("<font color=red>Current Password in Incorrect. </font>");
                } else if(resp == "True")
                {
                    $('#checkCurrentPwdError').html("<font color=green>Current Password in Correct. </font>");
                }
            },
            error: function () {
                alert("Error");
            }
            });
    });

    // Update Section Status
    $('.updateSectionsStatus').click(function () {
        let status = $(this).text();
        let section_id = $(this).attr('section_id');
        // alert(status);
        // alert(section_id);
        $.ajax({
           type: 'POST',
           url: '/admin/update-section-status',
           data: {
                status : status,
                section_id: section_id
           },
           success:function (resp) {
                // alert(resp['status']);
                //alert(resp['section_id']);
                if(resp['status'] == 0)
                {
                    $('#section-'+section_id).html('<a href="javascript:void(0)" class="updateSectionsStatus"">Inactive</a>');
                } else if (resp['status'] == 1){
                    $('#section-'+section_id).html('<a href="javascript:void(0)" class="updateSectionsStatus"">Active</a>');
                }
           },
           error:function () {
               alert("Error");
           }
        });
    });

    // Update Category Status
    $('.updateCategoryStatus').click(function () {
        let status = $(this).text();
        let category_id = $(this).attr('category_id');
        // alert(status);
        // alert(category_id);
        $.ajax({
            type: 'POST',
            url: '/admin/update-category-status',
            data: {
                status: status,
                category_id: category_id
            },
            success:function (resp) {
               // alert(resp['status']);
               // alert(resp['category_id']);
                if(resp['status'] == 0)
                {
                    $('#category-'+category_id).html('<a href="javascript:void(0)" class="updateCategoryStatus"">Inactive</a>');
                } else if (resp['status']== 1){
                    $('#category-'+category_id).html('<a href="javascript:void(0)" class="updateCategoryStatus"">Active</a>');
                }
            },
            error:function () {
                alert("Error");
            }
        });
    });


    //Append Category level
    $('#sectionId').change(function () {
        let section_id = $(this).val();
        // alert(section_id);
        $.ajax({
           type: 'POST',
           url: '/admin/append-category-level',
           data: {
               section_id: section_id
            },
           success:function (resp) {
                $('#appendCategoryLevel').html(resp)
            },
           error:function () {
                alert("Error");
            }
        });
    });

});
