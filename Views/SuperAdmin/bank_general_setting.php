<?php
include '../superadmin-session.php';
error_reporting(0);

if (isset($_POST['Save'])) {
    $sql = mysql_query("insert into bankgeneralsetting set 
                            CustomerPassResetDays = '" . $_POST['CustomerPassResetDays'] . "', 
                            CustomerTransactionalPassResetDays = '" . $_POST['CustomerTransactionalPassResetDays'] . "',
                            MobileSessiontimeinmin = '" . $_POST['MobileSessiontimeinmin'] . "',
                            InternetSessiontimeinmin = '" . $_POST['InternetSessiontimeinmin'] . "'
                            ") or die(mysql_error());

    if ($sql) {
        header("location: superadmin_dashboard.php");
    }
}
?>    

<!DOCTYPE html>
<html>
    <head>
<?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini" link="white">
        <div class="wrapper">

<?php include 'include/sidenav.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content">
                    <form role="form" action="" method="post" onsubmit="validationcheck()">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Bank General Setting </h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="col-md-3">             
                                    <div class="form-group">
                                        <label>Customer Pwd Reset Days</label>
                                    </div>
                                </div>
                                <div class="col-md-3">             
                                    <div class="form-group">
                                        <input type="text" name="CustomerPassResetDays" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">             
                                    <div class="form-group">
                                        <label>Customer Transactn Pwd Reset Days</label>
                                    </div>
                                </div>
                                <div class="col-md-3">             
                                    <div class="form-group">
                                        <input type="text" name="CustomerTransactionalPassResetDays" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile Session Time (in min)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">			
                                        <input type="text" name="MobileSessiontimeinmin" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Internet Session Time (in min)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="InternetSessiontimeinmin" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <input type="submit" name="Save" class="btn btn-warning" value="Save">
                            </div>

                        </div>
                    </form>
                </section>
            </div>
            <!-- /.content -->






<?php include 'include/script.php'; ?>
            <!-- /.content-wrapper -->
            <!--  <footer class="main-footer">
              
               <strong>Copyright &copy; 2017-2018 <a href="#">CodeFever</a>.</strong> All rights
               reserved.
             </footer> -->

            <!-- Control Sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

<?php include 'alerts.php'; ?>

        <script type="text/javascript">

            function validationcheck()
            {
                jSuccess('Bank Setting Done', 'Success Dialog');
            }
        </script>

    </body>
</html>


