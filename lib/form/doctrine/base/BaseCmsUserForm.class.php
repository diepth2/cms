<?php

/**
 * CmsUser form base class.
 *
 * @method CmsUser getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCmsUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'           => new sfWidgetFormInputHidden(),
      'user_name'         => new sfWidgetFormInputText(),
      'create_date'       => new sfWidgetFormDateTime(),
      'modified_date'     => new sfWidgetFormDateTime(),
      'email'             => new sfWidgetFormInputText(),
      'phone'             => new sfWidgetFormInputText(),
      'mobile'            => new sfWidgetFormInputText(),
      'gender'            => new sfWidgetFormInputText(),
      'date_of_birth'     => new sfWidgetFormDate(),
      'birth_place'       => new sfWidgetFormInputText(),
      'first_name'        => new sfWidgetFormInputText(),
      'middle_name'       => new sfWidgetFormInputText(),
      'last_name'         => new sfWidgetFormInputText(),
      'status'            => new sfWidgetFormInputText(),
      'password'          => new sfWidgetFormInputText(),
      'dept_id'           => new sfWidgetFormInputText(),
      'address'           => new sfWidgetFormTextarea(),
      'description'       => new sfWidgetFormTextarea(),
      'verification_code' => new sfWidgetFormInputText(),
      'cp'                => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'user_id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'user_name'         => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'create_date'       => new sfValidatorDateTime(array('required' => false)),
      'modified_date'     => new sfValidatorDateTime(array('required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'phone'             => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'mobile'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'gender'            => new sfValidatorInteger(array('required' => false)),
      'date_of_birth'     => new sfValidatorDate(array('required' => false)),
      'birth_place'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'first_name'        => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'middle_name'       => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'last_name'         => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'status'            => new sfValidatorInteger(array('required' => false)),
      'password'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dept_id'           => new sfValidatorInteger(array('required' => false)),
      'address'           => new sfValidatorString(array('required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'verification_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cp'                => new sfValidatorString(array('max_length' => 500, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cms_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsUser';
  }

}
