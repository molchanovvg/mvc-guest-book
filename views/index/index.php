<ul class="pager">
	<li><a href="/index">MAIN</a></li>
	<li><a href="/admin/login">LOGIN</a></li>
</ul>
<ul class="pager">
	<li><a href="/index/?name=asc">Имя &uarr;</a></li>
	<li><a href="/index/?name=desc">Имя &darr;</a></li>
	<li><a href="/index/?email=asc">Email &uarr;</a></li>
	<li><a href="/index/?email=desc">Email &darr;</a></li>
	<li><a href="/index/?date=asc">Дата &uarr;</a></li>
	<li><a href="/index/?date=desc">Дата &darr;</a></li>
</ul>

<?php
	if ($messageOk) {?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Комментарий отправлен!</strong>
		</div>
	<?php } ?>


<?php if($comments): ?>
	<?php foreach($comments as $comment): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?=$comment['name'];?>
			<em>(<?=$comment['email'];?>)</em>
			<?php
			if ($comment['moderate']) {
				?>
				- отредактирован администратором
				<?php
			}
			?>
		</div>
		<div class="panel-body">
			<h6><?=$comment['comment'];?></h6>
			<p><?=$comment['date'];?></p>
			<?php
				$pathToPicture = ".." . DS . "uploads_pic" . DS . $comment['pic'];
				$pathToPictureFull = SITE_PATH . DS . "uploads_pic" .  DS . $comment['pic'];
				if (is_file($pathToPictureFull)) {
				?>
					<p id="image_in_comment"><img src="<?php echo $pathToPicture; ?>" alt=" "></p>
				<?php
			}
			?>
		</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>

<div class="jumbotron vertical-center">
	<form id="myForm" enctype="multipart/form-data" method="post" action="/index" class="form-horizontal">
		<fieldset>
			<legend>Оставьте свой комментарий</legend>
			<div class="form-group">
				<label for="name" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
					<input class="form-control" id="name" placeholder="Name" type="text" name="name">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10">
					<input class="form-control" id="inputEmail" placeholder="Email" type="email" name="email">
				</div>
			</div>
			<div class="form-group">
				<label for="textArea" class="col-lg-2 control-label">Comment</label>
				<div class="col-lg-10">
					<textarea class="form-control" rows="3" id="textArea" name="comment"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
					<input type="file" class="btn btn-info" name="userfile" />
					<script type="text/javascript">
						$('input[type=file]').bootstrapFileInput();
						$('.file-inputs').bootstrapFileInput();
					</script>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<input type="submit" class="btn btn-primary" name="submit" value="Отправить">
					<input type="button" class="btn btn-info" name="presubmit" id="presend" value="Предпросмотр">
				</div>
			</div>
		</fieldset>
	</form>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div id="preview-name"></div>
						<em id="preview-email"></em>
					</div>
					<div class="panel-body">
						<h6 id="preview-comment"></h6>
						<p id="preview-image-in-comment"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$('#presend').click(function () { // по клику на кнопку выполнить код
			var modalBody = $('#myModal .modal-body');
			// поместить внутрь блока кусок HTML
			modalBody.find('#preview-name').html($('#name').val());
			modalBody.find('#preview-email').html($('#email').val());
			modalBody.find('#preview-comment').html($('#textArea').val());
			// show modal
			$('#myModal').modal('show', true);
		});
	});
</script>
