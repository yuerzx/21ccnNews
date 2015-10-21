<?php
require("functions.php");
global $wpdb;
global $table_school;
get_header("referral");
?>
<div class="row">
    <div class="col-lg-12">

        <div id="content-full">
            <?php if (bi_get_data('enable_disable_breadcrumbs', '1') == '1') { ?>
                <?php echo responsive_breadcrumb_lists(); ?>
            <?php } ?>

            <article>
                <header class="page-header text-center" style="margin-top: 20px;">
                    <img src="img/system/header.png">
                </header>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>欢迎参与由澳洲侨报主办，多家媒体参与的分享拿大奖活动~</p>
                    </div>
                </div>

                <section class="post-entry">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="join.php" id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                注册参与
                            </a>
                        </div>
                        <div class="col-md-12" style="padding-top: 20px;">
                            <a href="duanzishou.php" id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                段子大赛
                            </a>
                        </div>
                        <div class="col-md-12" style="padding-top: 20px; ">
                            <a href="join.php" id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-diamond"></i> 积分抽奖
                            </a>
                        </div>
                        <div class="col-md-12" style="padding-top: 20px;padding-bottom: 20px;">
                            <a href="join.php" id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                排行榜
                            </a>
                        </div>
                    </div>
                    <?php include('footer-logo.php');?>
                </section>
                <!-- end of .post-entry -->
            </article>
            <!-- end of #post-<?php the_ID(); ?> -->
        </div>
        <!-- end of #content-full -->
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        console.log("*****WANT TO FIND OUT HOW TO DO IT? EMAIL: HANSUN@1230.ME *****");
        console.log("*****技术支持，万友澳洲，联系：HANSUN@1230.me             *****");
    });

    var warning1 = '<div class="alert alert-warning alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    var warning2 = '</div>';
    function returnForm() {
        jQuery('#success').hide();
        jQuery('#user-form').show(1000);
        jQuery('#user-form')[0].reset();
        jQuery('#submit').prop('disabled', false).text("点击生成");
    }
    ;
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
    ;
    jQuery(document).ready(function ($) {
            $("#user-form").submit(function (event) {
                    event.preventDefault();
                    var phone = $('#sPhone').val();
                    var result = $('#result');
                    var name = $('#sName').val();
                    var email = $('#sEmail').val();
                    if (phone && phone.length == 10 && isValidEmailAddress(email)) {
                        $('#submit').prop('disabled', true).text("载入中.....请稍等");
                        $.ajax({
                            type: "POST",
                            url: "wp-ajax/ajax-register-user.php",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                                if (data['status'] == 'ok') {
                                    $('#user-form').hide(1000);
                                    result.hide();
                                    var s_title = "恭喜<b>" + name + "</b>登记成功";
                                    var s_pass = "您的用户名是：" + "</b><br> 视频地址是: <a href='http://www.oneuni.com.au/wenbo-ielts-speaking-video/'>http://www.oneuni.com.au/wenbo-ielts-speaking-video/</a>" + "<br>您可以直接用您的邮箱登陆视频页面了！ 如果没收到邮件，请直接尝试登陆页面，谢谢。 在60秒后页面自动返回";
                                    $('#Call-Back-Title').html(s_title);
                                    $('#Call-Back-Contain').html(s_pass);
                                    $('#success').show(700);

                                    setTimeout(returnForm, 60000);
                                } else if (data['status'] == 'fail') {
                                    $(warning1 + '手机号已经存在，请更改后注册' + warning2).hide().prependTo(result).show("slow");
                                    $('#submit').prop('disabled', false).text("点击生成");
                                }
                            },
                            error: function (xhr, status, error) {
                                $('#result').html("系统连接错误，请刷新后重试");
                                console.log(error);
                                console.log(status);
                                console.log(xhr);
                                $('#submit').prop('disabled', false).text("点击生成");
                            }
                        });
                    } else {
                        $(warning1 + '<b>手机</b>或者<b>邮箱</b>为空或格式不对，请更改后重试' + warning2).hide().prependTo(result).show("slow");
                    }
                }
            );
        }
    );


</script>
<?php get_footer(); ?>
