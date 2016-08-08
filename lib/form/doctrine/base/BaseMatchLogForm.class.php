<?php

/**
 * MatchLog form base class.
 *
 * @method MatchLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMatchLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'matchlogid'  => new sfWidgetFormInputHidden(),
      'roomid'      => new sfWidgetFormInputText(),
      'matchindex'  => new sfWidgetFormInputText(),
      'gameid'      => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'createdtime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'matchlogid'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('matchlogid')), 'empty_value' => $this->getObject()->get('matchlogid'), 'required' => false)),
      'roomid'      => new sfValidatorInteger(),
      'matchindex'  => new sfValidatorInteger(array('required' => false)),
      'gameid'      => new sfValidatorInteger(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 4000)),
      'createdtime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('match_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MatchLog';
  }

}
