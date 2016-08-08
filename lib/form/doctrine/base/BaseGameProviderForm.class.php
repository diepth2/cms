<?php

/**
 * GameProvider form base class.
 *
 * @method GameProvider getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameProviderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'providerid'   => new sfWidgetFormInputHidden(),
      'providername' => new sfWidgetFormInputText(),
      'md5key'       => new sfWidgetFormInputText(),
      'defaultcp'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'providerid'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('providerid')), 'empty_value' => $this->getObject()->get('providerid'), 'required' => false)),
      'providername' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'md5key'       => new sfValidatorString(array('max_length' => 50)),
      'defaultcp'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_provider[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameProvider';
  }

}
