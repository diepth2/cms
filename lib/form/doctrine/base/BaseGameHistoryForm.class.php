<?php

/**
 * GameHistory form base class.
 *
 * @method GameHistory getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gamehistoryid'     => new sfWidgetFormInputHidden(),
      'userid'            => new sfWidgetFormInputText(),
      'username'          => new sfWidgetFormInputText(),
      'cash'              => new sfWidgetFormInputText(),
      'currentcash'       => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'gameid'            => new sfWidgetFormInputText(),
      'gametransactionid' => new sfWidgetFormInputText(),
      'time'              => new sfWidgetFormDateTime(),
      'money'             => new sfWidgetFormInputText(),
      'cp'                => new sfWidgetFormTextarea(),
      'title'             => new sfWidgetFormTextarea(),
      'tax'               => new sfWidgetFormInputText(),
      'taxpercent'        => new sfWidgetFormInputText(),
      'gold'              => new sfWidgetFormInputText(),
      'currentgold'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'gamehistoryid'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gamehistoryid')), 'empty_value' => $this->getObject()->get('gamehistoryid'), 'required' => false)),
      'userid'            => new sfValidatorInteger(),
      'username'          => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'cash'              => new sfValidatorInteger(),
      'currentcash'       => new sfValidatorInteger(),
      'description'       => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'gameid'            => new sfValidatorInteger(array('required' => false)),
      'gametransactionid' => new sfValidatorInteger(array('required' => false)),
      'time'              => new sfValidatorDateTime(array('required' => false)),
      'money'             => new sfValidatorInteger(array('required' => false)),
      'cp'                => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'tax'               => new sfValidatorInteger(array('required' => false)),
      'taxpercent'        => new sfValidatorInteger(array('required' => false)),
      'gold'              => new sfValidatorInteger(array('required' => false)),
      'currentgold'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameHistory';
  }

}
