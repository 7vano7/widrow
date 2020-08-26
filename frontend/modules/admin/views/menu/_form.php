<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\modules\admin\models\Language;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => false, 'enableClientValidation' => false]); ?>
    <?php if (!$model->isNewRecord): ?>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#panel1"><?php echo Yii::t('admin', 'Main info') ?></a>
            </li>
            <?php
            $models = $model->menuLang;
            foreach ($models as $lang):?>
                <li><a data-toggle="tab" href="#<?= $lang->lang ?>"><?= $lang->language->name; ?></a></li>
            <?php endforeach ?>
            <div class="tab-content">
                <div id="panel1" class="tab-pane fade in active">
                    <div class="col-sm-12 down">
                        <?php if ($model->image): ?>
                            <img src="<?php echo $model->image ?>" style="width: 100px; margin: 10px">
                        <?php endif ?>
                        <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'status')->dropDownList($model->getStatuses(), ['prompt' => Yii::t('menu', 'Select status')]) ?>
                        <?= $form->field($model, 'url')->textInput(['placeholder'=>'Url']);?>
                        <?= $form->field($model, 'position')->textInput(['placeholder'=>'Position']);?>
                        <div class="menu-languages">
                            <div class="add-lang button-inline">
                                <button class="btn btn-primary add-lang" data-id="<?php echo count($model->lang)?>"><?php echo Yii::t('menu', 'Add lang') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($models as $index=>$lang): ?>
                    <div id="<?= $lang->lang ?>" class="tab-pane fade in ">
                        <div class="col-sm-12 add-language">
                            <?php echo $this->render('_form_lang', ['model' => $lang, 'index' => $index]) ?>
                            <button class="btn btn-danger del-lang"><?php echo Yii::t('news', 'Del lang') ?></button>
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
    <?php else: ?>
        <div class="menu-languages">
            <?php $i = 1; ?>
            <?php foreach ($model->lang as $lang): ?>
                <div class="add-language">
                    <?php echo $this->render('_form_lang', ['model' => $lang, 'index' => 0]) ?>
                    <?php if (count($model->lang) === $i): ?>
                        <button class="btn btn-primary add-lang" data-id="0"><?php echo Yii::t('coach', 'Add lang') ?></button>
                    <?php else: ?>
                        <button class="btn btn-danger del-lang"><?php echo Yii::t('coach', 'Del lang') ?></button>
                    <?php endif ?>
                    <?php $i++; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?= $form->field($model, 'image')->fileInput();?>
        <?= $form->field($model, 'status')->dropDownList($model->getStatuses(), ['prompt' => Yii::t('menu', 'Select status')]) ?>
        <?= $form->field($model, 'url')->textInput(['placeholder'=>'Url']);?>
        <?= $form->field($model, 'position')->textInput(['placeholder'=>'Position']);?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif ?>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = "
    $(document).on('click', '.add-lang', function (event) {
        var index = $(this).attr('data-id');
        index = parseInt(index) +1;
        var block = $(this).closest('.add-language');
        $('.add-lang').remove();
        $.ajax({
            url: '" . Url::toRoute('/admin/menu/language') . "',
            type:'post',
            data:{lang:'add', index:index},
            dataType:'json',
            success: function(res)
            {
                if(res)
                {
                    $('div').siblings('.add-lang').remove();
                    var button = $('<button/>').text('" . Yii::t('news', 'Del lang') . "').addClass('btn btn-danger del-lang');
                    block.append(button);
                    var lines = $('<div />').addClass('add-language');
                    lines.append(res.data);
                    button = $('<button/>').text('" . Yii::t('coach', 'Add lang') . "').addClass('btn btn-primary add-lang').attr('data-id', index);
                    lines.append(button);
                    $('.menu-languages').append(lines);
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

$slug = " $('#menu-url').slugify('input[name=\"MenuLang[0][menu_name]\"]');";
$this->registerJs($slug, yii\web\View::POS_END);
?>
