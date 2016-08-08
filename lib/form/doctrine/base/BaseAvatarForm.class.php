<?php

/**
 * Avatar form base class.
 *
 * @method Avatar getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAvatarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'avatarid'    => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'path'        => new sfWidgetFormInputText(),
      'cash'        => new sfWidgetFormInputText(),
      'gold'        => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
      'width'       => new sfWidgetFormInputText(),
      'height'      => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      '_bytes'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'avatarid'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('avatarid')), 'empty_value' => $this->getObject()->get('avatarid'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'path'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'cash'        => new sfValidatorInteger(array('required' => false)),
      'gold'        => new sfValidatorInteger(array('required' => false)),
      'createdtime' => new sfValidatorDateTime(),
      'width'       => new sfValidatorInteger(array('required' => false)),
      'height'      => new sfValidatorInteger(array('required' => false)),
      'status'      => new sfValidatorInteger(array('required' => false)),
      '_bytes'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('avatar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Avatar';
  }

}
