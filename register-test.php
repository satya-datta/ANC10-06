<?php
error_reporting(0); // Temporarily disable error reporting
ini_set('display_errors', 0);

require_once 'db.php';

// Handle AJAX/post requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    // Handle beneficiary name fetch request
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'fetch_beneficiary') {
            try {
                if (empty($_POST['rchId'])) {
                    throw new Exception("RCH ID is required");
                }

                $stmt = $pdo->prepare("SELECT name FROM beneficiaries WHERE rch_id = :rch_id");
                $stmt->bindParam(':rch_id', $_POST['rchId']);
                $stmt->execute();
                
                $beneficiary = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$beneficiary) {
                    throw new Exception("No beneficiary found with RCH ID: " . $_POST['rchId']);
                }
                
                echo json_encode([
                    'success' => true,
                    'beneficiary_name' => $beneficiary['name']
                ]);
                exit;
                
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
        }
    }

    // Handle form submission
    try {
        // Validate required fields
        if (empty($_POST['rchId'])) {
            throw new Exception("Error: RCH ID is required");
        }

        // Start transaction
        $pdo->beginTransaction();

        // Fetch beneficiary details
        $beneficiary_stmt = $pdo->prepare("SELECT name FROM beneficiaries WHERE rch_id = :rch_id");
        $beneficiary_stmt->bindParam(':rch_id', $_POST['rchId']);
        $beneficiary_stmt->execute();
        
        $beneficiary = $beneficiary_stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$beneficiary) {
            throw new Exception("No beneficiary found with RCH ID: " . $_POST['rchId']);
        }
        
        $beneficiary_name = $beneficiary['name'];

        // Insert main test data
        $stmt = $pdo->prepare("
            INSERT INTO tests (
                rch_id, beneficiary_name,
                td1_date, td2_date, td_booster_date,
                ifa_date, ifa_quantity, calcium_date, calcium_quantity,
                albendazole_date, albendazole_quantity,
                tb_screening_date, tb_screening_result, tb_screening_refer,
                hiv_date, hiv_result,
                hbsag_date, hbsag_result,
                hb1_date, hb1_value, hb2_date, hb2_value,
                hb3_date, hb3_value, hb4_date, hb4_value,
                bp_date, bp_systolic, bp_diastolic,
                fetal_scan_date, fetal_scan_impression, fetal_scan_result,
                ogtt_date, ogtt_value,
                abortion, abortion_status,
                created_by
            ) VALUES (
                :rch_id, :beneficiary_name,
                :td1_date, :td2_date, :td_booster_date,
                :ifa_date, :ifa_quantity, :calcium_date, :calcium_quantity,
                :albendazole_date, :albendazole_quantity,
                :tb_screening_date, :tb_screening_result, :tb_screening_refer,
                :hiv_date, :hiv_result,
                :hbsag_date, :hbsag_result,
                :hb1_date, :hb1_value, :hb2_date, :hb2_value,
                :hb3_date, :hb3_value, :hb4_date, :hb4_value,
                :bp_date, :bp_systolic, :bp_diastolic,
                :fetal_scan_date, :fetal_scan_impression, :fetal_scan_result,
                :ogtt_date, :ogtt_value,
                :abortion, :abortion_status,
                :created_by
            )
        ");

        // Bind all parameters
        $stmt->bindParam(':rch_id', $_POST['rchId']);
        $stmt->bindParam(':beneficiary_name', $beneficiary_name);
        
        // Bind all other parameters with null checks
        $fields = [
            'td1_date' => 'TD-1 Date',
            'td2_date' => 'TD-2 Date',
            'td_booster_date' => 'TD BOOSTER Date',
            'ifa_date' => 'IFA Date',
            'ifa_quantity' => 'IFA Quantity',
            'calcium_date' => 'Calcium Issue Date',
            'calcium_quantity' => 'Calcium Quantity',
            'albendazole_date' => 'Albandozole Issue Date',
            'albendazole_quantity' => 'Albandozole Quantity',
            'tb_screening_date' => 'TB screening Date',
            'tb_screening_result' => 'TB screening Result',
            'tb_screening_refer' => 'TB screening Refer',
            'hiv_date' => 'HIV Date',
            'hiv_result' => 'HIV Result',
            'hbsag_date' => 'HBsAg Date',
            'hbsag_result' => 'HBsAg Result',
            'hb1_date' => 'HB Test-1 Date',
            'hb1_value' => 'HB Test-1 Value',
            'hb2_date' => 'HB Test-2 Date',
            'hb2_value' => 'HB Test-2 Value',
            'hb3_date' => 'HB Test-3 Date',
            'hb3_value' => 'HB Test-3 Value',
            'hb4_date' => 'HB Test-4 Date',
            'hb4_value' => 'HB Test-4 Value',
            'bp_date' => 'BP Date',
            'bp_systolic' => 'BP SYS',
            'bp_diastolic' => 'BP DIA',
            'fetal_scan_date' => 'FECTAL SCAN Date',
            'fetal_scan_impression' => 'FECTAL SCAN Impression',
            'fetal_scan_result' => 'FECTAL SCAN Result',
            'ogtt_date' => 'OGTT Date',
            'ogtt_value' => 'OGTT Value',
            'abortion' => 'ABORTION',
            'abortion_status' => 'Abortion Status'
        ];

        foreach ($fields as $param => $post) {
            $value = !empty($_POST[$post]) ? $_POST[$post] : null;
            $stmt->bindParam(':' . $param, $value);
        }

        // Current user ID (replace with actual user ID from session)
        $created_by = 1;
        $stmt->bindParam(':created_by', $created_by);

        $stmt->execute();
        $test_id = $pdo->lastInsertId();
          
        if (!empty($_POST['test-count'])) {
            $test_count = (int)$_POST['test-count'];
            
            for ($i = 1; $i <= $test_count; $i++) {
                if (!empty($_POST["test-name-$i"]) && !empty($_POST["test-date-$i"]) && !empty($_POST["test-result-$i"])) {
                    $test_stmt = $pdo->prepare("
                        INSERT INTO test_details (
                            test_id, test_name, test_date, test_result
                        ) VALUES (
                            :test_id, :test_name, :test_date, :test_result
                        )
                    ");
                    
                    $test_stmt->bindParam(':test_id', $test_id);
                    $test_stmt->bindParam(':test_name', $_POST["test-name-$i"]);
                    $test_stmt->bindParam(':test_date', $_POST["test-date-$i"]);
                    $test_stmt->bindParam(':test_result', $_POST["test-result-$i"]);
                    
                    $test_stmt->execute();
                }
            }
        }
        // Commit transaction
        $pdo->commit();

        echo json_encode([
            'success' => true, 
            'message' => 'Test data saved successfully', 
            'test_id' => $test_id,
            'beneficiary_name' => $beneficiary_name
        ]);
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
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
                <h4 class="main-title">REGISTER TEST</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-cardholder f-s-16"></i>  Test
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Register Test</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Form Validation start -->
        <div class="row">
            
            <!-- Custom Styles start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column gap-2">
                        <h5>REGISTER TEST</h5>
                        <div>
                            <p> The Register Test feature allows user to add the Test 
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                 <form id="testForm" class="app-form row g-3 needs-validation" novalidate method="POST" action="">
                          <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">RCH ID</label>
                                <input 
                                        type="text" 
                                        class="form-control" 
                                        id="validationCustom01" 
                                        name="rchId"
                                        pattern="^[0-9]{12}$" 
                                        minlength="12" 
                                        maxlength="12" 
                                        inputmode="numeric" 
                                        placeholder="Enter 12-digit RCH ID" 
                                        required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                                <div class="valid-feedback">
                                     Good!
                                </div>
                                <div class="invalid-feedback">
                                                    Please provide RCH ID.
                                </div>
                            </div>
                      
                            <!-- Input Field -->
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Beneficiary Name</label>
                                <input type="text" class="form-control" id="validationCustom02" name="beneficiary_name" placeholder="Enter the Beneficiary Name" required>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide Beneficiary Name.
                                </div>
                            </div>

                            <!-- Search Button (same height as input) -->
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-info w-100" id="searchBtn">
                                    <i class="ti ti-search"></i> Search
                                </button>
                            </div>


                            <div class="col-md-4">
                                <label for="td-1-date" class="form-label">TD-1 Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="td-1-date" 
                                    name="TD-1 Date" 
                                    placeholder="Enter TD-1 Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid TD-1 date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="td-2-date" class="form-label">TD-2 Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="td-2-date" 
                                    name="TD-2 Date" 
                                    placeholder="Enter TD-2 Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid TD-2 date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="td-booster-date" class="form-label">TD BOOSTER Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="td-booster-date" 
                                    name="TD BOOSTER Date" 
                                    placeholder="Enter TD BOOSTER Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid TD BOOSTER date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="ifa-date" class="form-label">IFA Issue Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="ifa-date" 
                                    name="IFA Date" 
                                    placeholder="Enter IFA Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid IFA date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="ifa-value" class="form-label">IFA Quantity</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="ifa-value" 
                                    name="IFA Quantity" 
                                    placeholder="Enter IFA Quantity" 
                                    required
                                    min="0"
                                    max="999">
                                <div class="invalid-feedback">
                                    Please provide a valid IFA Quantity.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="calcium-date" class="form-label">Calcium Issue Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="calcium-date" 
                                    name="Calcium Issue Date" 
                                    placeholder="Enter Calcium Issue Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid Calcium Issue date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="calcium-value" class="form-label">Calcium Quantity</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="calcium-value" 
                                    name="Calcium Quantity" 
                                    placeholder="Enter Calcium Quantity" 
                                    required
                                    min="0"
                                    max="999">
                                <div class="invalid-feedback">
                                    Please provide a valid Calcium Quantity.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="albandozole-date" class="form-label">Albandozole Issue Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="albandozole-date" 
                                    name="Albandozole Issue Date" 
                                    placeholder="Enter Albandozole Issue Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid Albandozole Issue date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="albandozole-value" class="form-label">Albandozole Quantity</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="albandozole-value" 
                                    name="Albandozole Quantity" 
                                    placeholder="Enter Albandozole Quantity" 
                                    required
                                    min="0"
                                    max="999">
                                <div class="invalid-feedback">
                                    Please provide a valid Albandozole Quantity.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="tb-screening-date" class="form-label">TB screening Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="tb-screening-date" 
                                    name="TB screening Date" 
                                    placeholder="Enter TB screening Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid TB screening date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="tb-screening-result" class="form-label">TB screening Result</label>
                                <select class="form-select" id="tb-screening-result" name="TB screening Result" required>
                                    <option selected disabled value="">Select Result</option>
                                    <option value="Good">Good</option>
                                    <option value="Refer">Refer</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a TB screening result.
                                </div>
                            </div>
                            <div class="col-md-4" id="refer-box" style="display:none;">
                                <label for="tb-screening-value" class="form-label">TB screening Refer</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="tb-screening-value" 
                                    name="TB screening Refer" 
                                    placeholder="Enter TB screening Refer" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid TB screening Refer.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="hiv-date" class="form-label">HIV Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="hiv-date" 
                                    name="HIV Date" 
                                    placeholder="Enter HIV Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HIV date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hiv-result" class="form-label">HIV Result</label>
                                <select class="form-select" id="hiv-result" name="HIV Result" required>
                                    <option selected disabled value="">Select Result</option>
                                    <option value="Negative">Negative</option>
                                    <option value="Positive">Positive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a HIV result.
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="hbsag-date" class="form-label">HBsAg Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="hbsag-date" 
                                    name="HBsAg Date" 
                                    placeholder="Enter HBsAg Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HBsAg date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hbsag-result" class="form-label">HBsAg Result</label>
                                <select class="form-select" id="hbsag-result" name="HBsAg Result" required>
                                    <option selected disabled value="">Select Result</option>
                                    <option value="Negative">Negative</option>
                                    <option value="Positive">Positive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a HBsAg result.
                                </div>
                            </div>
                                                        <div class="col-md-4">
                                <label for="hb-1-date" class="form-label">HB Test-1 Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="hb-1-date" 
                                    name="HB Test-1 Date" 
                                    placeholder="Enter HB Test-1 Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-1 date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hb-1-value" class="form-label">HB Test-1 Value</label>
                                <input 
                                    type="number" 
                                    step="0.01"
                                    min="4.00"
                                    max="15.50"
                                    class="form-control" 
                                    id="hb-1-value" 
                                    name="HB Test-1 Value" 
                                    placeholder="Enter HB Test-1 value" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-1 value.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="hb-2-date" class="form-label">HB Test-2 Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="hb-2-date" 
                                    name="HB Test-2 Date" 
                                    placeholder="Enter HB Test-2 Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-2 date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hb-2-value" class="form-label">HB Test-2 Value</label>
                                <input 
                                    type="number"
                                    step="0.01"
                                    min="4.00"
                                    max="15.50" 
                                    class="form-control" 
                                    id="hb-2-value" 
                                    name="HB Test-2 Value" 
                                    placeholder="Enter HB Test-2 value" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-2 value.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="hb-3-date" class="form-label">HB Test-3 Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="hb-3-date" 
                                    name="HB Test-3 Date" 
                                    placeholder="Enter HB Test-3 Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-3 date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hb-3-value" class="form-label">HB Test-3 Value</label>
                                <input 
                                    type="number"
                                    step="0.01"
                                    min="4.00"
                                    max="15.50" 
                                    class="form-control" 
                                    id="hb-3-value" 
                                    name="HB Test-3 Value" 
                                    placeholder="Enter HB Test-3 value" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-3 value.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="hb-4-date" class="form-label">HB Test-4 Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="hb-4-date" 
                                    name="HB Test-4 Date" 
                                    placeholder="Enter HB Test-4 Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-4 date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hb-4-value" class="form-label">HB Test-4 Value</label>
                                <input 
                                    type="number" 
                                    step="0.01"
                                    min="4.00"
                                    max="15.50"
                                    class="form-control" 
                                    id="hb-4-value" 
                                    name="HB Test-4 Value" 
                                    placeholder="Enter HB Test-4 value" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid HB Test-4 value.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="p-date" class="form-label">BP Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="p-date" 
                                    name="BP Date" 
                                    placeholder="Enter BP Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid BP date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                              <label for="bp-sys" class="form-label">BP Systolic (SYS)</label>
                              <input 
                                  type="number" 
                                  class="form-control" 
                                  id="bp-sys" 
                                  name="BP SYS" 
                                  placeholder="Enter Systolic Value" 
                                  required
                                  min="50" max="250">
                              <div class="invalid-feedback">
                                  Please provide a valid Systolic BP value.
                              </div>
                              <div class="valid-feedback">
                                  Good!
                              </div>
                            </div>

                            <div class="col-md-4">
                              <label for="bp-dia" class="form-label">BP Diastolic (DIA)</label>
                              <input 
                                  type="number" 
                                  class="form-control" 
                                  id="bp-dia" 
                                  name="BP DIA" 
                                  placeholder="Enter Diastolic Value" 
                                  required
                                  min="30" max="150">
                              <div class="invalid-feedback">
                                  Please provide a valid Diastolic BP value.
                              </div>
                              <div class="valid-feedback">
                                  Good!
                              </div>
                            </div>

                            <div class="col-md-4">
                                <label for="fectal-scan-date" class="form-label">FECTAL SCAN Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="fectal-scan-date" 
                                    name="FECTAL SCAN Date" 
                                    placeholder="Enter FECTAL SCAN Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid FECTAL SCAN date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="fectal-scan-result" class="form-label">FECTAL SCAN Impression</label>
                                <select class="form-select" id="fectal-scan-result" name="FECTAL SCAN Impression" required>
                                    <option selected disabled value="">Select Impression</option>
                                    <option value="Good">Good</option>
                                    <option value="..">..</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a FECTAL SCAN Impression.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="fectal-scan-value" class="form-label">FECTAL SCAN Result</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="fectal-scan-value" 
                                name="FECTAL SCAN Result" 
                                placeholder="Enter FECTAL SCAN Result" 
                                required
                                min="0"
                                max="9">

                                <div class="invalid-feedback">
                                    Please provide a valid FECTAL SCAN Result.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="ogtt-date" class="form-label">OGTT Date</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="ogtt-date" 
                                    name="OGTT Date" 
                                    placeholder="Enter OGTT Date" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid OGTT date.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="ogtt-value" class="form-label">OGTT Value</label>
                                <input 
                                type="number" 
                                class="form-control" 
                                id="ogtt-value" 
                                name="OGTT Value" 
                                placeholder="Enter OGTT value" 
                                required 
                                min="0" 
                                max="999">

                                <div class="invalid-feedback">
                                    Please provide a valid OGTT value.
                                </div>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                            <div class="col-md-4">
                              <label for="test-count" class="form-label">Number of Tests Done (max 5)</label>
                              <input type="number" id="test-count" name="test-count" min="1" max="5" class="form-control" placeholder="Enter number of tests" required>
                            </div>
                            <div id="test-container" class="mt-3"></div>

                            <div class="col-md-4">
                                <label for="abortion-status" class="form-label">ABORTION</label>
                                <select class="form-select" id="abortion-select" name="ABORTION" required>
                                    <option selected disabled value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select an abortion option.
                                </div>
                            </div>

                            <div class="col-md-4" id="abortion-status-container" style="display: none;">
                                <label for="abortion-status" class="form-label">Abortion Status</label>
                                <select class="form-select" id="abortion-status" name="Abortion Status">
                                    <option selected disabled value="">Select Status</option>
                                    <option value="Spontaneous">Spontaneous</option>
                                    <option value="Induced">Induced</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Unknown">Unknown</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select the abortion status.
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check d-flex flex-wrap gap-1">
                                    <input class="form-check-input mg-2" type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        I confirm that the entered data is correct.
                                    </label>
                                    <div class="invalid-feedback">
                                        You must confirm before submitting.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 me-2">
                                <button class="btn btn-success w-100" type="submit">Submit</button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger w-100" type="button" id="cancelBtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Custom Styles end -->
        </div>
        <!-- Form Validation end -->
    </div>
</main>
<!-- Main Section end -->

<!-- JavaScript for form handling -->
<script>
// Form submission only (no validations)
(function () {
    'use strict';
    
    // Fetch all forms
    const forms = document.querySelectorAll('form');
    
    // Loop over forms and handle submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            handleFormSubmit(form);
        }, false);
    });
    
    // Handle form submission with AJAX
    function handleFormSubmit(form) {
        const formData = new FormData(form);
        
        // Convert FormData to JSON
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
        
        // Add additional tests data if exists
        const testCountInput = document.getElementById('test-count');
        if (testCountInput) {
            const testCount = parseInt(testCountInput.value) || 0;
            if (testCount > 0) {
                jsonData['test-count'] = testCount;
            }
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
        submitBtn.disabled = true;
        
        // Send data to server
        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Redirect or clear form as needed
                    form.reset();
                    window.location.href = 'register-test.php';
                });
            } else {    
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message,
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while submitting the form.',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => {
            // Restore button state
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
        });
    }
    
    // Cancel button handler
    const cancelBtn = document.getElementById('cancelBtn');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
            });
        });
    }
    
    // Search button functionality
    const searchBtn = document.getElementById('searchBtn');
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            const rchId = document.getElementById('validationCustom01').value;
            if (rchId.length === 12) {
                fetchBeneficiaryDetails(rchId);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid RCH ID',
                    text: 'Please enter a valid 12-digit RCH ID',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
    
    function fetchBeneficiaryDetails(rchId) {
    if (!rchId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please enter an RCH ID',
            confirmButtonText: 'OK'
        });
        return;
    }

    const nameField = document.getElementById('validationCustom02');
    if (nameField) {
        nameField.value = 'Loading...';
    }

    fetch('register-test.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'fetch_beneficiary',
            rchId: rchId
        })
    })
    .then(response => {
        if (!response.ok) {
            // Get the actual HTTP status code
            console.log(response.json())
            const status = response.status;
            let errorMsg = 'Network response was not ok';
            
            // Add specific messages for common status codes
            if (status === 404) {
                errorMsg = 'Beneficiary not found (404)';
            } else if (status === 500) {
                errorMsg = 'Server error (500)';
            }
            
            throw new Error(`${errorMsg} (Status: ${status})`);
        }
        return response.json();
    })
    .then(data => {
        if (!data) {
            throw new Error('No data received from server');
        }
        
        if (data.success && nameField) {
            nameField.value = data.beneficiary_name || '';
        } else {
            const errorMsg = data.message || 'Failed to fetch beneficiary details';
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMsg,
                confirmButtonText: 'OK'
            });
            if (nameField) nameField.value = '';
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'An error occurred while fetching beneficiary details',
            confirmButtonText: 'OK'
        });
        if (nameField) nameField.value = '';
    });
}
})();
</script>

<!-- Footer Section start -->
<?php include 'footer.php'; ?>