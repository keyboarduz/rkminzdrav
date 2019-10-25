<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "leadership".
 *
 * @property int $id
 * @property string $name Ism sharifi
 * @property string $position Lavozimi
 * @property string $photo Rasmi
 * @property string $phone Telefon raqami
 * @property string $email Email
 * @property string $reception_days Qabul kunlari
 */
class Leadership extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leadership';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['phone'], 'string', 'max' => 255],
            [['name', 'position', 'photo', 'email', 'reception_days'], 'string', 'max' => 255],
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ism sharifi',
            'position' => 'Lavozimi',
            'photo' => 'Photo',
            'phone' => 'Telefon raqami',
            'email' => 'Email',
            'reception_days' => 'Qabul kunlari',
        ];
    }
}
