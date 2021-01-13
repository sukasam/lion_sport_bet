<?php
include_once "../../function/cpanel/app_top.php";
include_once "../../_inc/config.php";
include_once "../../_inc/model.php";
include_once "../../function/poker_api.php";

/* Database connection start */

$conn = mysqli_connect($db_conn['host'], $db_conn['user'], $db_conn['pass'], $db_conn['database']) or die("Connection failed: " . mysqli_connect_error());

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$columns = array(
    // datatable column index  => database column name
    0 => 'id',
    1 => 'player',
    2 => 'amount',
    3 => 'currency',
    4 => 'date',
    5 => 'time',
    6 => 'status',
);

// getting total number records without any search
$sql = "SELECT *";
$sql .= " FROM withdraw_history";
$query = mysqli_query($conn, $sql) or die("withdraw_history_ajax.php: get withdraw_history");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

$timestamp = time();
$dateToday = date("Y-m-d", $timestamp);

$sql = "SELECT *";
$sql .= " FROM withdraw_history WHERE 1=1 AND withdraw_type = '1' AND status = '0'";
if (!empty($requestData['search']['value'])) { // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql .= " AND ( player LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR amount LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR currency LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR date LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR time LIKE '" . $requestData['search']['value'] . "%' )";
}
$query = mysqli_query($conn, $sql) or die("withdraw_history_ajax.php: get withdraw_history");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("withdraw_history_ajax.php: get withdraw_history");

$data = array();
while ($row = mysqli_fetch_array($query)) { // preparing an array

    $nestedData = array();

    $nestedData[] = "<center>" . $row["player"] . "</center>";
    $nestedData[] = "<center>" . $row["amount"] . "</center>";
    $nestedData[] = "<center>" . $row["currency"] . "</center>";
    $nestedData[] = "<center>" . $row["date"] . "</center>";
    $nestedData[] = "<center>" . $row["time"] . "</center>";

    if ($row["status"] == 1) {
        $buttonAction = '<center><button class="btn btn-success" style="width: 150px;">Complated</button></center>';
    }else if($row["status"] == 2) {
        $buttonAction = '<center><button class="btn btn-danger" style="width: 150px;">Cancel</button></center>';
    }else{
        $buttonAction = '<center><button class="btn btn-warning" style="width: 150px;">Pending</button></center>';
    }

    $nestedData[] = $buttonAction;
    $nestedData[] = "<center class=\"btAction\"><button id=\"approve\" class=\"btn btn-success\" style=\"margin-right:10px;\" title=\"Approve Payment\" onclick=\"approve('".$row["id"]."');\">Approve</button><button id=\"cancel\" class=\"btn btn-danger\" style=\"margin-right:10px;\" title=\"Approve Payment\" onclick=\"cancel('".$row["id"]."');\">Cancel</button></center>";

    $data[] = $nestedData;
}

$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal" => intval($totalData), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data, // total data array
);

echo json_encode($json_data); // send data as json format
