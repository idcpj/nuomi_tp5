<?php
	function show($status=1,$message,$data=[]){
		return [
			'status'=>$status,
			'message'=>$message,
			'data'=>$data,
		];
	}
