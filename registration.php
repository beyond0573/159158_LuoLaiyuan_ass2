<?php 
	session_start(); 
	include "conn.php";
	date_default_timezone_set('Asia/Shanghai'); 
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<link href="./style.css" rel="stylesheet" type="text/css">
		<title>Registration</title>
		<script type="text/javascript" src="check.js"></script>
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
				  <form  name="myform" method="post" action="registration.php"  enctype="multipart/form-data" onsubmit="return checkSubmit()">
				  <table width="650" border="1" cellpadding="3" cellspacing="1" bordercolor="#D6E7A5">
                      <tr>
                        <td class="i_table" colspan="2">&nbsp;<span class="tableBorder_LTR">Registration</SPAN></span></td>
                      </tr>
					  
                      <tr>
                        <td valign="top" align="right" width="20%"><SPAN class="STYLE2">User Name:</SPAN><br></td>&nbsp;&nbsp;  <!--注册用户名-->
                        <td width="42%"><input name="Reg_userName" type="text" id="Reg_userName" size="40" onblur="chkUsername(this.value)"></td>
						<td><span class="STYLE2" id="userInfor"></span></td>
                      </tr>
					  
                      <tr>
                        <td align="right" width="20%"><SPAN class="STYLE2">Passward:</SPAN></td>&nbsp;&nbsp;<!--注册密码-->
                        <td width="42%"><input name="Reg_paswd" type="password" id="Reg_paswd" size="40" onkeyup="chkPwd1(this.value)"></td>
						<td><span class="STYLE2" id="pwdInfor"></span></td>
                      </tr>
					  
					  <tr>
                        <td align="right" width="20%"><SPAN class="STYLE2">Passward check:</SPAN></td>&nbsp;&nbsp;<!--密码检验-->
                        <td width="42%"><input name="Reg_paswdCk" type="password" id="Reg_paswdCk" size="40" onkeyup="chkPwd2(this.value)"></td>
						<td><span class="STYLE2" id="pwdCheckInfor"></span></td>
                      </tr>
					  
					  <tr>
                        <td align="right" width="20%"><SPAN class="STYLE2">Email:</SPAN></td>&nbsp;&nbsp;<!--注册邮箱-->
                        <td width="42%"><input name="Reg_email" type="text" id="Reg_email" size="40" onblur="chkEmail(this.value)"></td>
						<td><span class="STYLE2" id="emailCheckInfor"></span></td>
                      </tr>
					  
					  <tr>
						<td align="right" width="20%"><SPAN class="STYLE2">Sex:</SPAN></td><!--性别-->
						<td width="42%">&nbsp;&nbsp;&nbsp;<SPAN class="STYLE2">Male:</SPAN><input name="Reg_sex" type="radio" value="Male" checked="checked" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<SPAN class="STYLE2">Female:</SPAN><input name="Reg_sex" type="radio"  value="Female" /></td>
					  </tr>
					
					  <tr>
						<td align="right" width="20%"><SPAN class="STYLE2">Country:</SPAN></td><!--国籍-->
						<td colspan="6"><label>&nbsp;&nbsp;
						<select name="Reg_country">
							<option value="China"><SPAN class="STYLE2">China</SPAN></option>
							<option value="USA"><SPAN class="STYLE2">USA</SPAN></option>
							<option value="UN"><SPAN class="STYLE2">UN</SPAN></option>
						</select>
						</label> </td>
					  </tr>
					  
					  <tr>
						<td align="right" width="20%"><SPAN class="STYLE2">Intresting:</SPAN></td><!--爱好-->
						<td colspan="6" > <label>&nbsp;&nbsp;
							<input type="checkbox" name="sport" value="sport" id="sport"/><SPAN class="STYLE2">Sport</SPAN>&nbsp;&nbsp;
							<input type="checkbox" name="reading" value="reading" id="reading"/><SPAN class="STYLE2">Reading </SPAN>&nbsp;&nbsp;
							<input type="checkbox" name="playgame" value="playgame" id="playgame"/><SPAN class="STYLE2">Play Game</SPAN>&nbsp;&nbsp;
							<input type="checkbox" name="other" value="other" id="other"><SPAN class="STYLE2"/>Other</SPAN>
							</label></td>
					  </tr>
                      <tr align="center">
                        <td colspan="2"><input name="Reg_submit" type="submit" id="Reg_submit" value="submit" >&nbsp;&nbsp;
                          <input name="Reg_reset" type="reset" id="Reg_reset" value="reset"></td>
                        </tr>
                  </table>
				  </form>
				  </td>
                </tr>
              </table></td>
          </tr>
          </table></td>
		</tr>
	   </table>
	  </TD> 
    </TR>  
  </TBODY> 
 </TABLE> 
</body>
</html>


<?php
	if(count($_POST) != 0){
		//获取爱好信息
		if (array_key_exists('sport', $_POST)) {
			$sport = 'sport';
		} else {
			$sport = '';
		}
		if (array_key_exists('reading', $_POST)) {
			$reading = 'reading';
		} else {
			$reading = '';
		}
		if (array_key_exists('playgame', $_POST)) {
			$playgame = 'playgame';
		} else {
			$playgame = '';
		}
		if (array_key_exists('other', $_POST)) {
			$other = 'other';
		} else {
			$other = '';
		}
		$intresting= array(
				'sport' => $sport,
				'reading' => $reading,
				'playgame' => $playgame,
				'other' => $other,
			);
			
		$intresting = serialize($intresting);
		$admin = 0;
		$regname = $_POST[Reg_userName];
		$regpwd = $_POST[Reg_paswd];
		$regpwd = md5($regpwd);
		$regemail = $_POST[Reg_email];
		$regsex = $_POST[Reg_sex];
		$regcountry = $_POST[Reg_country];
		$timestamp = date("G:i:s M j Y");

		//将注册信息插入数据库	
		$sql = "INSERT INTO tb_users(name, passward, admi, email, sex, country, intrest, time)VALUES('$regname', '$regpwd', '$admin', '$regemail', '$regsex', '$regcountry', '$intresting', '$timestamp')";
		$INS = mysql_query($sql, $mycon) or die('Error: ' . mysql_error());
			
		if($INS){
			echo "<script> alert('Registrate success!');</script>";
			echo "<script> window.location.href='login.php';</script>";
		}
	}
?>
