<?php
/*
 * $Id: charts.php 61 2009-06-03 13:53:26Z iulia_bublea $
 */
 require("../../../../config/tools/system/smonitor/local.inc.php"); 
 require("../../../../config/tools/system/smonitor/db.inc.php"); 
 require("../../../../config/db.inc.php"); 
 require("lib/functions.inc.php");

 session_start();  
 require("lib/put_select_boxes.php"); 
 include("lib/db_connect.php"); 
 
 $box_id=get_box_id($current_box); 
 require("template/header.php");
 $table=$config->table_monitoring;
 $name_table=$config->table_monitored;
 
 if ($_GET['stat_id']!=null)
 {
  $stat_id = $_GET['stat_id'];
  if ($_SESSION['stat_open'][$stat_id]=="yes") $_SESSION['stat_open'][$stat_id]="no";
   else $_SESSION['stat_open'][$stat_id]="yes";
 }
 
 if ($_POST['flush']!=null)
 {
  $sql = "delete from ".$config->table_monitoring." where box_id=".$box_id;
  $link->exec($sql);
  $link->disconnect();
 }
 
 $expanded=false;
 for($i=0; $i<sizeof($_SESSION['stat_open']); $i++)
  if ($_SESSION["stat_open"][$i]=="yes") $expanded=true;
 
 require("template/".$page_id.".main.php");
 require("template/footer.php");
 exit();
 
?>