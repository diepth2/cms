<?php

/**
 * BetCash form base class.
 *
 * @method BetCash getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBetCashForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'betcashid' => new sfWidgetFormInputHidden(),
      'cash'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'betcashid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('betcashid')), 'empty_value' => $this->getObject()->get('betcashid'), 'required' => false)),
      'cash'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('bet_cash[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BetCash';
  }

}
