<?php

/**
 * This is the model class for table "{{looktags}}".
 *
 * The followings are the available columns in table '{{looktags}}':
 * @property integer $id
 */
class Looktags extends CActiveRecord
{
    public $str_data = '';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{looktags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('p_id, name, x_koord, y_koord', 'required'),

		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'p_id' => 'P',
			'name' => 'Name',
			'url' => 'Url',
			'x_koord' => 'X Koord',
			'y_koord' => 'Y Koord',
			'ct_id' => 'Ct',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('x_koord',$this->x_koord,true);
		$criteria->compare('y_koord',$this->y_koord,true);
		$criteria->compare('ct_id',$this->ct_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Looktags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
