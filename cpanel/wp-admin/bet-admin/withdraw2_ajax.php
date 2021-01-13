<?php
include_once "../../function/cpanel/app_top.php";
include_once "../../_inc/config.php";
include_once "../../function/poker_config.php";
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
    3 => 'date',
    4 => '',
    5 => '',
    6 => '',
    7 => '',
    8 => 'status',
    9 => 'comment',
);

// getting total number records without any search
if ($requestData['0'] === '1' || $requestData['0'] === '2' || $requestData['0'] === '0') {
    $condition = " AND status='" . $requestData['0'] . "'";
} else {
    $condition = "";
}

$sql = "SELECT *";
$sql .= " FROM withdraw_history WHERE withdraw_type='2'" . $condition;
$query = mysqli_query($conn, $sql) or die("withdraw_ajax.php: get withdraw_history");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT *";
$sql .= " FROM withdraw_history WHERE withdraw_type='2'";
if (!empty($requestData['search']['value'])) { // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql .= " AND ( player LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR amount LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR date LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR status LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR comment LIKE '" . $requestData['search']['value'] . "%' )";

}

$sql .= $condition;

$query = mysqli_query($conn, $sql) or die("withdraw_ajax.php: get withdraw_history");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("withdraw_ajax.php: get withdraw_history");

$data = array();
while ($row = mysqli_fetch_array($query)) { // preparing an array

    $btAction = '';
    if ($row["status"] == 0) {
        $btAction .= '<div class="row">';
        $btAction .= ' <div class="col-md-12 text-center">';
        $btAction .= '   <div class="btn-group">';
        $btAction .= '     <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        $btAction .= '       Action <span class="caret"></span>';
        $btAction .= '     </button>';
        $btAction .= '     <ul class="dropdown-menu" role="menu" style="left: -81px;">';
        $btAction .= '       <li><a href="javascript:void(0)" onclick="getOnchange(\'1\',\'' . $row['id'] . '\');">Approved</a></li>';
        $btAction .= '       <li><a href="javascript:void(0);" onclick="getOnchange(\'2\',\'' . $row['id'] . '\');">Cancel</a></li>';
        $btAction .= '     </ul>';
        $btAction .= '   </div>';
        $btAction .= ' </div>';
        $btAction .= '</div>';
    }

    $RecDataBank = $db->select("SELECT * FROM bank_info WHERE player = '" . $row['player'] . "'  ORDER BY id DESC");

    if ($row['status'] == "1") {
        $btStatus = '<button class="btn btn-success" style="width: 100px;">Complated</button>';
    } else if ($row['status'] == "2") {
        $btStatus = '<button class="btn btn-danger" style="width: 100px;">Cancel</button>';
    } else {
        $btStatus = '<button class="btn btn-primary" style="width: 100px;">Processing</button>';
    }

    $bocComment = '';
    if ($row['status'] == 0) {
        $bocComment = '<form name="frmWd" id="frmWd' . $row["id"] . '" action="withdraw2_.php?action=changeStatus" method="post">';
        $bocComment .= '<input type="text" name="comment" value="" style="width: 80px;">';
        $bocComment .= '<input type="hidden" name="statusCh" id="statusCh' . $row["id"] . '" value="">';
        $bocComment .= '<input type="hidden" name="acID" value="' . $row["id"] . '">';
        $bocComment .= '<input type="hidden" name="player" value="' . $row["player"] . '">';
        $bocComment .= '<input type="hidden" name="amount" value="' . $row["amount"] . '">';
        $bocComment .= '</form>';

    } else {
        $bocComment = $row['comment'];
    }

    if ($row["comment_date"] !== "") {
        $dateTimeComment = "<br>" . $row["comment_date"] . " " . $row["comment_time"] . "";
    }

    $nestedData = array();
    $nestedData[] = $row["player"];
    $nestedData[] = $row["amount"] . "0";
    $nestedData[] = "<center>" . $row["date"] . " " . $row['time'] . "</center>";
    $nestedData[] = "<center>" . $RecDataBank[0]['bank_name'] . "</center>";
    $nestedData[] = "<center>" . $RecDataBank[0]['fullname'] . "</center>";
    $nestedData[] = "<center>" . $RecDataBank[0]['bank_card'] . "</center>";
    $nestedData[] = "<center>" . $RecDataBank[0]['bank_sheba'] . "</center>";
    $nestedData[] = "<center>" . $btStatus . "</center>";
    $nestedData[] = "<center>" . $bocComment . $dateTimeComment . "</center>";
    $nestedData[] = "<center>" . $btAction . "</center>";
    $data[] = $nestedData;
}

$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal" => intval($totalData), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data, // total data array,
    "status" => $requestData['0'],
);

echo json_encode($json_data); // send data as json format
