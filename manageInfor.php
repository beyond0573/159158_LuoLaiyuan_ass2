<?php 
	session_start(); 
	include "conn.php";
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta http-equiv="refresh" content="60"> 
		<link href="./style.css" rel="stylesheet" type="text/css">
		<title>index</title>
		<script type="text/javascript" src="check.js"></script>
	</head>

<body>
  <TABLE width="757" cellPadding=0 cellSpacing=0 style="WIDTH: 755px" align="center"> 
   <TBODY> 
		<TR> 
			<TD style="VERTICAL-ALIGN: bottom; HEIGHT: 6px" colSpan=3> 
				<TABLE style="BACKGROUND-IMAGE: url( images/f_head.jpg); WIDTH: 760px; HEIGHT: 154px" cellSpacing=0 cellPadding=0> 
					<TBODY> 
						<TR> 
							<TD height="110" colspan="6" style="VERTICAL-ALIGN: text-top; WIDTH: 80px; HEIGHT: 115px; TEXT-ALIGN: right"></TD> 
						</TR> 
						<TR><TD height="29" align="center" valign="middle">
							<TABLE style="WIDTH: 580px" VERTICAL-ALIGN: text-top; cellSpacing=0 cellPadding=0 align="center">
								<TBODY>
									<TR align="center" valign="middle">
									<?php
										if(isset($_SESSION["username"])){
									?>
										<TD class="STYLE4">Welcome:&nbsp;<SPAN class="STYLE3"><?php echo $_SESSION["username"]; ?></SPAN>&nbsp;&nbsp;</TD>
									 <?php
										}
									?>
										<TD class="STYLE4"><SPAN class="STYLE3"><a href="index.php">Home Page</a></SPAN></TD>
									<?php
										if(!isset($_SESSION["username"])){
									?>
										<TD class="STYLE4"><SPAN class="STYLE3"><a href="login.php">Login</a></SPAN></TD>               
										<TD class="STYLE4"><SPAN class="STYLE3"><a href="registration.php">Registration</a></SPAN></TD>
									<?php
										} else {
									?> 
										<TD class="STYLE4"><SPAN class="STYLE3"><a href="add_pic.php">Add Picture</a></SPAN></TD>	
										<TD class="STYLE4"><SPAN class="STYLE3"><a href="logout.php">Log out</a></SPAN></TD>
									<?php
										} 
									?>		
									<?php
									  if($_SESSION["admin"] == 1){
									?>
									   <TD class="STYLE4"><SPAN class="STYLE3"><a href="manageuser.php">Manage User</a></SPAN></TD>
									   <TD class="STYLE4"><SPAN class="STYLE3"><a href="manageInfor.php">Manage Picture</a></SPAN></TD> 									   
									<?php  
									  }
									?>
									</TR>
								</TBODY>
							</TABLE>			  
							</TD> 
						</TR> 
					</TBODY> 
				</TABLE>
			</TD> 
		</TR>
		<?php
			if($_SESSION["admin"] == 1){
		?>
		<TR> 
		  <TD colSpan=3 valign="baseline" style="BACKGROUND-IMAGE: url( images/bg.jpg); VERTICAL-ALIGN: middle; HEIGHT: 450px; TEXT-ALIGN: center">
			<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="#ABADB3">
			<tr><td height="400" align="center" valign="top"><br>
				<table width="640"  border="0" cellpadding="0" cellspacing="0" bordercolor="#ABADB3">
					<tr>
						<td width="613" height="16" align="right" valign="top">&nbsp;</td><br>
					</tr>
					<tr>
						<td height="290" align="center" valign="top" bordercolor="#ABADB3">
							<table width="600" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF">
								<tr align="left" colspan="2" >
									<td width="390" height="30" colspan="3" valign="top" bgcolor="#EFF7DE"> <div align="center"><span class="tableBorder_LTR">Picture Show</span></div></td>
								</tr>
								<td height="250" align="center" valign="top" >
									<table width="496" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3">
										<tr><td height="57" align="center" valign="top" >
											<table width="565" height="307"  border="1" cellpadding="1" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF" class="i_table">
												<form  name="myform" method="post" action="manageInfor.php"  enctype="multipart/form-data">
					<?php
					//if($_SESSION["admin"] == 1){
						$link3 = "select * from tb_picture";
						$result1 = mysql_query($link3, $mycon) or die('Error: ' . mysql_error());
 						$numofpics = mysql_num_rows($result1);
						if($numofpics != 0 ){
							$j = 0;
							while($result2 = mysql_fetch_array($result1)){
								if($result2["admi"] == 0 ){
									$picArray[$j] = $result2['id'];
					?>						
													<tr bgcolor="#FFFFFF">
														<td width="11%" height="65" align="center"><SPAN class="STYLE2">Name:</SPAN> </td>
														<td width="19%"><SPAN class="STYLE2"><?php echo $result2['name']; ?></SPAN></td>
														<td width="11%" align="center"><SPAN class="STYLE2">Author: </SPAN></td>
														<td width="18%"><SPAN class="STYLE2"><?php echo $result2['author']; ?></SPAN></td>
														<td width="11%" align="center"><SPAN class="STYLE2">Add time: </SPAN></td>
														<td width="30%"><SPAN class="STYLE2"><?php echo $result2['time']; ?></SPAN></td>
													</tr>
													<tr bgcolor="#FFFFFF">
														<td height="85" align="center"><SPAN class="STYLE2">Change description:</SPAN> </td>
														<input name="changePicDiscrip" type="hidden" value="<?php echo $result2['id'];?>">
														<td colspan="6"><SPAN class="STYLE2"><textarea name="Pic_discrip" cols="80" rows="8" id="Pic_discrip" ><?php echo $result2['picdiscrip']; ?></textarea></SPAN></td>
													</tr>
													<tr align="right">
														<td colspan="6"><input name="PicDiscrip" type="submit" id="PicDiscrip" value="Change description"></td>
													</tr>
													<tr bgcolor="#FFFFFF">
														<td height="200" align="center"><SPAN class="STYLE2">Picture:</SPAN> </td>
														<td colspan="5"><div align="center"><img src="<?php echo $result2['picture'];?>"  align="middle" width="225" height="160"></div></td>
													</tr>
													<tr>
														<label>
														<td colspan="6" align="right"><input type = "checkbox" id = "<?php echo $result2['id']; ?>" name = "<?php echo $result2['id']; ?>" value = "<?php echo $result2['id']; ?>" /><?php echo "  Picture name: ".$result2['name']; echo $picArray[$j]; ?></td>											
														</label>
													</tr>
					<?php 
								}
								$j ++;
							}
					?>
													<tr align="right">
														<td colspan="6"><input type="submit" id = "AllowShowPic" name = "AllowShowPic" value="Allow pictures show"></td>
													</tr>
												</form>
											</table>
											</td>
										</tr>
					<?php	
						} else {
							echo " There have no pictures! ";
						} 	
					?>			
									</table>
								</td>	
							</table>
						</td>	
					</tr>
				</table>
				</td><p>&nbsp;</p>
			</tr>
			
			<tr><td height="651" align="center"><br>
				<table width="640" height="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="#ABADB3"> 		
					<tr><td height="293" align="center" valign="top">
						<table width="597" height="294" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF">
							<tr align="left" colspan="2" >
								<td width="390" height="21" colspan="3" valign="top" bgcolor="#EFF7DE"><div align="center"><span class="tableBorder_LTR">View comments</span> </div></td>
							</tr>
							<tr><td height="57" align="center" valign="top" >
									<table width="565" height="307"  border="1" cellpadding="1" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF" class="i_table">
										<form  name="myform" method="post" action="manageInfor.php"  enctype="multipart/form-data">
					<?php
							$link1 = "select * from tb_comment order by time desc";
							$result3 = mysql_query($link1, $mycon) or die('Error: ' . mysql_error());
							$numofcomms = mysql_num_rows($result3);
							$j = 0;
							while($result4 = mysql_fetch_array($result3)){
								if($result4['admi'] == 0){
									$commArray[$j] = $result4['id'];
					?>
											<tr bgcolor="#FFFFFF">
												<td width="11%" height="65" align="center"><SPAN class="STYLE2">Commentator:</SPAN> </td>
												<td width="18%"><SPAN class="STYLE2"><?php echo $result4['username']; ?></SPAN></td>
												<td width="12%" align="center"><SPAN class="STYLE2">Add time: </SPAN></td>
												<td width="30%"><SPAN class="STYLE2"><?php echo $result4['time']; ?></SPAN></td>
											</tr>
											<tr bgcolor="#FFFFFF">
												<td height="141" align="center"><SPAN class="STYLE2">Comment: </SPAN></td>
												<td colspan="5"><SPAN class="STYLE2"><?php echo $result4['comment']; ?></SPAN></td>
											</tr>
											<tr>
												<label>
													<td colspan="5" align="right"><input type="checkbox" id = "<?php echo $result4['id']; ?>" name="<?php echo $result4['id']; ?>" value="<?php echo $result4['id']; ?>" /><?php echo "  Commentator: ".$result4['username']; ?></td>											
												</label>
											</tr>
					<?php
								}
								$j ++;
							}
					?>	
											<tr align="right">
												<td colspan="6"><input id="AllowShowCom" name="AllowShowCom" type="submit" value="Allow show"></td>
											</tr>
										</form>
									</table>
								</td> 
							</tr>
						</table></td>
					</tr>
				</table></td> 
			</tr>	
			</table>
			<br> <br><br>		
		  </TD> 
		</TR>
	<?php
		}
	?>
   </TBODY> 
  </TABLE> 

<?php
	if (isset($_POST["AllowShowPic"])){
		for($i = 0; $i < $numofpics; $i ++){
			if (array_key_exists($picArray[$i], $_POST)) {
				$res = mysql_query("UPDATE tb_picture SET admi = 1 WHERE id = '".$picArray[$i]."'", $mycon) or die('Error: ' . mysql_error());
				if($res){
					echo "<script> alert('Modify picture show success!');</script>";
					echo "<script>window.location.href = window.location.href;</script>";
				}else{
					echo "<script> alert('Modify picture show failed!');</script>";
					echo "<script> history.go(-1);</script>";
				}
			}
		}
	}
	
	if (isset($_POST["AllowShowCom"])){
		for($i = 0; $i < $numofcomms; $i ++){
			if (array_key_exists($commArray[$i], $_POST)) {
				$res = mysql_query("UPDATE tb_comment SET admi = 1 WHERE id = '".$commArray[$i]."'", $mycon) or die('Error: ' . mysql_error());
				if($res){
					echo "<script> alert('Modify comment show success!');</script>";
					echo "<script>window.location.href = window.location.href;</script>";
				}else{
					echo "<script> alert('Modify comment show  failed!');</script>";
					echo "<script> history.go(-1);</script>";
				}
			}
		}
	}
	
	if (isset($_POST["PicDiscrip"])){
		$res = mysql_query("UPDATE tb_picture SET picdiscrip = '".$_POST["Pic_discrip"]."' WHERE id = '".$_POST['changePicDiscrip']."'", $mycon) or die('Error: ' . mysql_error());
		if($res){
			echo "<script> alert('Modify picture description success!');</script>";
				echo "<script>window.location.href = window.location.href;</script>";
		}else{
			echo "<script> alert('Modify picture description failed!');</script>";
				echo "<script> history.go(-1);</script>";
		}
	}

?>
 </body>
</html>