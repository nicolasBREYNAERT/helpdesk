<?php use micro\js\Jquery;
?>
<div class="container">
	<div class="well well-lg main" id="main">
		<h2>Informations du compte</h2>
		<br>
			<fieldset>
				<table>
					<tr><td colspan="3"><label>login</label></td></tr>
					<tr><td><?php echo $login;?></td><td>&nbsp;&nbsp;</td><td><a class="btn btn-primary btAjaxLogin" >Modifier</a></td>
					<tr><td colspan="3"><label>password</label></td></tr>
					<tr><td><input class="form-control" type="password" value="<?php echo $password;?>" disabled></td><td></td><td><a class="btn btn-primary btAjaxPassword">Modifier</a></td>
				</table>
			</fieldset>
	</div>
	<div id="response"></div>
</div>
<?php 
Jquery::getOn("click", ".btAjaxLogin", "defaultC/ajaxLogin","#response");
Jquery::getOn("click", ".btAjaxPassword", "defaultC/ajaxPassword","#response");
Jquery::getOn("click", ".btAjaxMail", "defaultC/ajaxMail","#response");
echo Jquery::compile();?>