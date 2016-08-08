<?php

/**
 * ClientType form base class.
 *
 * @method ClientType getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClientTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clientId' => new sfWidgetFormInputHidden(),
      'code'     => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'clientId' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('clientId')), 'empty_value' => $this->getObject()->get('clientId'), 'required' => false)),
      'code'     => new sfValidatorPass(array('required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('client_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClientType';
  }

}
