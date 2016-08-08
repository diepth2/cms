<?php

/**
 * GameClient form base class.
 *
 * @method GameClient getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameClientForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clientid'   => new sfWidgetFormInputHidden(),
      'clientname' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'clientid'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('clientid')), 'empty_value' => $this->getObject()->get('clientid'), 'required' => false)),
      'clientname' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_client[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameClient';
  }

}
