<?php if($messages) : ?>
<div class="container mt-2">
    <div class="row">
<?php foreach ($messages as $message) : ?>
            <div class="alert alert-<?= $message['type'] ?>" role="alert">
                <?= $message['msg'] ?>
            </div>
<?php endforeach ?>
            </div>
    </div>
</div>
<?php endif ?>