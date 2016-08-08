<?php

/**
 * PurchaseMoney form base class.
 *
 * @method PurchaseMoney getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePurchaseMoneyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'purchaseid'   => new sfWidgetFormInputHidden(),
      'userid'       => new sfWidgetFormInputText(),
      'username'     => new sfWidgetFormInputText(),
      'provider'     => new sfWidgetFormInputText(),
      'cardserial'   => new sfWidgetFormInputText(),
      'cardpin'      => new sfWidgetFormInputText(),
      'securitykey'  => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
      'senttime'     => new sfWidgetFormDateTime(),
      'receivedtime' => new sfWidgetFormDateTime(),
      'cardvalue'    => new sfWidgetFormInputText(),
      'gamemoney'    => new sfWidgetFormInputText(),
      'tocash'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'purchaseid'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('purchaseid')), 'empty_value' => $this->getObject()->get('purchaseid'), 'required' => false)),
      'userid'       => new sfValidatorInteger(),
      'username'     => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'provider'     => new sfValidatorString(array('max_length' => 10)),
      'cardserial'   => new sfValidatorString(array('max_length' => 20)),
      'cardpin'      => new sfValidatorString(array('max_length' => 20)),
      'securitykey'  => new sfValidatorString(array('max_length' => 100)),
      'status'       => new sfValidatorInteger(),
      'senttime'     => new sfValidatorDateTime(array('required' => false)),
      'receivedtime' => new sfValidatorDateTime(array('required' => false)),
      'cardvalue'    => new sfValidatorInteger(array('required' => false)),
      'gamemoney'    => new sfValidatorInteger(array('required' => false)),
      'tocash'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('purchase_money[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PurchaseMoney';
  }

}
