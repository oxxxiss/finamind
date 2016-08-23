<?php
/*
=====================================================
 Модуль парсер Finam для DLE 
-----------------------------------------------------
 http://lis-er.ru/
=====================================================
 ВКонтакте: osimitj
=====================================================
 Файл: finam.php
-----------------------------------------------------
 Назначение: Обработка информации
=====================================================
*/
if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}
		/*===================================================
							Конфиги
		===================================================*/
		require_once (ENGINE_DIR . '/data/finam.php');
		$index = "http://www.finam.ru/";		
		$index = file_get_contents($index);
		/*===================================================
							D&J-ind
		===================================================*/
		if ( $finam_cfg[dj] == 1 ){	
			preg_match_all( '#D&amp;J-Ind(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $dj_pos );
			if($dj_pos[4][0][0] == "-"){$dj_color = "red";$dj_str="down";}else{$dj_color = "green";$dj_str="up";}
			$dj = "<b>D&J-ind - </b> ".$dj_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$dj_str.".gif\"><b style=\"color:".$dj_color.";\">  ".$dj_pos[4][0]."</b> ".$dj_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}		
		/*===================================================
							Futsee-100
		===================================================*/
		if ( $finam_cfg[futsee] == 1 ){	
			preg_match_all( '#Futsee-100(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $futsee_pos );
			if($futsee_pos[4][0][0] == "-"){$futsee_color = "red";$futsee_str="down";}else{$futsee_color = "green";$futsee_str="up";}
			$futsee = "<b>Futsee-100 - </b> ".$futsee_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$futsee_str.".gif\"><b style=\"color:".$futsee_color.";\">  ".$futsee_pos[4][0]."</b> ".$futsee_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							NASDAQ**
		===================================================*/
		if ( $finam_cfg[nasdaq] == 1 ){
			preg_match_all( '#NASDAQ(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $nasdaq_pos );
			if($nasdaq_pos[4][0][0] == "-"){$nasdaq_color = "red";$nasdaq_str="down";}else{$nasdaq_color = "green";$nasdaq_str="up";}
			$nasdaq = "<b>NASDAQ** - </b> ".$nasdaq_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$nasdaq_str.".gif\"><b style=\"color:".$nasdaq_color.";\">  ".$nasdaq_pos[4][0]."</b> ".$nasdaq_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							N225Jap
		===================================================*/
		if ( $finam_cfg[n225jap] == 1 ){
			preg_match_all( '#n225jap(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $n225jap_pos );
			if($n225jap_pos[4][0][0] == "-"){$n225jap_color = "red";$n225jap_str="down";}else{$n225jap_color = "green";$n225jap_str="up";}
			$n225jap = "<b>N225Jap - </b> ".$n225jap_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$n225jap_str.".gif\"><b style=\"color:".$n225jap_color.";\">  ".$n225jap_pos[4][0]."</b> ".$n225jap_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							РТС
		===================================================*/
		if ( $finam_cfg[rts] == 1 ){
			preg_match_all( '#>RTSI</a>(.+?)<td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $rts_pos );
			if($rts_pos[4][0][0] == "-"){$rts_color = "red";$rts_str="down";}else{$rts_color = "green";$rts_str="up";}
			$rts = "<b>РТС - </b> ".$rts_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$rts_str.".gif\"><b style=\"color:".$rts_color.";\">  ".$rts_pos[4][0]."</b> ".$rts_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							ММВБ10
		===================================================*/	
		if ( $finam_cfg[micex10] == 1 ){
			preg_match_all( '#micex10(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $micex10_pos );
			if($micex10_pos[4][0][0] == "-"){$micex10_color = "red";$micex10_str="down";}else{$micex10_color = "green";$micex10_str="up";}
			$micex10 = "<b>ММВБ10 - </b> ".$micex10_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$micex10_str.".gif\"><b style=\"color:".$micex10_color.";\">  ".$micex10_pos[4][0]."</b> ".$micex10_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		
		}
		/*===================================================
						      ММВБ
		===================================================*/
		if ( $finam_cfg[micex] == 1 ){
			preg_match_all( '#micex</a>(.+?)<td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $micex_pos );
			if($micex_pos[4][0][0] == "-"){$micex_color = "red";$micex_str="down";}else{$micex_color = "green";$micex_str="up";}
			$micex = "<b>ММВБ - </b> ".$micex_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$micex_str.".gif\"><b style=\"color:".$micex_color.";\">  ".$micex_pos[4][0]."</b> ".$micex_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							Ta_25 Index
		===================================================*/
		if ( $finam_cfg[ta_25] == 1 ){
			preg_match_all( '#ta-25&nbsp;Index(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $ta_25_pos );
			if($ta_25_pos[4][0][0] == "-"){$ta_25_color = "red";$ta_25_str="down";}else{$ta_25_color = "green";$ta_25_str="up";}
			$ta_25 = "<b>Ta_25 Index - </b> ".$ta_25_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$ta_25_str.".gif\"><b style=\"color:".$ta_25_color.";\">  ".$ta_25_pos[4][0]."</b> ".$ta_25_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							SandP-Fut*
		===================================================*/
		if ( $finam_cfg[sandp] == 1 ){
			preg_match_all( '#SandP-Fut(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $sandp_pos );
			if($sandp_pos[4][0][0] == "-"){$sandp_color = "red";$sandp_str="down";}else{$sandp_color = "green";$sandp_str="up";}
			$sandp = "<b>SandP-Fut - </b> ".$sandp_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$sandp_str.".gif\"><b style=\"color:".$sandp_color.";\">  ".$sandp_pos[4][0]."</b> ".$sandp_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							SandP-500*
		===================================================*/
		if ( $finam_cfg[sandp500] == 1 ){
			preg_match_all( '#sandp-500(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $sandp500_pos );
			if($sandp500_pos[4][0][0] == "-"){$sandp500_color = "red";$sandp500_str="down";}else{$sandp500_color = "green";$sandp500_str="up";}
			$sandp500 = "<b>SandP-500 - </b> ".$sandp500_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$sandp500_str.".gif\"><b style=\"color:".$sandp500_color.";\">  ".$sandp500_pos[4][0]."</b> ".$sandp500_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}
		/*===================================================
							CSI300 (Китай)
		===================================================*/
		if ( $finam_cfg[CSI] == 1 ){
			preg_match_all( '#CSI300&nbsp;(.+?)</a></div></td><td align="right" class="usd"><span class="usd sm pl05">(.+?)</span>(.+?)<nobr>(.+?)</nobr></span></td><td align="right"><span class="sm light pl05">(.+?)</span>#is', $index, $CSI_pos );
			if($CSI_pos[4][0][0] == "-"){$CSI_color = "red";$CSI_str="down";}else{$CSI_color = "green";$CSI_str="up";}
			$CSI = "<b>CSI300 (Китай) - </b> ".$CSI_pos[2][0]."<img width=\"9\" height=\"9\" border=\"0\" src=\"http://www.finam.ru/i/N/".$CSI_str.".gif\"><b style=\"color:".$CSI_color.";\">  ".$CSI_pos[4][0]."</b> ".$CSI_pos[5][0]."&nbsp;&nbsp;<div class=\"polosindex\"></div>&nbsp;&nbsp;";
		}		
		/*===================================================
					     Теги для шаблона 
		===================================================*/	
	  /*$tpl->set( '{d&j}', $dj ); // Индекс D&J-ind
		$tpl->set( '{futsee-100}', $futsee ); // Индекс Futsee-100
		$tpl->set( '{nasdaq}', $nasdaq ); // Индекс NASDAQ**
		$tpl->set( '{n225jap}', $n225jap ); // Индекс N225Jap
		$tpl->set( '{rts}', $rts ); // Индекс РТС
		$tpl->set( '{micex10}', $micex10 ); // Индекс ММВБ10
		$tpl->set( '{micex}', $micex ); // Индекс ММВБ
		$tpl->set( '{ta_25}', $ta_25 ); // Индекс ta_25 Index
		$tpl->set( '{sandp}', $sandp ); // Индекс SandP-Fut*
		$tpl->set( '{sandp500}', $sandp500 ); // Индекс SandP-500*
		$tpl->set( '{csi300}', $csi ); // Индекс CSI300 (Китай)	*/		
		/*===================================================
					    Вывод информации
		===================================================*/
		$value = array($dj, $futsee, $nasdaq, $n225jap, $rts, $micex10,  $micex, $ta_25, $sandp, $sandp500, $CSI );
		$value = implode("",$value);
		echo $value;

?>