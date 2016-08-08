<?php

require_once dirname(__FILE__).'/../lib/gvManageOnlineLogGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/gvManageOnlineLogGeneratorHelper.class.php';

/**
 * gvManageOnlineLog actions.
 *
 * @package    Vt_Portals
 * @subpackage gvManageOnlineLog
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gvManageOnlineLogActions extends autoGvManageOnlineLogActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $online_logs = OnlineLogTable::getOnlineLog();
        $arr_log = array();
        foreach($online_logs as $i => $log){
            $arr_log[$log["insertedtime"]] = json_decode($log["peakdata"])->total;
        }
        $current_time_log = json_decode(end($online_logs)["peakdata"]);
        $list_game  = GameTable::getListGame();
        $arr_game = array();
        $arr_game["Tổng"] = $current_time_log->total;
        foreach($list_game as $i => $game){
            //$arr_game[$game["id"]] = $game["name"];
            $arr_game[$game["name"]] = isset($current_time_log->$game["gameid"])? $current_time_log->$game["gameid"]:0;
        }
        $this->arr_game=$arr_game;
        $this->arr_log = $arr_log;
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
        {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page'))
        {
            $this->setPage($request->getParameter('page'));
        }
        else
        {
            $this->setPage(1);
        }

        // max per page
        if ($request->getParameter('max_per_page'))
        {
            $this->setMaxPerPage($request->getParameter('max_per_page'));
        }

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();

        //Start - thongnq1 - 03/05/2013 - fix loi xoa du lieu tren trang danh sach
        if ($request->getParameter('current_page'))
        {
            $current_page = $request->getParameter('current_page');
            $this->setPage($current_page);
            $this->pager = $this->getPager();
        }
        //end thongnq1

        $this->sort = $this->getSort();
    }

    public function executeFilter(sfWebRequest $request)
    {
        $this->setPage(1);

        if ($request->hasParameter('_reset'))
        {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@online_log');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());
        //Chuyennv2 trim du lieu
        $filterValues = $request->getParameter($this->filters->getName());
        foreach ($filterValues as $key => $value)
        {
            if (isset($filterValues[$key]['text']))
            {
                $filterValues[$key]['text'] = trim($filterValues[$key]['text']);
            }
        }

        $this->filters->bind($filterValues);
        if ($this->filters->isValid())
        {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@online_log');
        }
        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }
}
