test
<?php
                        $url = 'https://www.app.edu.gov.on.ca/eng/sift/searchElementaryXLS.asp';
                        // header
                        $userAgent = array(
                                        'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', // FF 22
                                        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', // Chrome 27
                                        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)', // IE 9
                                        'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E)', // IE 8
                                        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E)', // IE 7
                                        'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.1 (KHTML, like Gecko) Maxthon/4.1.0.4000 Chrome/26.0.1410.43 Safari/537.1', // Maxthon 4
                                        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E)', // 2345 2
                                        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; QQBrowser/7.3.11251.400)', // QQ 7
                                        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E; SE 2.X MetaSr 1.0)', // Sougo 4
                                        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0) LBBROWSER', //  liebao 4
                        );

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
                        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0");
                        curl_setopt($ch, CURLOPT_REFERER, "https://www.app.edu.gov.on.ca/eng/sift/PCsearchSec.asp");
                        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent[rand(0, count($userAgent) - 1)]);
                        $headerOrigin = array("Host:www.app.edu.gov.on.ca");
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerOrigin);
			$fields = array(
				'chosenLevel' => urlencode("Secondary"),
				'compareLat' => urlencode("43.5596118"),
				'compareLong' => urlencode("-79.72719280000001"),
				'refineDistance' => urlencode("NN"),
			);
			$fields_string='';
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                        // 读取数据
                        $res = @curl_exec($ch);
                        curl_close($ch);
                       	print_r($res) ;


?>
