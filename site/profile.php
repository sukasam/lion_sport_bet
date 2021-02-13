<?php include_once "function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'account_info') {
    $_SESSION['errors_code'] = "";
    $_SESSION['errors_code1'] = "";
    $_SESSION['errors_code2'] = "";
    include_once "function/profile.php";
}

if (isset($_GET['action']) && $_GET['action'] === 'pm_info') {
    $_SESSION['errors_code'] = "";
    $_SESSION['errors_code1'] = "";
    $_SESSION['errors_code2'] = "";
    include_once "function/pm_info.php";
}

if (!isset($_GET['action'])) {
    $_SESSION['errors_code'] = "";
    $_SESSION['errors_code1'] = "";
    $_SESSION['errors_code2'] = "";
}

$RecDataSQL = "SELECT * FROM pm_info WHERE Player = ? ORDER BY id DESC";
$values = array($_SESSION['Player']);
$RecData = $model->doSelect($RecDataSQL, $values);

if (empty($RecData[0])) {
    $RecData[0]['pm_account'] = '';
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once 'meta2.php';?>
    <title>Profile | Lion Royal Betting</title>
</header>

<body class="dark-theme-layout">
    <?php include_once 'head2.php';?>
    <section class="page-paddings">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="user-page-main clearfix">
                        <?php include_once 'left_menu2.php';?>
                        <div class="user-panel-right">
                            <div class="user-detail">
                                <div class="user-box-detai">
                                    <div class="user-detail-tab user-detail-tab-active user-profile-box">
                                        <div class="row">
                                        <?php if($_SESSION['errors_code'] != ""){?>
                                            <div class="col-12">
                                                <div class="alert <?php echo $_SESSION['errors_code'];?>">
                                                    <?php echo $_SESSION['errors_msg'];?>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <?php if($_SESSION['errors_code1'] != ""){?>
                                            <div class="col-12">
                                                <div class="alert <?php echo $_SESSION['errors_code1'];?>">
                                                    <?php echo $_SESSION['errors_msg1'];?>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div class="col-xl-4 col-lg-5 pb-3">
                                                <div class="col-12">
                                                    <div class="main-title main-title-space">
                                                        <h3>Profile</h3>
                                                    </div>
                                                </div>
                                                <div class="author-card pb-3">
                                                    <div class="author-card-cover"></div>
                                                    <div class="author-card-profile clearfix">

                                                        <div class="author-card-avatar">
                                                            <div class="user-images">
                                                                <span class="user-img-bg"><?php echo substr($RecDataUserProfile[0]['Fname'], 0, 1); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="author-card-details">
                                                            <div class="author-card-profile-name">
                                                                <h5 class="author-card-name text-lg"><?php echo $RecDataUserProfile[0]['Fname'] . ' ' . $RecDataUserProfile[0]['Lname']; ?></h5>
                                                                <span class="author-card-position">Joined <?php echo date('d M Y', strtotime($RecDataUserProfile[0]['register_date'])); ?></span>
                                                            </div>
                                                            <div class="invoice-form-box">
                                                                <p style="font-size: 13px;"><span>Merchant ID</span> <?php echo sha1($RecDataUserProfile[0]['Email']); ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="invoice-form-box">
                                                       <div class="row">
                                                            <div class="col-6">
                                                                <p>Deposits</p>
                                                                <p><span class="author-balance"><?php echo number_format($RecDataUserProfile[0]['DBalance']) ?></span></p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>Cashouts</p>
                                                                <p><span class="author-balance"><?php echo number_format($RecDataUserProfile[0]['CBalance']) ?></span></p>
                                                            </div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-8 col-lg-7">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="main-title main-title-space">
                                                            <h3>Infomation</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class=" detail-tab">
                                                            <form id="updateInfo" enctype="multipart/form-data" role='form' action="profile.php?action=account_info" method="post">
                                                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="account-fn" class="inp">
                                                                                <input type="text" name="account_fname"
                                                                                    placeholder="&nbsp;" value="<?php echo $RecDataUserProfile[0]['Fname']; ?>"
                                                                                    autocomplete="off"
                                                                                    required>
                                                                                <span class="label">First Name</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="account-ln" class="inp">
                                                                                <input type="text" name="account_lname"
                                                                                    placeholder="&nbsp;" value="<?php echo $RecDataUserProfile[0]['Lname']; ?>"
                                                                                    autocomplete="off"
                                                                                    required>
                                                                                <span class="label">Last Name</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="account-email" class="inp">
                                                                                <input type="text"
                                                                                    placeholder="&nbsp;"
                                                                                    value="<?php echo $RecDataUserProfile[0]['Email']; ?>"
                                                                                    autocomplete="off"
                                                                                    name="account_emails"
                                                                                    required <?php if (!empty($RecDataUserProfile[0]['Email'])) {echo "readonly";}?>>
                                                                                <span class="label">E-mail Address</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="account-phone" class="inp">
                                                                                <input type="number"
                                                                                    name="account_phone" placeholder="&nbsp;"
                                                                                    value="<?php echo $RecDataUserProfile[0]['Telephone']; ?>" autocomplete="off"
                                                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                                                    required <?php if (!empty($RecDataUserProfile[0]['Telephone'])) {echo "readonly";}?>>
                                                                                <span class="label">Mobile Number</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="old_password" class="inp">
                                                                                <input type="password" id="old_password"
                                                                                    name="old_password" placeholder="&nbsp;">
                                                                                <span class="label">Old Password</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="new_password" class="inp">
                                                                                <input type="password" id="new_password"
                                                                                    name="new_password" placeholder="&nbsp;">
                                                                                <span class="label">New Password</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="d-flex flex-wrap justify-content-between align-items-center">

                                                                            <button class="btn-main-success" type="submit">Update Profile</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-20">
                                                        <div class="main-title main-title-space">
                                                            <h3>Perfect Money Account</h3>
                                                        </div>
                                                        <div class=" detail-tab">
                                                            <form id="updateBank" enctype="multipart/form-data" role='form' action="profile.php?action=pm_info" method="post">
                                                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="account-fn" class="inp">
                                                                                <input type="text" name="pm_account"
                                                                                    placeholder="&nbsp;" value="<?php echo $RecData[0]['pm_account']; ?>"
                                                                                    autocomplete="off"
                                                                                    required>
                                                                                <span class="label">P.M USD Account Information</span>
                                                                                <span class="border"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="d-flex flex-wrap justify-content-between align-items-center">

                                                                            <button class="btn-main-success" type="submit">Update P.M</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal fade" aria-hidden="true" role="dialog" id="change-password">
                            <div class="modal-dialog" style="height:25% ">
                                <form id="reset_pass_form" name="reset_pass_form" method="post" action="https://coinremitter.com/merchant/reset-password">
                                    <div class="modal-content modal-xs">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Change Password <span class="coin_name">BTC</span>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>
                                        <div class="modal-body no-padding">
                                            <div class="row">
                                                <div class="col-xl-12 " style="margin-top:10px;">
                                                    <div class="form-group">
                                                        <label for="account-pass" class="inp">
                                                            <input type="password" id="old_pass" name="old_pass"
                                                                placeholder="">
                                                            <span class="label">Old Password</span>
                                                            <span class="border"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12" style="margin-top:10px;">
                                                    <div class="form-group">
                                                        <label for="account-pass" class="inp">
                                                            <input type="password" id="new_pass" name="new_pass"
                                                                placeholder="">
                                                            <span class="label">New Password</span>
                                                            <span class="border"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12" style="margin-top:10px;">
                                                    <div class="form-group">
                                                        <label for="account-pass" class="inp">
                                                            <input type="password" id="conf_pass" name="conf_pass"
                                                                placeholder="">
                                                            <span class="label">Confirm Password:</span>
                                                            <span class="border"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-border" style="border-top:none;">
                                            <span class="alert-msg success" style="color:green;display: none;"></span>
                                            <span class="alert-msg failed" style="color:red;display: none;"></span>
                                            <button type="button" class="btn btn-main-success" onclick="reset_password()">Save Change</button>
                                            <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
    </section>
    <!-- <div class="modal fade" id="lendingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b id="cnf-header">Confirmation</b>
                </div>
                <div class="modal-body">
                    <p id="cnf-msg">Are You Sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-main-success" id="confirm_yes" onclick="" data-dismiss="modal">Confirm <span style="display: none;" id="footer_confirm_loader"><i
                                class="fas fa-spinner fa-spin"></i></span></button>
                    <button type="button" class="btn btn-cancel waves-effect" id="" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
    <script type="text/javascript" src="js/profile.min.js?cmt=fa217407"></script>
</body>

</html>