<?php 
	session_start(); 
	include "conn.php";
	date_default_timezone_set('Asia/Shanghai'); 
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<link href="./style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="check.js"></script>
		<title>Add Picture</title>	
	</head>

<body>
<TABLE width="757" cellPadding=0 cellSpacing=0 style="WIDTH: 755px" align="center"> 
  <TBODY> 
    <TR> <TD style="VERTICAL-ALIGN: bottom; HEIGHT: 6px" colSpan=3> 
		<TABLE style="BACKGROUND-IMAGE: url( images/f_head.jpg); WIDTH: 760px; HEIGHT: 154px" cellSpacing=0 cellPadding=0> 
			<TBODY> 
				<TR> <TD height="110" colspan="6" style="VERTICAL-ALIGN: text-top; WIDTH: 80px; HEIGHT: 115px; TEXT-ALIGN: right"></TD> 
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
							   <TD class="STYLE4"><SPAN class="STYLE3"><a href="index.php">Manage User</a></SPAN></TD>
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
		if (isset($_SESSION["username"])){
	?>
    <TR> 
      <TD colSpan=3 valign="baseline" style="BACKGROUND-IMAGE: url( images/bg.jpg); VERTICAL-ALIGN: middle; HEIGHT: 450px; TEXT-ALIGN: center"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="451" align="center" valign="top"><br>
            <table width="640"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="613" height="23" align="right" valign="top">&nbsp;</td><br>
            </tr>
            <tr>
              <td height="223" align="center" valign="top">
			  <table width="380" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
				  <form  name="myform" method="post" action="add_pic.php"  enctype="multipart/form-data">
				  <table width="450" border="1" cellpadding="3" cellspacing="1" bordercolor="#D6E7A5">
                      <tr>
                        <td class="i_table" colspan="2">&nbsp;<span class="tableBorder_LTR">Add picture</span></td>
                      </tr>
                      <tr>
                        <td valign="top" align="center" width="50%"><SPAN class="STYLE2">Picture Name:</SPAN><br></td>
						<input id="userName3" name="userName3" type="hidden" value="<?php echo $_SESSION["username"];?>">
                        <td width="50%"><input name="picName" type="text" id="picName" size="40"></td>
                      </tr>
					  <tr>
                        <td valign="top" align="center" width="50%"><SPAN class="STYLE2">Picture description:</SPAN><br></td>
						<td colspan="5"><textarea name="Pic_discrip" cols="50" rows="8" id="Pic_discrip" ></textarea></td>
                      </tr>
                      <tr>
                        <td align="center" width="50%"><SPAN class="STYLE2">Load path:</SPAN></td>
                        <td width="50%">
							<input type="hidden" name="action" value="upload" />
							<input name="fileName" type="file" size="23" maxlength="60" id="fileName"/>	
						</td>
                      </tr>
                      <tr align="center">
                        <td colspan="2"><input name="addPic_submit" type="submit" id="addPic_submit" value="Add" onClick = "chkPic()"> &nbsp;
                          <input name="addPic_reset" type="reset" id="addPic_reset" value="reset"></td>
                        </tr>
                  </table>
				  </form>
				  </td>
                </tr>
              </table></td>
          </tr>
          </table>            </td>
		</tr>
	   </table>
	  </TD> 
    </TR>
	<?php	
		} 
	?>	
  </TBODY> 
</TABLE> 
</body>
</html>

<?php
	session_start(); 
	$upload_dir = "./submissions/";
	$profix = array(".jpeg", ".gif",".jpg",".pjpeg");
	$f_name = $_FILES["fileName"]["name"];
	$pro_name = substr($f_name, strrpos($f_name,"."));
	$picName = $_POST["picName"].$pro_name;
	$upload_file =  $upload_dir.iconv("UTF-8","gb2312",$picName);
	$author = $_SESSION["username"];
	$timestamp = date("G:i:s M j Y");
	$picDis = $_POST["Pic_discrip"];
	$allow_show = 0;
	
	$res = mysql_query("Select name from tb_picture where name = '".$picName."'", $mycon) or die('Error: ' . mysql_error());
	if(isset($_POST["addPic_submit"])){	
		if($author != ""){
			if (in_array($pro_name,$profix)){
				if(($_FILES["fileName"]["size"] > 2000000) &&($_FILES["fileName"]["size"] < 0)){
					echo "<script>alert('The size of picture is more than 2M, please choose a new one!');</script>";
				}
				if ($_FILES["fileName"]["error"] > 0){
					$waring = "Return Code: ".$_FILES["fileName"]["error"] . "<br />";
					echo "<script>alert('$wraring');</script>";
				}else if (mysql_num_rows($res)) {
					$waring = $picName." already exists. ";
					echo "<script>alert('$waring');</script>";
				}else{
					move_uploaded_file($_FILES["fileName"]["tmp_name"], $upload_file);
					mysql_query("INSERT INTO tb_picture(name, author, admi, picture, time, picdiscrip) VALUES ('$picName', '$author', '$allow_show', '$upload_file', '$timestamp', '$picDis')", $mycon)  or die('Error: ' . mysql_error()); 
					echo "<script>alert('Add picture success!');</script>";
					echo "<script>window.location.href = window.location.href;</script>";
				}
			} else { 
				echo "<script>alert('Invalid file');</script>";
			}
		} else {
			echo "<script> alert('Time out, please login again!');</script>";
			echo "<script>window.self.location='login.php'</script>";
		}
    }
?>