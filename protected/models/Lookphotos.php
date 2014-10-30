<?php

/**
 * This is the model class for table "{{lookphotos}}".
 *
 * The followings are the available columns in table '{{lookphotos}}':
 * @property integer $p_id
 * @property integer $ls_id
 * @property integer $user_id
 * @property string $filename
 */
class Lookphotos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{lookphotos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ls_id, user_id, filename', 'required'),
			array('ls_id, user_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('p_id, ls_id, user_id, filename', 'safe', 'on'=>'search'),
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


    public function behaviors()
    {
        return array(
            'preview' => array(
                'class' => 'application.extensions.imageAttachment.ImageAttachmentBehavior',
                // size for image preview in widget
                'previewHeight' => 200,
                'previewWidth' => 300,
                // extension for image saving, can be also tiff, png or gif
                'extension' => 'jpg',
                // folder to store images
                'directory' => Yii::getPathOfAlias('webroot').'/images/productTheme/preview',
                // url for images folder
                'url' => Yii::app()->request->baseUrl . '/images/productTheme/preview',
                // image versions
                'versions' => array(
                    'small' => array(
                        'resize' => array(200, null),
                    ),
                    'medium' => array(
                        'resize' => array(800, null),
                    )
                )
            )
        );
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'p_id' => 'P',
			'ls_id' => 'Ls',
			'user_id' => 'User',
			'filename' => 'Filename',
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

		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('ls_id',$this->ls_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('filename',$this->filename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lookphotos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
