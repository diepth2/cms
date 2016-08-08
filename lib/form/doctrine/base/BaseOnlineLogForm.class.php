<?php

/**
 * OnlineLog form base class.
 *
 * @method OnlineLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOnlineLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'logid'        => new sfWidgetFormInputHidden(),
      'peakdata'     => new sfWidgetFormTextarea(),
      'insertedtime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'logid'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('logid')), 'empty_value' => $this->getObject()->get('logid'), 'required' => false)),
      'peakdata'     => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'insertedtime' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('online_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OnlineLog';
  }

}
