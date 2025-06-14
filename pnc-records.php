<?php include 'header.php'; ?>


<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">PNC RECORDS</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-pnc.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> PNC
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">PNC Records</a>
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
                        <h5>PNC RECORDS</h5>
                        <p>The PNC Records feature allows users to filter the existing beneficiaries and Downlaod</p>
                    </div>
                     
                        <div class="card-body d-flex flex-wrap gap-4">
                        <div>
                            <div class="mb-1 fw">Filter 1</div>
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 fw">Filter 2</div>
                            <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </div>
                        </div>
                        <div>
                            <div class="mb-1 fw">Filter 3</div>
                            <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 fw">Filter 4</div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                <input type="date" class="form-control bg-secondary text-white border-0">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start flex-wrap">
                                <button type="button" class="btn btn-outline-info">
                                <i class="ti ti-search"></i> Search
                                </button>
                                <button type="button" class="btn btn-outline-warning">
                                <i class="ti ti-reset"></i> Reset
                                </button>
                                <button type="button" class="btn btn-outline-success d-flex align-items-center">
                                Download <i class="ti ti-download ms-1"></i>
                                </button>
                            </div>
                       </div>

                        </div>

                       
                    <div class="card-body p-0">
                        <div class="app-datatable-default overflow-auto">
                            <table id="example3" class="display w-100 row-callback-datatable">
                               <style>
    th, td {
        white-space: nowrap;
    }
    th{
        padding:10px,
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
        <th>RCH ID</th>
        <th>Beneficiary Name</th>
        <th>Delivery Date & Time</th>
        <th>Type of Delivery</th>
        <th>Place of Delivery</th>
        <th>Hospital Address</th>
        <th>Live Birth</th>
        <th>Still Birth</th>
        <th>Child ID 1</th>
        <th>Sex of Baby 1</th>
        <th>Weight of Baby 1</th>
        <th>Child ID 2</th>
        <th>Sex of Baby 2</th>
        <th>Weight of Baby 2</th>
        <th>Child ID 3</th>
        <th>Sex of Baby 3</th>
        <th>Weight of Baby 3</th>
        <th>Child ID 4</th>
        <th>Sex of Baby 4</th>
        <th>Weight of Baby 4</th>
        <th>Child ID 5</th>
        <th>Sex of Baby 5</th>
        <th>Weight of Baby 5</th>
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
        
        // Query to fetch PNC records
        $stmt = $conn->prepare("SELECT * FROM pnc");
        $stmt->execute();
        
        // Set the resulting array to associative
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($results) > 0) {
            foreach($results as $row) {
                // Decode the children_data JSON
                $children = json_decode($row['children_data'], true);
                
                echo "<tr>";
                echo "<td>".htmlspecialchars($row['rch_id'])."</td>";
                echo "<td>".htmlspecialchars($row['beneficiary_name'])."</td>";
                echo "<td>".htmlspecialchars($row['delivery_datetime'])."</td>";
                echo "<td>".htmlspecialchars($row['delivery_type'])."</td>";
                echo "<td>".htmlspecialchars($row['delivery_place'])."</td>";
                echo "<td>".htmlspecialchars($row['hospital_address'])."</td>";
                echo "<td>".htmlspecialchars($row['live_birth_count'])."</td>";
                echo "<td>".htmlspecialchars($row['still_birth_count'])."</td>";
                
                // Display child data (up to 5 children)
                for ($i = 0; $i < 5; $i++) {
                    if (isset($children[$i])) {
                        echo "<td>".htmlspecialchars($children[$i]['child_id'] ?? '')."</td>";
                        echo "<td>".htmlspecialchars($children[$i]['sex'] ?? '')."</td>";
                        echo "<td>".htmlspecialchars($children[$i]['weight'] ?? '')." kg</td>";
                    } else {
                        // Empty cells if no child data exists
                        echo "<td></td><td></td><td></td>";
                    }
                }
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='23'>No records found</td></tr>";
        }
    } catch(PDOException $e) {
        echo "<tr><td colspan='23'>Error: " . $e->getMessage() . "</td></tr>";
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