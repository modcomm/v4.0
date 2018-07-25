<?php
    ####################################################
    #### Name: GetTotalAnsweredCalls.php            ####
    #### Type: API for dashboard php encode         ####
    #### Version: 0.9                               ####
    #### Copyright: GOAutoDial Inc. (c) 2011-2016   ####
    #### Written by: Demian Lizandro Biscocho       ####
    #### License: AGPLv2                            ####
    ####################################################
    
    require_once('../goCRMAPISettings.php');
	require_once('../Session.php');
    /*
    * Displaying Total Answered Calls
    * [[API: Function]] - goGetTotalAnsweredCalls
    * This application is used to get total calls.
    */

    $url = gourl."/goDashboard/goAPI.php"; #URL to GoAutoDial API. (required)
    $postfields["goUser"] = goUser; #Username goes here. (required)
    $postfields["goPass"] = goPass;
    $postfields["goAction"] = "goGetTotalAnsweredCalls"; #action performed by the [[API:Functions]]
    $postfields["responsetype"] = responsetype;
    $postfields["session_user"] = $_SESSION['user']; #current user
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
        
    $output = json_decode($data);

    $total_answered_calls = $output->data->getTotalAnsweredCalls;

    if($total_answered_calls == NULL || $total_answered_calls == 0){
        $total_answered_calls = 0;
    }
        
    echo number_format($total_answered_calls); 
	//var_dump($output);
?>