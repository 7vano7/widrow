<?php

use frontend\modules\admin\models\Language;
use yii\helpers\Html;

?>

<?php $languages = (new Language())->getList(); ?>

<div class="form-group field-menulang-lang required <?= $model->getErrors('lang') ? 'has-error' : '' ?>">
    <label class="control-label" for="menulang-lang"><?php echo Yii::t('menu', 'Lang') ?></label>
    <?php echo Html::activeDropDownList($model, 'lang', $languages, ['prompt' => Yii::t('menu', 'Select language'), 'class' => 'form-control', 'name' => 'MenuLang[' . $index . '][lang]']); ?>
    <div class="help-block"><?= $model->getFirstError('lang') ?></div>
</div>
<div class="form-group field-menulang-menu_name required <?= $model->getErrors('menu_name') ? 'has-error' : '' ?>">
    <label class="control-label" for="menulang-menu_name"><?php echo Yii::t('menu', 'Menu Name') ?></label>
    <?php echo Html::activeTextInput($model, 'menu_name', ['placeholder' => Yii::t('menu', 'Input name'), 'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'MenuLang[' . $index . '][menu_name]']) ?>
    <div class="help-block"><?= $model->getFirstError('menu_name') ?></div>
    <div class="form-group field-menulang-seo_title  <?= $model->getErrors('seo_title') ? 'has-error' : ''
    ?>">
        <label class="control-label" for="menulang-seo_title"><?php echo Yii::t('admin', 'Seo title')
            ?></label>
        <?php echo Html::activeTextInput($model, 'seo_title', ['placeholder' => Yii::t('menu', 'Input title'), 'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'MenuLang[' . $index . '][seo_title]']) ?>
        <div class="help-block"><?= $model->getFirstError('seo_title') ?></div>
    </div>
    <div class="form-group field-menulang-seo_description  <?= $model->getErrors('seo_description') ? 'has-error'
        : ''
    ?>">
        <label class="control-label" for="menulang-seo_description"><?php echo Yii::t('admin', 'Seo description')
            ?></label>
        <?php echo Html::activeTextarea($model, 'seo_description', ['placeholder' => Yii::t('menu', 'Input text'),
            'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'MenuLang[' . $index . '][seo_description]']) ?>
        <div class="help-block"><?= $model->getFirstError('seo_description') ?></div>
    </div>
    <div class="form-group field-menulang-seo_description  <?= $model->getErrors('seo_description') ? 'has-error'
        : ''
    ?>">
        <label class="control-label" for="menulang-seo_keywords"><?php echo Yii::t('admin', 'Seo keywords')
            ?></label>
        <?php echo Html::activeTextarea($model, 'seo_keywords', ['placeholder' => Yii::t('menu', 'Input text'),
            'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'MenuLang[' . $index . '][seo_keywords]']) ?>
        <div class="help-block"><?= $model->getFirstError('seo_keywords') ?></div>
    </div>
</div>


