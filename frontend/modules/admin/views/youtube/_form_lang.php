<?php

use frontend\modules\admin\models\Language;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;

/**
 * @var object $model \frontend\modules\admin\models\ArticleTranslation
 * @var integer $index
 */
?>

<?php $languages = (new Language())->getList(); ?>

<div class="form-group field-articletranslation-lang required <?= $model->getErrors('lang') ? 'has-error' : '' ?>">
    <label class="control-label" for="articletranslation-lang"><?php echo Yii::t('article', 'Language') ?></label>
    <?php echo Html::activeDropDownList($model, 'lang', $languages, ['prompt' => Yii::t('article', 'Select language'), 'class' => 'form-control', 'name' => 'ArticleTranslation[' . $index . '][lang]']); ?>
    <div class="help-block"><?= $model->getFirstError('lang') ?></div>
</div>
<div class="form-group field-articletranslation-title  <?= $model->getErrors('title') ? 'has-error' : '' ?>">
    <label class="control-label" for="articletranslation-title"><?php echo Yii::t('article', 'Title') ?></label>
    <?php echo Html::activeTextInput($model, 'title', ['placeholder' => Yii::t('article', 'Input title'), 'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'ArticleTranslation[' . $index . '][title]']) ?>
    <div class="help-block"><?= $model->getFirstError('title') ?></div>
</div>
<div class="form-group field-articletranslation-short_desk  <?= $model->getErrors('short_desk') ? 'has-error'
    : ''
?>">
    <label class="control-label" for="articletranslation-short_desc"><?php echo Yii::t('article', 'Short description')
        ?></label>
    <?php echo Html::activeTextarea($model, 'short_desc', ['placeholder' => Yii::t('article', 'Input text'),
        'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'ArticleTranslation[' . $index . '][short_desc]']) ?>
    <div class="help-block"><?= $model->getFirstError('short_desc') ?></div>
</div>
<div class="form-group field-articletranslation-seo_title  <?= $model->getErrors('seo_title') ? 'has-error' : ''
?>">
    <label class="control-label" for="articletranslation-seo_title"><?php echo Yii::t('admin', 'Seo title')
        ?></label>
    <?php echo Html::activeTextInput($model, 'seo_title', ['placeholder' => Yii::t('article', 'Input title'), 'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'ArticleTranslation[' . $index . '][seo_title]']) ?>
    <div class="help-block"><?= $model->getFirstError('seo_title') ?></div>
</div>
<div class="form-group field-articletranslation-seo_description  <?= $model->getErrors('seo_description') ? 'has-error'
    : ''
?>">
    <label class="control-label" for="articletranslation-seo_description"><?php echo Yii::t('admin', 'Seo description')
        ?></label>
    <?php echo Html::activeTextarea($model, 'seo_description', ['placeholder' => Yii::t('article', 'Input text'),
        'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'ArticleTranslation[' . $index . '][seo_description]']) ?>
    <div class="help-block"><?= $model->getFirstError('seo_description') ?></div>
</div>
<div class="form-group field-articletranslation-seo_description  <?= $model->getErrors('seo_description') ? 'has-error'
    : ''
?>">
    <label class="control-label" for="articletranslation-seo_keywords"><?php echo Yii::t('admin', 'Seo keywords')
        ?></label>
    <?php echo Html::activeTextarea($model, 'seo_keywords', ['placeholder' => Yii::t('article', 'Input text'),
        'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'ArticleTranslation[' . $index . '][seo_keywords]']) ?>
    <div class="help-block"><?= $model->getFirstError('seo_keywords') ?></div>
</div>
