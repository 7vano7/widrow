<?php

<<<<<<< HEAD
=======
use frontend\components\LanguageViewWidget;
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $main object
 * @var $model array
 * @var $video array
 */
?>
<section class="col-sm-12 logotype">
    <div class="col-sm-12 main-header">
        <div class="container bunner">
            <?php if ($main): ?>
                <?php if (preg_match('/(mp4|mpeg4)$/ui', $main->staticPage->file)): ?>
                    <video controls="controls" autoplay="autoplay" muted="" loop="loop" id="players">
                        <source src="<?php echo Yii::getAlias('@web') . $main->staticPage->file ?>"
                                type='video/ogg; codecs="theora, vorbis"'>
                        <source src="<?php echo Yii::getAlias('@web') . $main->staticPage->file ?>"
                                type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                        <source src="<?php echo Yii::getAlias('@web') . $main->staticPage->file ?>"
                                type='video/webm; codecs="vp8, vorbis"'>
                    </video>
                <?php else: ?>
<<<<<<< HEAD
                    <img src="<?php echo Yii::getAlias('@web') . $main->staticPage->file ?>" alt="image"
=======
                    <img src="<?php echo Yii::getAlias('@web') . $main->staticPage->file ?>"
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
                         style="width: 100px; margin: 10px">
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>
</section>
<div class="col-sm-12">
    <?php if ($model): ?>
        <?php $numb = count($model);
        $current_numb = 1; ?>
        <?php foreach ($model as $item): ?>
            <div class="col-sm-12">
                <div class="col-sm-12 menu-items">
                    <?php echo Html::a(Html::img($item['image']), Url::toRoute('/category/' . $item['url'])); ?>
                </div>
                <div class="col-sm-12">
                    <?php if (!empty($item['articles'])): ?>
                        <div id="Carousel-<?php echo $item['id'] ?>" class="carousel slide"
                             data-ride="carousel" data-interval="false">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php $count = count($item['articles']); ?>
                                <?php for ($i = 0; $i < $count; $i += 4): ?>
                                    <li data-target="<?php echo $item['label'] . 'Carousel' ?>"
<<<<<<< HEAD
                                        data-slide-to="<?= $i ?>" class="<?= $i % 4 === 0 ? 'active' : '' ?>"></li>
=======
                                        data-slide-to="<?= $i ?>" class="<?= $i % 4 == 0 ? 'active' : '' ?>"></li>
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
                                <?php endfor; ?>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner row">
                                <?php for ($i = 0; $i < $count; $i++): ?>
<<<<<<< HEAD
                                    <div class="item <?= $i === 0 ? 'active' : '' ?>">
=======
                                    <div class="item <?= $i == 0 ? 'active' : '' ?>">
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
                                        <ul class="thumbnails">
                                            <li class="col-sm-3 slide-1">
                                                <div class="thumbnail">
                                                    <?php echo Html::a(Html::img(Yii::getAlias('@web') . $item['articles'][$i]['image']), Url::toRoute('/article/' . $item['articles'][$i]['url'])) ?>
                                                </div>
                                                <div class="caption">
                                                    <h4><?php echo Html::a($item['articles'][$i]['title'],
                                                            Url::toRoute('/article/' . $item['articles'][$i]['url']))
                                                        ?></h4>
                                                    <!--                                                    <p>Nullam Condimentum Nibh Etiam Sem</p>-->
                                                </div>
                                            </li>
                                            <li class="col-sm-3 slide-2">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img(Yii::getAlias('@web') . $item['articles'][$i]['image']), Url::toRoute('/article/' . $item['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($item['articles'][$i]['title'],
                                                                Url::toRoute('article/' . $item['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            <li class="col-sm-3 slide-3">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img(Yii::getAlias('@web') . $item['articles'][$i]['image']), Url::toRoute('/article/' . $item['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($item['articles'][$i]['title'],
                                                                Url::toRoute('/article/' . $item['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            <li class="col-sm-3 slide-4">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img(Yii::getAlias('@web') . $item['articles'][$i]['image']), Url::toRoute('/article/' . $item['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($item['articles'][$i]['title'],
                                                                Url::toRoute('/article/' . $item['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                        </ul>
                                    </div><!-- /Slide -->
                                <?php endfor ?>
                            </div>
                            <!-- Left and right controls -->
                            <?php if ($i > 4): ?>
                                <a class="left carousel-control" href="#Carousel-<?php echo $item['id'] ?>"
                                   data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#Carousel-<?php echo $item['id'] ?>"
                                   data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <?php if ($current_numb <= $numb): ?>
                <div class="col-sm-12 menu-line">
                    <hr>
                </div>
            <?php endif ?>
            <?php $current_numb++; ?>
        <?php endforeach; ?>
    <?php endif ?>
</div>
<?php if ($video): ?>
    <div class="col-sm-12 youtube">
        <?php foreach ($video as $videos): ?>
            <div class="col-sm-12 video">
                <div class="col-sm-12 menu-items">
                    <?php echo Html::a($videos['label'], Url::to($videos['url'])); ?>
                </div>
                <div class="col-sm-12">
                    <?php if (!empty($videos['articles'])): ?>
                        <div id="Carousel-<?php echo $videos['id'] ?>" class="carousel slide slide-youtube"
                             data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php $count = count($videos['articles']); ?>
                                <?php for ($i = 0; $i < $count; $i += 4): ?>
                                    <li data-target="<?php echo $videos['label'] . 'Carousel' ?>"
<<<<<<< HEAD
                                        data-slide-to="<?= $i ?>" class="<?= $i % 4 === 0 ? 'active' : '' ?>"></li>
=======
                                        data-slide-to="<?= $i ?>" class="<?= $i % 4 == 0 ? 'active' : '' ?>"></li>
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
                                <?php endfor; ?>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner row">
                                <?php for ($i = 0; $i < $count; $i++): ?>
<<<<<<< HEAD
                                    <div class="item <?= $i === 0 ? 'active' : '' ?>">
=======
                                    <div class="item <?= $i == 0 ? 'active' : '' ?>">
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
                                        <ul class="thumbnails">
                                            <li class="col-sm-2 slide-1">
                                                <div class="thumbnail">
                                                    <?php echo Html::a(Html::img($videos['articles'][$i]['image']),
                                                        Url::to($videos['articles'][$i]['url'])) ?>
                                                </div>
                                                <div class="caption">
                                                    <h4><?php echo Html::a($videos['articles'][$i]['title'],
                                                            Url::to($videos['articles'][$i]['url']))
                                                        ?></h4>
                                                    <!--                                                    <p>Nullam Condimentum Nibh Etiam Sem</p>-->
                                                </div>
                                            </li>
                                            <li class="col-sm-2 slide-2">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img($videos['articles'][$i]['image']), Url::to($videos['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($videos['articles'][$i]['title'],
                                                                Url::to($videos['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            <li class="col-sm-2 slide-3">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img($videos['articles'][$i]['image']), Url::to($videos['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($videos['articles'][$i]['title'],
                                                                Url::to($videos['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            <li class="col-sm-2 slide-4">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img($videos['articles'][$i]['image']), Url::to($videos['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($videos['articles'][$i]['title'],
                                                                Url::to($videos['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            <li class="col-sm-2 slide-5">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img($videos['articles'][$i]['image']), Url::to($videos['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($videos['articles'][$i]['title'],
                                                                Url::to($videos['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            <li class="col-sm-2 slide-6">
                                                <?php $i++; ?>
                                                <?php if ($i < $count) : ?>
                                                    <div class="thumbnail">
                                                        <?php echo Html::a(Html::img($videos['articles'][$i]['image']), Url::to($videos['articles'][$i]['url'])) ?>
                                                    </div>
                                                    <div class="caption">
                                                        <h4><?php echo Html::a($videos['articles'][$i]['title'],
                                                                Url::to($videos['articles'][$i]['url']))
                                                            ?></h4>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                        </ul>
                                    </div><!-- /Slide -->
                                <?php endfor ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
