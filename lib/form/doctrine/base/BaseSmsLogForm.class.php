<?php

/**
 * SmsLog form base class.
 *
 * @method SmsLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSmsLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'smslogid'    => new sfWidgetFormInputHidden(),
      'sender'      => new sfWidgetFormInputText(),
      'recipient'   => new sfWidgetFormInputText(),
      'mobody'      => new sfWidgetFormInputText(),
      'mtbody'      => new sfWidgetFormInputText(),
      'cp'          => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
      'sendnumber'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'smslogid'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('smslogid')), 'empty_value' => $this->getObject()->get('smslogid'), 'required' => false)),
      'sender'      => new sfValidatorString(array('max_length' => 12)),
      'recipient'   => new sfValidatorString(array('max_length' => 12)),
      'mobody'      => new sfValidatorString(array('max_length' => 160)),
      'mtbody'      => new sfValidatorString(array('max_length' => 160, 'required' => false)),
      'cp'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'status'      => new sfValidatorInteger(array('required' => false)),
      'createdtime' => new sfValidatorDateTime(),
      'sendnumber'  => new sfValidatorString(array('max_length' => 15, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sms_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SmsLog';
  }

}
