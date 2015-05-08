<?php 
	session_start(); 
	include "conn.php";
	date_default_timezone_set('Asia/Shanghai'); //设置时区为上海
	//新建一个存放评论的表格
	$do = mysql_query("CREATE TABLE IF NOT EXISTS tb_comment (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`username` varchar(20) NOT NULL,
		`admi` int(2) NOT NULL,
		`picName` varchar(20) NOT NULL,
		`comment` text NOT NULL,
		`time` varchar(20) NOT NUll
	)ENGINE=MyISAM DEFAULT CHARSET=latin1;", $mycon) or die('Error: ' . mysql_error());
	//新建一个存放图片的表格	
	$do = mysql_query("CREATE TABLE IF NOT EXISTS tb_picture (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`name` varchar(20) NOT NULL,
		`author` varchar(20) NOT NULL,
		`admi` int(2) NOT NULL,
		`picture` text NOT NULL,
		`time` varchar(20) NOT NUll,
		`picdiscrip` text NOT NUll
	)ENGINE=MyISAM DEFAULT CHARSET=latin1;", $mycon) or die('Error: ' . mysql_error());
	//新建一个存放用户的表格
	$do = mysql_query( " CREATE TABLE IF NOT EXISTS tb_users (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`name` varchar(20) NOT NULL,
		`passward` text NOT NULL,
		`admi` int(2) NOT NULL,
		`email` varchar(40) NOT NULL,
		`sex` varchar(20)  NOT NUll,
		`country` varchar(20) NOT NULL,
		`intrest` text,
		`time` varchar(20) NOT NUll
	)ENGINE=MyISAM DEFAULT CHARSET=latin1;", $mycon) or die('Error: ' . mysql_error());
	//向tb_uaers表中新增管理员用户admin，默认密码qqqqqq。
	$do = mysql_query("select * from tb_users where name = 'admin'", $mycon) or die('Error: ' . mysql_error());
	$do1 = mysql_num_rows($do);  //返回查询结果，如果存在相关目录，则不执行插入管理员用户
	if($do1 == 0){
		$do = mysql_query("INSERT INTO `tb_users` (`id`, `name`, `passward`, `admi`, `email`, `sex`, `country`, `intrest`, `time`) values( 1, 'admin', '343b1c4a3ea721b2d640fc8700db0f36', 1, 'qq@qq.com', 'Male', 'China',  \"a:4:{s:5:'sport';s:5:'sport';s:7:'reading';s:7:'reading';s:8:'playgame';s:0:'';s:5:'other';s:0:'';}\", '14:11:12 May 17 2013' )", $mycon) or die('Error: ' . mysql_error());
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta http-equiv="refresh" content="60"> 
		<link href="./style.css" rel="stylesheet" type="text/css">
		<title>index</title>
		<script type="text/javascript" src="check.js"></script> <!--从外部导入javascript脚本-->
	</head>

<body>
  <TABLE width="757" cellPadding=0 cellSpacing=0 style="WIDTH: 755px" align="center"> 
   <TBODY> 
		<TR> <!--设置网页导航栏信息-->
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
										if(!isset($_SESSION["username"])){//如果没有登录，则显示登录和注册导航栏
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
									  if($_SESSION["admin"] == 1){ //如果是管理员，则具有修改用户和图片基本信息的权限
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
					<?php
						$link3 = "select * from tb_picture where admi = 1"; //找出全部被允许展示的图片
						$result1 = mysql_query($link3, $mycon) or die('Error: ' . mysql_error());
						
 						$pic_count = mysql_num_rows($result1);
						$i = 0;
						while( $result2 = mysql_fetch_array($result1)){
							$idArray[$i] = $result2['id']; //讲允许展示的图片的id号放在一个数组中，以后通过数组访问允许被展示的图片
							$i ++;
						}
						
						if($_GET['usePicNum']=="" || is_numeric($_GET['usePicNum'] == false)){ //获得当前的页面，如果没有，则默认展示第一张图片
							$curr_pic_num = $pic_count;
							$_SESSION["usePicNum"] = $pic_count;
						} else {
						    $curr_pic_num = $_GET['usePicNum'];
							$_SESSION["usePicNum"] = $_GET['usePicNum'];
						}
						$curr_pic_id = $curr_pic_num - 1;
						$result1 = mysql_query("select * from tb_picture where id = '".$idArray[$curr_pic_id]."' order by id desc") or die('Error: ' . mysql_error());
						$result2 = mysql_fetch_array($result1); 	
						$_SESSION["userPicName"] = $result2['name'];
					?>
									<table width="496" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3">
					<?php
						if( $pic_count != 0 ){
							if($result2['admi'] == 1){
					?>
										<tr><td height="57" align="center" valign="top" ><!--图片展示区域-->
											<table width="565" height="307"  border="1" cellpadding="1" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF" class="i_table">
												<tr bgcolor="#FFFFFF">
													<td width="11%" height="65" align="center"><SPAN class="STYLE2">Name:</SPAN> </td>
													<td width="19%"><SPAN class="STYLE2"><?php echo $result2['name']; ?></SPAN></td>
													<td width="11%" align="center"><SPAN class="STYLE2">Author: </SPAN></td>
													<td width="18%"><SPAN class="STYLE2"><?php echo $result2['author']; ?></SPAN></td>
													<td width="11%" align="center"><SPAN class="STYLE2">Add time: </SPAN></td>
													<td width="30%"><SPAN class="STYLE2"><?php echo $result2['time']; ?></SPAN></td>
												</tr>
												<?php
													if($_SESSION["username"] == $result2['author']){
												?>
												<form  name="myform" method="post" action="index.php"  enctype="multipart/form-data">
													<tr bgcolor="#FFFFFF">
														<td height="85" align="center"><SPAN class="STYLE2">Change description:</SPAN> </td><!--图片描述展示区域，如果是作者或者管理员则有权限修改描述-->
														<input name="changePicDiscrip" type="hidden" value="<?php echo $_SESSION['userPicName'];?>">
														<td colspan="5"><SPAN class="STYLE2"><textarea name="Pic_discrip" cols="80" rows="8" id="Pic_discrip" ><?php echo $result2['picdiscrip']; ?></textarea></SPAN></td>
													</tr>
													<tr align="right">
														<td colspan="6"><input name="PicDiscrip" type="submit" id="PicDiscrip" value="Change description"></td>
													</tr>
												</form>
												<?php
													} else{
												?>
												<tr bgcolor="#FFFFFF">
													<td height="85" align="center"><SPAN class="STYLE2">description:</SPAN> </td>
													<td colspan="5"><SPAN class="STYLE2"><?php echo $result2['picdiscrip']; ?></SPAN></td>
												</tr>
												<?php		
													}
												?>
												<tr bgcolor="#FFFFFF">
													<td height="200" align="center"><SPAN class="STYLE2">Picture:</SPAN> </td>
													<td colspan="5"><div align="center"><img src="<?php echo $result2['picture'];?>"  align="middle" width="225" height="160"></div></td>	
					<?php	
							}		
						} else {
							echo " There have no pictures! ";
						} 	
					?>
												</tr>
											</table></td>
										</tr>
									</table>
								</td>	
							</table>
						</td>	
					</tr>
				</table>
				<?php
					if (isset($_SESSION["userPicName"])){
				?>
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#ABADB3">
					<tr bgcolor="#EFF7DE">
						<td align="right" class="hongse01">
                    <?php
							if($curr_pic_num != 1){ //图片的换页
								$use_pic_page = $curr_pic_num - 1;
								echo  "<a href=index.php?usePicNum=".$pic_count."><SPAN class=\"STYLE2\">Home</SPAN></a>&nbsp;";
								echo "<a href=index.php?usePicNum=".$use_pic_page."><SPAN class=\"STYLE2\">Previous</SPAN></a>&nbsp;";
							}
							if($curr_pic_num < $pic_count){
								$use_pic_page = $curr_pic_num + 1;
								echo "<a href=index.php?usePicNum=".$use_pic_page."><SPAN class=\"STYLE2\">Back</SPAN></a>&nbsp;";
								echo  "<a href=index.php?usePicNum=1><SPAN class=\"STYLE2\">End</SPAN></a>";
							}
					?>
					  </td>
					</tr>
				</table>
				<?php
					}
				?>
				</td><p>&nbsp;</p>
			</tr>
			
			<?php
				if (isset($_SESSION["userPicName"]) && isset($_SESSION["username"])){
			?>
			<tr><td height="651" align="center"><br><!--评论展示区域-->
				<table width="640" height="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="#ABADB3"> 		
					<tr><td height="293" align="center" valign="top">
						<form name="comform" method="post" action="index.php" enctype="multipart/form-data">
							<table width="600" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF">
								<tr align="left" colspan="2" >
									<td width="390" height="25" colspan="3" valign="top" bgcolor="#EFF7DE"> <div align="center"><span class="tableBorder_LTR"> Add a comment</span> </div></td>
								</tr>
									<td height="112" align="center" valign="top" ><input id="picName2" name="picName2" type="hidden" value="<?php if($_SESSION["admin"] != 1){ echo $_SESSION["userPicName"]; } else { echo $_SESSION["adminPicName"]; }?>">
																				  <input id="userName2" name="userName2" type="hidden" value="<?php echo $_SESSION["username"];?>">
										<table width="550"  border="1" cellpadding="1" cellspacing="0" bordercolor="#ABADB3" bgcolor="#FFFFFF">
											<tr>
												<td align="center"><SPAN class="STYLE2">Add your comment</span></td>
												<td width="410"><textarea name="Com_txtArea" cols="66" rows="8" id="Com_txtArea" ></textarea></td>
											</tr>
											<tr align="center"><td colspan="3"><SPAN class="STYLE2"><input type="button" name="Com_submit" id="Com_submit" value="Add your comment" onClick = "chkComment()"></span>&nbsp;
												<SPAN class="STYLE2"><input type="reset" name="Com_reset" id="Com_reset" value="Reset"></span></td>
											</tr>
									    </table>		
									</td>
							</table>
						</form>	
						</td>
					</tr> 
					
					<tr><td height="293" align="center" valign="top">
						<table width="597" height="294" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF">
							<tr align="left" colspan="2" >
								<td width="390" height="21" colspan="3" valign="top" bgcolor="#EFF7DE"><div align="center"><span class="tableBorder_LTR">View comments</span> </div></td>
							</tr>
                    <?php
							$com_pic_name = $_SESSION["userPicName"]; 
							$link1 = "select * from tb_comment where picName = '".$com_pic_name."' and admi = 1 order by time desc"; //找出当前图片的所有评论。
							$result3 = mysql_query($link1, $mycon) or die('Error: ' . mysql_error());	
								if(mysql_num_rows($result3) == 0){
					?>
							<tr><td height="57" align="center" valign="top" ><!--如果没有评论，则显示没有评论-->
									<table width="565" height="307"  border="1" cellpadding="1" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF" class="i_table">
										<tr bgcolor="#FFFFFF">
											<td width="11%" height="65" align="center"><SPAN class="STYLE2">Commentator:</SPAN> </td>
											<td width="18%"><SPAN class="STYLE2"><?php echo "Null"; ?></SPAN></td>
											<td width="12%" align="center"><SPAN class="STYLE2">Add time: </SPAN></td>
											<td width="30%"><SPAN class="STYLE2"><?php echo "Null"; ?></SPAN></td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td height="141" align="center"><SPAN class="STYLE2">Comment:</SPAN> </td>
											<td colspan="6"><SPAN class="STYLE2"><?php echo "There have no comment or the comment can not be allowed to show!"; ?></SPAN></td>
										</tr>
									</table>
								</td>
							</tr>	
					<?php
								} else {
									while($userows = mysql_fetch_array($result3)){
					?>
							<tr><td height="57" align="center" valign="top" >
									<table width="565" height="307"  border="1" cellpadding="1" cellspacing="1" bordercolor="#ABADB3" bgcolor="#FFFFFF" class="i_table">
										<tr bgcolor="#FFFFFF">
											<td width="11%" height="65" align="center"><SPAN class="STYLE2">Commentator:</SPAN> </td>
											<td width="18%"><SPAN class="STYLE2"><?php echo $userows['username']; ?></SPAN></td>
											<td width="12%" align="center"><SPAN class="STYLE2">Add time: </SPAN></td>
											<td width="30%"><SPAN class="STYLE2"><?php echo $userows['time']; ?></SPAN></td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td height="141" align="center"><SPAN class="STYLE2">Comment: </SPAN></td>
											<td colspan="6"><SPAN class="STYLE2"><?php echo $userows['comment']; ?></SPAN></td>
										</tr>
									</table>
								</td> 
							</tr>
					<?php
									}
								} 
					?>
						</table></td>
					</tr>
				</table></td> 
			</tr>
			<?php
				}
			?>
			</table>
			<br> <br><br>		
		  </TD> 
		</TR>  
   </TBODY> 
  </TABLE> 

<?php
	$picName = $_SESSION["userPicName"];
	if (isset($_POST["PicDiscrip"])){//作者或者管理员更改图片的描述信息
		$res = mysql_query("UPDATE tb_picture SET picdiscrip = '".$_POST["Pic_discrip"]."' WHERE name = '".$picName."'", $mycon) or die('Error: ' . mysql_error());
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