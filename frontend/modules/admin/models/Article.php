<?php

namespace frontend\modules\admin\models;

use Yii;
use frontend\models\form\UploadForm;
use yii\imagine\Image;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Class Article
 * @package frontend\modules\admin\models
 */
class Article extends \common\models\Article
{

    public $lang;
    public $title;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['category', 'status', 'image', 'url', 'user_id', 'top'], 'required'],
            ['top', 'default', 'value' => self::NOT_TOP],
            [['category', 'top', 'user_id'], 'integer'],
            [['status', 'image', 'gif', 'url'], 'string'],
            ['url', 'unique', 'targetClass' => '\common\models\Article', 'message' => Yii::t('article', 'This url has already been taken.'), 'on' => 'insert'],
            ['url', 'unique', 'filter' => ['!=', 'id', $this->id], 'targetClass' => '\common\models\Article', 'message'
            => Yii::t('article', 'This url has already been taken.')],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'category' => Yii::t('article', 'Category'),
            'status' => Yii::t('article', 'Status'),
            'image' => Yii::t('article', 'Image'),
            'created_at' => Yii::t('admin', 'Created'),
            'updated_at' => Yii::t('admin', 'Updated'),
            'top' => Yii::t('article', 'Top'),
            'user_id' => Yii::t('article', 'User'),
            'gif' => Yii::t('article', 'Gif'),
            'url' => Yii::t('article', 'Url'),
            'title' => Yii::t('article', 'Title'),
        ];
    }

    /**
     * Get relation ArticleLang models
     * @param mixed
     * @return array
     */
    public function getArticleTranslation()
    {
        return $this->hasMany(ArticleTranslation::className(), ['article_id' => 'id']);
    }

    /**
     * Get relation Menu models
     * @param mixed
     * @return array
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'category']);
    }

    /**
     * Upload file
     * @param $file string
     * @return mixed
     */
    public function saveImage($file): void
    {
        if ($this->isNewRecord) {
            $id = Article::find()->orderBy('id DESC')->one();
            if ($id === null) {
                $id = 1;
            } else {
                $id = $id->id + 1;
            }
        } else {
            $id = $this->id;
        }

        $path = Yii::getAlias('@frontend') . '/web/images/article/' . $id . '/';
        $image = new UploadForm;
        $image->imageFile = UploadedFile::getInstance($this, $file);
        if (!is_dir($path)) {
            if (!mkdir($path, 0777) && !is_dir($path)) {
                throw new NotFoundHttpException(sprintf('Directory "%s" was not created', $path));
            }
        }

        if (!file_exists($path . $image->imageFile->name)) {
            if (!preg_match('/(png|jpg|jpeg|giff)$/ui', $image->imageFile->extension, $match)) {
                $this->addError($file, Yii::t('admin', 'Error format'));
            } else {
                $this->$file = $image->upload($path);
            }
            if (file_exists($path . $this->$file)) {
                if (!file_exists($path . 'resize_' . $this->$file) && preg_match('/\.(png|jpg|jpeg|giff)$/ui', $this->$file, $match)) {
                    if ($image = Image::thumbnail($path . $this->$file, 700, 400)->save($path . 'resize_' .
                        $this->$file, ['quality' => 50])) {
                        $this->$file = '/images/article/' . $id . '/resize_' . $this->$file;
                    } else {
                        $this->$file = '/images/article/' . $id . '/' . $this->$file;
                    }
                }
            }
        } elseif (file_exists($path . 'resize_' . $image->imageFile->name)) {
            $this->$file = '/images/article/' . $id . '/resize_' . $image->imageFile->name;
        }
    }

    /*
     * Get statuses of article
     * #return array
     */
    public function getStatuses(): array
    {
        $array = [
            self::STATUS_ACTIVE => Yii::t('article', 'active'),
            self::STATUS_DISABLE => Yii::t('article', 'disable'),
        ];
        return $array;
    }

    /*
     * Get article top
     * #return array
     */
    public function getTop(): array
    {
        $array = [
            self::IS_TOP => Yii::t('article', 'In top'),
            self::NOT_TOP => Yii::t('article', 'Not top'),
        ];
        return $array;
    }

    /**
     * get Menu list by language
     * @param string $language
     * @return mixed
     */
    public function getCategory($language, $category = null)
    {
        $array = [];
        if ($language) {
            $list = Menu::find()->joinWith('menuLang')->where(['status' => self::STATUS_ACTIVE,
                'is_menu'=>Menu::MENU_TRUE, 'lang' => $language])->all();
            if (empty($list)) {
                return $array;
            }
            foreach ($list as $item) {
                $array[$item->id] = $item->menuLang[0]['menu_name'];
            }
        }
        if (!empty($array) && $category && array_key_exists($category, $array)) {
            return $array[$category];
        }
        return $array;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if ($this->lang) {
            ArticleTranslation::deleteAll(['article_id' => $this->id]);
            foreach ($this->lang as $lang) {
                $lang->article_id = $this->id;
                $lang->save();
            }
        }

    }
}