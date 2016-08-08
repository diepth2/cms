<?php

/**
 * Medal form base class.
 *
 * @method Medal getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMedalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'medal'       => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'maxlevel'    => new sfWidgetFormInputText(),
      '_bytes'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'medal'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('medal')), 'empty_value' => $this->getObject()->get('medal'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'maxlevel'    => new sfValidatorInteger(array('required' => false)),
      '_bytes'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('medal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Medal';
  }

}
