<div class="jumbotron vertical-center">
	<form id="myForm" method="post" action="/admin/edit" class="form-horizontal">
		<fieldset>
			<legend>Редактирование комментария</legend>
			<p>Комментарий сделан:</p>
			<p><?=$comment[0]['name'];?> ( <?=$comment[0]['email'];?> ) <?=$comment[0]['date'];?></p>
			<div class="form-group">
				<div class="col-lg-10">
					<textarea class="form-control" rows="3" id="textArea" name="comment"><?=$comment[0]['comment'];?></textarea>
					<input type="hidden" name="id" value="<?=$comment[0]['id'];?>"><br>
					<input type="submit" class="btn btn-primary" name="submit" value="Сохранить">
				</div>
			</div>
		</fieldset>
	</form>
</div>

