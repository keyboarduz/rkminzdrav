<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_VIEWED = 2;
    const STATUS_DELETED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
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
            ['phone', 'string', 'max' => 30],
            [['name', 'email', 'subject', 'body'], 'required' ],
            [['name', 'body'], 'string'],
            [['status'], 'default', 'value' => self::STATUS_NEW ],
            ['email', 'email'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'FISH',
            'email' => 'E-mail',
            'subject' => 'Mavzu',
            'body' => 'Kontent',
            'status' => 'Status',
            'Phone' => 'Telefon',
            'created_at' => 'Yaratildi',
            'updated_at' => 'O\'zgartirildi',
        ];
    }

    public function editStatus(int $status) {
        if (!$this->hasStatus($status)) {
            throw new \Exception('Unknown status model');
        }

        $this->status = $status;

        return $this->save();
    }

    protected function hasStatus (int $status) {

        return in_array($status, $this->getStatuses());
    }

    public function getStatuses(){
        $oClass = new \ReflectionClass(__CLASS__);
        $statuses = [];

        foreach ($oClass->getConstants() as $key => $value) {
            if (substr($key, 0, 7) === 'STATUS_') {
                $statuses[$key] = $value;
            }
        }

        return $statuses;
    }

    public function getStatusLabel(int $status){
        $labelColor = 'warning';
        $labelContent = 'Aniqlanmagan';

        switch ($status) {
            case self::STATUS_NEW:
                $labelColor = 'primary';
                $labelContent = 'Yangi';
                break;
            case self::STATUS_DELETED:
                $labelColor = 'danger';
                $labelContent = "O'chirilgan";
                break;
            case self::STATUS_VIEWED:
                $labelColor = 'success';
                $labelContent = "Ko'rilgan";
                break;

        }

        return "<span class='label label-{$labelColor}'>{$labelContent}</span>";

    }
}
