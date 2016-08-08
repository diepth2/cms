<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'       => new sfWidgetFormInputHidden(),
      'username'     => new sfWidgetFormInputText(),
      'password'     => new sfWidgetFormInputText(),
      'displayname'  => new sfWidgetFormInputText(),
      'identity'     => new sfWidgetFormInputText(),
      'address'      => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'mobile'       => new sfWidgetFormInputText(),
      'birthday'     => new sfWidgetFormDate(),
      'sex'          => new sfWidgetFormInputText(),
      'registedtime' => new sfWidgetFormDateTime(),
      'age'          => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'userid'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('userid')), 'empty_value' => $this->getObject()->get('userid'), 'required' => false)),
      'username'     => new sfValidatorString(array('max_length' => 50)),
      'password'     => new sfValidatorString(array('max_length' => 100)),
      'displayname'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'identity'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'address'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'mobile'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'birthday'     => new sfValidatorDate(array('required' => false)),
      'sex'          => new sfValidatorInteger(array('required' => false)),
      'registedtime' => new sfValidatorDateTime(array('required' => false)),
      'age'          => new sfValidatorInteger(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

}
