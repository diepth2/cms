<?php

/**
 * DownloadLog form base class.
 *
 * @method DownloadLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDownloadLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'downloadlogid' => new sfWidgetFormInputHidden(),
      'phonename'     => new sfWidgetFormTextarea(),
      'brandname'     => new sfWidgetFormTextarea(),
      'datetime'      => new sfWidgetFormDateTime(),
      'width'         => new sfWidgetFormInputText(),
      'height'        => new sfWidgetFormInputText(),
      'setup'         => new sfWidgetFormInputText(),
      'registry'      => new sfWidgetFormInputText(),
      'login'         => new sfWidgetFormInputText(),
      'version'       => new sfWidgetFormInputText(),
      'setuptime'     => new sfWidgetFormDateTime(),
      'source'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'downloadlogid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('downloadlogid')), 'empty_value' => $this->getObject()->get('downloadlogid'), 'required' => false)),
      'phonename'     => new sfValidatorString(array('max_length' => 1000)),
      'brandname'     => new sfValidatorString(array('max_length' => 1000)),
      'datetime'      => new sfValidatorDateTime(),
      'width'         => new sfValidatorInteger(array('required' => false)),
      'height'        => new sfValidatorInteger(array('required' => false)),
      'setup'         => new sfValidatorInteger(array('required' => false)),
      'registry'      => new sfValidatorInteger(array('required' => false)),
      'login'         => new sfValidatorInteger(array('required' => false)),
      'version'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'setuptime'     => new sfValidatorDateTime(array('required' => false)),
      'source'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('download_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DownloadLog';
  }

}
