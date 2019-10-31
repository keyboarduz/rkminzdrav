<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string $name Hujjat nomi
 * @property string $date_of_admission Qabul qilinish sanasi
 * @property int $type_document Hujjat turi
 * @property int $category Hujjat kategoryiyasi
 * @property string $file Hujjat fayli nomi
 * @property string $description Hujjat tavsifi
 * @property string $content Hujjat kontenti
 * @property string $document_number Hujjat raqami
 * @property int $created_at
 * @property int $updated_at
 */
class Document extends \yii\db\ActiveRecord
{
    const CATEGORY_LAW_OF_THE_REPUBLIC_OF_UZBEKISTAN = 1;
    const CATEGORY_DECREES_RESOLUTIONS_AND_DIRECTIONS_OF_THE_PRESIDENT = 2;
    const CATEGORY_RESOLUTION_OF_THE_CABINET_OF_MINSTERS_UZ = 4;
    const CATEGORY_RESOLUTION_OF_THE_CABINET_OF_MINSTERS_KR = 5;
    const CATEGORY_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_UZBEKISTAN = 6;
    const CATEGORY_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_KARAKALPAKSTAN = 7;
    const CATEGORY_REGULATION = 8;
    const CATEGORY_DIAGNOSTIC_AND_TREATMENT_STANDARDS = 9;
    const CATEGORY_CLINICAL_GUIDELINE = 10;
    const CATEGORY_CONCEPT = 11;
    const CATEGORY_METHODOLOGICAL_DOCUMENT = 12;
    const CATEGORY_SANITARY_NORMS_AND_RULES = 13;
    const CATEGORY_JOB_DESCRIPTION = 14;
    const CATEGORY_CODE = 15;
    const CATEGORY_DECREE_OF_THE_MINISTRY_OF_HEALTH = 16;

    const TYPE_LAW = 1; //qonun
    const TYPE_ORDER = 2; //buyruq
    const TYPE_REGULATION = 3; //nizom
    const TYPE_GUIDELINE = 4; //qo'llanma
    const TYPE_DECREE = 5; // qaror
    const TYPE_RESOLUTION = 6; // farmon
    const TYPE_DIRECTION = 7; // farmoyish
    const TYPE_INDICATION = 8; // ko'rsatma
    const TYPE_LETTER = 9; // xat

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category'], 'required'],
            [['date_of_admission'], 'date', 'format' => 'php: d.m.Y'],
            [['category', 'created_at', 'updated_at'], 'integer'],
            [['description', 'content'], 'string'],
            [['name', 'file', 'document_number'], 'string', 'max' => 255],
            [['type_document'], 'integer'],
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->date_of_admission = date('Y-m-d', strtotime($this->date_of_admission));

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->date_of_admission = date('d.m.Y', strtotime($this->date_of_admission));
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Hujjat nomi',
            'date_of_admission' => 'Qabul qilinish sanasi',
            'category' => 'Hujjat kategoriyasi',
            'file' => 'Hujjat fayli nomi',
            'description' => 'Hujjat tavsifi',
            'content' => 'Hujjat kontenti',
            'document_number' => 'Hujjat raqami',
            'type_document' => 'Hujjat turi',
            'created_at' => 'Yaratildi',
            'updated_at' => "O'zgartirildi",
        ];
    }

    public static function getTypes() {
        return [
            self::TYPE_LAW => 'қонун',
            self::TYPE_ORDER => 'буйруқ',
            self::TYPE_REGULATION => 'низом',
            self::TYPE_GUIDELINE => 'қўлланма',
            self::TYPE_DECREE => 'қарор',
            self::TYPE_RESOLUTION => 'фармон',
            self::TYPE_DIRECTION => 'фармойиш',
            self::TYPE_INDICATION => 'кўрсатма',
            self::TYPE_LETTER => 'хат'
        ];
    }

    public static function getCategories() {
        return [
            self::CATEGORY_LAW_OF_THE_REPUBLIC_OF_UZBEKISTAN => "Ўзбекистон Республикаси Қонунлари",
            self::CATEGORY_DECREES_RESOLUTIONS_AND_DIRECTIONS_OF_THE_PRESIDENT => "Ўзбекистон Республикаси Президентининг Фармонлари, Қарорлари, Буйруқлари",
            self::CATEGORY_RESOLUTION_OF_THE_CABINET_OF_MINSTERS_UZ => "Ўзбекистон Республикаси Вазирлар Маҳқамасининг Фармонлари, Қарорлари, Буйруқлари",
            self::CATEGORY_RESOLUTION_OF_THE_CABINET_OF_MINSTERS_KR => "Қорақалпоғистон Республикаси Вазирлар Кенгашининг Фармонлари, Қарорлари, Буйруқлари",
            self::CATEGORY_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_UZBEKISTAN => "Ўзбекистон Республикаси Соғлиқни сақлаш вазирлиги буйруқлари",
            self::CATEGORY_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_KARAKALPAKSTAN => "Қорақалпоғистон Республикаси Соғлиқни сақлаш вазирлиги буйруқлари",
            self::CATEGORY_REGULATION => "Низомлар",
            self::CATEGORY_DIAGNOSTIC_AND_TREATMENT_STANDARDS => "Ташҳис қўйиш ва даволаш меъёрлари",
            self::CATEGORY_CLINICAL_GUIDELINE => "Клиник қўлланма",
            self::CATEGORY_CONCEPT => "Концепция",
            self::CATEGORY_METHODOLOGICAL_DOCUMENT => "Услубий ҳужжатлар",
            self::CATEGORY_SANITARY_NORMS_AND_RULES => "Санитария қоидалари ва меъёрлари",
            self::CATEGORY_JOB_DESCRIPTION => "Квалификацион тавсифлар",
            self::CATEGORY_CODE => "Кодекслар",
            self::CATEGORY_DECREE_OF_THE_MINISTRY_OF_HEALTH => "Соғлиқни сақлаш вазирлигининг Фармойишлари, Қарорлари",
        ];
    }

    public static function getCountCategories() {
        $countCategories = static::find()
            ->select('category, COUNT(*) AS cnt')
            ->groupBy('category')
            ->indexBy('category')
            ->asArray()
            ->all();

        return $countCategories;
    }
}
