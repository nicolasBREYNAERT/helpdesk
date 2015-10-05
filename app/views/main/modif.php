<?php use micro\js\Jquery;
?>
<div class="container">
	<div class="well well-lg">
		<h2>Informations du compte</h2>
		<br>
			<fieldset>
				<table>
					<tr><td colspan="3"><label>login</label></td></tr>
					<tr><td><?php echo $login;?></td><td>&nbsp;&nbsp;</td><td><a class="btn btn-primary" href="DefaultC/modification/login">Modifier</a></td>
					<tr><td colspan="3"><label>password</label></td></tr>
					<tr><td><input class="form-control" type="password" value="<?php echo $password;?>" disabled></td><td></td><td><a class="btn btn-primary" href="DefaultC/modification/password">Modifier</a></td>
					<tr><td colspan="3"><label>email</label></td></tr>
					<tr><td><?php echo $user->getMail();?></td><td></td><td><a class="btn btn-primary" href="DefaultC/modification/mail">Modifier</a></td>
				</table>
			</fieldset>
	</div>
</div>