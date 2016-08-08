<?php

/**
 * Slider form base class.
 *
 * @method Slider getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSliderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slideid'   => new sfWidgetFormInputHidden(),
      'title'     => new sfWidgetFormInputText(),
      'url'       => new sfWidgetFormInputText(),
      'starttime' => new sfWidgetFormDateTime(),
      'endtime'   => new sfWidgetFormDateTime(),
      'file'      => new sfWidgetFormInputText(),
      'cp'        => new sfWidgetFormInputText(),
      'status'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'slideid'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('slideid')), 'empty_value' => $this->getObject()->get('slideid'), 'required' => false)),
      'title'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'starttime' => new sfValidatorDateTime(array('required' => false)),
      'endtime'   => new sfValidatorDateTime(array('required' => false)),
      'file'      => new sfValidatorString(array('max_length' => 155, 'required' => false)),
      'cp'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'status'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('slider[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Slider';
  }

}
