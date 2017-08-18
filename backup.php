<?php

$filename='database_backup_'.date('G_a_m_d_y').'.sql';

$result=exec('mysqldump minbazu5_coopbank --password=kaminey_007 --user=minbazu5_bankusr --single-transaction >/home/minbazu5/public_html/peopledevelopment.in/coopbank/backup/'.$filename,$output);

if($output==''){echo "unable to take backup";}
else {echo "Backup file:".$filename;}
?>

