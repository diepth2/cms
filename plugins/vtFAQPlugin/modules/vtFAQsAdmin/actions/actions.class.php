<?php

require_once dirname(__FILE__) . '/../lib/vtFAQsAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/vtFAQsAdminGeneratorHelper.class.php';

/**
 * vtFAQsAdmin actions.
 *
 * @package    st
 * @subpackage vtFAQsAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtFAQsAdminActions extends autoVtFAQsAdminActions
{
  /*
   * ham active cac ban ghi cua faqs
   * @author dongvt1
   * @create on  12/4/2013
   */
  public function executeBatchActive(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $records = Doctrine_Query::create()
        ->from('VtFAQs')
        ->whereIn('id', $ids)
        ->execute();
    foreach ($records as $record) {
      $this->dispatcher->notify(new sfEvent($this, 'admin.active_object', array('object' => $record)));
      $record->setIsActive(1);
      $record->save();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been active successfully.');
    $this->redirect('@vt_faqs');
  }

  /*
   * ham deactive cac ban ghi cua faqs
   * @author dongvt1
   * @create on  12/4/2013
   */
  public function executeBatchDeactive(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $records = Doctrine_Query::create()
        ->from('VtFAQs')
        ->whereIn('id', $ids)
        ->execute();
    foreach ($records as $record) {
      $this->dispatcher->notify(new sfEvent($this, 'admin.deactive_object', array('object' => $record)));
      $record->setIsActive(0);
      $record->save();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been deactive successfully.');
    $this->redirect('@vt_faqs');
  }
}
