<?php

/**
 * Level form base class.
 *
 * @method Level getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLevelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'level'       => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'maxexp'      => new sfWidgetFormInputText(),
      'cashgift'    => new sfWidgetFormInputText(),
      'goldgift'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'level'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('level')), 'empty_value' => $this->getObject()->get('level'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'maxexp'      => new sfValidatorInteger(array('required' => false)),
      'cashgift'    => new sfValidatorInteger(array('required' => false)),
      'goldgift'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('level[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Level';
  }

}
