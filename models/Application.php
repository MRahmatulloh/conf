<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $sender_first_name
 * @property string $sender_last_name
 * @property string|null $owners
 * @property int $category_id
 * @property string $article_name
 * @property string|null $comment
 * @property string $phone
 * @property string $email
 * @property int|null $is_first
 * @property int|null $status
 * @property string $link
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Application extends ActiveRecord
{
    public $file;

    public const CATERORIES = [
        1 => 'Raqamli texnologiyalar, bulutli hisoblash va sun’iy intellekt',
        2 => 'Amaliy matematika: matematik modellashtirish va sonli usullar',
        3 => 'Raqamli iqtisodiyot va elektron hukumat tizimi muammolari',
        4 => 'Iqtisodiyotda innovatsion texnologiyalar: raqamli transformatsiya',
        5 => 'Biznes boshqarish tizimlarining dolzarb masalalari',
        6 => 'Xorijiy tillarni o‘qitishda innovatsion usullar',
        7 => 'Raqamli pedagogika dolzarb masalalarining innovatsion yechimlari',
        8 => 'Maktabgacha ta’lim pedagogikasida zamonaviy o‘qitish usullari',
        9 => 'Psixologiya fanlarining dolzarb masalalari va innovatsion yondoshuvlar',
        10 => 'O‘zbek tili nazariyasi va kompyuter lingvistikasi',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_first_name', 'sender_last_name', 'category_id', 'article_name', 'phone', 'email', 'file'], 'required'],
            [['owners', 'comment'], 'string', 'max' => 600],
            [['email'], 'email'],
            [['category_id', 'is_first', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sender_first_name', 'sender_last_name', 'article_name', 'phone', 'email', 'link'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'doc, docx, pdf, rtf', 'maxFiles' => 1, 'maxSize' => 8 * 1024 * 1024]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_first_name' => 'Имя отправителя',
            'sender_last_name' => 'Фамилия отправителя',
            'owners' => 'Владельцы статей',
            'category_id' => 'Направление',
            'article_name' => 'Тема статьи',
            'comment' => 'Комментарий',
            'phone' => 'Телефон',
            'email' => 'Email',
            'is_first' => 'Вы впервые участвуете в этой конференции?',
            'status' => 'Статус',
            'link' => 'Ссылка',
            'file' => 'Загрузить файл тезисов или статей (не более 3-5 страниц)',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
