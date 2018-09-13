<?php 
	
	if (isset($_POST['password'])) {
		$Data = $_POST;
		$user_json = json_decode(file_get_contents('users.json'), true);
		if (log_in($user_json,$Data) == false) {
			put_into_file($user_json,$Data);
		}
		echo "Success";
		die;
	}
	else if (isset($_POST['message'])) {
		$chat_json = json_decode(file_get_contents('chat.json', true)); 
		$data = $_POST + array('time'=>date("H:i:s"));
		array_push($chat_json, $data);
		file_put_contents('chat.json',json_encode($chat_json,JSON_PRETTY_PRINT));
	}
	else{
		$Data = file_get_contents('chat.json');
		json_encode($Data);
		echo $Data;
	}
		
	function log_in($user_json,$Data){
		for ($i=0; $i < count($user_json); $i++) { 
			if ($Data['username'] == $user_json[$i]['username']) {
				if ($Data['password'] == $user_json[$i]['password']){
					return true;
				} else {
					echo "WrongPassword";
					die;
				}	
			}

		}
		return false; 
	}
	function put_into_file($user_json,$Data){
		array_push($user_json,$Data);
		file_put_contents('users.json',json_encode($user_json,JSON_PRETTY_PRINT));
		
	}
	

 ?>