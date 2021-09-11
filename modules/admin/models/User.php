<?php

namespace app\modules\admin\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
use \yii\base\NotSupportedException;
use \yii\behaviors\TimestampBehavior;

/**
 *
 * @property integer $id
 * @property string $username
 * @property string  $cpf
 * @property string $chave_autenticacao
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property string $email
 * @property string $logradouro
 * @property integer $status
 * @property integer $criado_em
 * @property integer $alterado_em
 * @property integer nome
 */

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DESATIVADO = 0;
    const STATUS_ATIVADO  = 1;
    const STATUS_ATIVADO_STRING = 'Ativo';
    const STATUS_DESATIVADO_STRING = 'Desativado';

    public $confirmPassword = '';
    public $password = '';

    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->generatechave_autenticacao();
        }

        if (isset(Yii::$app->request->post()['User']['passwordHash'])) {
            $this->setPassword(Yii::$app->request->post()['User']['passwordHash']);
        }
       
        return parent::beforeSave($insert);
    }

    public function getStatusUser()
    {
        return [
            self::STATUS_DESATIVADO => self::STATUS_DESATIVADO_STRING,
            self::STATUS_ATIVADO => self::STATUS_ATIVADO_STRING,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'logradouro', 'nome', 'data_nascimento', 'passwordHash'], 'filter', 'filter' => 'trim'],
            [['username', 'passwordHash', 'email'], 'required'],
            [['status'], 'integer'],
            [['nome'], 'string'],
            [['data_nascimento'], 'string'],
            [['cpf'], 'unique'],
            [['telefone'], 'string'],
            [['cep'], 'string'],
            [['logradouro'], 'string'],
            [['bairro'], 'string'],
            [['cidade'], 'string'],
            [['estado'], 'string'],
            [['complemento'], 'string'],
            [['username', 'passwordHash', 'passwordResetToken', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['passwordResetToken'], 'unique'],
            ['cadastrador', 'default', 'value' => \Yii::$app->user->identity->id],
            ['status', 'default', 'value' => self::STATUS_ATIVADO],
            ['status', 'in', 'range' => [self::STATUS_ATIVADO, self::STATUS_DESATIVADO]],
            //Tratando o scenario resetPassword
            [['password', 'passwordHash', 'confirmPassword'], 'filter', 'filter' => 'trim', 'on' => 'reset-password'],
            [['password', 'passwordHash', 'confirmPassword'], 'required', 'on' => 'resetPassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'chave_autenticacao' => Yii::t('app', 'Auth Key'),
            'passwordHash' => Yii::t('app', 'Senha'),
            'passwordResetToken' => Yii::t('app', 'Senha Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'criado_em' => Yii::t('app', 'Criado em'),
            'password' => Yii::t('app', 'Senha antiga'),
            'newPassword' => Yii::t('app', 'Nova senha'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['resetPassword'] = ['password', 'passwordHash', 'confirmPassword'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ATIVADO]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByCpf($cpf)
    {
        $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
        return static::findOne(['cpf' => $cpf, 'status' => self::STATUS_ATIVADO]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ATIVADO,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getchave_autenticacao()
    {
        return $this->chave_autenticacao;
    }

    /**
     * @inheritdoc
     */
    public function validatechave_autenticacao($chave_autenticacao)
    {
        return $this->chave_autenticacao === $chave_autenticacao;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatepasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generatechave_autenticacao()
    {
        $this->chave_autenticacao = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    public function requestPasswordResetToken($id)
    {
        $user = User::findOne([
            'status' => User::STATUS_ATIVADO,
            'id' => $id,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->passwordResetToken)) {
            $user->generatePasswordResetToken();
        }

        if (!$user->save()) {
            return false;
        }

        return $user->passwordResetToken;
    }

    public function resetPassword(){
        
    }
}