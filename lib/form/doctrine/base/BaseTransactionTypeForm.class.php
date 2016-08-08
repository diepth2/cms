<?php

/**
 * TransactionType form base class.
 *
 * @method TransactionType getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransactionTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactiontypeid' => new sfWidgetFormInputHidden(),
      'type'              => new sfWidgetFormInputText(),
      'code'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transactiontypeid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('transactiontypeid')), 'empty_value' => $this->getObject()->get('transactiontypeid'), 'required' => false)),
      'type'              => new sfValidatorString(array('max_length' => 40)),
      'code'              => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transaction_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransactionType';
  }

}
