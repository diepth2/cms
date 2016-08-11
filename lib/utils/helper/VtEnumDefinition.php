<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class VtCommonEnum {

     //end define value of Module
    
    const NUMBER_ONE=1;
    const NUMBER_ZERO=0;
    const NUMBER_MINUS_ONE=-1;
    const NUMBER_TWO=2;
    const NUMBER_THREE=3;
    const NUMBER_FOUR=4;
    const NUMBER_FIVE=5;
    const NUMBER_SIX=6;
    const NUMBER_EIGHT=8;
    const NUMBER_SIXTEEN=16;

}
final class VtUserStatus {
    /* Trạng thái của Dev */
    const NOT_ACTIVE = 0;       //0: Chưa kích hoạt,
    const DEV_ACTIVE = 1;           //1: hoạt động,
    const USER_DEV_WARNING = 2;          //2: Bị cảnh cáo,
    const USER_DEACTIVE = 3;         //3: Bị đình chỉ
}
final class TypeGame {
    /* Trạng thái của Dev */
    const GOLD_MODE = 0;       //0: free
    const CASH_MODE = 1;           //1: tiền thật
}


