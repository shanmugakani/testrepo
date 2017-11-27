<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="./dist/JsBarcode.all.js"></script>	

</head>
<body> 
<?php 
include('./barcode128.php'); 
$hostname_arka = "192.168.1.206";
$database_arka = "arka_wms";
$username_arka = "root";
$password_arka = "";

$arka = mysql_connect($hostname_arka, $username_arka, $password_arka) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_arka, $arka);

if($_GET['sticker_id']!="")
{ 
	//echo 'select * from arka_sticker where sticker_id= "'.$_GET['sticker_id'].'"';
	 $views='select * from arka_sticker where sticker_id="'.$_GET['sticker_id'].'"'; 
     $ran = mysql_query($views);//print_r ($ran);exit;
		
	$i=0;
	?>
	
    	<table style="padding:100px; margin-left:15px; margin-top:-260px;" border="0">
		<?php 
		while($step=mysql_fetch_array($ran))
	{
	for($j=0;$j<$step['str_qty'];$j++)	
	{		
  
?>
<table width="380px" style="margin-left:205px;" border="0" cellspacing=0>
							<tr><td class="inner"><font size="+3"><?php echo $step['m_code'];?></font>&ensp;<span class="text">QTY&nbsp;:</span>
							<span class="number"><?php echo $step['pdt_qty'];?></span>&nbsp;<span class="text">&ensp;Nos.</span></td></tr>
							<tr><td class="inner" colspan="2"><span class="text"><?php echo $step['m_name'];?></span></td></tr>
							<tr><td class="inner"><span class="text">PKD ON&ensp;:&ensp;</span><font size="+3"><?php echo date('m-Y'); ?></font></td></tr>	
							<tr><td class="inner"><span class="text">MRP .&ensp;RS&ensp;:&ensp;</span><font size="+3"><?php echo $step['total_price'];?></font></td></tr>
							<tr align="inner"><td><svg id="barcode<?php echo $i;?>"/></svg>
													
													<script> 
														JsBarcode("#barcode<?php echo $i;?>", "<?php echo $step['bar_code'];?>", {
														  width: 1.6,
														  height: 60,
														  displayValue: true
														});
													</script>
											  </td>
							</tr>						
							</table>
							<?php 
$i=$i+1;
}
} ?>	
		</table>        	        
<?php 
}?>
	</body>
   
    <script type="text/javascript">
		 window.onload=function(){self.print();} 
    </script>
	<style>
table 
{
	font-family: Calibri;
		
}
td.inner {
    padding-top: .1em;
    padding-bottom: .1em;
}
@media print
{
@page{ margin:0;}
body{margin: 1.6cm;}
}
.number
{
font-size:32px;
font: bolder;

}
.text
{
font-size:20px;
font:bold;
}
.add
{
font-size:16px;
color:#000080;
}
	</style>

