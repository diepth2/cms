<?php

/**
 * SmsText form base class.
 *
 * @method SmsText getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSmsTextForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'smstextid'      => new sfWidgetFormInputHidden(),
      'gameid'         => new sfWidgetFormInputText(),
      'partnerid'      => new sfWidgetFormInputText(),
      'txref'          => new sfWidgetFormInputText(),
      'operatornumber' => new sfWidgetFormInputText(),
      'cmdcode'        => new sfWidgetFormInputText(),
      'msisdn'         => new sfWidgetFormInputText(),
      'mobody'         => new sfWidgetFormInputText(),
      'mtbody'         => new sfWidgetFormInputText(),
      'targetuserid'   => new sfWidgetFormInputText(),
      'targetusername' => new sfWidgetFormInputText(),
      'receivedtime'   => new sfWidgetFormDateTime(),
      'responedtime'   => new sfWidgetFormDateTime(),
      'status'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'smstextid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('smstextid')), 'empty_value' => $this->getObject()->get('smstextid'), 'required' => false)),
      'gameid'         => new sfValidatorInteger(),
      'partnerid'      => new sfValidatorInteger(),
      'txref'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'operatornumber' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'cmdcode'        => new sfValidatorString(array('max_length' => 50)),
      'msisdn'         => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'mobody'         => new sfValidatorString(array('max_length' => 160)),
      'mtbody'         => new sfValidatorString(array('max_length' => 160, 'required' => false)),
      'targetuserid'   => new sfValidatorInteger(array('required' => false)),
      'targetusername' => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'receivedtime'   => new sfValidatorDateTime(),
      'responedtime'   => new sfValidatorDateTime(array('required' => false)),
      'status'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sms_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SmsText';
  }

}
