<?php

/**
 * faqs actions.
 *
 * @package    vendordiem
 * @subpackage faqs
 * @author     NhungNTH12
 */
class vtFAQActions extends sfActions
{

  /**
   * Lay danh sach 10 cau hoi cho trang index
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
      $this->page = intval($request->getParameter('page', 1));
      if (!$this->page)
      {
         $this->redirect('@error404');
      }
      if ($this->page < 1 || !intval($request->hasParameter('page')))
      {
          $this->key = 0;
      }
      else
      {
          $this->key = ($this->page - 1) * sfConfig::get('app_faqs_items_per_page', 15);
      }

      $i18n = sfContext::getInstance()->getI18N();
      $query = VtFAQsTable::getInstance()->getListFaqsQuery();
      $this->listFaqs = new sfDoctrinePager('VtFAQs', sfConfig::get('app_faqs_items_per_page', 15));
      $this->listFaqs->setQuery($query);
      $this->listFaqs->setPage($this->page);
      $this->listFaqs->init();
      //setTitle
      $this->getResponse()->setTitle($i18n->__('FAQ'));
      //set layout
//      $this->setLayout('layoutProvider');
  }

}
