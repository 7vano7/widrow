<?php

namespace frontend\models\form;

use yii\base\Model;
use yii\web\UploadedFile;


class UploadFiles extends Model
{
    /**
     * @var UploadedFiles
     */

    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, giff', 'maxFiles' => 4],
        ];
    }
    
    public function upload($path)
    {
        
        if ($this->validate()) {
            $array = []; 
            foreach ($this->imageFiles as $file) {
                $file->saveAs($path . $file->baseName . '.' . $file->extension);
                chmod($path . $file->baseName . '.' . $file->extension, 0755);
                $array[] = $file->name;
            }
            return $array;
        }
    }

}
