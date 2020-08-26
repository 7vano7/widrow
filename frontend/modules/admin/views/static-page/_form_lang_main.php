<?php

use frontend\modules\admin\models\Language;
use yii\helpers\Html;

/**
 * var $model StaticPageTranslation model
 * var $index integer
 */
?>

<?php $languages = (new Language())->getList(); ?>

<div class="form-group field-staticpagetranslation-lang required <?= $model->getErrors('lang') ? 'has-error' : '' ?>">
    <label class="control-label" for="staticpagetranslation-lang"><?php echo Yii::t('static', 'Lang') ?></label>
    <?php echo Html::activeDropDownList($model, 'lang', $languages, ['prompt' => Yii::t('static', 'Select language'),
        'class' => 'form-control', 'name' => 'StaticPageTranslation[' . $index . '][lang]']); ?>
    <div class="help-block"><?= $model->getFirstError('lang') ?></div>
</div>
<div class="form-group field-staticpagetranslation-title required <?= $model->getErrors('title') ? 'has-error' : '' ?>">
    <label class="control-label" for="staticpagetranslation-title"><?php echo Yii::t('static', 'Title') ?></label>
    <?php echo Html::activeTextInput($model, 'title', ['placeholder' => Yii::t('static', 'Input title'), 'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'StaticPageTranslation[' . $index . '][title]']) ?>
    <div class="help-block"><?= $model->getFirstError('title') ?></div>
</div>
<div class="form-group field-staticpagetranslation-content required <?= $model->getErrors('title') ? 'has-error' : ''
?>">
    <div class="form-group field-staticpagetranslation-seo_title  <?= $model->getErrors('seo_title') ? 'has-error' : ''
    ?>">
        <label class="control-label" for="staticpagetranslation-seo_title"><?php echo Yii::t('admin', 'Seo title')
            ?></label>
        <?php echo Html::activeTextInput($model, 'seo_title', ['placeholder' => Yii::t('static', 'Input title'), 'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'StaticPageTranslation[' . $index . '][seo_title]']) ?>
        <div class="help-block"><?= $model->getFirstError('seo_title') ?></div>
    </div>
    <div class="form-group field-staticpagetranslation-seo_description  <?= $model->getErrors('seo_description') ? 'has-error'
        : ''
    ?>">
        <label class="control-label" for="staticpagetranslation-seo_description"><?php echo Yii::t('admin', 'Seo description')
            ?></label>
        <?php echo Html::activeTextarea($model, 'seo_description', ['placeholder' => Yii::t('static', 'Input text'),
            'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'StaticPageTranslation[' . $index . '][seo_description]']) ?>
        <div class="help-block"><?= $model->getFirstError('seo_description') ?></div>
    </div>
    <div class="form-group field-staticpagetranslation-seo_description  <?= $model->getErrors('seo_description') ? 'has-error'
        : ''
    ?>">
        <label class="control-label" for="staticpagetranslation-seo_keywords"><?php echo Yii::t('admin', 'Seo keywords')
            ?></label>
        <?php echo Html::activeTextarea($model, 'seo_keywords', ['placeholder' => Yii::t('static', 'Input text'),
            'aria-required' => true, 'aria-invalid' => true, 'class' => 'form-control', 'name' => 'StaticPageTranslation[' . $index . '][seo_keywords]']) ?>
        <div class="help-block"><?= $model->getFirstError('seo_keywords') ?></div>
    </div>
</div>


