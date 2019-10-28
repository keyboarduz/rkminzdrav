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
 * @property int $type Hujjat turi
 * @property string $file Hujjat fayli nomi
 * @property string $description Hujjat tavsifi
 * @property string $content Hujjat kontenti
 * @property string $document_number Hujjat raqami
 * @property int $created_at
 * @property int $updated_at
 */
class Document extends \yii\db\ActiveRecord
{
    const TYPE_LAW_OF_THE_REPUBLIC_OF_UZBEKISTAN = 1;
    const TYPE_DECREE_OF_THE_PRESIDENT = 2;
    const TYPE_RESOLUTION_OF_THE_PRESIDENT = 3;
    const TYPE_DIRECTION_OF_THE_PRESIDENT = 4;
    const TYPE_RESOLUTION_OF_THE_CABINET_OF_MINSTERS = 5;
    const TYPE_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_UZBEKISTAN = 6;
    const TYPE_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_KARAKALPAKSTAN = 7;
    const TYPE_REGULATION = 8;
    const TYPE_DIAGNOSTIC_AND_TREATMENT_STANDARDS = 9;
    const TYPE_CLINICAL_GUIDELINE = 10;
    const TYPE_CONCEPT = 11;
    const TYPE_METHODOLOGICAL_DOCUMENT = 12;
    const TYPE_SANITARY_NORMS_AND_RULES = 13;
    const TYPE_JOB_DESCRIPTION = 14;
    const TYPE_CODE = 15;
    const TYPE_DECREE_OF_THE_MINISTRY_OF_HEALTH = 16;

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
            [['name', 'type'], 'required'],
            [['date_of_admission'], 'date', 'format' => 'php: d.m.Y'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'content'], 'string'],
            [['name', 'file', 'document_number'], 'string', 'max' => 255],
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
            'type' => 'Hujjat turi',
            'file' => 'Hujjat fayli nomi',
            'description' => 'Hujjat tavsifi',
            'content' => 'Hujjat kontenti',
            'document_number' => 'Hujjat raqami',
            'created_at' => 'Yaratildi',
            'updated_at' => "O'zgartirildi",
        ];
    }

    public static function getTypes() {
        return [
            self::TYPE_LAW_OF_THE_REPUBLIC_OF_UZBEKISTAN => "Ўзбекистон Республикаси Қонунлари",
            self::TYPE_DECREE_OF_THE_PRESIDENT => "Ўзбекистон Республикаси Президентининг Фармонлари",
            self::TYPE_RESOLUTION_OF_THE_PRESIDENT => "Ўзбекистон Республикаси Президентининг Қарорлари",
            self::TYPE_DIRECTION_OF_THE_PRESIDENT => "Ўзбекистон Республикаси Президентининг Буйруқлари",
            self::TYPE_RESOLUTION_OF_THE_CABINET_OF_MINSTERS => "Ўзбекистон Республикаси Вазирлар Маҳқамасининг Қарорлари",
            self::TYPE_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_UZBEKISTAN => "Ўзбекистон Республикаси Соғлиқни сақлаш вазирлиги буйруқлари",
            self::TYPE_ORDER_OF_THE_MINISTRY_OF_HEALTH_OF_THE_REPUBLIC_OF_KARAKALPAKSTAN => "Қорақалпоғистон Республикаси Соғлиқни сақлаш вазирлиги буйруқлари",
            self::TYPE_REGULATION => "Низомлари",
            self::TYPE_DIAGNOSTIC_AND_TREATMENT_STANDARDS => "Ташҳис қўйиш ва даволаш меъёрлари",
            self::TYPE_CLINICAL_GUIDELINE => "Клиник қўлланма",
            self::TYPE_CONCEPT => "Концепция",
            self::TYPE_METHODOLOGICAL_DOCUMENT => "Услубий ҳужжатлар",
            self::TYPE_SANITARY_NORMS_AND_RULES => "Санитария қоидалари ва меъёрлари",
            self::TYPE_JOB_DESCRIPTION => "Квалификацион тавсифлар",
            self::TYPE_CODE => "Кодекслар",
            self::TYPE_DECREE_OF_THE_MINISTRY_OF_HEALTH => "Соғлиқни сақлаш вазирлигининг Фармойишлари, Қарорлари",
        ];
    }

    public static function getCountTypes() {
        $countTypes = static::find()
            ->select('type, COUNT(*) AS cnt')
            ->groupBy('type')
            ->indexBy('type')
            ->asArray()
            ->all();

        return $countTypes;
    }
}
