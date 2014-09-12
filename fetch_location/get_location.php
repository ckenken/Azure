<?php

	require("Pin.php");

	$date = $_GET["date"];

	mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;
	mysql_select_db("gowalla") or die(mysql_error());;

	$all;  // 準備用來裝整個輸出用的 json

	$all["models"] = Array();

	$query = "select * from segment_result_d20 where user_id=" . $date . " and param_id=78 and setting_id=25";

	$segs = mysql_query($query);

	$segArray = Array();

	$i = 0;
	while($fr = mysql_fetch_row($segs)) {
		$segArray[$i] = $fr;
		$i++;
	}

	//var_dump($segArray);

	$start = -1;
	$end = -1;

	for($i = 0; $i<count($segArray); $i++) {
		// 0 = segid, 1 = date, 2 = setting, 3 = param_id, 4 = hour, 5 = model, 6 = fake
		if($start == -1)
			$start = $i;

		if($end <= $i)
			$end = $i;


		if(($i+1) < count($segArray) && $segArray[$i][5] == $segArray[$i+1][5]) {  // 同一個 model
			continue;
		}
		else if(($i+1) < count($segArray) && $segArray[$i][5] != $segArray[$i+1][5] || ($i+1) >= count($segArray)) {  // change point

			$points = Array();	
			for($j = $start; $j<= $end; $j++) {
				$query = "select o.id, o.cluster_id from optics_cluster_d20 o left join (select id lid from segment_point_result_d20 where seg_seq_id =" . $segArray[$i][0] . ") t on o.id=t.lid where t.lid is not null and o.param_id = 78";

				$id_cluster_table = mysql_query($query);

				while($fr = mysql_fetch_row($id_cluster_table)) {
					$temp = new Pin;

					$temp->id = $fr[0];
					$temp->cluster = $fr[1];

					array_push($points, $temp);
				}				
			}

			for($j = 0; $j<count($points); $j++) {

				$query = "select * from gowalla_data_d20 where id =" . $points[$j]->id;

				$result = mysql_query($query);

				$data = mysql_fetch_row($result);
				// 0 = id, 1 = date, 2 = time, 3 = lat, 4 = long, 5 = location_id

				$points[$j]->latitude = $data[3];
				$points[$j]->longitude = $data[4];
				$points[$j]->location_id = $data[5];

				//var_dump($points[$j]);

			}

			array_push($all["models"], $points);

			$start = -1;
			$end = -1;
		}  // end of end point cut
	} // end of i

//	var_dump($all);

	echo json_encode($all);


?>	