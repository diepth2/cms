<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diepth2
 * Date: 7/17/14
 * Time: 2:25 PM
 * To change this template use File | Settings | File Templates.
 */


class ChangePortalFilter extends sfFilter
{
    public function execute($filterChain) {
        $sfContext = sfContext::getInstance();

        if($sfContext->getRequest()->hasParameter('portal')){
            $portal = $sfContext->getRequest()->getParameter('portal',0);
            $sfContext->getUser()->setAttribute('portal',$portal);
        }
        $filterChain->execute();
    }
}