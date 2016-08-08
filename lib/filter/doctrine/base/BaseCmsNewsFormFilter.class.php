<?php

/**
 * CmsNews filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCmsNewsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'content'      => new sfWidgetFormFilterInput(),
      'photo'        => new sfWidgetFormFilterInput(),
      'createdtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'categoryid'   => new sfWidgetFormFilterInput(),
      'author'       => new sfWidgetFormFilterInput(),
      'views'        => new sfWidgetFormFilterInput(),
      'spotlight'    => new sfWidgetFormFilterInput(),
      'modifiedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'order'        => new sfWidgetFormFilterInput(),
      'slider'       => new sfWidgetFormFilterInput(),
      'website'      => new sfWidgetFormFilterInput(),
      'ispopup'      => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'        => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'content'      => new sfValidatorPass(array('required' => false)),
      'photo'        => new sfValidatorPass(array('required' => false)),
      'createdtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'categoryid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author'       => new sfValidatorPass(array('required' => false)),
      'views'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'spotlight'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'modifiedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'order'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slider'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'website'      => new sfValidatorPass(array('required' => false)),
      'ispopup'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('cms_news_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsNews';
  }

  public function getFields()
  {
    return array(
      'newid'        => 'Number',
      'title'        => 'Text',
      'description'  => 'Text',
      'content'      => 'Text',
      'photo'        => 'Text',
      'createdtime'  => 'Date',
      'categoryid'   => 'Number',
      'author'       => 'Text',
      'views'        => 'Number',
      'spotlight'    => 'Number',
      'modifiedtime' => 'Date',
      'order'        => 'Number',
      'slider'       => 'Number',
      'website'      => 'Text',
      'ispopup'      => 'Number',
      'status'       => 'Number',
    );
  }
}
