<!DOCTYPE html>
<html>
<header>
    <?php include_once 'meta2.php';?>
    <title>Dashboard | Lion Royal Betting</title>
</header>
<body class="dark-theme-layout">
    <div class="" id="testtheme"></div>
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
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="main-title main-title-space">
                                                <h3>Profile</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-detail-tab user-detail-tab-active user-profile-box" id="BTC">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5 pb-5">

                                                <div class="author-card pb-3">
                                                    <div class="author-card-cover"></div>
                                                    <div class="author-card-profile clearfix">

                                                        <div class="author-card-avatar">
                                                            <div class="user-images">
                                                                <span class="user-img-bg">S</span>
                                                            </div>
                                                        </div>
                                                        <div class="author-card-details">
                                                            <div class="author-card-profile-name">
                                                                <h5 class="author-card-name text-lg">saman Arbabi</h5>
                                                                <span class="author-card-position">Joined 25 Jan
                                                                    2021</span>
                                                            </div>
                                                            <div class="invoice-form-box">
                                                                <p style="font-size: 13px;"><span>Merchant ID</span> 600e4b1fe7b52e006b7287a0
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="invoice-form-box">
                                                        <label>Ref Link</label>
                                                        <p>
                                                            <span id="ref_link" style="display: none">https://coinremitter.com/signup?ref=saman</span> https://coinremitter.com/signup?ref....
                                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="" onclick="copy('ref_link')" data-original-title="https://coinremitter.com/signup?ref=saman"><i
                                                                    class="fa fa-link fa-lg"></i></a>
                                                        </p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="col-xl-8 col-lg-7">
                                                <div class=" detail-tab">
                                                    <form id="updateInfo" enctype="multipart/form-data" role='form' action="https://coinremitter.com/merchant/update-profile" method="post">
                                                        <input class="form-control" type="hidden" id="user_name_e" name="user_name" value="saman Arbabi" placeholder="Name" required="">
                                                        <input class="form-control" type="hidden" id="token" name="_token" value="Qs8ERsZpmWnFqvKN5iVen1SmapOWE150y8VHJiTC">
                                                        <input type="hidden" name="merchant_id" id="merchant_id" value="600e4b1fe7b52e006b7287a0" />
                                                        <input type="file" name="profile_pic_file" id="profile_pic_file" style="display: none" onchange="preview_profile(this)" />
                                                        <input type="hidden" id="country" name="country">
                                                        <div class="row">
                                                            <!-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="account-fn" class="inp">
                                                                        <input type="text" id="account-fn" name="fname"
                                                                            placeholder="&nbsp;" value="saman"
                                                                            required="" autocomplete="off">
                                                                        <span class="label">First Name</span>
                                                                        <span class="border"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="account-ln" class="inp">
                                                                        <input type="text" id="account-ln" name="lname"
                                                                            placeholder="&nbsp;" value="Arbabi"
                                                                            required="" autocomplete="off">
                                                                        <span class="label">Last Name</span>
                                                                        <span class="border"></span>
                                                                    </label>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="account-email" class="inp">
                                                                        <input type="text" id="account-email"
                                                                            placeholder="&nbsp;"
                                                                            value="samanlion2021@gmail.com" disabled=""
                                                                            autocomplete="off">
                                                                        <span class="label">E-mail Address</span>
                                                                        <span class="border"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="account-phone" class="inp">
                                                                        <input type="number" id="account-phone"
                                                                            name="mobile" placeholder="&nbsp;"
                                                                            value="00447310181721" autocomplete="off"
                                                                            required=""
                                                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                                                        <span class="label">Mobile Number</span>
                                                                        <span class="border"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="old_pass" class="inp">
                                                                        <input type="password" id="old_pass"
                                                                            name="old_pass" placeholder="&nbsp;">
                                                                        <span class="label">Old Password</span>
                                                                        <span class="border"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="new_pass" class="inp">
                                                                        <input type="password" id="new_pass"
                                                                            name="new_pass" placeholder="&nbsp;">
                                                                        <span class="label">New Password</span>
                                                                        <span class="border"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="d-flex flex-wrap justify-content-between align-items-center">

                                                                    <button class="btn-main-success" type="button" id="edit_user">Update Profile <span id="spinner"
                                                                            style="display:none"><i
                                                                                class="fa fa-spinner fa-spin"></i></span></button>

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
                        <div class="modal fade" aria-hidden="true" role="dialog" id="change-password">
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
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="lendingModal" tabindex="-1" role="dialog" aria-hidden="true">
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
    </div>
    <script type="text/javascript" src="https://coinremitter.com/assets/js/profile.min.js?cmt=fa217407"></script>
    <script type="text/javascript">
        var base_url = $('#base_url').val();
        $("#profile").children().addClass("active");
    </script>
    <script>
        var lastCheck = new Date();
        var caffeineSendDrip = function() {
            var ajax = window.XMLHttpRequest ?
                new XMLHttpRequest :
                new ActiveXObject('Microsoft.XMLHTTP');

            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 204) {
                    lastCheck = new Date();
                }
            };

            ajax.open('GET', 'https://coinremitter.com/genealabs/laravel-caffeine/drip');
            ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            ajax.send();
        };

        setInterval(function() {
            caffeineSendDrip();
        }, 300000);

        if (2000 > 0) {
            setInterval(function() {
                if (new Date() - lastCheck >= 7082000) {
                    location.reload(true);
                }
            }, 2000);
        }
    </script>
    <script>
        var lastCheck = new Date();
        var caffeineSendDrip = function() {
            var ajax = window.XMLHttpRequest ?
                new XMLHttpRequest :
                new ActiveXObject('Microsoft.XMLHTTP');

            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 204) {
                    lastCheck = new Date();
                }
            };

            ajax.open('GET', 'https://coinremitter.com/genealabs/laravel-caffeine/drip');
            ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            ajax.send();
        };

        setInterval(function() {
            caffeineSendDrip();
        }, 300000);

        if (2000 > 0) {
            setInterval(function() {
                if (new Date() - lastCheck >= 7082000) {
                    location.reload(true);
                }
            }, 2000);
        }
    </script>
</body>

</html>