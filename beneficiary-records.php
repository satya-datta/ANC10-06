<?php
require_once 'db.php';

// Initialize variables
$filteredBeneficiaries = [];

try {
    // Get filter parameters
    $filters = [
        'gravida' => isset($_GET['gravida']) ? (int)$_GET['gravida'] : null,
        'para' => isset($_GET['para']) ? (int)$_GET['para'] : null,
        'lmp_from' => $_GET['lmp_from'] ?? null,
        'lmp_to' => $_GET['lmp_to'] ?? null,
        'edd_from' => $_GET['edd_from'] ?? null,
        'edd_to' => $_GET['edd_to'] ?? null
    ];

    // Build query
    $query = "SELECT * FROM beneficiaries WHERE 1=1";
    $params = [];

    if (!empty($filters['gravida'])) {
        if ($filters['gravida'] > 4) {
            $query .= " AND gravida > ?";
            $params[] = 4;
        } else {
            $query .= " AND gravida = ?";
            $params[] = $filters['gravida'];
        }
    }

    if (!empty($filters['para'])) {
        if ($filters['para'] > 3) {
            $query .= " AND para > ?";
            $params[] = 3;
        } else {
            $query .= " AND para = ?";
            $params[] = $filters['para'];
        }
    }

    // Date range filters
    if (!empty($filters['lmp_from'])) {
        $query .= " AND lmp >= ?";
        $params[] = $filters['lmp_from'];
    }
    if (!empty($filters['lmp_to'])) {
        $query .= " AND lmp <= ?";
        $params[] = $filters['lmp_to'];
    }
    if (!empty($filters['edd_from'])) {
        $query .= " AND edd >= ?";
        $params[] = $filters['edd_from'];
    }
    if (!empty($filters['edd_to'])) {
        $query .= " AND edd <= ?";
        $params[] = $filters['edd_to'];
    }

    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $filteredBeneficiaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
}

// Handle CSV download
if (isset($_GET['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="beneficiaries_'.date('Y-m-d').'.csv"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['RCHID', 'Name', 'Husband', 'Age', 'Gravida', 'Para', 'Register Date', 'LMP', 'EDD', 'Address']);
    
    foreach ($filteredBeneficiaries as $row) {
        $address = $row['street'].', '.$row['city'].' - '.$row['pincode'];
        fputcsv($output, [
            $row['rch_id'],
            $row['beneficiary_name'],
            $row['husband_name'],
            $row['age'],
            $row['gravida'],
            $row['para'],
            $row['register_date'],
            $row['lmp'],
            $row['edd'],
            $address
        ]);
    }
    
    fclose($output);
    exit;
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
                <h4 class="main-title">BENEFICIARY RECORDS</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-beneficiary.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> Beneficiary
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Beneficiary Records</a>
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
                <h5>LIST BENEFICIARY</h5>
                <p>The List Beneficiary feature allows users to filter the existing beneficiaries and Download</p>
            </div>
            
            <form id="filterForm" method="GET">
             <div class="card-body d-flex flex-wrap gap-4">
    <!-- Gravida Filter -->
  <!-- Gravida Filter -->
<div class="mb-3">
    <label for="gravidaInput" class="form-label fw">Gravida</label>
    <input
        type="number"
        class="form-control"
        id="gravidaInput"
        name="gravida"
        placeholder="Enter Gravida"
        value="<?= htmlspecialchars($_GET['gravida'] ?? '') ?>"
        min="0"
    >
</div>

<!-- Para Filter -->
<div class="mb-3">
    <label for="paraInput" class="form-label fw">Para</label>
    <input
        type="number"
        class="form-control"
        id="paraInput"
        name="para"
        placeholder="Enter Para"
        value="<?= htmlspecialchars($_GET['para'] ?? '') ?>"
        min="0"
    >
</div>


<!-- Add this JavaScript code to handle dropdown functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap dropdowns
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });

    // Handle dropdown item selection
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.closest('.dropdown');
            const input = dropdown.querySelector('input[type="hidden"]');
            const button = dropdown.querySelector('.dropdown-toggle');
            
            input.value = this.dataset.value;
            button.textContent = this.dataset.value ? this.textContent : button.id.includes('gravida') ? 'Select Gravida' : 'Select Para';
        });
    });
});
</script>

    <!-- LMP Date Range Filter -->
    <div>
        <div class="mb-1 fw">LMP Date Range</div>
        <div class="row g-2">
            <div class="col-md-6">
                <input type="date" name="lmp_from" class="form-control bg-secondary text-white border-0" 
                       value="<?= htmlspecialchars($_GET['lmp_from'] ?? '') ?>" placeholder="From">
            </div>
            <div class="col-md-6">
                <input type="date" name="lmp_to" class="form-control bg-secondary text-white border-0" 
                       value="<?= htmlspecialchars($_GET['lmp_to'] ?? '') ?>" placeholder="To">
            </div>
        </div>
    </div>

    <!-- EDD Date Range Filter -->
    <div>
        <div class="mb-1 fw">EDD Date Range</div>
        <div class="row g-2">
            <div class="col-md-6">
                <input type="date" name="edd_from" class="form-control bg-secondary text-white border-0" 
                       value="<?= htmlspecialchars($_GET['edd_from'] ?? '') ?>" placeholder="From">
            </div>
            <div class="col-md-6">
                <input type="date" name="edd_to" class="form-control bg-secondary text-white border-0" 
                       value="<?= htmlspecialchars($_GET['edd_to'] ?? '') ?>" placeholder="To">
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <button type="submit" class="btn btn-outline-info"> 
            <i class="ti ti-search"></i> Search
        </button>
        <button type="button" id="downloadBtn" class="btn btn-outline-success d-lg-inline-flex align-items-center">
            Download <i class="ti ti-download"></i>
        </button>
        <?php if (!empty($_GET)): ?>
            <a href="?" class="btn btn-outline-warning">Reset Filters</a>
        <?php endif; ?>
    </div>
</div>
            </form>
            
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
                                <th>RCHID</th>
                                <th>Beneficiary Name</th>
                                <th>Husband Name</th>
                                <th>Age</th>
                                <th>Gravida</th>
                                <th>Para</th>
                                <th>Register Date</th>
                                <th>LMP</th>
                                <th>EDD</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filteredBeneficiaries as $beneficiary): ?>
                                <tr>
                                    <td class="left-cell" style="padding-left: 20px;"><?php echo htmlspecialchars($beneficiary['rch_id']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['beneficiary_name']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['husband_name']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['age']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['gravida']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['para']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['register_date']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['lmp']); ?></td>
                                    <td><?php echo htmlspecialchars($beneficiary['edd']); ?></td>
                                    <td>
                                        <?php 
                                            $address = $beneficiary['street'] . ', ' . $beneficiary['city'] . ' - ' . $beneficiary['pincode'];
                                            echo htmlspecialchars($address); 
                                        ?>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle dropdown selections
    document.querySelectorAll('.dropdown-menu a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.closest('.dropdown');
            const input = dropdown.querySelector('input[type="hidden"]');
            const button = dropdown.querySelector('.dropdown-toggle');
            
            input.value = this.dataset.value;
            button.textContent = this.textContent;
            
            // Update the button text to show the selected value
            if (this.dataset.value === '') {
                button.textContent = button.id === 'gravidaDropdown' ? 'Select Gravida' : 'Select Para';
            } else {
                button.textContent = this.textContent;
            }
        });
    });
    // Download button functionality - updated version
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simplified download button handler
    document.getElementById('downloadBtn').addEventListener('click', function() {
        // Add download parameter to existing form
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'download';
        input.value = '1';
        document.getElementById('filterForm').appendChild(input);
        document.getElementById('filterForm').submit();
    });
    
    // Remove duplicate download handlers if any
});
</script>
    
    // Add to document and submit
    document.body.appendChild(tempForm);
    tempForm.submit();
    document.body.removeChild(tempForm);
});
    // Set initial dropdown button text based on URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    const gravidaValue = urlParams.get('gravida');
    if (gravidaValue) {
        const gravidaButton = document.getElementById('gravidaDropdown');
        gravidaButton.textContent = gravidaValue === '4' ? '4+' : gravidaValue;
    }
    
    const paraValue = urlParams.get('para');
    if (paraValue) {
        const paraButton = document.getElementById('paraDropdown');
        paraButton.textContent = paraValue === '3' ? '3+' : paraValue;
    }
    
    // Download button functionality
    document.getElementById('downloadBtn').addEventListener('click', function() {
        const form = document.getElementById('filterForm');
        form.action = 'download_beneficiaries.php'; // Change this to your download endpoint
        form.submit();
        form.action = ''; // Reset the action
    });
    
    // Reset filters
    document.getElementById('resetFilters').addEventListener('click', function() {
        window.location.href = window.location.pathname;
    });
});
</script>
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