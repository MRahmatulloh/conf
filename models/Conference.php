<?php

namespace app\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conference';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start_date', 'end_date'], 'required'],
            [['accepting_end', 'start_date', 'end_date'], 'safe'],
            [['description'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'link', 'filename'], 'string', 'max' => 255],
        ];
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
            'link' => 'Link',
            'filename' => 'Filename',
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
}
