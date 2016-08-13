<?php

/*
 * To change this templates, choose Tools | Templates
 * and open the templates in the editor.
 */

/**
 * Danh sách các mã lỗi và message tương ứng của Restfull
 * @author diepth2 <diepth2@viettel.com>
 * @created_at: 4/15/14 8:48 AM
 */
class PaymentErrorCode  extends  ErrorCodeUtil{
    //danh sách mã lỗi

    const SUCCESS = 0;
    const FAILURE = 1;
    const NULL_PARAM = 2;
    const CHARGE_BAN = 3;
    const SERVER_ERROR = 4;
    //danh sách message tương ứng
    public static $messages = array(
        0 => "Thành công",
        1 => "Thong tin ma the khong hop le",
        2 => "Vui long gui day du du lieu",
        3 => "Ban nap sai qua so lan quy dinh. vui long thu lai sau 30 phut nua",
        4 => "He thong nap the dang nang cap. Vui long thu lai sau"
    );
}
?>
