<?php

namespace app\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public function attributes()
    {
        
        return [
            'id',
            'title',
            'genre',
            'image',
            'description'
        ];
    }
    
}
