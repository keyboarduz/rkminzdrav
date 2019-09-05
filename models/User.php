<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class User
 * @package app\models
 *
 * @property $id integer
 * @property $username string
 * @property $email string
 * @property $status integer
 * @property $password_hash integer
 * @property $auth_key string
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 0;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => USER::STATUS_ACTIVE],
            ['status', 'in', 'range' => [USER::STATUS_ACTIVE, USER::STATUS_DELETED]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'status' => 'Holati',
            'email' => 'E-mail',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => "O'zgartirilgan vaqti",
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => USER::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => USER::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     * @param $password string
     * @throws yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
