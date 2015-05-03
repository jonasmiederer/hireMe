<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobAd".
 *
 * @property integer $id
 * @property string $description
 * @property string $job_begin
 * @property string $job_end
 * @property string $zip
 * @property integer $sector
 * @property integer $contact_id
 * @property integer $company_id
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $contact
 * @property Company $company
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'description', 'zip', 'sector', 'contact_id', 'company_id', 'active'], 'required'],
            [['id', 'sector', 'contact_id', 'company_id', 'active'], 'integer'],
            [['job_begin', 'job_end', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'job_begin' => Yii::t('app', 'Job Begin'),
            'job_end' => Yii::t('app', 'Job End'),
            'zip' => Yii::t('app', 'Zip'),
            'sector' => Yii::t('app', 'Sector'),
            'contact_id' => Yii::t('app', 'Contact ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(User::className(), ['id' => 'contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
