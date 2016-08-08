<?php

/**
 * GameVersion form base class.
 *
 * @method GameVersion getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'versionid'       => new sfWidgetFormInputHidden(),
      'clientid'        => new sfWidgetFormInputText(),
      'versioncode'     => new sfWidgetFormInputText(),
      'versionmsg'      => new sfWidgetFormInputText(),
      'forceupdate'     => new sfWidgetFormInputText(),
      'lastupdatedtime' => new sfWidgetFormDateTime(),
      'status'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'versionid'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('versionid')), 'empty_value' => $this->getObject()->get('versionid'), 'required' => false)),
      'clientid'        => new sfValidatorInteger(),
      'versioncode'     => new sfValidatorString(array('max_length' => 5)),
      'versionmsg'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'forceupdate'     => new sfValidatorInteger(array('required' => false)),
      'lastupdatedtime' => new sfValidatorDateTime(array('required' => false)),
      'status'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameVersion';
  }

}
