<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;

?>

<h1 class="page-header">
    Courses
    <a href="index.php?r=courses/create" class="btn btn-primary pull-right">Create</a>
</h1>

<?php if(null !== Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success"><?=Yii::$app->session->getFlash('success')?></div>
<?php endif;?>

    <ul class="list-group">
        <?php foreach ($courses as $course):?>
            <li class="list-group-item">
                <a href="/index.php?r=students/index&idcourse=<?= $course->idcourses?>"><?= $course->title?></a>
                <a href="index.php?r=courses/delete&idcourse=<?= $course->idcourses?>" class="btn btn-danger btn-sm pull-right">Delete</a>
                <a href="index.php?r=courses/update&idcourse=<?= $course->idcourses?>" class="btn btn-info btn-sm pull-right">Edit</a>
            </li>
        <?php endforeach;?>
    </ul>


<?= LinkPager::widget(['pagination' => $pagination])?>