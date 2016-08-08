<?php

require_once dirname(__FILE__) . '/../lib/vtAdvertiseAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/vtAdvertiseAdminGeneratorHelper.class.php';

/**
 * vtAdvertiseAdmin actions.
 *
 * @package    st
 * @subpackage vtAdvertiseAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtAdvertiseAdminActions extends autoVtAdvertiseAdminActions
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
        ->from('VtAdvertise')
        ->whereIn('id', $ids)
        ->execute();

    foreach ($records as $record) {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
      $record->setIsActive(1);
      $record->save();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been active successfully.');
    $this->redirect('@vt_advertise');
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
        ->from('VtAdvertise')
        ->whereIn('id', $ids)
        ->execute();

    foreach ($records as $record) {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
      $record->setIsActive(0);
      $record->save();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been deactive successfully.');
    $this->redirect('@vt_advertise');
  }
}
