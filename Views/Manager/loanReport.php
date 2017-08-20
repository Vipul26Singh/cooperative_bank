<?php
include '../superadmin-session.php';
error_reporting(E_ALL);

$search = mysql_fetch_array(mysql_query("SELECT * FROM `loan` WHERE LoanId='" . $_GET['id'] . "' ")) or die(mysql_error());
$customersearch = mysql_fetch_array(mysql_query("SELECT * FROM `customer` WHERE CustomerID='" . $search['CustomerID'] . "' ")) or die(mysql_error());

$selectdata = mysql_fetch_array(mysql_query("SELECT l.*,b.BranchId,b.BranchName,c.CustomerID,c.CustomerName,c.ResAddress FROM `loan` l 
INNER JOIN branch b
ON b.BranchId = l.BranchId
INNER JOIN customer c
ON c.CustomerID = l.CustomerID where l.LoanId='" . $_GET['id'] . "'"));

$selectloandetail = mysql_fetch_array(mysql_query("SELECT * FROM `loantype` WHERE LoanTypeid= '" . $search['LoanTypeid'] . "' " )) or die(mysql_error()); 


$principalSum = '';
$emiSum = '';
$intrestamountSum = '';

$searchcompanysetup = mysql_fetch_array(mysql_query("SELECT * FROM `companysetup` ")) or die(mysql_error());
?>    

<!DOCTYPE html>
<html>

    <!-- webcam link -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <!-- image upload -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <!-- jQuery 2.2.3 -->
    <script src="../CSS/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../CSS/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../CSS/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../CSS/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../CSS/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../CSS/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../CSS/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../CSS/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../CSS/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../CSS/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../CSS/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../CSS/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../CSS/dist/js/demo.js"></script>

    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manager</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../CSS/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../CSS/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../CSS/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../CSS/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../CSS/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../CSS/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../CSS/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../CSS/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../CSS/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <body class="hold-transition skin-blue sidebar-mini">
        <div >

            <style type="text/css">
                .contentnew {
                    min-height: 50px;
                    padding: 15px;
                    margin-right: auto;
                    margin-left: auto;
                    padding-left: 15px;
                    padding-right: 15px;
                }
            </style>

            <!-- Content Wrapper. Contains page content -->
            <div style="border: solid 1px;"> 
                <section >
                    <div class="box box-primary">
                        <div class="box-header with-border" style="text-align: center;background-color:#EEEEEE">
                            <h3 class="box-title">PROMISSORY NOTE</h3>
                        </div>

                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-10 invoice-col"  style="padding-left:29px;">
                                <table >
                                    <tr>
                                        <td><b>LOAN AMOUNT</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['Amount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Branch Name</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['BranchName'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Loan Account No</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['LoanNumber'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>EMI Per Month</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['installmentamount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Customer Id</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['CustomerID'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Customer Name</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['CustomerName'] ?></td>
                                    </tr><tr>
                                        <td><b>Customer Address</b></td>
                                        <td></td>
                                        <td>:</td>
                                        <td>&nbsp;<?php echo $selectdata['ResAddress'] ?></td>
                                    </tr>
                                </table>



                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 invoice-col">
                                <div class="user-block">
                                    <?php echo '<img src="../upload/' . $customersearch['mphoto'] . '" style="width:169px; height:110px" />'
                                    ?>

                                </div>
                                <div><?php echo '<img src="../upload/' . $customersearch['CSign'] . '" style="width:169px; height:40px" />'
                                    ?></div>
                            </div>

                        </div>
                        <!-- /.row -->
                        <!-- Main content -->
                        <div class="contentnew body">
                            <span><b>FOR VALUE RECEIVED,</b> the undersigned,(the "Maker"),hereby promises  to pay to the order of   
                                <b><?php echo $searchcompanysetup['CompanyName'] ?></b>(LENDER NAME) ("Payee"), the principal sum of <b>INR <?php echo $selectdata['Amount']; ?></b> Pursuant to the terms and conditions set forth herein.</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>PAYMENT OF PRINCIPAL,</b>The   principal   amount   of   this   Promissory   Note   
                                (the "Note") and   any   accrued   but   unpaid interest   shall   be   due   and   payable   in  12(NUMBER   OF   PAYMENTS)   (CIRCLE   ONE:   equal   monthly   installments  /  equal quarterly  installments  /  payments  as  described  below)  beginning <b>(<?php echo date('d-m-y', strtotime($search['FirstInstallmentDate'])); ?>)</b>.All  payments  under  this  Note  shall  be applied   first   to   accrued   but   unpaid   interest,   and   next   to   outstanding   principal.If   not   sooner   paid,   the   entire   remaining indebtedness (including accrued interest) shall be due and payable on (<b><?php echo date('d-m-y', strtotime($search['FirstInstallmentDate'])); ?>)</b> </span>
                        </div>

                        <div class="contentnew body">
                            <span><b>INTEREST.</b>This Note shall bear interest, compounded annually, at <b><?php echo $search['Interestrate'] ?>% (ANNUAL INTEREST RATE)</b> percent.</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>PREPAYMENT.</b>The  Maker  shall  have  the  right  at  any  time  and  from  time  to  time  to  prepay  this  Note  in  whole  or  in  part without premium or penalty.</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>REMEDIES.</b> No  delay  or  omission  on  part  of  the  holder  of  this  Note  in  exercising  any  right  hereunder  shall  operate  as  a 
                                waiver  of  any  such  right  or  of  any  other  right  of  such  holder,  nor  shall  any  delay,  omission  or  waiver  on  any  one  occasion 
                                be  deemed  a  bar  to  or  waiver  of  the  same  or  any  other  right  on  any  future  occasion.    The  rights  and  remedies  of  the 
                                Payee shall be cumulative and may be pursued singly, successively, or together, in the sole discretion of the Payee.</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>EVENTS  OF  ACCELERATION.
                                    ,</b>The   occurrence   of   any   of   the   following   shall   constitute   an   
                                "Event   of   Acceleration"  by Maker under this Note:(a)Maker's     failure     to     pay     any     part     of     the principal or interest  as and  when  due under  this  Note; or
                                (b)
                                Maker's becoming insolvent or not paying its debts as they become due</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>ACCELERATION.</b> Upon  the  occurrence  of  an  Event  of  Acceleration  under  this  Note,  and  in  addition  to  any  other  rights 
                                and   remedies   that   Payee   may   have,   Payee   shall   have   the   right,   at   its   sole   and   exclusive   option,   to   declare   this   Note 
                                immediately due and payable</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>SUBORDINATION.</b> 
                                The   Maker's   obligations   under   this   Promissory   Note   are   subordinated   to   all   indebtedness,   if   any,   of Maker,  to  any  unrelated  third  party  lender  to  the  extent  such  indebtedness  is  outstanding  on  the  date  of  this  Note  and such subordination is required under the loan documents providing for such indebtedness.</span>
                        </div>
                        <div class="contentnew body">
                            <span><b>WAIVERS   BY   MAKER.</b> 
                                All   parties   to   this   Note   including   Maker   and   any   sureties,   endorsers,   and   guarantors   hereby 
                                waive   protest,   presentment,   notice   of   dishonor,   and   notice   of   acceleration   of   maturity   and   agree   to   continue   to   remain 
                                bound   for   the   payment   of   principal,   interest   and   all   other   sums   due   under   this   Note   notwithstanding   any   change   or 
                                changes  by  way  of  release,  surrender,  exchange,  modification  or  substitution  of  any  security  for  this  Note  or  by  way  of 
                                any   extension   or   extensions   of   time   for   the   payment   of   principal   and   interest;   and   all   such   parties   waive   all   and   every 
                                kind  of  notice  of  such  change  or  changes  and  agree  that  the  same  may  be  made  without  notice  or  consent  of  any  of 
                                them</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>EXPENSES.</b> 
                                In  the  event  any  payment  under  this  Note  is  not  paid  when  due,  the  Maker  agrees  to  pay,  in  addition  to  the principal   and   interest   hereunder,   reasonable   attorneys'   fees   not   exceeding   a   sum   equal   to   15%   of   the   then   outstanding balance   owing   on   the   Note,   plus   all   other   reasonable   expenses   incurred   by   Payee   in   exercising   any   of   its   rights   and remedies upon default.</span>
                        </div>
                        <div class="contentnew body">
                            <span><b>GOVERNING   LAW</b> 
                                This   Note   shall   be   governed   by,   and   construed   in   accordance   with,   the   laws   of   the   State   of 
                                Maharashtra
                                (STATE NAME).</span>
                        </div>

                        <div class="contentnew body">
                            <span><b>SUCCESSORS</b> 
                                All  of  the  foregoing  is  the  promise  of  Maker  and  shall  bind  Maker  and  Maker's  successors,  heirs  and assigns;   provided,   however,   that   Maker   may   not   assign   any   of   its   rights   or   delegate   any   of   its   obligations   hereunder</span>
                        </div>
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped" style="border: solid 1px;">
                                    <thead>
                                        <tr>
                                            <th>Installment No</th>
                                            <th>EMI date</th>
                                            <th>Outstanding Principal</th>
                                            <th>EMI</th>
                                            <th>Principal</th>
                                            <th>Interest</th>
                                            <th>Outstanding</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sr = 1;
                                        $count = $search['Durationinmonth'];
                                        $searchdata = $search['FirstInstallmentDate'];
					$freq = $selectloandetail['Frequency'];

                                        $start = date('Y-m-d', strtotime($search['DisburseDate']));
                                        $end = date('Y-m-d', strtotime($search['FirstInstallmentDate']));

                                        $outstanding = $search['Amount'];
                                        $interest = $search['Interestrate'];
                                        $emi = $search['installmentamount'];

                                        function dateDiff($start, $end) {
                                            return round(abs(strtotime($start) - strtotime($end)) / 86400);
                                        }
					$addFreq = null;
					if($freq == 'MONTHLY'){
						$addFreq = 'months';
					}else if($freq == 'DAILY'){
						$addFreq = 'day';
					}else if($freq == 'WEEKLY'){
						$addFreq = 'week';
					}

                                        for ($i = 1; $i <= $count; $i++) {
                                            if ($i <= $count - 1) {
                                                $emiDate = date('Y-m-d', strtotime($searchdata . "+$i $addFreq"));
                                                $data = dateDiff($end, $start);
                                                $outprincipal = $outstanding;
                                                $intrestamount = ((($outprincipal) * ($interest)) / 36500) * $data;
                                                $principal = ($emi - $intrestamount);
                                                $outstanding = ($outprincipal - $principal);
                                                $start = $end;
                                                $end = $emiDate;
                                                ?>



                                                <tr>
                                                    <td><?php echo $sr; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($start)); ?></td>
                                                    <td><?php echo round($outprincipal, 2); ?></td>
                                                    <td><?php echo round($search['installmentamount'], 2); ?></td>
                                                    <td><?php echo round($principal, 2); ?></td>
                                                    <td><?php echo round($intrestamount, 2); ?></td>
                                                    <td><?php echo round($outstanding, 2); ?></td>
                                                </tr>

                                                <?php
                                                $principalSum += $principal;
                                                $emiSum += $search['installmentamount'];
                                                $intrestamountSum += $intrestamount;
                                            } else {
                                                $emiDate = date('Y-m-d', strtotime($searchdata . "+$i $addFreq"));
                                                $data = dateDiff($end, $start);
                                                $outprincipal = $outstanding;
                                                $intrestamount = (($outprincipal * $interest) / 36500) * $data;
                                                $principal = $outprincipal;
                                                $outstanding = $outprincipal - $principal;
                                                $emi = $principal + $intrestamount;
                                                $start = $end;
                                                $end = $emiDate;
                                                ?>
                                                <tr>
                                                    <td><?php echo $sr; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($start)); ?></td>
                                                    <td><?php echo round($outprincipal, 2); ?></td>
                                                    <td><?php echo round($emi, 2); ?></td>
                                                    <td><?php echo round($principal, 2); ?></td>
                                                    <td><?php echo round($intrestamount, 2); ?></td>
                                                    <td><?php echo round($outstanding, 2); ?></td>
                                                </tr>
                                                <?php
                                                $principalSum1 += $principal;
                                                $emiSum1 += $emi;
                                                $intrestamountSum1 += $intrestamount;
                                            }
                                            ?>
                                            <?php
                                            $sr++;
                                        }

                                        $principalSum = $principalSum + $principalSum1;
                                        $emiSum = $emiSum + $emiSum1;
                                        $intrestamountSum = $intrestamountSum + $intrestamountSum1;
                                        ?>


                                    </tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td><?php echo round($emiSum, 2); ?></td>
                                        <td><?php echo round($principalSum, 2); ?></td>
                                        <td><?php echo round($intrestamountSum, 2); ?></td>
                                        <td></td>

                                    </tr>

                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="contentnew body">
                            <span>
                                <b>IN WITNESS WHEREOF</b> 
                                IN WITNESS WHEREOF,
                                Maker has executed this Promissory Note as of the day and year first above written.<br>
                                Borrower Name: 
                                <?php echo $selectdata['CustomerName'] ?><br>
                                Borrower Signature:______________________________
                            </span>
                        </div>


                    </div>
                </section>


                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->




            <div class="control-sidebar-bg"></div>
        </div>
        <!--Script-->

        <?php include 'include/mang_script.php'; ?>

    </body>
</html>
