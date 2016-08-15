
<ul class="pager">
    <li><a href="/admin/logout">Logout</a></li>
</ul>
<ul class="pager">
    <li><a href="/admin/?status=asc">Статус &uarr;</a></li>
    <li><a href="/admin/?status=desc">Статус &darr;</a></li>
    <li><a href="/admin/?date=asc">Дата &uarr;</a></li>
    <li><a href="/admin/?date=desc">Дата &darr;</a></li>
</ul>

<?php if($comments): ?>
    <?php foreach($comments as $comment): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Статус: <b><?=$comment['status'];?></b>
                <a href="/admin/edit?id=<?=$comment['id'];?>" class="btn btn-info btn-xs">Edit</a>
                <a href="/admin/changestatus?id=<?=$comment['id'];?>&status=approved" class="btn btn-success btn-xs">Approved</a>
                <a href="/admin/changestatus?id=<?=$comment['id'];?>&status=rejected" class="btn btn-primary btn-xs">Reject</a>
            </div>
            <div class="panel-heading">
                <?=$comment['name'];?>
                <em>
                    <?=$comment['email'];?>
                    <?=$comment['date'];?>
                </em>
            </div>
            <div class="panel-body">
                <p><?=$comment['comment'];?></p>
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