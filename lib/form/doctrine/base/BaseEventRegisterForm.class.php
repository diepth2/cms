<?php

/**
 * EventRegister form base class.
 *
 * @method EventRegister getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventRegisterForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eventregisterid' => new sfWidgetFormInputHidden(),
      'eventid'         => new sfWidgetFormInputText(),
      'username'        => new sfWidgetFormInputText(),
      'fullname'        => new sfWidgetFormInputText(),
      'email'           => new sfWidgetFormInputText(),
      'phone'           => new sfWidgetFormInputText(),
      'registeredtime'  => new sfWidgetFormDateTime(),
      'ym'              => new sfWidgetFormInputText(),
      'rank'            => new sfWidgetFormInputText(),
      'comment'         => new sfWidgetFormTextarea(),
      'identity'        => new sfWidgetFormInputText(),
      'startcash'       => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'eventregisterid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('eventregisterid')), 'empty_value' => $this->getObject()->get('eventregisterid'), 'required' => false)),
      'eventid'         => new sfValidatorInteger(array('required' => false)),
      'username'        => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'fullname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'registeredtime'  => new sfValidatorDateTime(),
      'ym'              => new sfValidatorString(array('max_length' => 255)),
      'rank'            => new sfValidatorInteger(array('required' => false)),
      'comment'         => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'identity'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'startcash'       => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'status'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event_register[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventRegister';
  }

}
