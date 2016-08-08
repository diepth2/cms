<?php

/**
 * PasswordUpdate form base class.
 *
 * @method PasswordUpdate getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePasswordUpdateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'passwordupdateid' => new sfWidgetFormInputHidden(),
      'userid'           => new sfWidgetFormInputText(),
      'username'         => new sfWidgetFormInputText(),
      'log'              => new sfWidgetFormInputText(),
      'updatetime'       => new sfWidgetFormDateTime(),
      'mysql_user'       => new sfWidgetFormInputText(),
      'oldpass'          => new sfWidgetFormInputText(),
      'newpass'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'passwordupdateid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('passwordupdateid')), 'empty_value' => $this->getObject()->get('passwordupdateid'), 'required' => false)),
      'userid'           => new sfValidatorInteger(array('required' => false)),
      'username'         => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'log'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'updatetime'       => new sfValidatorDateTime(array('required' => false)),
      'mysql_user'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'oldpass'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'newpass'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('password_update[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PasswordUpdate';
  }

}
