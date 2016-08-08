<?php

/**
 * BetGold form base class.
 *
 * @method BetGold getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBetGoldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'betgoldid' => new sfWidgetFormInputHidden(),
      'gold'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'betgoldid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('betgoldid')), 'empty_value' => $this->getObject()->get('betgoldid'), 'required' => false)),
      'gold'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('bet_gold[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BetGold';
  }

}
