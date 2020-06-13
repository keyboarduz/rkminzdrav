<?php

namespace app\models;

use app\components\GoogleRecaptchaV3;
use app\modules\admin\models\Contact;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $recaptcha;
    public $phone;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['recaptcha', 'validateRecaptcha', 'skipOnEmpty' => false, 'skipOnError' => false],
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'subject', 'body'], 'string'],
            ['phone', 'match', 'pattern' => '/^[+]*[0-9]{3}[-0-9]*$/i', 'enableClientValidation' => false, 'message' => 'Телефон формати тугри емас'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Исм шариф',
            'email' => 'E-mail',
            'subject' => 'Хабар мавзуси',
            'body' => 'Матн',
            'phone' => 'Телефон'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {

            $contact = new Contact();
            $contact->attributes = $this->attributes;

            $isValid = $contact->save();

            if (Yii::$app->params['enableEmail']) {
                $isValid = $isValid && Yii::$app->mailer->compose()
                        ->setTo($email)
                        ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                        ->setReplyTo([$this->email => $this->name])
                        ->setSubject($this->subject)
                        ->setTextBody($this->body)
                        ->send();
            }


            return $isValid;
        }

        return false;
    }

    public function validateRecaptcha($attribute, $params) {
        if (! is_string($this->$attribute)) {
            $this->addError($attribute, 'Сатр бўлиши керак');
        }

        $gr = new GoogleRecaptchaV3($this->$attribute);

        $isValid = $gr->isValidRequest();
        if (YII_DEBUG) Yii::debug($gr->getResult());

        if (!$isValid) {
            $this->addError($attribute, 'validate recaptcha error');
        }
    }
}
