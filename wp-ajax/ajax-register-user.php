<?php

require('../functions.php');
$user_data = $_POST;
global $user_class;

if ( isset( $_POST['game_name_ver'] )
    && wp_verify_nonce( $_POST['game_name_ver'], 'game_submit' )
    && isset($user_data['sPhone'])
    && isset($user_data['s21ccn'])
    && isset($user_data['sQingnian'])
    ) {
    //prepare data for process
    $phone  = esc_attr($_POST['sPhone']);
    $name  = esc_attr($_POST['sName']);
    $email = esc_attr(strtolower($_POST['sEmail']));

    $user_phone_check = $user_class->get_user_id_by_phone($phone);
    if( $user_phone_check == null){
        //conditon for number not existed
        $result = $wpdb->insert(
            $table_21ccn_users,
            array(
                'sName'         => $name,
                'sPhone'        => $phone,
                'sEmail'        => $email

            ),
            array(
                '%s',
                '%s',
                '%s'

            )
        );
        if ($result === false || $result == 0){
            $callback   = "fail";
            $answer     = array( "status" => $callback, "vt"=> "writenin2 fail");
            echo json_encode($answer);
        } else {
            ob_end_flush();
            $answer     = array( "status" => "ok", "phone"=>$phone);
            echo json_encode($answer);
            ob_start();
            try{
                $email_send = $user_class->send_welcome_email($name,$email);
            } catch (SomeException $e)
            {
                // do nothing... php will ignore and continue
            }
        }
        
        //end of else
    }else{
        // if the number existed before, then get the data back from server
        $user_info = $user_class->get_user_info_by_id($user_phone_check);
        $answer = array("status"=>"fail","phone"=>$phone);
        echo json_encode($answer);
    }

} else {
    echo json_encode(array("status"=>"fail", "vt"=>"hack"));
}

