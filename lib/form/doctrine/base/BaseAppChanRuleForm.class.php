<?php

/**
 * AppChanRule form base class.
 *
 * @method AppChanRule getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAppChanRuleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ruleid'      => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'point'       => new sfWidgetFormInputText(),
      'dich'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ruleid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ruleid')), 'empty_value' => $this->getObject()->get('ruleid'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'point'       => new sfValidatorInteger(array('required' => false)),
      'dich'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('app_chan_rule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AppChanRule';
  }

}
