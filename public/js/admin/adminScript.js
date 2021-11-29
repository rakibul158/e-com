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

    // Update Product Status
    $('.updateProductStatus').click(function () {
        let status = $(this).text();
        let product_id = $(this).attr('product_id');
        // alert(status);
        // alert(product_id);
        $.ajax({
            type: 'POST',
            url: '/admin/update-product-status',
            data: {
                status: status,
                product_id: product_id
            },
            success:function (resp) {
                // alert(resp['status']);
                // alert(resp['product_id']);
                if(resp['status'] == 0)
                {
                    $('#product-'+product_id).html('<a href="javascript:void(0)" class="updateProductStatus"">Inactive</a>');
                } else if (resp['status']== 1){
                    $('#product-'+product_id).html('<a href="javascript:void(0)" class="updateProductStatus"">Active</a>');
                }
            },
            error:function () {
                alert("Error");
            }
        });
    });

    // Confirm Delete Popup Show

   /* $('.confirmDelete').click(function () {
        var name = $(this).attr('name');
        if(confirm("Are you sure to delete this "+name+"?"))
        {
            return true;
        }
        return false;
    });
*/
    $('.confirmDelete').click(function () {
        var record = $(this).attr('record');
        var recordId = $(this).attr('recordId');
        Swal.fire({
            title: 'Are you sure to delete '+record+'?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href="/admin/delete-"+record+"/"+recordId;
            }
        });
    });
});
