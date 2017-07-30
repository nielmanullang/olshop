<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Pelanggan;

class RegistrationForm extends Model {

    /**
     * @inheritdoc
     */
    public $username;
    public $password;
    public $confirm_password;
    public $email;
    public $pelanggan_nama;
    public $pelanggan_notelpon;
    public $pelanggan_provinsi;
    public $pelanggan_kabupaten;
    public $pelanggan_kecamatan;
    public $pelanggan_alamat;
    public $kode_pos;
    public $verifyCode;

    public function rules() {
        return [
            [['username', 'password', 'confirm_password', 'pelanggan_nama', 'pelanggan_notelpon', 'pelanggan_provinsi', 'pelanggan_kabupaten', 'pelanggan_kecamatan', 'pelanggan_alamat', 'kode_pos'], 'required'],
//            [['username'], 'validateUsername'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'The Password must match')],
            [['pelanggan_provinsi', 'pelanggan_kabupaten', 'pelanggan_kecamatan'], 'integer'],
            [['username'], 'string', 'max' => 16],
            [['password', 'confirm_password'], 'string', 'min' => 8],
            [['pelanggan_alamat', 'email'], 'string', 'max' => 64],
            [['pelanggan_nama', 'pelanggan_notelpon'], 'string', 'max' => 32],
            [['kode_pos'], 'string', 'max' => 6],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'confirm_password' => 'Retype Password',
            'email' => 'Email',
            'pelanggan_nama' => 'Nama',
            'pelanggan_notelpon' => 'No Telpon',
            'pelanggan_provinsi' => 'Provinsi',
            'pelanggan_kabupaten' => 'Kabupaten',
            'pelanggan_kecamatan' => 'Kecamatan',
            'pelanggan_alamat' => 'Alamat',
            'kode_pos' => 'Kode Pos',
            'verifyCode' => 'Verification Code',
        ];
    }

//        public function validateUsername() {
//        $result = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user u WHERE u.username = "' . $this->username.'"')->queryScalar();
//        if ($result > 0) {
//            $this->addError("username", "Username sudah digunakan");
//        }
//
////        if ($this->leader == $this->nim_user[0] || $this->leader == $this->nim_user[1]) {
////            $this->addError("leader", "Data " . $this->Students($this->leader)->nama . " Duplicate");
////            $this->addError("nim_user", "Data " . $this->Students($this->leader)->nama . " Duplicate");
////        }
//    }    
    
    public function register() {
        if (!$this->validate()) {
            return null;
        }
            $user = new User();
        $user->username = $this->username;
        $user->password = $this->password;
        $user->email = $this->email;
        //$account->setPassword($this->password);
        //$member->generateAuthKey();
        if ($user->save()) {
            //transaction begin
            $pelanggan = new Pelanggan();
            $pelanggan->user_id = $user->id;
            $pelanggan->pelanggan_nama = $this->pelanggan_nama;
            $pelanggan->pelanggan_notelpon = $this->pelanggan_notelpon;
            $pelanggan->pelanggan_provinsi = $this->pelanggan_provinsi;
            $pelanggan->pelanggan_kabupaten = $this->pelanggan_kabupaten;
            $pelanggan->pelanggan_kecamatan = $this->pelanggan_kecamatan;
            $pelanggan->pelanggan_alamat = $this->pelanggan_alamat;
            $pelanggan->kode_pos = $this->kode_pos;
            if ($pelanggan->save()) {
                return $user; //return user yang berhasil register
            } else {
                print_r($pelanggan->errors);
            }
        } else {
            print_r($user->errors);
        }
        return null;
    }

}
