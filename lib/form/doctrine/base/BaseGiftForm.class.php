<?php

/**
 * Gift form base class.
 *
 * @method Gift getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGiftForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'giftid'      => new sfWidgetFormInputHidden(),
      'code'        => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
      'expiredtime' => new sfWidgetFormDateTime(),
      'gifttypeid'  => new sfWidgetFormInputText(),
      'userid'      => new sfWidgetFormInputText(),
      'username'    => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'value'       => new sfWidgetFormInputText(),
      'volume'      => new sfWidgetFormInputText(),
      'ip'          => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'giftid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('giftid')), 'empty_value' => $this->getObject()->get('giftid'), 'required' => false)),
      'code'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'createdtime' => new sfValidatorDateTime(array('required' => false)),
      'expiredtime' => new sfValidatorDateTime(array('required' => false)),
      'gifttypeid'  => new sfValidatorInteger(array('required' => false)),
      'userid'      => new sfValidatorInteger(array('required' => false)),
      'username'    => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'value'       => new sfValidatorInteger(array('required' => false)),
      'volume'      => new sfValidatorInteger(array('required' => false)),
      'ip'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gift[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gift';
  }

}
