<?php
	// +----------------------------------------------------------------------
	// | ThinkPHP [ WE CAN DO IT JUST THINK ]
	// +----------------------------------------------------------------------
	// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
	// +----------------------------------------------------------------------
	// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
	// +----------------------------------------------------------------------
	// | Author: 流年 <liu21st@gmail.com>
	// +----------------------------------------------------------------------
	// 应用公共文件
	/**
	 * @param       $url
	 * @param int   $type 0 get 1 post
	 * @param array $data
	 * @return mixed
	 */
	function dourl($url, $type = 0, $data = []){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//成功至返回结果
		curl_setopt($ch, CURLOPT_HEADER, 0);
		if($type == 1){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	//日志呼出
	function write_log($msg){
		Think\Log::record($msg, \think\Log::INFO, true);
	}

	/**发送邮箱
	 * @param $msg
	 * @return \PHPMailer\PHPMailer\PHPMailer
	 */
	function sendMail($emailAddres, $name, $title, $msg){
		$mail = new PHPMailer\PHPMailer\PHPMailer();        //设置smtp参数
		$mail->SMTPDebug = 1;
		$mail->isSMTP();
		$mail->Host = config('email.host');
		$mail->Port = config('email.port');
		$mail->CharSet = 'UTF-8';
		//填写email帐号密码
		$mail->Username = config('email.username');
		$mail->Password = config('email.password');
		$mail->SMTPSecure = config('email.smtpsecure');
		$mail->SMTPAuth = true;
		$mail->SMTPKeepAlive = true;
		//设置发送方
		$mail->setFrom($emailAddres, $name);
		$mail->addAddress('15726517105@163.com');
		$mail->addReplyTo("15726817105@163.com");
		$mail->isHTML(true);
		$mail->Subject = $title;
		$mail->Body = $msg;
		$mail->AltBody = "this is a altBOdy";
		if( ! $mail->Send()){
			echo "Mailer Error: " . $mail->ErrorInfo; //调用错误提示.
		}
		else{
			echo "Message sent successfully！";//你不想在页面中出现这句吧.
		}

	}

