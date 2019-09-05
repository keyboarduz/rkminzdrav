<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 13.08.2019
 * Time: 17:50
 */

namespace app\modules\admin\models;


use app\models\User;
use yii\base\Model;

class ManageUserForm extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $username;
    public $password;
    public $email;

    private $_user;

    public function setUser($value) {
        $this->_user = $value;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['username', 'email', 'password'];
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'password'];
        return $scenarios;
    }

    public function rules()
    {
        $user_id = $this->_user ? $this->_user->id : null;

        return [
            [['username', 'email', 'password'], 'trim'],
            ['username', 'required'],
            ['username', 'string'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Bu login mavjud.', 'on' => [self::SCENARIO_CREATE]],
            ['password', 'required'],
            ['password', 'string', 'min' => 3],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Bu e-mail mavjud.', 'on' => [self::SCENARIO_CREATE]],

            [
                'username',
                'unique',
                'targetClass' => 'app\models\User',
                'filter' => function($query) use ($user_id) {
                    return $query->andWhere('id!=:user_id')->addParams([':user_id' => $user_id]);
                },
                'message' => 'Bu login mavjud.',
                'on' => [self::SCENARIO_UPDATE],
            ],
            [
                'email',
                'unique',
                'targetClass' => 'app\models\User',
                'filter' => function($query) use ($user_id) {
                    return $query->andWhere('id!=:user_id')->addParams([':user_id' => $user_id]);
                },
                'message' => 'Bu e-mail mavjud.',
                'on' => [self::SCENARIO_UPDATE],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'password' => 'Parol',
            'email' => 'E-mail',
        ];
    }

    public function create() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

    /**
     * @param $user User
     * @return bool|null
     */
    public function update($user) {
        if (!$this->validate()) {
            return null;
        }

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);

        return $user->save();
    }

}