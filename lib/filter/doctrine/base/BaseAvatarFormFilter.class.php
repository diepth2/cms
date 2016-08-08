<?php

/**
 * Avatar filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAvatarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'path'        => new sfWidgetFormFilterInput(),
      'cash'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gold'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'width'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'height'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      '_bytes'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'path'        => new sfValidatorPass(array('required' => false)),
      'cash'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gold'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'createdtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'width'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      '_bytes'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('avatar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Avatar';
  }

  public function getFields()
  {
    return array(
      'avatarid'    => 'Number',
      'name'        => 'Text',
      'description' => 'Text',
      'path'        => 'Text',
      'cash'        => 'Number',
      'gold'        => 'Number',
      'createdtime' => 'Date',
      'width'       => 'Number',
      'height'      => 'Number',
      'status'      => 'Number',
      '_bytes'      => 'Text',
    );
  }
}
