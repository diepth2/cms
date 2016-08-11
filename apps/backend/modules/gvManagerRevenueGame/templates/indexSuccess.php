<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gvManagerRevenueGame/assets') ?>
<?php include_partial('gvManagerRevenueGame/header') ?>

<?php include_component(
    'gvManagerRevenueGame',
    'moneyLogAll',
    array(
        'revenuGoldToday' => $revenuGoldToday,
        'revenuCashToday' => $revenuCashToday,
        'revenuGoldYesterday' => $revenuGoldYesterday,
        'revenuCashYesterday' => $revenuCashYesterday,
        'revenuGoldThisMonth' => $revenuGoldThisMonth,
        'revenuCashThisMonth' => $revenuCashThisMonth,
        'list_games' => $list_games,
        'list_os' => $list_os,
        'listRevenueGroupByDateFromTo' => $listRevenueGroupByDateFromTo,
        'listRevenueGoldGroupByDateFromTo' => $listRevenueGoldGroupByDateFromTo
    ))
?>
<?php include_partial('gvManagerRevenueGame/footer') ?>