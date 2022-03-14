<form method="POST" action="<?php echo $this->getUrl('loginPost');?>">
	<table border="1" width="100%" cellspacing="4">
		
		<tr>
			<td colspan="2"><b>Admin Login</b></td>
		</tr>
		
		<tr>
			<td width="10%">Email</td>
			<td><input type="email" name="login[email]"></td>
		</tr>

		<tr>
			<td width="10%">Password</td>
			<td><input type="passowrd" name="login[password]"></td>
		</tr>
		
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" value="Login"> 
			</td>
		</tr>
	</table>
</form>