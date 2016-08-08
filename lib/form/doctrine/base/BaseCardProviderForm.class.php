<?php

/**
 * CardProvider form base class.
 *
 * @method CardProvider getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCardProviderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cardproviderid' => new sfWidgetFormInputHidden(),
      'cardid'         => new sfWidgetFormInputText(),
      'cardname'       => new sfWidgetFormInputText(),
      'submenu'        => new sfWidgetFormInputText(),
      'len1'           => new sfWidgetFormInputText(),
      'len2'           => new sfWidgetFormInputText(),
      'cardmsg'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cardproviderid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cardproviderid')), 'empty_value' => $this->getObject()->get('cardproviderid'), 'required' => false)),
      'cardid'         => new sfValidatorInteger(),
      'cardname'       => new sfValidatorString(array('max_length' => 30)),
      'submenu'        => new sfValidatorString(array('max_length' => 200)),
      'len1'           => new sfValidatorInteger(array('required' => false)),
      'len2'           => new sfValidatorInteger(array('required' => false)),
      'cardmsg'        => new sfValidatorString(array('max_length' => 200)),
    ));

    $this->widgetSchema->setNameFormat('card_provider[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CardProvider';
  }

}
