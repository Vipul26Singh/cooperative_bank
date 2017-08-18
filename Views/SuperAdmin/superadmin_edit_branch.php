<?php
include '../superadmin-session.php';
error_reporting(0);
$cid = $_GET['id'];

if (isset($_REQUEST['submit'])) {
    $b_name = $_POST['b_name'];
    $b_status = $_POST['status'];
    $badd = $_POST['b_add'];
    $bcode = $_POST['b_code'];
    $bcity = $_POST['bcity'];
    $bregn = $_POST['bregn'];
    $bstate = $_POST['bstate'];
    $bcountry = $_POST['bcountry'];


    $sql1 = mysql_query("UPDATE `branch` SET `BranchName`='" . $b_name . "',`BranchAddress`='" . $badd . "',`CityId`='" . $bcity . "',`StateId`='" . $bstate . "',`RegionId`='" . $bregn . "',`CountryId`='" . $bcountry . "',`BranchCode`='" . $bcode . "',`Active`='" . $b_status . "',`ModifiedBy`='" . $login_session_id . "',`ModifiedDate`=CURTIME() WHERE BranchId ='" . $cid . "' ") or die(mysql_error());

    if ($sql1) {
        //echo "Successfully Updated";
        header("location: superadmin_branch_list.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/nav.php'; ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'include/sidenav.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Branch Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="">

                            <?php
                            if (isset($_GET['id'])) {
                                //echo $_GET['id'];
                                $id = $_GET['id'];
                                $sql = mysql_query("SELECT branch.*, city.CityName, country.CountryName, state.StateName, region.Regionname FROM branch INNER JOIN city ON branch.CityId=city.CityId INNER JOIN country ON branch.CountryId=country.CountryId INNER JOIN state ON branch.StateId=state.StateId LEFT JOIN region ON branch.RegionId=region.RegionId WHERE BranchId ='" . $cid . "' ") or die(mysql_error());
                                while ($row = mysql_fetch_array($sql)) {
                                    ?>

                                    <div class="box-body">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Branch Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['BranchName']; ?>" name="b_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="status" style="width: 100%;" >
                                                    <?php
                                                    if ($row['Active'] == 1) {
                                                        $a = "Active";
                                                        $b = "Deactive";
                                                        echo "<option  value='1'>" . $a . "</option>"
                                                        . "<option  value='0'>" . $b . "</option>";
                                                    } else {
                                                        $a = "Active";
                                                        $b = "Deactive";
                                                        echo "<option  value='0'>" . $b . "</option>"
                                                        . "<option  value='1'>" . $a . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>BranchAddress</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['BranchAddress']; ?>" name="b_add" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>BranchCode</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $row['BranchCode']; ?>" name="b_code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Region</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="bregn" style="width: 100%;">
                                                    <?php
                                                    echo "<option value='" . $row['RegionId'] . "'>" . $row['Regionname'];
                                                    $result = mysql_query("SELECT RegionId, Regionname FROM region WHERE Active=1") or die(mysql_error());

                                                    while ($reg = mysql_fetch_array($result)) {
                                                        if ($reg['Regionname'] == $row['Regionname']) {
                                                            "<option style='display: none;' value='' >";
                                                        } else {
                                                            echo "<option value='" . $reg['RegionId'] . "'>" . $reg['Regionname'];
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>     
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="bcity" style="width: 100%;">
                                                    <?php
                                                    echo "<option value='" . $row['CityId'] . "'>" . $row['CityName'];
                                                    $result3 = mysql_query("SELECT CityId, CityName FROM city WHERE Active=1");

                                                    while ($city = mysql_fetch_array($result3)) {
                                                        if ($city['CityName'] == $row['CityName']) {
                                                            "<option style='display: none;' value='' >";
                                                        } else {
                                                            echo "<option value='" . $city['CityId'] . "'>" . $city['CityName'];
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="bstate" style="width: 100%;">
                                                    <?php
                                                    echo "<option value='" . $row['StateId'] . "'>" . $row['StateName'];
                                                    $result1 = mysql_query("SELECT StateId, StateName FROM state WHERE Active=1");
                                                    while ($st = mysql_fetch_array($result1)) {
                                                        if ($st['StateName'] == $row['StateName']) {
                                                            "<option style='display: none;' value='' >";
                                                        } else {
                                                            echo "<option value='" . $st['StateId'] . "'>" . $st['StateName'];
                                                        }
                                                    }
                                                    ?>
                                                </select>                    
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="bcountry" style="width: 100%;">
                                                    <?php
                                                    echo "<option value='" . $row['CountryId'] . "'>" . $row['CountryName'];
                                                    $result2 = mysql_query("SELECT CountryId, CountryName FROM country WHERE Active=1");
                                                    while ($c = mysql_fetch_array($result2)) {
                                                        if ($c['CountryName'] == $row['CountryName']) {
                                                            "<option style='display: none;' value='' >";
                                                        } else {
                                                            echo "<option value='" . $c['CountryId'] . "'>" . $c['CountryName'];
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer text-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </form>
                    </div>
                </section>           

                <!-- /.box-body -->


                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include 'include/script.php'; ?>

            <!-- Control Sidebar -->

            <div class="control-sidebar-bg"></div>
        </div>

    </body>
</html>
