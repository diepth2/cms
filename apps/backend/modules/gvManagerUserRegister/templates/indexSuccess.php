<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gvManagerUserRegister/assets') ?>
<?php include_partial('gvManagerUserRegister/header') ?>



<div class="container-fluid">
    <div class="span6">
        <!-- ID Vẽ biểu đồ loại hệ điều hành -->
        <div id="piechart_pub_type" style="width: 600px; height: 280px; top: -240px;"></div>
    </div>
<!--    <div class="span6">-->
<!--        <!-- ID Vẽ biểu đồ trạng thái thông tin về developer -->-->
<!--        <div id="piechart_pub_status" style="width: 600px; height: 280px; top: -240px;"></div>-->
<!--    </div>-->
    <div class="span12">
        <!-- ID Vẽ biểu đồ đăng ký tài khoản -->
        <div id="piechart_pub_register" style="width: 100%; height: 500px"></div>
    </div>

    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('gvManagerUserRegister/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('Thống kê user đăng ký', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
                <div class="span9">
                                  <?php include_partial('gvManagerUserRegister/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
                                </div>
                <div class="span3">
                    <div class="pull-right"><?php include_partial('gvManagerUserRegister/list_actions', array('helper' => $helper)) ?></div>
                </div>
            </div>

            <table style="width:100%">
                <tr>
                    <th><?php echo __("Tổng số")?></th>
                    <?php foreach ($total_by_os as $total){
                            echo "<th class='sf_admin_text'>" . $total['os_name'] . "<th>";
                    }  ?>
                </tr>
                <tr>
                    <?php foreach ($total_by_os as $total){
                        echo "<td>" . $total['sum_os'] . "<td>";
                    }  ?>
                </tr>
            </table>
            <?php include_partial('gvManagerUserRegister/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('gvManagerUserRegister/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                                    <form class="form-inline" id="list-form" action="<?php echo url_for('user_register_collection', array('action' => 'batch')) ?>" method="post">
                
                <?php include_partial('gvManagerUserRegister/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

                <div>
                    <?php include_partial('gvManagerUserRegister/list_batch_actions', array('helper' => $helper)) ?>
                </div>
                                    </form>
                
                <form class="form-inline" method="get" action="<?php echo url_for('user_register') ?>">
                    <div class="well pull-right">
                      <?php echo __('Số bản ghi/trang: ')?>
                        <?php $select = new sfWidgetFormChoice(array(
                                        'multiple' => false,
                                        'expanded' => false,
                                        'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
                                    ),
                                    array('class' => 'input-medium')); echo $select->render('max_per_page', $sf_user->getAttribute('gvManagerUserRegister.max_per_page', null, 'admin_module')) ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

            <?php include_partial('gvManagerUserRegister/list_footer', array('pager' => $pager)) ?>
        </div>
    </div>
</div>

<?php include_partial('gvManagerUserRegister/footer') ?>
<script type="text/javascript" src="/css/jsapi.css"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var formatter = new google.visualization.NumberFormat({
            pattern: '###,###'
        });

        //Hình 1: Loại nhà phát triển
        var array_type = new Array(['Task', '<?php echo __('Loại hệ điều hành')?>']);
        <?php foreach ($total_by_os as $value) {?>
        array_type.push(['<?php echo $value['os_name']?>', <?php echo $value['sum_os']; ?>]);
        <?php } ?>
        var data_api = google.visualization.arrayToDataTable(array_type);
        formatter.format(data_api, 1);
        var options_api = {
            title: '<?php echo __('Loại hệ điều hành')?>',
            is3D: true
        };
        var chart_api = new google.visualization.PieChart(document.getElementById('piechart_pub_type'));
        chart_api.draw(data_api, options_api);

        //Hình 2: trạng thái thông tin về developer
//        var array_developer = new Array(['Task', '<?php //echo __('Tình trạng developer')?>//']);
//        <?php //if($count_actived_developer) {?>
//        array_developer.push(['<?php //echo __('Còn hoạt động')?>//', <?php //echo $count_actived_developer;?>//]);
//        <?php //}?>
<!--        --><?php //if($count_deactived_developer) {?>
//        array_developer.push(['<?php //echo __('Chưa kích hoạt')?>//', <?php //echo $count_deactived_developer;?>//]);
//        <?php //}?>
<!--        --><?php //if($count_banned_developer) {?>
//        array_developer.push(['<?php //echo __('Bị Đình chỉ')?>//', <?php //echo $count_banned_developer;?>//]);
//        <?php //}?>
//        var data_developer = google.visualization.arrayToDataTable(array_developer);
//        formatter.format(data_developer, 1);
//        var options_developer = {
//            title: '<?php //echo __('Thông tin về developer')?>//',
//            is3D: true
//        };
//        var chart_developer = new google.visualization.PieChart(document.getElementById('piechart_pub_status'));
//        chart_developer.draw(data_developer, options_developer);

        //Hình 3: Thông tin nhà phát triển đăng ký tài khoản
        var array_develop_info = new Array(["<?php echo __('Ngày') ?>", "<?php echo __('Đăng ký mới') ?>"]);
        <?php foreach($sevent_day as $day => $value):?>
        array_develop_info.push(['<?php echo $day;  ?>', Number('<?php echo $value[0]?>')]);
        <?php endforeach ?>
        var data_develop_info = google.visualization.arrayToDataTable(array_develop_info);
        formatter.format(data_develop_info, 1);
        var options_develop_info = {
            title: '<?php echo __('Thông tin người chơi đăng ký') ?>',
            is3D: true,
            hAxis: {title: 'Gamevina',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };
        var chart_develop_info = new google.visualization.ColumnChart(document.getElementById('piechart_pub_register'));
        chart_develop_info.draw(data_develop_info, options_develop_info);
    }
</script>
