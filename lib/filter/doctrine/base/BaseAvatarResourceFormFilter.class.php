<?php

/**
 * AvatarResource filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAvatarResourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'      => new sfWidgetFormFilterInput(),
      'path'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cash'             => new sfWidgetFormFilterInput(),
      'gold'             => new sfWidgetFormFilterInput(),
      'buynumber'        => new sfWidgetFormFilterInput(),
      'createdtime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modifiedtime'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'width'            => new sfWidgetFormFilterInput(),
      'height'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'path'             => new sfValidatorPass(array('required' => false)),
      'cash'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gold'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'buynumber'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'createdtime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedtime'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'width'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('avatar_resource_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AvatarResource';
  }

  public function getFields()
  {
    return array(
      'avatarresourceid' => 'Number',
      'name'             => 'Text',
      'description'      => 'Text',
      'path'             => 'Text',
      'cash'             => 'Number',
      'gold'             => 'Number',
      'buynumber'        => 'Number',
      'createdtime'      => 'Date',
      'modifiedtime'     => 'Date',
      'width'            => 'Number',
      'height'           => 'Number',
    );
  }
}
