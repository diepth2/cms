<?php

/**
 * CmsCategory filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCmsCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'        => new sfWidgetFormFilterInput(),
      'menutext'     => new sfWidgetFormFilterInput(),
      'parentid'     => new sfWidgetFormFilterInput(),
      'url'          => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'createdtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modifiedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'author'       => new sfWidgetFormFilterInput(),
      'ismenu'       => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'        => new sfValidatorPass(array('required' => false)),
      'menutext'     => new sfValidatorPass(array('required' => false)),
      'parentid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'url'          => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'createdtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'author'       => new sfValidatorPass(array('required' => false)),
      'ismenu'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('cms_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsCategory';
  }

  public function getFields()
  {
    return array(
      'categoryid'   => 'Number',
      'title'        => 'Text',
      'menutext'     => 'Text',
      'parentid'     => 'Number',
      'url'          => 'Text',
      'description'  => 'Text',
      'createdtime'  => 'Date',
      'modifiedtime' => 'Date',
      'author'       => 'Text',
      'ismenu'       => 'Number',
      'status'       => 'Number',
    );
  }
}
