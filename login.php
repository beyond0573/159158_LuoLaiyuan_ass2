<?php 
	session_start(); 
	include "conn.php";
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<link href="./style.css" rel="stylesheet" type="text/css">
		<title>Login</title>	
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
							   <TD class="STYLE4"><SPAN class="STYLE3"><a href="index.php">Manage Page</a></SPAN></TD>
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
				  <form  name="myform" method="post" action="login.php"  enctype="multipart/form-data">
				  <table width="450" border="1" cellpadding="3" cellspacing="1" bordercolor="#D6E7A5">
                      <tr>
                        <td class="i_table" colspan="2">&nbsp;<span class="tableBorder_LTR">Login</span></td>
                      </tr>
                      <tr>
                        <td valign="top" align="right" width="28%"><SPAN class="STYLE2">User Name:</SPAN><br></td>
                        <td width="72%"><input name="Log_userName" type="text" id="Log_userName" size="40"></td>
                      </tr>
                      <tr>
                        <td align="right" width="28%"><SPAN class="STYLE2">Passward:</SPAN></td>
                        <td width="72%">
							<input name="Log_paswd" type="password" id="Log_paswd" size="40"></td>	
						</td>
                      </tr>
                      <tr align="center">
                        <td colspan="2"><input name="Log_submit" type="submit" id="Log_submit" value="Log in" >                          &nbsp;
                          <input name="Log_reset" type="reset" id="Log_reset" value="reset"></td>
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
  </TBODY> 
 </TABLE> 
</body>
</html>


<?php
	$logName = $_POST["Log_userName"] ;
	$logPwd = $_POST["Log_paswd"] ;
	
	
	if(isset($_POST["Log_submit"])){
		if(empty($logName)){
			echo "<script>alert('Please enter your account.');</script>";
	    } else if(empty($logPwd)){
			  	echo "<script>alert('Please enter your password.');</script>";
			} else {
				$logPwd = md5($logPwd);
				$sql = "select * from tb_users where name = '".$logName."'";
				$result = mysql_query($sql, $mycon) or die('Error: ' . mysql_error());
				$do = mysql_num_rows($result);
				if ($do != 0){
					$sql = "select * from tb_users where name = '".$logName."' and passward = '".$logPwd."'";
					$result = mysql_query($sql, $mycon) or die('Error: ' . mysql_error());
					$do = mysql_num_rows($result);
					if ($do != 0){
						$do2 = mysql_fetch_array($result);
						$_SESSION["username"] = $logName;
						$_SESSION["admin"] = $do2[admi];
						echo "<script> window.location.href ='index.php'</script>";
					} else {
						echo "<script> alert('Incorrect password, Please login again');</script>";
					}
				}
				echo "<script> alert('User name does not exist, please register!');</script>";
				echo "<script> window.location.href ='registration.php'</script>";	
			}
	}
?>