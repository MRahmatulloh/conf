<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property int $conference_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Conference $conference
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
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
            [['name', 'conference_id'], 'required'],
            [['status', 'conference_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'checkForDublicate', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['conference_id'], 'exist', 'skipOnError' => false, 'targetClass' => Conference::class, 'targetAttribute' => ['conference_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название направления',
            'status' => 'Статус',
            'conference_id' => 'Конференция',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function checkForDublicate($attribute, $params){
        $dublicate = self::findOne(['name' => $this->$attribute, 'conference_id' => $this->conference_id]);

        if($dublicate){
            $this->addError($attribute, 'Это направление уже добавлено');
            return false;
        }
        return true;
    }

    /**
     * Gets query for [[Conference]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConference()
    {
        return $this->hasOne(Conference::class, ['id' => 'conference_id']);
    }

    public static function selectList($condition = null)
    {
        return ArrayHelper::map(self::find()->where($condition)->all(), 'id', 'name');
    }
}
