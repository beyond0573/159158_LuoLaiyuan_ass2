<?php
	session_start();
	include "conn.php";
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
											   <TD class="STYLE4"><SPAN class="STYLE3"><a href="index.php">Manage user</a></SPAN></TD> 
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
							<?php
								if ($_SESSION["admin"] == 1){
							?>
							<tr><td height="651" align="center"><br>
								<table width="640" height="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="#ABADB3"> 
									<tr align="right" bgcolor="#FFFFFF"><td width="390" height="25" colspan="6" valign="top" bgcolor="#EFF7DE">
										<table width="600" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF">
											<tr>
												<td align="center" width="100%"><SPAN class="tableBorder_LTR">Change Users's authority:</span></td>
											</tr>
											<table width="600" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF">
												<tr>
													<td align="left" width="28%"><SPAN class="STYLE2">Users:</span></td>
												</tr>
									
												<tr>
													<td colspan="6">
														<form  name="chgAutform" method="post" action="manageuser.php" >
														<?php
															$j = 0;
															$sql = mysql_query("select * from tb_users", $mycon) or die('Error: ' . mysql_error());
															$numofusers  = mysql_num_rows($sql);
															while($info = mysql_fetch_array($sql)){
																if( $info['admi'] == 0){
														?>
															<label>
																<input type="checkbox" id = "<?php echo $info['name']; ?>" name="<?php echo $info['name']; ?>" value="<?php echo $info['name']; ?>" />
																	<SPAN class="STYLE2"/><?php echo $info['name']; ?></SPAN>
															</label>
														<?php
																	$array[$j] = $info['name'];
																}
																$j++;
															}
														?>
															<tr align="center">
																<td colspan="5"><SPAN class="STYLE2"><input name="chgAut_submit" type="submit" id="chgAut_submit" value="submit" ></span>                          &nbsp;
																<SPAN class="STYLE2"><input name="chgAut_reset" type="reset" id="chgAut_reset" value="reset"></span></td>
															</tr>
														</form>	
													</td>
												</tr>
									
											</table>
										</table>
										</td>
									</tr>
									<?php
									}
									?>	
								</table></td> 
							</tr>
						</table>
					</TD>
				</TR>
				<?php
					}
				?>
			</TBODY> 
		</TABLE>
		<?php
			if(isset($_POST["chgAut_submit"])){
				for($i = 0; $i < $numofusers; $i ++){
					if (array_key_exists($array[$i], $_POST)) {
						$res = mysql_query("UPDATE tb_users SET admi = 1 WHERE name = '".$array[$i]."'", $mycon) or die('Error: ' . mysql_error());
						if($res){
							echo "<script> alert('Change author success!');</script>";
							echo "<script>window.location.href = window.location.href;</script>";
						}else{
							echo "<script> alert('Change author failed!');</script>";
							echo "<script> history.go(-1);</script>";
						}
					}
				}
			}
		?>
	</body>
</html>