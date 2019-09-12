<?php

namespace app\modules\admin\models;

use Yii;
use app\models\User;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $author_id Yangilik muallifi
 * @property int $category_id Yangilik kategoriyasi
 * @property string $title Mavzu
 * @property string $content Yangilik kontenti
 * @property string $image_url Rasm urli
 * @property int $status Status
 * @property int $viewed Ko'rishlar soni
 * @property int $created_at Yaratilgan vaqti
 * @property int $updated_at O'zgartirilgan vaqti
 *
 * @property User $author
 * @property Category $category
 */
class News extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DRAFT = 5;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function scenarios()
    {
        $scenarios =  parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['id', 'author_id', 'category_id', 'title', 'content', 'status', 'viewed', 'created_at', 'updated_at', 'image_url', 'description'];
        $scenarios[self::SCENARIO_UPDATE] = ['category_id', 'title', 'content', 'status', 'viewed', 'created_at', 'updated_at', 'image_url', 'description'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
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
            [['author_id', 'category_id', 'status', 'viewed'], 'integer'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['image_url', 'string'],
            ['description', 'string', 'skipOnEmpty' => true],
            ['created_at', 'date', 'timestampAttribute' => 'created_at', 'format' => 'php:m.d.Y']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Yangilik muallifi',
            'category_id' => 'Yangilik kategoriyasi',
            'title' => 'Mavzu',
            'description' => 'Qisqacha mazmuni',
            'content' => 'Yangilik kontenti',
            'status' => 'Status',
            'viewed' => 'Ko\'rishlar soni',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'O\'zgartirilgan vaqti',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getStatuses() {
        return [
            self::STATUS_DRAFT => 'Qoralama',
            self::STATUS_ACTIVE => 'Aktiv',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->author_id = Yii::$app->getUser()->getIdentity()->getId();
        }

        return true;
    }

    public function deleteNewsWithImage() {
        $transaction = self::getDb()->beginTransaction();

        try {
            $imageUrl = $this->image_url;

            $pathToFile = Yii::getAlias('@webroot') . $imageUrl;

            $isValid = ($this->delete() !== false);

            if ($isValid) {
                $countLink = static::find()
                    ->select('image_url')
                    ->where(['image_url' => $imageUrl])
                    ->count();

                if ($countLink == 0 && is_file($pathToFile)) {
                    $isValid = $isValid
                               && FileHelper::unlink($pathToFile);
                }
            }

            if (!$isValid) {
                throw new \Exception('Rasmni yoki ma\'lumotni o\'chirishda xatolik.' . PHP_EOL . Yii::getAlias('@webroot') . $this->image_url);
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('danger', $e->getMessage());

            $transaction->rollBack();
            return false;
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('danger', $e->getMessage());

            $transaction->rollBack();
            return false;
        }
    }
}
