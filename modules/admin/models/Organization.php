<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $leader
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property int $category
 */
class Organization extends \yii\db\ActiveRecord
{
    const ORGANIZATION_REPUBLIC = 1;
    const ORGANIZATION_DISTRICT_MEDICAL_ASSOCIATION = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'category'], 'required'],
            [['name', 'address', 'email'], 'trim'],
            [['name', 'address', 'email'], 'string'],
            [['category'], 'integer'],
            [['photo', 'leader', 'phone', 'site'], 'string', 'max' => 255],
            ['email', 'email'],
            ['site', 'default', 'value' => null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Muassasa nomi',
            'photo' => 'Muassasa rasmi',
            'leader' => 'Muassasa rahbari',
            'address' => 'Muassasa manzili',
            'phone' => 'Telefon raqami',
            'email' => 'Elektron pochta manzili',
            'site' => 'Veb sayti',
            'category' => 'Muassasa turi',
        ];
    }

    public static function getOrganizations() {
        return [
            self::ORGANIZATION_REPUBLIC => 'Respublika muassasasi',
            self::ORGANIZATION_DISTRICT_MEDICAL_ASSOCIATION => 'Tuman tibbiyot birlashmasi',
        ];
    }
}
