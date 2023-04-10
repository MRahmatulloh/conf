<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use function PHPUnit\Framework\throwException;

/**
 * This is the model class for table "conference".
 *
 * @property int $id
 * @property string $name
 * @property string|null $accepting_end
 * @property string $start_date
 * @property string $end_date
 * @property string|null $description
 * @property string|null $link
 * @property string|null $filename
 * @property string|null $place
 * @property string|null $short
 * @property string|null $responsible_tel
 * @property string|null $responsible_person
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Application[] $applications
 * @property Category[] $categories
 */
class Conference extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conference';
    }

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
            [['name', 'start_date', 'end_date', 'description', 'short', 'responsible_person', 'responsible_tel'], 'required'],
            [['file'], 'required', 'on' => 'create'],
            [['accepting_end', 'start_date', 'end_date'], 'safe'],
            [['start_date'], 'checkStartDate', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['accepting_end'], 'checkAcceptDate', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['description', 'short'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'link', 'filename', 'place', 'responsible_person', 'responsible_tel'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'doc, docx, pdf, rtf', 'maxFiles' => 1, 'maxSize' => 8 * 1024 * 1024]
        ];
    }

    public function checkStartDate($attribute, $params){
        if($this->$attribute > $this->end_date){
            $this->addError($attribute, 'Дата начала не может быть больше даты окончания');
            return false;
        }
        return true;
    }

    public function checkAcceptDate($attribute, $params){
        if($this->$attribute > $this->start_date){
            $this->addError($attribute, 'Крайний срок подачи заявок не может быть больше даты начала');
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'accepting_end' => 'Крайний срок подачи заявок',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'description' => 'Описание',
            'link' => 'Ссылка',
            'place' => 'Место проведения',
            'short' => 'Краткое описание',
            'responsible_person' => 'Ответственное лицо',
            'responsible_tel' => 'Телефон ответственного лица',
            'filename' => 'Filename',
            'file' => 'Загрузить файл с описанием конференции',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['conference_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['conference_id' => 'id']);
    }

    public function getDateTitle()
    {
        return Yii::$app->formatter->asDate($this->start_date, 'php:d') . ' - ' .
            Yii::$app->formatter->asDate($this->end_date, 'php:d') . ' ' .
            Yii::$app->formatter->asDate($this->end_date, 'php:F') . ' ' .
            Yii::$app->formatter->asDate($this->end_date, 'php:Y');
    }

    public function getStatusName(){
        return $this->status ? 'Активна' : 'Неактивна';
    }

    public function getResponsibleInfo(){
        return $this->responsible_person . ', +998 ' . $this->responsible_tel;
    }

    public function checkForOutdate(){
        return strtotime(date($this->accepting_end)) < time();
    }

    public static function selectList($condition = null)
    {
        return ArrayHelper::map(self::find()->where($condition)->all(), 'id', function($model){
            /** @var $model Conference */
            return $model->name . ' - ' . $model->getDateTitle();
        });
    }

    public function getFile(){
        $filepath = 'files/conferences/' . $this->filename;

        if (file_exists($filepath)){
            return Yii::$app->response->sendFile($filepath);
        }

        return throw new \Exception('Xatolik yuz berdi. Fayl topilmadi');
    }

}
