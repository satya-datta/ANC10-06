<?php include 'header.php'; ?>
<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">PNC MANAGEMENT</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-pnc.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> PNC
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">PNC Management</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Breadcrumb end -->

        <!-- Data Table start -->
        <div class="row">
            <!-- Row Created Callback Example start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>PNC MANAGEMENT</h5>
                        <p>The PNC Management feature allows users to edit or delete existing beneficiaries</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="app-datatable-default overflow-auto">
                            <table id="example3" class="display w-100 row-callback-datatable">
                               <style>
    th, td {
        white-space: nowrap;
    }

    /* Left align RCHID and Beneficiary Name headers and data */
    th:nth-child(1), td:nth-child(1),
    th:nth-child(2), td:nth-child(2) {
        text-align: left;
    }

    /* Center all other headers except 1st and 2nd */
    th:not(:nth-child(1)):not(:nth-child(2)) {
        text-align: center !important;
        vertical-align: middle;
    }

    /* Center all other data cells except 1st and 2nd */
    td:not(:nth-child(1)):not(:nth-child(2)) {
        text-align: center;
    }

    /* Additional fixed width and padding for GRAVDA header (5th column) */
    th:nth-child(5) {
        width: 100px;
        padding-left: 0;
        padding-right: 0;
    }
</style>

                                <thead>
                                <tr>
                                    <th>RCHID</th>
                                    <th>Beneficiary Name</th>
                                    <th>Delivery Date & Time</th>
                                    <th>Type of Delivery</th>
                                    <th>Place of Delivery</th>
                                    <th>Live Birth</th>
                                    <th>Still Birth</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Database connection
                                $servername = "localhost";
                                $username = "root";
                                $password = "root";
                                $dbname = "anc";
                               
                                try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    
                                    // Fetch PNC data
                                    $stmt = $conn->prepare("SELECT 
                                        p.rch_id, 
                                        b.beneficiary_name AS beneficiary_name,
                                        p.delivery_datetime,
                                        p.delivery_type,
                                        p.delivery_place,
                                        p.live_birth_count,
                                        p.still_birth_count
                                        FROM pnc p
                                        JOIN beneficiaries b ON p.rch_id = b.rch_id
                                        ORDER BY p.delivery_datetime DESC");
                                    $stmt->execute();
                                    
                                    // Set the resulting array to associative
                                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    
                                    foreach($stmt->fetchAll() as $row) {
                                        // Format delivery date
                                        $deliveryDate = date("d-m-Y H:i", strtotime($row['delivery_datetime']));
                                        
                                        echo "<tr>
                                            <td>{$row['rch_id']}</td>
                                            <td>{$row['beneficiary_name']}</td>
                                            <td>{$deliveryDate}</td>
                                            <td>{$row['delivery_type']}</td>
                                            <td>{$row['delivery_place']}</td>
                                            <td>{$row['live_birth_count']}</td>
                                            <td>{$row['still_birth_count']}</td>
                                            <td>
                                                <a href='pnc-revise.php?id={$row['rch_id']}' class='btn btn-light-success icon-btn b-r-4'>
                                                    <i class='ti ti-edit text-success'></i>
                                                </a>
                                                <a href='pnc-details.php?id={$row['rch_id']}' class='btn btn-light-info icon-btn b-r-4'>
                                                    <i class='fa-solid fa-eye fa-fw'></i>
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                } catch(PDOException $e) {
                                    echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
                                }
                                $conn = null;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Created Callback Example end -->
        </div>
        <!-- Data Table end -->
    </div>
        </main>
        <!-- Main Section end -->
    </div>

    <!-- tap on top -->
    <div class="go-top">
      <span class="progress-value">
        <i class="ti ti-arrow-up"></i>
      </span>
    </div>

    <!-- Footer Section start -->
     <!-- Footer Section starts-->
<?php include 'footer.php'; ?>