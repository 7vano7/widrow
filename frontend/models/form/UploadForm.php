<?php

namespace frontend\models\form;

use yii\base\Model;
use yii\web\UploadedFile;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, giff, gif, pdf, doc, docx, xls, xlsx, xml, mp4, mpeg4'],
        ];
    }

    public function upload($path)
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($path . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            chmod($path . $this->imageFile->baseName . '.' . $this->imageFile->extension, 0755);
            return $this->imageFile->name;
        } else {
            return false;
        }
    }
}
