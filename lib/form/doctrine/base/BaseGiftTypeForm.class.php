<?php

/**
 * GiftType form base class.
 *
 * @method GiftType getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGiftTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gifttypeid'  => new sfWidgetFormInputHidden(),
      'type'        => new sfWidgetFormInputText(),
      'value'       => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
      'expiredtime' => new sfWidgetFormDateTime(),
      'volume'      => new sfWidgetFormInputText(),
      'code'        => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'gifttypeid'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gifttypeid')), 'empty_value' => $this->getObject()->get('gifttypeid'), 'required' => false)),
      'type'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'value'       => new sfValidatorNumber(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'createdtime' => new sfValidatorDateTime(array('required' => false)),
      'expiredtime' => new sfValidatorDateTime(array('required' => false)),
      'volume'      => new sfValidatorInteger(array('required' => false)),
      'code'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gift_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GiftType';
  }

}
