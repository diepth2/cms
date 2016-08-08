<?php

/**
 * DownloadLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDownloadLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'phonename'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'brandname'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datetime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'width'         => new sfWidgetFormFilterInput(),
      'height'        => new sfWidgetFormFilterInput(),
      'setup'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'registry'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'login'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'version'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'setuptime'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'source'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'phonename'     => new sfValidatorPass(array('required' => false)),
      'brandname'     => new sfValidatorPass(array('required' => false)),
      'datetime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'width'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'registry'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'login'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'version'       => new sfValidatorPass(array('required' => false)),
      'setuptime'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'source'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('download_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DownloadLog';
  }

  public function getFields()
  {
    return array(
      'downloadlogid' => 'Number',
      'phonename'     => 'Text',
      'brandname'     => 'Text',
      'datetime'      => 'Date',
      'width'         => 'Number',
      'height'        => 'Number',
      'setup'         => 'Number',
      'registry'      => 'Number',
      'login'         => 'Number',
      'version'       => 'Text',
      'setuptime'     => 'Date',
      'source'        => 'Text',
    );
  }
}
