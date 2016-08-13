<?php

/**
 * LogPayment form base class.
 *
 * @method LogPayment getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLogPaymentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'userid'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserInfo'), 'add_empty' => false)),
      'seria'        => new sfWidgetFormInputText(),
      'pin_card'     => new sfWidgetFormInputText(),
      'providerId'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Provider'), 'add_empty' => true)),
      'money'        => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
      'message'      => new sfWidgetFormTextarea(),
      'content'      => new sfWidgetFormTextarea(),
      'request_time' => new sfWidgetFormDateTime(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'userid'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserInfo'))),
      'seria'        => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'pin_card'     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'providerId'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Provider'), 'required' => false)),
      'money'        => new sfValidatorInteger(array('required' => false)),
      'type'         => new sfValidatorInteger(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
      'message'      => new sfValidatorString(array('max_length' => 5000)),
      'content'      => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'request_time' => new sfValidatorDateTime(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('log_payment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogPayment';
  }

}
