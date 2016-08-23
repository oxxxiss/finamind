<?PHP
/*
=====================================================
 Модуль FinamIND by LisER
-----------------------------------------------------
 http://lis-er.ru/
-----------------------------------------------------
 ICQ: 654-988-423
=====================================================
 Файл: finam.php
=====================================================
*/
if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
	die( "Hacking attempt!" );
}

if( $member_id['user_group'] != 1 ) {
	msg( "error", $lang['index_denied'], $lang['index_denied'] );
}

		?>
		<link href="/engine/classes/js/finam/finam.css" media="screen" rel="stylesheet" type="text/css">
		<title>Finam</title>
		<?php
require_once (ENGINE_DIR . '/data/finam.php');
if( $action == "save" ) {
	$db->query( "INSERT INTO " . USERPREFIX . "_admin_logs (name, date, ip, action, extras) values ('".$db->safesql($member_id['name'])."', '{$_TIME}', '{$_IP}', '78', '')" );
	
	$finam_save = $_POST['finam_save'];
	$finam_save['dj'] = intval($finam_save['dj']);
	$finam_save['futsee'] = intval($finam_save['futsee']);
	$finam_save['nasdaq'] = intval($finam_save['nasdaq']);
	$finam_save['n225jap'] = intval($finam_save['n225jap']);
	$finam_save['rts'] = intval($finam_save['rts']);
	$finam_save['micex10'] = intval($finam_save['micex10']);
	$finam_save['micex'] = intval($finam_save['micex']);
	$finam_save['ta_25'] = intval($finam_save['ta_25']);
	$finam_save['sandp'] = intval($finam_save['sandp']);
	$finam_save['sandp500'] = intval($finam_save['sandp500']);
	$finam_save['CSI'] = intval($finam_save['CSI']);
	
	
	$find = array();
	$replace = array();
	
	$find[] = "'\r'";
	$replace[] = "";
	$find[] = "'\n'";
	$replace[] = "";
	
	$finam_save = $finam_save + $finam_cfg;	
	$handler = fopen( ENGINE_DIR . '/data/finam.php', "w" );	
	fwrite( $handler, "<?PHP \n\n//Конфигурации модуля \"Мировые индексы\"\n\n\$finam_cfg = array (\n" );
	foreach ( $finam_save as $name => $value ) {
		fwrite( $handler, "'{$name}' => '{$value}',\n" );
	}
	fwrite( $handler, ");\n?>" );
	fclose( $handler );	
	clear_cache();
	msg( "info", $lang['opt_sysok'], $lang['opt_sysok_1'], "?mod=finam" );
}
	
function showRow($title = "", $description = "", $field = "", $class = "") {
	echo "<tr>
       <td class=\"col-xs-10 col-sm-6 col-md-7 {$class}\"><h6>{$title}</h6><span class=\"note large\">{$description}</span></td>
       <td class=\"col-xs-2 col-md-5 settingstd {$class}\">{$field}</td>
       </tr>";
}
	
function makeDropDown($options, $name, $selected) {
	$output = "<select class=\"uniform\" style=\"min-width:100px;\" name=\"$name\">\r\n";
	foreach ( $options as $value => $description ) {
		$output .= "<option value=\"$value\"";
		if( $selected == $value ) {
			$output .= " selected ";
		}
		$output .= ">$description</option>\n";
	}
	$output .= "</select>";
	return $output;
}

function makeCheckBox($name, $selected) {
	$selected = $selected ? "checked" : "";
	
	return "<input class=\"checkbox\" type=\"checkbox\" name=\"$name\" value=\"1\" {$selected}>";
}


echo <<<HTML
<div class="polos"></div>
<div class="img"><button onclick="location.href = '?';">Админпанель сайта</button><img src="/engine/classes/js/finam/bg1.png" style=" width: 550px;position: relative;"><img src="/engine/classes/js/finam/bg2.png" style=" width: 250px; position: absolute;"></div>
<script type="text/javascript">
<!--
        function ChangeOption(selectedOption) {
                document.getElementById('general').style.display = "none";
                document.getElementById('info').style.display = "none";
				document.getElementById(selectedOption).style.display = "";
       }
//-->
</script>
<div class="fin-box">
  <div class="fin-box-content">	
		<ul class="settingsb">
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('general');" class="tip" title="Общие настройки"><span>Общие настройки</span></a></li>
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('info');" class="tip" title="О модуле"></i><span>О модуле</span></a></li>
	</ul>
     </div>
</div>
<form action="?mod=finam&action=save" name="conf" id="conf" method="post">
<div id="general" class="fin-box">
  <div class="fin-box-header">
    <div class="fin-title">{$lang['vconf_title']}</div>
  </div>
  <div class="fin-box-content">
  <table class="table fin-table-normal">
HTML;
	showRow( "Включить D&J-ind", "",  makeCheckBox( "finam_save[dj]", "{$finam_cfg['dj']}" ) );
	showRow( "Включить Futsee-100", "",  makeCheckBox( "finam_save[futsee]", "{$finam_cfg['futsee']}" ) );
	showRow( "Включить NASDAQ**", "",  makeCheckBox( "finam_save[nasdaq]", "{$finam_cfg['nasdaq']}" ) );
	showRow( "Включить N225Jap", "",  makeCheckBox( "finam_save[n225jap]", "{$finam_cfg['n225jap']}" ) );
	showRow( "Включить РТС", "",  makeCheckBox( "finam_save[rts]", "{$finam_cfg['rts']}" ) );
	showRow( "Включить ММВБ10", "",  makeCheckBox( "finam_save[micex10]", "{$finam_cfg['micex10']}" ) );
	showRow( "Включить ММВБ", "",  makeCheckBox( "finam_save[micex]", "{$finam_cfg['micex']}" ) );
	showRow( "Включить TA-25 Index", "",  makeCheckBox( "finam_save[ta_25]", "{$finam_cfg['ta_25']}" ) );
	showRow( "Включить SandP-Fut*", "",  makeCheckBox( "finam_save[sandp]", "{$finam_cfg['sandp']}" ) );
	showRow( "Включить SandP-500", "",  makeCheckBox( "finam_save[sandp500]", "{$finam_cfg['sandp500']}" ) );
	showRow( "Включить CSI300 (Китай)", "",  makeCheckBox( "finam_save[CSI]", "{$finam_cfg['CSI']}" ) );
	
echo <<<HTML
</table></div>
<div class="butblock">
<input type="hidden" name="user_hash" value="{$dle_login_hash}" />
<input id="sub" type="submit" class="butsubmit" value="Сохранить">
</div></div>
</form>
<div id="info" class="fin-box" style="display:none">
  <div class="fin-box-header">
    <div class="fin-title">Информация о авторе</div>
  </div>
  	 <div class="fin-box-content">
  <table class="table fin-table-normal">
  <tbody>
  <tr><td class="col-xs-10 col-sm-6 col-md-7 "><h6>Автор </h6><span class="note large"></span></td><td class="col-xs-2 col-md-5 settingstd"> LisER</td></tr>
  <tr><td class="col-xs-10 col-sm-6 col-md-7 "><h6>Сайты автора </h6><span class="note large"></span></td><td class="col-xs-2 col-md-5 settingstd"><a href="http://lis-er.ru">Lis-ER.ru</a>&nbsp;&nbsp;и&nbsp;&nbsp;<a href="http://q-film.ru">Q-film.ru</a></td></tr>
  <tr><td class="col-xs-10 col-sm-6 col-md-7 "><h6>E-mail </h6><span class="note large"></span></td><td class="col-xs-2 col-md-5 settingstd"><a href="maiito:osimi98@yandex.ru">osimi98@yandex.ru</a>&nbsp;&nbsp;и&nbsp;&nbsp;<a href="maiito:osimi_98@mail.ru">osimi_98@mail.ru</a></td></tr>
  <tr><td class="col-xs-10 col-sm-6 col-md-7 "><h6>ICQ </h6><span class="note large"></span></td><td class="col-xs-2 col-md-5 settingstd">654-988-423</td></tr>
      </tbody>
  </table>
  </div>
  </div>
HTML;
	if(!is_writable(ENGINE_DIR . '/data/finam.php')) {
		$lang['stat_system'] = str_replace ("{file}", "engine/data/finam.php", $lang['stat_system']);
		echo "<div class=\"alert alert-error\">{$lang['stat_system']}</div>";
	}

echofooter();
?>