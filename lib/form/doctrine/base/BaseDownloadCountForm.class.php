<?php

/**
 * DownloadCount form base class.
 *
 * @method DownloadCount getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDownloadCountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'downloadcountid' => new sfWidgetFormInputHidden(),
      'ip'              => new sfWidgetFormInputText(),
      'platform'        => new sfWidgetFormInputText(),
      'downloadedtime'  => new sfWidgetFormDateTime(),
      'cp'              => new sfWidgetFormInputText(),
      'type'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'downloadcountid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('downloadcountid')), 'empty_value' => $this->getObject()->get('downloadcountid'), 'required' => false)),
      'ip'              => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'platform'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'downloadedtime'  => new sfValidatorDateTime(array('required' => false)),
      'cp'              => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'type'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('download_count[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DownloadCount';
  }

}
