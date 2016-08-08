<?php

/**
 * Comment components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class vtAdvertiseWebComponents extends sfComponents
{ 
  /**
   * Xu ly lay ra danh sach quang cao theo vi tri
   * @author dongvt1
   * @created on 17/04/2013
   */
  public function executeListByLocation(sfWebrequest $request) 
  {
    $location = VtAdvertiseLocationTable::getInstance()->getLocationByName($this->locationName);
    $this->listAdvertise = null;
    
    if ($location)
    {
      $advIdArr = VtAdvertiseLocationItemTable::getInstance()->getAdvByLocationId($location->getId());
      if (!empty($advIdArr))
      {
           $this->listAdvertise = VtAdvertiseTable::getInstance()->getAdvertiseList($advIdArr);
      }
    }
  }
}
