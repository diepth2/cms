<?php

/**
 * PluginVtSlideshow form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginVtSlideshowForm extends BaseVtSlideshowForm
{
  public function setup()
  {
    parent::setup();
    unset($this['created_at'] , $this['updated_at']);
    // khai bao maxsize
    $maxSizeMb = intval(sfConfig::get('app_slideshow_slide_maxsize', 5242880) / 1024 / 1024);
    $i18n = sfContext::getInstance()->getI18N();

    $this->validatorSchema['name'] = new sfValidatorString(array(
      'required' => true,
      'max_length' => 100,
    ));

    $this->validatorSchema['priority'] = new sfValidatorAnd(array(
      new sfValidatorString(array('max_length' => 6)),
      new sfValidatorInteger(
        array('min' => 0, 'required' => false,
        ))));
    $this->setDefault('priority', 0);

    //start_time & end_time
    $this->widgetSchema['start_time'] = new sfWidgetFormDateTimePicker(array('default' => 'now'), array('id'=>'start_time'));
    $this->validatorSchema['start_time'] = new sfValidatorDateTimePicker(array(
      'required' => true,
      'date_format' => '~(?P<day>\d{2})-(?P<month>\d{2})-(?P<year>\d{4}) (?P<hour>\d{2}):(?P<minute>\d{2})~',
      'date_output' => 'd-m-Y',
      'datetime_output' => 'd-m-Y H:i',
      'date_format_error' => 'd-m-Y H:i',
      'date_format_range_error' => 'd-m-Y H:i'
    ));
    $this->widgetSchema['end_time'] = new sfWidgetFormDateTimePicker(array('default' => 'now'), array('id'=>'end_time'));
    $this->validatorSchema['end_time'] = new sfValidatorDateTimePicker(array(
      'required' => true,
      'date_format' => '~(?P<day>\d{2})-(?P<month>\d{2})-(?P<year>\d{4}) (?P<hour>\d{2}):(?P<minute>\d{2})~',
      'date_output' => 'd-m-Y',
      'datetime_output' => 'd-m-Y H:i',
      'date_format_error' => 'd-m-Y H:i',
      'date_format_range_error' => 'd-m-Y H:i'
    ));

    //validate start_time & end_time
    $this->mergePostValidator(new sfValidatorSchemaCompare('start_time',
      sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'end_time',
      array(), array('invalid' => $i18n->__('The begin date must be before the end date.'))
    ));

    $this->widgetSchema['file_path'] = new VtWidgetFormInputFile(array(
      'file_src' => $this->getObject()->getFilePath(),
      'is_image' => true,
      'edit_mode' => $this->getObject()->getFilePath(),));
    $this->validatorSchema['file_path_delete'] = new sfValidatorPass();
    $this->validatorSchema['file_path'] =  new sfValidatorFile(array(
      'max_size' => sfConfig::get('app_slideshow_slide_maxsize', 5242880),
      'mime_types' => array('application/x-shockwave-flash', 'image/jpeg', 'image/png', 'image/gif'), //you can set your own of course
      'path' => sfConfig::get('sf_web_dir') . VtSlideshowPluginHelper::generatePath('slideshow'),
      'required' => true
    ), array(
      'mime_types'=> $i18n->__('File upload is wrong type'),
      'max_size'  => $i18n->__('File is too large (maximum is %max_size%Mb)' , array('%max_size%'=>$maxSizeMb))
    ));


    //comment ho tro upload anh
    $this->widgetSchema->setHelp('file_path', $i18n->__('Recommend: Image should be image-large 430x225.') .
        ' ' . $i18n->__('File is not too large %max_size%Mb.', array('%max_size%' => $maxSizeMb)));
    //end modified
    $this->setDefault('is_active', false);
    $this->validatorSchema['url'] = new sfValidatorUrl(array('max_length' => 255, 'required' => false, 'trim' => false));
    $this->validatorSchema['file_path']->setOption('required', $this->isNew());
  }


  public function processValues($values)
  {
    $values = parent::processValues($values);

    if (substr($values['file_path'], 0, 1) != '/' && !empty($values['file_path'])) {
      $values['file_path'] = VtSlideshowPluginHelper::generatePath('slideshow') . $values['file_path'];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    @$mimeType   = finfo_file($finfo, sfConfig::get('sf_web_dir'). '/'. $values['file_path']);

    if ($mimeType == 'application/x-shockwave-flash')
    {
      $values['is_flash'] = 1;
    }
    return $values;
  }
}
