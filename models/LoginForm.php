<?php

namespace app\models;

use app\components\GoogleRecaptchaV3;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $reCaptcha;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['reCaptcha', 'validateReCaptcha', 'skipOnEmpty' => false, 'skipOnError' => false],
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Login yoki parol xato.');
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateReCaptcha($attribute, $params) {
        if (! is_string($this->$attribute)) {
            $this->addError($attribute, "{$this->$attribute}: satr bo'lishi kerak");
            return;
        }

        $googleReCaptcha = new GoogleRecaptchaV3($this->$attribute);

        if (!$googleReCaptcha->isValidRequest()) {
            $this->addError($attribute, 'google recaptcha validatsiyadan o\'tmadi');
        }

        if (!YII_ENV_PROD)
            Yii::debug($googleReCaptcha->getResult(), 'recaptcha');
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'password' => 'Parol',
            'rememberMe' => 'Saqlash',
        ];
    }
}
