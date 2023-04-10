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
 * @property int $conference_id
 * @property string $article_name
 * @property string|null $comment
 * @property string $phone
 * @property string $email
 * @property int|null $is_first
 * @property int|null $status
 * @property string $link
 * @property string $filename
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Conference $conference
 * @property Category $category
 */
class Application extends ActiveRecord
{
    public $file;

    public const STATUS_ARRAY = [
        1 => 'Yangi',
        2 => 'Qabul qilingan',
        3 => 'Rad etilgan',
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
            [['sender_first_name', 'sender_last_name', 'category_id', 'conference_id','article_name', 'phone', 'email'], 'required'],
            [['owners', 'comment'], 'string', 'max' => 600],
            [['email'], 'email'],
            [['category_id', 'is_first', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sender_first_name', 'sender_last_name', 'article_name', 'phone', 'email', 'link', 'filename'], 'string', 'max' => 255],
            [['file'], 'required', 'on' => 'create'],
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
            'conference_id' => 'Конференция',
            'article_name' => 'Тема статьи',
            'comment' => 'Комментарий',
            'phone' => 'Телефон',
            'email' => 'Email',
            'is_first' => 'Вы впервые участвуете в этой конференции?',
            'status' => 'Статус',
            'link' => 'Ссылка',
            'filename' => 'Файл',
            'file' => 'Загрузить файл тезисов или статей (не более 3-5 страниц)',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function getConference()
    {
        return $this->hasOne(Conference::class, ['id' => 'conference_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getFile(){
        $filepath = 'files/applications/' . $this->filename;

        if (file_exists($filepath)){
            return Yii::$app->response->sendFile($filepath);
        }

        return throw new \Exception('Xatolik yuz berdi. Fayl topilmadi');
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $text =
                "№: #Ариза #А" . $this->id . PHP_EOL .
                'Янги кушилди'. PHP_EOL .
                'Конференция: '. $this->conference->name . PHP_EOL .
                'Йуналиш: '. $this->category->name . PHP_EOL .
                'Статус: ' . self::STATUS_ARRAY[$this->status ?? 1] . PHP_EOL .
                'Сана: ' . date('d.m.Y H:i:s', $this->created_at) . PHP_EOL .
                'Киритди: ' . $this->sender_last_name . ' ' . $this->sender_first_name . PHP_EOL;

            Yii::$app->telegram->sendMessage([
                'chat_id' => '-1001906470744',
                'text' => $text,
                "parse_mode" => "markdown",
                "reply_markup" => json_encode(["inline_keyboard" => [
                    [
                        [
                            "text" => "Очиб кориш",
                            "url" => "http://" . $_SERVER['SERVER_NAME'] . \Yii::$app->getUrlManager()->createUrl(['application/index', 'ApplicationSearch[id]' => $this->id])
                        ]
                    ]
                ]])
            ]);
        } else {
            $text =
                "№: #Ариза #А" . $this->id . PHP_EOL .
                'Узгартирилди'. PHP_EOL .
                'Конференция: '. $this->conference->name . PHP_EOL .
                'Йуналиш: '. $this->category->name . PHP_EOL .
                'Статус: ' . self::STATUS_ARRAY[$this->status ?? 1] . PHP_EOL .
                'Сана: ' . date('d.m.Y H:i:s', $this->created_at) . PHP_EOL .
                'Киритди: ' . $this->sender_last_name . ' ' . $this->sender_first_name . PHP_EOL;

            Yii::$app->telegram->sendMessage([
                'chat_id' => '-1001906470744',
                'text' => $text,
                "parse_mode" => "markdown",
                "reply_markup" => json_encode(["inline_keyboard" => [
                    [
                        [
                            "text" => "Очиб кориш",
                            "url" => "http://" . $_SERVER['SERVER_NAME'] . \Yii::$app->getUrlManager()->createUrl(['application/index', 'ApplicationSearch[id]' => $this->id])
                        ]
                    ]
                ]])
            ]);

        }
        return true;
    }
}
