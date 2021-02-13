<header class="header-main">
    <div class="header-bottom" id="navheader">
        <div class="container">
            <div class="row">
                <div class="col-xl-2">
                    <div class="header-logo">
                        <a href="profile.php"><img src="img/logo-white.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-2 text-right user-dropdown">
                    <div class="header-mobile-menu"><i class="fa fa-bars"></i></div>
                    <div class="noti-box">
                        <a class="dropdown-toggle notilink" data-toggle="noti_dropdown" aria-expanded="false">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <div class="couner">
                                <input type="hidden" name="" id="noti_count_input">
                                <p id="noti_count"> 0 </p>
                            </div>
                        </a>
                        <div id="notificationContainer" class="tog">
                            <a class="" data-toggle="dropdown-toggle" aria-expanded="false">
                                <div id="notificationTitle">Notifications</div>
                            </a>
                            <div id="notificationsBody" class="notifications">
                                <a class="" data-toggle="noti_dropdown" aria-expanded="false">
                                </a>
                                <div id="noti_block">
                                    <li role="" class="list_n " id="n_600e4f12edf02308db3a38e1">
                                        <div class="notifi-list">
                                            <div class="dropdown-icon"></div>
                                            <a class="dropdown-title" href="JavaScript:void(0);"><i class="dropdown-ico fa fa-envelope mass"></i>    Your new TCN wallet lionroyal is cerated recently 
                                                <div id="noti_status_600e4f12edf02308db3a38e1">
                                                    <div class="dropdown-close" tooltip="Mark as unread" id="noti_un" onclick="unread_noti('600e4f12edf02308db3a38e1')" flow="left">
                                                        <i class="fa fa-circle"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="dropdown-date">
                                            <span>2 weeks before</span>
                                        </div>
                                    </li>
                                </div>
                                <!-- <li class="text-center" id="view_more" style="padding: 3px;border: none;width: 100%;font-size: 14px;">
                                    <a onclick="view_more()" href="#" style="color: black;text-decoration: none;">view more</a>
                                </li> -->
                            </div>
                            <div id="notificationFooter">
                                <a href="javascript:read_my_all_noti()">Mark all as a read</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" title="saman Arbabi">
                            <div class="user-images">
                                <span class="user-img-bg"><?php echo substr($RecDataUserProfile[0]['Fname'],0,1);?></span>
                            </div>
                        </a>
                        <ul class="header-dropdown-menu pro tog" id="navblock">
                            <li role="presentation"><a href="profile.php">Profile</a>
                            </li>
                            <li role="presentation"><a href="logout.php">Signout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>