<?php include 'header.php'; ?>

<!-- Header Section end -->
<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">VACCINE MANAGEMENT</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-vaccine.html" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-table f-s-16"></i> PNC</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Vaccine Management</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Data Table start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>VACCINE MANAGEMENT</h5>
                        <p>The Vaccine Management feature allows users to edit or delete existing beneficiaries</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="app-datatable-default overflow-auto">
                            <table id="example3" class="display w-100 row-callback-datatable">
                                <style>
                                    th, td {
                                        white-space: nowrap;
                                    }
                                    th:nth-child(1), td:nth-child(1),
                                    th:nth-child(2), td:nth-child(2) {
                                        text-align: left;
                                    }
                                    th:not(:nth-child(1)):not(:nth-child(2)) {
                                        text-align: center !important;
                                        vertical-align: middle;
                                    }
                                    td:not(:nth-child(1)):not(:nth-child(2)) {
                                        text-align: center;
                                    }
                                    th:nth-child(5) {
                                        width: 100px;
                                        padding-left: 0;
                                        padding-right: 0;
                                    }
                                </style>
                                <thead>
                                    <tr>
                                        <th>Child ID</th>
                                        <th>Beneficiary Mother Name</th>
                                        <th>BCG Date</th>
                                        <th>PENTA-1 Date</th>
                                        <th>PENTA-2 Date</th>
                                        <th>PENTA-3 Date</th>
                                        <th>MR-1 Date</th>
                                        <th>MR-2 Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Database connection
                                    $db = new mysqli('localhost', 'root', 'root', 'anc');
                                    
                                    // Check connection
                                    if ($db->connect_error) {
                                        die("Connection failed: " . $db->connect_error);
                                    }
                                    
                                    // Fetch data from vaccines table
                                    $query = "SELECT 
                                        child_id, 
                                        beneficiary_mother_name, 
                                        bcg_date, 
                                        penta1_date, 
                                        penta2_date, 
                                        penta3_date, 
                                        mr1_date, 
                                        mr2_date 
                                        FROM vaccines 
                                        ORDER BY created_at DESC";
                                    
                                    $result = $db->query($query);
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['child_id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['beneficiary_mother_name']) . '</td>';
                                            echo '<td>' . ($row['bcg_date'] ? date('Y-m-d', strtotime($row['bcg_date'])) : '') . '</td>';
                                            echo '<td>' . ($row['penta1_date'] ? date('Y-m-d', strtotime($row['penta1_date'])) : '') . '</td>';
                                            echo '<td>' . ($row['penta2_date'] ? date('Y-m-d', strtotime($row['penta2_date'])) : '') . '</td>';
                                            echo '<td>' . ($row['penta3_date'] ? date('Y-m-d', strtotime($row['penta3_date'])) : '') . '</td>';
                                            echo '<td>' . ($row['mr1_date'] ? date('Y-m-d', strtotime($row['mr1_date'])) : '') . '</td>';
                                            echo '<td>' . ($row['mr2_date'] ? date('Y-m-d', strtotime($row['mr2_date'])) : '') . '</td>';
                                            echo '<td>
                                                <a href="vaccine-revise.php?id=' . $row['child_id'] . '" class="btn btn-light-success icon-btn b-r-4">
                                                    <i class="ti ti-edit text-success"></i>
                                                </a>
                                                <a href="vaccine-details.php?id=' . $row['child_id'] . '" class="btn btn-light-info icon-btn b-r-4">
                                                    <i class="fa-solid fa-eye fa-fw"></i>
                                                </a>
                                            </td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="9" class="text-center">No vaccine records found</td></tr>';
                                    }
                                    
                                    $db->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Table end -->
    </div>
</main>
<!-- Main Section end -->

<!-- Footer Section start -->
<?php include 'footer.php'; ?>