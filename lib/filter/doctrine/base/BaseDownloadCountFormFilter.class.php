<?php

/**
 * DownloadCount filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDownloadCountFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip'              => new sfWidgetFormFilterInput(),
      'platform'        => new sfWidgetFormFilterInput(),
      'downloadedtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cp'              => new sfWidgetFormFilterInput(),
      'type'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ip'              => new sfValidatorPass(array('required' => false)),
      'platform'        => new sfValidatorPass(array('required' => false)),
      'downloadedtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cp'              => new sfValidatorPass(array('required' => false)),
      'type'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('download_count_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DownloadCount';
  }

  public function getFields()
  {
    return array(
      'downloadcountid' => 'Number',
      'ip'              => 'Text',
      'platform'        => 'Text',
      'downloadedtime'  => 'Date',
      'cp'              => 'Text',
      'type'            => 'Text',
    );
  }
}
