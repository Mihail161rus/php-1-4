<?php
$jsonArray = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Rostov-on-Don&appid=e117e6ab126792a3b7f473e009ed4984');
$weatherArray = json_decode($jsonArray, true);

$cityName = $weatherArray['name'];
$tempFar = $weatherArray['main']['temp'];
$atmoPressurePa = $weatherArray['main']['pressure'];
$humidity = $weatherArray['main']['humidity'];
$windSpeed = $weatherArray['wind']['speed'];
$sunrise = $weatherArray['sys']['sunrise'];
$sunset = $weatherArray['sys']['sunset'];
$iconWeather = $weatherArray['weather'][0]['icon'];
$weatherDesc = $weatherArray['weather'][0]['description'];

$temperature = round(((($tempFar) / 10) - 32) / 1.8);
$atmoPressure = round($atmoPressurePa * 0.750064);
$windSpeedView = round($windSpeed, 1);
$sunriseTime = date_sunrise($sunrise);
$sunsetTime = date_sunset($sunset);
$dateNow = date('d M Y - G:i');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Текущая погода в <?=$cityName?></title>
    <style>
        table {
            border: 1px solid #eeeeee;
        }

        td {
            padding: 5px 15px;
            border: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
	<h1>Погода в <?=$cityName?></h1>

    <h3>Текущая дата: <?=$dateNow?></h3>

	<table>
        <tr>
            <td rowspan="2">Погодные условия</td>
            <td style="text-align: center;"><img src="http://openweathermap.org/img/w/<?=$iconWeather?>.png" alt="<?=$weatherDesc?>"></td>
        </tr>
        <tr>
            <td><?=$weatherDesc?></td>
        </tr>
		<tr>
			<td>Температура воздуха</td>
			<td><?=$temperature?> °C</td>
		</tr>
		<tr>
			<td>Атмосферное давление</td>
			<td><?=$atmoPressure?> мм. рт. ст.</td>
		</tr>
		<tr>
			<td>Влажность воздуха</td>
			<td><?=$humidity?> %</td>
		</tr>
		<tr>
			<td>Скорость ветра</td>
			<td><?=$windSpeedView?> м/с</td>
		</tr>
		<tr>
			<td>Время восхода солнца</td>
			<td><?=$sunriseTime?></td>
		</tr>
		<tr>
			<td>Время захода солнца</td>
			<td><?=$sunsetTime?></td>
		</tr>
	</table>
</body>
</html>