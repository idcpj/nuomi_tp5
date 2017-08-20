<?php
	class Map{

		/**根据地址调用经纬度
		 * @param $address
		 * @return array
		 */
		public static function getLngLat($address){
			if(empty($address)){
				return '';
			}
			$data = [
				'address'=>$address,
				'ak'=>config('map.ak'),
				'output'=>'json',
			];
			$url = config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);
			$result = dourl($url);
			if($result){
				return json_decode($result,true);
			}else{
				return '';
			}
		}

		/**
		 * 查找地址
		 * @param $center
		 * @return string
		 */
		public static function staticimage($center){
			if(empty($center)){
				return '';
			}
			$data = [
				'center'=>$center,
				'ak'=>config('map.ak'),
				'width'=>config('map.width'),
				'height'=>config('map.height'),
				'markers'=>$center,
			];
			$url = config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);
			return $url;
		}
	}

