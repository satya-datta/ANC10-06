<!-- Menu Navigation starts -->
<nav>
    <div class="app-logo">
        <a class="logo d-inline-block" href="index.php">
            <img alt="#" src="assets/images/logo/1.png">
        </a>

        <span class="bg-light-primary toggle-semi-nav d-flex-center">
            <i class="ti ti-chevron-right"></i>
        </span>

        <div class="d-flex align-items-center nav-profile p-3">
            <span class="h-45 w-45 d-flex-center b-r-10 position-relative bg-danger m-auto">
                <img alt="avatar" class="img-fluid b-r-10" src="assets/images/avatar/2.png">
                <span class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
            </span>
            <div class="flex-grow-1 ps-2">
                <h6 class="text-primary mb-0">NIKITH DEVARA</h6>
                <p class="text-muted f-s-12 mb-0">Design & Devop</p>
            </div>

            <div class="dropdown profile-menu-dropdown">
                <a aria-expanded="false" data-bs-auto-close="true" data-bs-placement="top" data-bs-toggle="dropdown" role="button">
                    <i class="ti ti-settings fs-5"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <a class="f-w-500" href="profile.php" target="_blank">
                            <i class="ph-duotone ph-user-circle pe-1 f-s-20"></i> Profile Details
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a class="f-w-500" href="setting.php" target="_blank">
                            <i class="ph-duotone ph-gear pe-1 f-s-20"></i> Settings
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <a class="f-w-500" href="#">
                                    <i class="ph-duotone ph-detective pe-1 f-s-20"></i> Incognito
                                </a>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" id="incognitoSwitch" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </li>
                   
                    <li class="app-divider-v dotted py-1"></li>

                    <li class="dropdown-item">
                        <a class="mb-0 text-danger" href="logout.php" target="_blank">
                            <i class="ph-duotone ph-sign-out pe-1 f-s-20"></i> Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
            <li class="menu-title">
                <span>Dashboard</span>
            </li>
          
            <?php 
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            
            <li class="no-sub <?= ($current_page == 'anc-dashboard.php') ? 'active' : '' ?>">
                <a href="anc-dashboard.php" class="icon-link">
                    <svg class="menu-icon" width="24" height="24">
                        <use xlink:href="assets/svg/sprite.svg#home"></use>
                    </svg>
                    ANC Dashboard
                </a>
            </li>
            
            <li class="no-sub <?= ($current_page == 'pnc-dashboard.php') ? 'active' : '' ?>">
                <a href="pnc-dashboard.php" class="icon-link">
                    <svg class="menu-icon" width="24" height="24">
                        <use xlink:href="assets/svg/sprite.svg#home"></use>
                    </svg>
                    PNC Dashboard
                </a>
            </li>

            <li class="menu-title"><span>Antenatal</span></li>

           <li class="<?= (in_array($current_page, ['register-beneficiary.php', 'beneficiary-management.php', 'beneficiary-records.php']) ? 'active' : '') ?>">

                <a aria-expanded="false" data-bs-toggle="collapse" href="#Beneficiary" class="icon-link">
                    <svg class="menu-icon" width="24" height="24">
                        <use xlink:href="assets/svg/sprite.svg#pregnant"></use>
                    </svg>
                    Beneficiary
                </a>
                <ul class="collapse <?= (in_array($current_page, ['register-beneficiary.php', 'beneficiary-management.php', 'beneficiary-records.php']) ? 'show' : '') ?>" id="Beneficiary">
                    <li class="<?= ($current_page == 'register-beneficiary.php') ? 'active' : '' ?>">
                        <a href="register-beneficiary.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#add"></use>
                            </svg>
                            Register Beneficiary
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'beneficiary-management.php') ? 'active' : '' ?>">
                        <a href="beneficiary-management.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#manage"></use>
                            </svg>
                            Beneficiary Management
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'beneficiary-records.php') ? 'active' : '' ?>">
                        <a href="beneficiary-records.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#list"></use>
                            </svg>
                            Beneficiary Records
                        </a>
                    </li>
                </ul>
            </li>

            <li class="<?= (in_array($current_page, ['register-test.php', 'test-management.php', 'test-records.php']) ? 'active' : '') ?>">
                <a aria-expanded="false" data-bs-toggle="collapse" href="#TEST" class="icon-link">
                    <svg class="menu-icon" width="24" height="24">
                        <use xlink:href="assets/svg/sprite.svg#test"></use>
                    </svg>
                    Preventive Diagnostics
                </a>
                <ul class="collapse <?= (in_array($current_page, ['register-test.php', 'test-management.php', 'test-records.php']) ? 'show' : '') ?>" id="TEST">
                    <li class="<?= ($current_page == 'register-test.php') ? 'active' : '' ?>">
                        <a href="register-test.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#add"></use>
                            </svg>
                            Register Test 
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'test-management.php') ? 'active' : '' ?>">
                        <a href="test-management.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#manage"></use>
                            </svg>
                            Test Management
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'test-records.php') ? 'active' : '' ?>">
                        <a href="test-records.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#list"></use>
                            </svg>
                            Test Records
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-title"><span>Postnatal</span></li>

            <li class="<?= (in_array($current_page, ['register-pnc.php', 'pnc-management.php', 'pnc-records.php']) ? 'active' : '') ?>">
                <a aria-expanded="false" data-bs-toggle="collapse" href="#PNC" class="icon-link">
                    <svg class="menu-icon" width="24" height="24">
                        <use xlink:href="assets/svg/sprite.svg#pnc"></use>
                    </svg>
                    PNC
                </a>
                <ul class="collapse <?= (in_array($current_page, ['register-pnc.php', 'pnc-management.php', 'pnc-records.php']) ? 'show' : '') ?>" id="PNC">
                    <li class="<?= ($current_page == 'register-pnc.php') ? 'active' : '' ?>">
                        <a href="register-pnc.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#add"></use>
                            </svg>
                            Register PNC
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'pnc-management.php') ? 'active' : '' ?>">
                        <a href="pnc-management.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#manage"></use>
                            </svg>
                            PNC Management
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'pnc-records.php') ? 'active' : '' ?>">
                        <a href="pnc-records.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#list"></use>
                            </svg>
                            PNC Records
                        </a>
                    </li>
                </ul>
            </li>

            <li class="<?= (in_array($current_page, ['register-vaccine.php', 'vaccine-management.php', 'vaccine-records.php']) ? 'active' : '') ?>">
                <a aria-expanded="false" data-bs-toggle="collapse" href="#Vaccines" class="icon-link">
                    <svg class="menu-icon" width="24" height="24">
                        <use xlink:href="assets/svg/sprite.svg#vac"></use>
                    </svg>
                    Child Immunization
                </a>
                <ul class="collapse <?= (in_array($current_page, ['register-vaccine.php', 'vaccine-management.php', 'vaccine-records.php']) ? 'show' : '') ?>" id="Vaccines">
                    <li class="<?= ($current_page == 'register-vaccine.php') ? 'active' : '' ?>">
                        <a href="register-vaccine.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#add"></use>
                            </svg>
                            Register Vaccine 
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'vaccine-management.php') ? 'active' : '' ?>">
                        <a href="vaccine-management.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#manage"></use>
                            </svg>
                            Vaccine Management
                        </a>
                    </li>
                    <li class="<?= ($current_page == 'vaccine-records.php') ? 'active' : '' ?>">
                        <a href="vaccine-records.php" class="icon-link">
                            <svg class="menu-icon" width="24" height="24">
                                <use xlink:href="assets/svg/sprite.svg#list"></use>
                            </svg>
                            Vaccine Records
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="menu-navs">
        <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
    </div>
    
    <style>
        .menu-icon {
            margin-right: 8px;
            vertical-align: middle;
        }
    </style>
</nav>
<!-- Menu Navigation ends -->