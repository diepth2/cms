<?php

/**
 * TransactionCard form base class.
 *
 * @method TransactionCard getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransactionCardForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactioncardid' => new sfWidgetFormInputHidden(),
      'cardnumber'        => new sfWidgetFormInputText(),
      'cardserial'        => new sfWidgetFormInputText(),
      'username'          => new sfWidgetFormInputText(),
      'cardprovider'      => new sfWidgetFormInputText(),
      'cp'                => new sfWidgetFormInputText(),
      'channel'           => new sfWidgetFormInputText(),
      'cardprice'         => new sfWidgetFormInputText(),
      'gameprice'         => new sfWidgetFormInputText(),
      'resmsg'            => new sfWidgetFormInputText(),
      'transactiontime'   => new sfWidgetFormDateTime(),
      'status'            => new sfWidgetFormInputText(),
      'userid'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transactioncardid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('transactioncardid')), 'empty_value' => $this->getObject()->get('transactioncardid'), 'required' => false)),
      'cardnumber'        => new sfValidatorString(array('max_length' => 50)),
      'cardserial'        => new sfValidatorString(array('max_length' => 50)),
      'username'          => new sfValidatorString(array('max_length' => 75)),
      'cardprovider'      => new sfValidatorString(array('max_length' => 10)),
      'cp'                => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'channel'           => new sfValidatorInteger(array('required' => false)),
      'cardprice'         => new sfValidatorInteger(),
      'gameprice'         => new sfValidatorInteger(),
      'resmsg'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'transactiontime'   => new sfValidatorDateTime(),
      'status'            => new sfValidatorInteger(),
      'userid'            => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('transaction_card[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransactionCard';
  }

}
