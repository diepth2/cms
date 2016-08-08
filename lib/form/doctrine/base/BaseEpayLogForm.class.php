<?php

/**
 * EpayLog form base class.
 *
 * @method EpayLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEpayLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'epaylogid' => new sfWidgetFormInputHidden(),
      'time'      => new sfWidgetFormDateTime(),
      'status'    => new sfWidgetFormTextarea(),
      'code'      => new sfWidgetFormInputText(),
      'success'   => new sfWidgetFormInputText(),
      'type'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'epaylogid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('epaylogid')), 'empty_value' => $this->getObject()->get('epaylogid'), 'required' => false)),
      'time'      => new sfValidatorDateTime(array('required' => false)),
      'status'    => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'code'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'success'   => new sfValidatorInteger(array('required' => false)),
      'type'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('epay_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EpayLog';
  }

}
