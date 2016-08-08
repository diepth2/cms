<?php

/**
 * Link form base class.
 *
 * @method Link getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLinkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'linkid'      => new sfWidgetFormInputHidden(),
      'url'         => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'userid'      => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'clicked'     => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
      'updatedtime' => new sfWidgetFormDateTime(),
      'introuserid' => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'linkid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('linkid')), 'empty_value' => $this->getObject()->get('linkid'), 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'userid'      => new sfValidatorInteger(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clicked'     => new sfValidatorInteger(array('required' => false)),
      'createdtime' => new sfValidatorDateTime(array('required' => false)),
      'updatedtime' => new sfValidatorDateTime(array('required' => false)),
      'introuserid' => new sfValidatorInteger(array('required' => false)),
      'status'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Link';
  }

}
