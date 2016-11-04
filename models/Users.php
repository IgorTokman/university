<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\web\User;

/**
 * This is the model class for table "users".
 *
 * @property integer $idusers
 * @property string $full_name
 * @property string $email
 * @property string $auth_key
 * @property string $username
 * @property string $password
 * @property string $created_date
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'username', 'password'], 'required'],
            [['created_date'], 'safe'],
            [['full_name', 'email', 'username', 'password'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusers' => 'Idusers',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'username' => 'Username',
            'password' => 'Password',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->idusers;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            if ($this->isNewRecord)
                $this->auth_key = \Yii::$app->security->generateRandomString();
            if(isset($this->password)) {
                $this->password = md5($this->password);
                parent::beforeSave($insert);
            }
        }
        return true;
    }

    public static function findByUsername($username){
        return Users::findOne(['username' => $username]);
    }

    public function validatePassword($password){
        return $this->password === md5($password);
    }
}
