<?php
// Include your database connection file
// $con = new mysqli("host", "username", "password", "database");

// Retrieve user rank and status in one query
$user_query = mysqli_query($con, "SELECT user_rank, user_status FROM users WHERE user_id='$userid'");
$user_data = mysqli_fetch_assoc($user_query);
$user_rank = $user_data['user_rank'];
$user_status = $user_data['user_status'];

// Query to get the count of new baptismal records with bapstatus = 0
$baptismal_query = "SELECT COUNT(*) AS new_count FROM baptismal WHERE bapstatus = 0";
$baptismal_result = $con->query($baptismal_query);
$baptismal_data = $baptismal_result->fetch_assoc();
$new_count = $baptismal_data['new_count'];

// Initialize counters for JSON files
$jsonCounts = [
    'confirmation.json' => 0,
    'wedding.json' => 0,
    'coh.json' => 0
];

// Loop through each JSON file and count records with bapstatus = 0
foreach ($jsonCounts as $file => &$count) {
    if (file_exists($file)) {
        $jsonData = json_decode(file_get_contents($file), true);

        // Check if $jsonData is an array before proceeding
        if (is_array($jsonData)) {
            foreach ($jsonData as $record) {
                if (isset($record['log_id']) && isset($record['bapstatus']) && $record['bapstatus'] == 0) {
                    $count++;
                }
            }
        }
    } else {
        echo "JSON file $file not found.<br>";
    }
}
unset($count); // Break the reference after the loop

// Assign individual counts for clarity
$cnew_count = $jsonCounts['confirmation.json'];
$wnew_count = $jsonCounts['wedding.json'];
$cohnew_count = $jsonCounts['coh.json'];
?>

<nav class="side-menu-fixed">
    <div class="scrollbar side-menu-bg" style="min-height: calc(100vh - 0px);">
        <ul class="nav navbar-nav side-menu" id="sidebarnav" style="min-height: 100vh;">
            <!-- Dashboard & Logo -->
            <li class="menu-header">
                <div class="text-center">
                    <img src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-2.png" height="120" width="120" alt="Logo">
                    <p class="logo-text" style="color: #ffffff">ST. JOSEPH CATHEDRAL PARISH</p>
                </div>
            </li>
            <li class="menu-item">
                <a href="dashboard">
                    <img src="https://img.sikatpinoy.net/images/2024/07/25/image.png" alt="Dashboard Icon" width="20" height="20">
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if ($user_rank == 'superadmin') { ?>
                <!-- Manage Reservation Menu -->
                <li class="menu-dropdown">
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Reservation">
                        <img src="https://img.sikatpinoy.net/images/2024/07/26/image18cba3e3c0f81e30.png" alt="Reservation Icon" width="25" height="25">
                        <span>Manage Reservation</span>
                        <i class="ti-plus pull-right"></i>
                    </a>
                    <ul id="Reservation" class="collapse">
                        <!-- Baptismal Submenu -->
                        <li class="submenu-dropdown">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#baptismal">
                                <img src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-1.png" alt="Baptismal Icon" width="25" height="25">
                                <span>Baptismal</span>
                                <i class="ti-plus pull-right"></i>
                            </a>
                            <ul id="baptismal" class="collapse">
                                <li><a href="baptismal">NEW <?php if ($new_count > 0): ?><span class="badge"><?php echo $new_count; ?></span><?php endif; ?></a></li>
                                <li><a href="abaptismal">APPROVED</a></li>
                                <li><a href="dbaptismal">DECLINED</a></li>
                                <li><a href="cbaptismal">CANCEL</a></li>
                            </ul>
                        </li>
                        
                        <!-- Confirmation Submenu -->
                        <li class="submenu-dropdown">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Confirmation">
                                <img src="https://img.sikatpinoy.net/images/2024/08/14/image48efe10dd8815c06.png" alt="Confirmation Icon" width="25" height="25">
                                <span>Confirmation</span>
                                <i class="ti-plus pull-right"></i>
                            </a>
                            <ul id="Confirmation" class="collapse">
                                <li><a href="Confirmation">NEW <?php if ($cnew_count > 0): ?><span class="badge"><?php echo $cnew_count; ?></span><?php endif; ?></a></li>
                                <li><a href="aConfirmation">APPROVED</a></li>
                                <li><a href="dConfirmation">DECLINED</a></li>
                                <li><a href="cConfirmation">CANCEL</a></li>
                            </ul>
                        </li>
                        
                        <!-- Wedding Submenu -->
                        <li class="submenu-dropdown">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Wedding">
                                <img src="https://img.sikatpinoy.net/images/2024/08/14/imageebd8db62f2da2051.png" alt="Wedding Icon" width="25" height="25">
                                <span>Wedding</span>
                                <i class="ti-plus pull-right"></i>
                            </a>
                            <ul id="Wedding" class="collapse">
                                <li><a href="wedding1">NEW <?php if ($wnew_count > 0): ?><span class="badge"><?php echo $wnew_count; ?></span><?php endif; ?></a></li>
                                <li><a href="awedding">APPROVED</a></li>
                                <li><a href="dwedding">DECLINED</a></li>
                                <li><a href="cwedding">CANCEL</a></li>
                            </ul>
                        </li>

                        <!-- Car Or House Submenu -->
                        <li class="submenu-dropdown">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#car">
                                <img src="https://stveronicassf.com/wp-content/uploads/2021/05/icon-car-blessed.png" alt="Car/House Icon" width="25" height="25">
                                <span>Car Or House</span>
                                <i class="ti-plus pull-right"></i>
                            </a>
                            <ul id="car" class="collapse">
                                <li><a href="coh1">NEW <?php if ($cohnew_count > 0): ?><span class="badge"><?php echo $cohnew_count; ?></span><?php endif; ?></a></li>
                                <li><a href="acoh">APPROVED</a></li>
                                <li><a href="dcoh">DECLINED</a></li>
                                <li><a href="ccoh">CANCEL</a></li>
                            </ul>
                        </li>
                        
                        <!-- Burial Submenu -->
                        <li class="submenu-dropdown">
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#burial">
                                <img src="https://img.icons8.com/ios-filled/25/ffffff/cemetery.png" alt="Burial Icon" width="25" height="25">
                                <span>Burial</span>
                                <i class="ti-plus pull-right"></i>
                            </a>
                            <ul id="burial" class="collapse">
                                <li><a href="burial">NEW</a></li>
                                <li><a href="aburial">APPROVED</a></li>
                                <li><a href="dburial">DECLINED</a></li>
                                <li><a href="cburial">CANCEL</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Additional Admin Menus -->
                <li class="menu-item">
                    <a href="confirm-management">
                        <img src="https://img.sikatpinoy.net/images/2024/08/03/image09dce3a988e61a91.png" alt="Schedule Icon" width="20" height="20" style="filter: invert(100%);">
                        <span>Manage Schedules</span>
                    </a>
                </li>
                <li class="menu-dropdown">
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#HisRep">
                        <img src="https://img.icons8.com/ios-filled/20/ffffff/timeline.png" alt="History Icon" width="20" height="20">
                        <span>History Reports</span>
                        <i class="ti-plus pull-right"></i>
                    </a>
                    <ul id="HisRep" class="collapse">
                        <li><a href="baptismalReports"><img src="https://img.icons8.com/ios-filled/20/ffffff/timeline.png" alt="Icon" width="20" height="20"> Baptismal History</a></li>
                        <li><a href="weddinReport"><img src="https://img.icons8.com/ios-filled/20/ffffff/timeline.png" alt="Icon" width="20" height="20"> Wedding History</a></li>
                        <li><a href="confirmationReports"><img src="https://img.icons8.com/ios-filled/20/ffffff/timeline.png" alt="Icon" width="20" height="20"> Confirmation History</a></li>
                        <li><a href="cohReports"><img src="https://img.icons8.com/ios-filled/20/ffffff/timeline.png" alt="Icon" width="20" height="20"> Car or House History</a></li>
                        <li><a href="burialReports"><img src="https://img.icons8.com/ios-filled/20/ffffff/timeline.png" alt="Icon" width="20" height="20"> Burial History</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($user_rank == 'normal') { ?>
                <!-- Normal User Menus -->
                <li class="menu-item">
                    <a href="baptismal">
                        <img src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-1.png" alt="Baptismal Icon" width="25" height="20">
                        <span>Baptismal</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="Confirmation">
                        <img src="https://img.sikatpinoy.net/images/2024/08/14/image48efe10dd8815c06.png" alt="Confirmation Icon" width="20" height="20">
                        <span>Confirmation</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="wedding1">
                        <img src="https://img.sikatpinoy.net/images/2024/08/14/imageebd8db62f2da2051.png" alt="Wedding Icon" width="20" height="20">
                        <span>Wedding</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="coh">
                        <img src="https://stveronicassf.com/wp-content/uploads/2021/05/icon-car-blessed.png" alt="Car/House Icon" width="20" height="20">
                        <span>Car Or House</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="burial">
                        <img src="https://img.icons8.com/ios-filled/25/ffffff/cemetery.png" alt="Car/House Icon" width="20" height="20">
                        <span>Burial</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<!-- Left Sidebar End-->