<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 10/23/19
 * Time: 4:26 PM
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

/**
 * Class GeneralInformation
 * @property string $content
 */
class GeneralInformation extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%general_information}}';
    }

    public function rules()
    {
        return [
            ['content', 'string']
        ];
    }
}