$(document).ready(function () {
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
});
