<?php
// Include the database connection
require_once 'db.php';

try {
    // Fetch data from beneficiaries table using the existing connection
    $stmt = $conn->prepare("SELECT id, rch_id, beneficiary_name, age, register_date, gravida, para FROM beneficiaries");
    $stmt->execute();
    $beneficiaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    die("Error fetching beneficiaries: " . $e->getMessage());
}
?>
<?php include 'header.php'; ?>
<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">BENEFICIARY MANAGEMENT</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> Beneficiary
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Beneficiary Management</a>
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
                        <h5>BENEFICIARY MANAGEMENT</h5>
                        <p>The Beneficiary Management feature allows users to edit or delete existing beneficiaries</p>
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
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Gravida</th>
                                    <th>Para</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                     <tbody>
                      <?php foreach ($beneficiaries as $beneficiary): ?>
                        <tr>
                        <td class="left-cell" style="padding-left: 20px;"><?php echo htmlspecialchars($beneficiary['rch_id']); ?></td>
<td><?php echo htmlspecialchars($beneficiary['beneficiary_name']); ?></td>
<td><?php echo htmlspecialchars($beneficiary['age']); ?></td>
<td><?php echo htmlspecialchars($beneficiary['register_date']); ?></td>
<td><?php echo htmlspecialchars($beneficiary['gravida']); ?></td>
<td><?php echo htmlspecialchars($beneficiary['para']); ?></td>
<td>
  <a href="beneficiary-revise.php?id=<?php echo $beneficiary['id']; ?>" class="btn btn-light-success icon-btn b-r-4 me-1">
    <i class="ti ti-edit text-success"></i>
  </a>
  <a href="beneficiary-details.php?id=<?php echo $beneficiary['id']; ?>" class="btn btn-light-info icon-btn b-r-4">
    <i class="ti ti-eye text-info"></i>
  </a>
</td>

                        </tr>
                      <?php endforeach; ?>
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