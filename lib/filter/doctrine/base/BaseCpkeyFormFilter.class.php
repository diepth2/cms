<?php

/**
 * Cpkey filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCpkeyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cpid'       => new sfWidgetFormFilterInput(),
      'keyconnect' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cpid'       => new sfValidatorPass(array('required' => false)),
      'keyconnect' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cpkey_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cpkey';
  }

  public function getFields()
  {
    return array(
      'cpkeyid'    => 'Number',
      'cpid'       => 'Text',
      'keyconnect' => 'Text',
    );
  }
}
