<?php

/**
 * TopupLog form base class.
 *
 * @method TopupLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTopupLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'topupid'      => new sfWidgetFormInputHidden(),
      'timetopup'    => new sfWidgetFormDateTime(),
      'username'     => new sfWidgetFormInputText(),
      'cardserial'   => new sfWidgetFormInputText(),
      'cardpin'      => new sfWidgetFormInputText(),
      'value'        => new sfWidgetFormInputText(),
      'providercard' => new sfWidgetFormInputText(),
      'currentcash'  => new sfWidgetFormInputText(),
      'currentgold'  => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
      'userid'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'topupid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('topupid')), 'empty_value' => $this->getObject()->get('topupid'), 'required' => false)),
      'timetopup'    => new sfValidatorDateTime(array('required' => false)),
      'username'     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'cardserial'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'cardpin'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'value'        => new sfValidatorInteger(array('required' => false)),
      'providercard' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'currentcash'  => new sfValidatorInteger(array('required' => false)),
      'currentgold'  => new sfValidatorInteger(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
      'userid'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('topup_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TopupLog';
  }

}
