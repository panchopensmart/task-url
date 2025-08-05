<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->beginPage();
?><!DOCTYPE html>
<html>
<head>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>