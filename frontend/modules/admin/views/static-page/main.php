<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\MainPage */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('static', 'Update static');
$this->params['breadcrumbs'][] = ['label' => 'static', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');

?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Static'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('static', 'Update static'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="static-update">
            <div class="menu-form">
                <?php $form = ActiveForm::begin(); ?>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab"
                                          href="#panel1"><?php echo Yii::t('admin', 'Main info') ?></a>
                    </li>
                    <?php
                    $models = $model->pageTranslation;
                    foreach ($models as $lang):?>
                        <li><a data-toggle="tab" href="#<?= $lang->lang ?>"><?= $lang->language->name; ?></a></li>
                    <?php endforeach ?>
                    <div class="tab-content">
                        <div id="panel1" class="tab-pane fade in active">
                            <div class="col-sm-12 down">
                                <?php if ($model->file): ?>
                                <?php if(preg_match('/(mp4|mpeg4)$/ui', $model->file)): ?>
                                    <video src="<?php echo $model->file?>"></video>
                                <?php else: ?>
                                    <img src="<?php echo $model->file ?>" style="width: 100px; margin: 10px">
                                <?php endif ?>
                                <?php endif ?>
                                <?= $form->field($model, 'file')->fileInput(); ?>
                                <div class="menu-languages">
                                    <div class="add-lang button-inline">
                                        <button class="btn btn-primary add-lang"
                                                data-id="<?php echo count($model->lang) ?>"><?php echo Yii::t('static', 'Add lang') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($models as $index => $lang): ?>
                            <div id="<?= $lang->lang ?>" class="tab-pane fade in ">
                                <div class="col-sm-12 add-language">
                                    <?php echo $this->render('_form_lang_main', ['model' => $lang, 'index' =>
                                        $index]) ?>
                                    <button class="btn btn-danger del-lang"><?php echo Yii::t('static', 'Del lang') ?></button>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </ul>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = "
    $(document).on('click', '.add-lang', function (event) {
        var index = $(this).attr('data-id');
        index = parseInt(index) +1;
        var block = $(this).closest('.add-language');
        $('.add-lang').remove();
        $.ajax({
            url: '" . Url::toRoute('/admin/static-page/languagemain') . "',
            type:'post',
            data:{lang:'add', index:index},
            dataType:'json',
            success: function(res)
            {
                if(res)
                {
                    $('div').siblings('.add-lang').remove();
                    var button = $('<button/>').text('" . Yii::t('static', 'Del lang') . "').addClass('btn btn-danger del-lang');
                    block.append(button);
                    var lines = $('<div />').addClass('add-language');
                    lines.append(res.data);
                    button = $('<button/>').text('" . Yii::t('static', 'Add lang') . "').addClass('btn btn-primary add-lang').attr('data-id', index);
                    lines.append(button);
                    $('.menu-languages').append(lines);
                    CKEDITOR.replace('cke'+index, {
                        filebrowserBrowseUrl : '/elfinder/manager',
                        language : '" . Yii::$app->language . "',
                    });
                }
                else
                {
                    console.log('no');
                }
            },
            error: function()
            {
            alert('Ошибка подключения!');
            }
        });
        return false;
    });
    
    $(document).on('click', '.del-lang', function () {
        $(this).closest('.add-language').remove();
	});
    
    ";
$this->registerJs($script, yii\web\View::POS_END);

$slug = " $('#staticpage-url').slugify('input[name=\"StaticPageTranslation[0][title]\"]');";
$this->registerJs($slug, yii\web\View::POS_END);
?>
