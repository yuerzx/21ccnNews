<?php
require("functions.php");
global $wpdb;
global $table_school;
get_header("referral");
?>
<div class="row">
    <div class="col-lg-12">

        <div id="content-full">

            <article>
                <header class="page-header text-center" style="margin-top: 20px;">
                    <img src="img/system/register-header.gif">
                </header>

                <section class="post-entry">
                    <div class="row">
                        <form class="form-horizontal" id="user-form" method="post" novalidate name="regsiter">
                            <fieldset>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="s21ccn">澳洲侨报关注码</label>

                                    <div class="col-md-4">
                                        <input id="s21ccn" name="s21ccn" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sQingnian">澳洲梦青年俱乐部关注码</label>

                                    <div class="col-md-4">
                                        <input id="sQingnian" name="sQingnian" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sName">姓名</label>

                                    <div class="col-md-4">
                                        <input id="sName" name="sName" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sPhone">手机</label>

                                    <div class="col-md-4">
                                        <input id="sPhone" name="sPhone" type="text" placeholder=""
                                               class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sEmail">邮箱</label>

                                    <div class="col-md-4">
                                        <input id="sEmail" name="sEmail" type="text" placeholder="请正确填写，获奖信息会发送到邮箱中"
                                               class="form-control input-md" required="">
                                    </div>
                                </div>

                                <?php wp_nonce_field('game_submit', 'game_name_ver'); ?>
                                <div class="form-group">
                                    <div class="col-md-12" style="padding-bottom: 20px;">
                                        <button id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                            点击参与
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="index.php" id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                                            返回首页
                                        </a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="row" id="Call-Back-Frame">
                            <div class="col-md-12" id="result">
                            </div>
                            <div class="col-md-12 text-center" id="success" style="display: none">
                                <h2 id="Call-Back-Title"></h2>

                                <p id="Call-Back-Contain"></p>

                                <div class="col-md-12">
                                    <button id="new-entry" name="submit" class="btn btn-primary btn-lg btn-block"
                                            onclick="returnForm()">录入新的
                                    </button>
                                </div>
                            </div>
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
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
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
                    var ccncode = $('#s21ccn').val();
                    var qiannian = $('#sQingnian').val();
                    var ccnhash = CryptoJS.MD5(ccncode);
                    var qingnianhash = CryptoJS.MD5(qiannian);
                    if( ccnhash != "151dbc3973c16125d26e2ac41b67a4a9" || qingnianhash != "9912a6370a4b5fca0edb675b579d31c7"){
                        $(warning1 + '邀请码不正确，请查看后重试，全部字母为小写' + warning2).hide().prependTo(result).show("slow");
                    }else if (phone && phone.length == 10 && isValidEmailAddress(email)) {
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
                                    var s_pass = "稍后将会跳转到分享页面，您已经成功获得20点积分";
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
