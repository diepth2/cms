<?php

/**
 * GameLog form base class.
 *
 * @method GameLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gamelogid'    => new sfWidgetFormInputHidden(),
      'gameid'       => new sfWidgetFormInputText(),
      'hostuserid'   => new sfWidgetFormInputText(),
      'winnerid'     => new sfWidgetFormInputText(),
      'roomid'       => new sfWidgetFormInputText(),
      'cash'         => new sfWidgetFormInputText(),
      'gold'         => new sfWidgetFormInputText(),
      'uniqueid'     => new sfWidgetFormInputText(),
      'inserttime'   => new sfWidgetFormDateTime(),
      'roomname'     => new sfWidgetFormInputText(),
      'playernumber' => new sfWidgetFormInputText(),
      'playercount'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'gamelogid'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gamelogid')), 'empty_value' => $this->getObject()->get('gamelogid'), 'required' => false)),
      'gameid'       => new sfValidatorInteger(),
      'hostuserid'   => new sfValidatorInteger(),
      'winnerid'     => new sfValidatorInteger(array('required' => false)),
      'roomid'       => new sfValidatorInteger(array('required' => false)),
      'cash'         => new sfValidatorInteger(),
      'gold'         => new sfValidatorInteger(),
      'uniqueid'     => new sfValidatorInteger(),
      'inserttime'   => new sfValidatorDateTime(),
      'roomname'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'playernumber' => new sfValidatorInteger(array('required' => false)),
      'playercount'  => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('game_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameLog';
  }

}
