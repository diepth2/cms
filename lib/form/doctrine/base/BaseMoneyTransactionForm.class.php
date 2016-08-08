<?php

/**
 * MoneyTransaction form base class.
 *
 * @method MoneyTransaction getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMoneyTransactionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactionid' => new sfWidgetFormInputHidden(),
      'type'          => new sfWidgetFormInputText(),
      'code'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transactionid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('transactionid')), 'empty_value' => $this->getObject()->get('transactionid'), 'required' => false)),
      'type'          => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'code'          => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('money_transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MoneyTransaction';
  }

}
