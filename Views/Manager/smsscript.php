<script type="text/javascript">
    function accountdetails()
    {
        var val = $("#LoanNo").val();
        $.ajax({url: 'loanTransection_ajax.php',
            data: {val: val},
            type: 'post',
            success: function (output)
            {

                $("#customerinfo").html(output);
                $("#FDTransaction").hide();
            }

        });
    }
</script>
