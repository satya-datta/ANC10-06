<?php 

include 'header.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "anc";
error_reporting(0);
// Initialize variables
$pncData = [];
$childrenDetails = [];
$successMessage = '';
$errorMessage = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Get form data
        $rchId = $_POST['rch_id'];
        $deliveryDateTime = $_POST['deliveryDateTime'];
        $deliveryType = $_POST['deliveryType'];
        $placeOfDelivery = $_POST['placeOfDelivery'];
        $hospitalAddress = $_POST['hospitalAddress'];
        $liveBirth = $_POST['liveBirth'];
        $stillBirth = $_POST['stillBirth'];
        
        // Prepare children details array
        $childrenDetails = [];
        if(isset($_POST['childId'])) {
            foreach($_POST['childId'] as $index => $childId) {
                $childrenDetails[] = [
                    'child_id' => $childId,
                    'sex' => $_POST['childSex'][$index],
                    'weight' => $_POST['childWeight'][$index]
                ];
            }
        }
        
        // Update PNC record
        $stmt = $conn->prepare("UPDATE pnc SET 
            delivery_datetime = :delivery_date_time,
            delivery_type = :delivery_type,
            delivery_place = :place_of_delivery,
            hospital_address = :hospital_address,
            live_birth_count = :live_birth,
            still_birth_count = :still_birth,
            children_data = :children_details,
            updated_at = NOW()
            WHERE rch_id = :rch_id");
        
        $stmt->bindParam(':delivery_date_time', $deliveryDateTime);
        $stmt->bindParam(':delivery_type', $deliveryType);
        $stmt->bindParam(':place_of_delivery', $placeOfDelivery);
        $stmt->bindParam(':hospital_address', $hospitalAddress);
        $stmt->bindParam(':live_birth', $liveBirth);
        $stmt->bindParam(':still_birth', $stillBirth);
        $stmt->bindParam(':children_details', json_encode($childrenDetails));
        $stmt->bindParam(':rch_id', $rchId);
        
        $stmt->execute();
        
        $successMessage = "PNC record updated successfully!";
        
    } catch(PDOException $e) {
        $errorMessage = "Error updating record: " . $e->getMessage();
    }
    $conn = null;
}

// Get RCH ID from URL parameter
$rchId = isset($_GET['id']) ? $_GET['id'] : '';

if(empty($rchId)) {
    die("Invalid RCH ID");
}

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
        p.hospital_address,
        p.live_birth_count,
        p.still_birth_count,
        p.children_data
        FROM pnc p
        JOIN beneficiaries b ON p.rch_id = b.rch_id
        WHERE p.rch_id = :rch_id");
    $stmt->bindParam(':rch_id', $rchId);
    $stmt->execute();
    
    $pncData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$pncData) {
        die("PNC record not found");
    }
    
    // Format delivery date for datetime-local input
    $deliveryDateTime = date("Y-m-d\TH:i", strtotime($pncData['delivery_datetime']));
    
    // Decode children details if exists
    $childrenDetails = json_decode($pncData['children_data'], true) ?: [];
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
$conn = null;
?>

<!-- Header Section ends -->
<!-- Header Section end -->

<!-- Main Section start -->
<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">PNC REVISE</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-pnc.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-cardholder f-s-16"></i>  PNC
                      </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="pnc-management.html" class="f-s-14 f-w-500">
                        PNC Management
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">PNC Revise</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Display messages -->
        <?php if ($successMessage): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $successMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if ($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $errorMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <!-- Form Validation start -->
        <div class="row">
            <!-- Custom Styles start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column gap-2">
                        <h5>UPDATE PNC RECORD</h5>
                        <div>
                            <p> Update the PNC details for beneficiary <?php echo htmlspecialchars($pncData['beneficiary_name']); ?> (RCH ID: <?php echo htmlspecialchars($pncData['rch_id']); ?>)</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="app-form row g-3 needs-validation" method="POST" novalidate>
                            <input type="hidden" name="rch_id" value="<?php echo htmlspecialchars($pncData['rch_id']); ?>">
                            
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">RCH ID</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="validationCustom01" 
                                    name="rchId"
                                    value="<?php echo htmlspecialchars($pncData['rch_id']); ?>"
                                    pattern="^[0-9]{12}$" 
                                    minlength="12" 
                                    maxlength="12" 
                                    inputmode="numeric" 
                                    placeholder="Enter 12-digit RCH ID" 
                                    required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    readonly>
                                <div class="valid-feedback">Good!</div>
                                <div class="invalid-feedback">Please provide RCH ID.</div>
                            </div>
                      
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Beneficiary Name</label>
                                <input 
                                    disabled 
                                    type="text" 
                                    class="form-control" 
                                    id="validationCustom02" 
                                    value="<?php echo htmlspecialchars($pncData['beneficiary_name']); ?>"
                                    placeholder="Enter the Beneficiary Name" 
                                    required>
                                <div class="valid-feedback">Good!</div>
                                <div class="invalid-feedback">Please provide Beneficiary Name.</div>
                            </div>

                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-info w-100">
                                    <i class="ti ti-edit"></i> Tap to Update
                                </button>
                            </div>

                            <div class="col-md-4">
                                <label for="deliveryDateTime" class="form-label">Delivery Date & Time</label>
                                <input 
                                    type="datetime-local" 
                                    class="form-control" 
                                    id="deliveryDateTime" 
                                    name="deliveryDateTime"
                                    value="<?php echo htmlspecialchars($deliveryDateTime); ?>"
                                    placeholder="Enter Delivery Date & Time" 
                                    required>
                                <div class="invalid-feedback">Please provide a Delivery Date & Time.</div>
                                <div class="valid-feedback">Good!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="deliveryType" class="form-label">Type of delivery</label>
                                <select class="form-select" id="deliveryType" name="deliveryType" required>
                                    <option value="">Delivery type</option>
                                    <option value="NVD" <?php echo ($pncData['delivery_type'] == 'NVD') ? 'selected' : ''; ?>>NVD</option>
                                    <option value="LSCS" <?php echo ($pncData['delivery_type'] == 'LSCS') ? 'selected' : ''; ?>>LSCS</option>
                                </select>
                                <div class="invalid-feedback">Please select a delivery type.</div>
                            </div>   
                            
                            <div class="col-md-4">
                                <label for="placeOfDelivery" class="form-label">Place of delivery</label>
                                <select class="form-select" id="placeOfDelivery" name="placeOfDelivery" required>
                                    <option value="">Delivery place</option>
                                    <option value="Government" <?php echo ($pncData['delivery_place'] == 'Government') ? 'selected' : ''; ?>>Government</option>
                                    <option value="Private" <?php echo ($pncData['delivery_place'] == 'Private') ? 'selected' : ''; ?>>Private</option>
                                </select>
                                <div class="invalid-feedback">Please select a delivery place.</div>
                            </div> 
                            
                            <div class="col-md-4">
                                <label for="hospitalAddress" class="form-label">Hospital address</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="hospitalAddress" 
                                    name="hospitalAddress"
                                    value="<?php echo htmlspecialchars($pncData['hospital_address']); ?>"
                                    placeholder="Enter the Hospital address" 
                                    required>
                                <div class="invalid-feedback">Please provide a valid address.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="liveBirth" class="form-label">Live birth</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="liveBirth"
                                    name="liveBirth"
                                    value="<?php echo htmlspecialchars($pncData['live_birth_count']); ?>"
                                    placeholder="Enter the number of live births"
                                    min="0" 
                                    max="9" 
                                    required>
                                <div class="invalid-feedback">Please provide a valid live birth count (0–9).</div>
                            </div>

                            <div class="row mt-3" id="dynamicFields">
                                <?php foreach($childrenDetails as $index => $child): ?>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Child ID <?php echo $index + 1; ?></label>
                                    <input 
                                        type="text" 
                                        class="form-control child-id"
                                        name="childId[]"
                                        value="<?php echo htmlspecialchars($child['child_id']); ?>"
                                        pattern="^[0-9]{12}$"
                                        minlength="12" 
                                        maxlength="12"
                                        inputmode="numeric"
                                        placeholder="Enter 12-digit Child ID"
                                        required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <div class="valid-feedback">Good!</div>
                                    <div class="invalid-feedback">Please provide valid 12-digit Child ID.</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sex of Baby <?php echo $index + 1; ?></label>
                                    <select class="form-select" name="childSex[]" required>
                                        <option value="">Select Sex</option>
                                        <option value="Male" <?php echo ($child['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo ($child['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    </select>
                                    <div class="invalid-feedback">Please select the baby's sex.</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Weight of Baby <?php echo $index + 1; ?></label>
                                    <div class="input-group has-validation">
                                        <input 
                                            type="number" 
                                            step="0.001" 
                                            min="0" 
                                            max="10.2"
                                            class="form-control baby-weight"
                                            name="childWeight[]"
                                            value="<?php echo htmlspecialchars($child['weight']); ?>"
                                            placeholder="e.g. 2.555" 
                                            required>
                                        <span class="input-group-text">kg</span>
                                        <div class="invalid-feedback">Enter appropriate weight.</div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="col-md-4">
                                <label for="stillBirth" class="form-label">Still birth</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="stillBirth"
                                    name="stillBirth"
                                    value="<?php echo htmlspecialchars($pncData['still_birth_count']); ?>"
                                    placeholder="Enter the Still birth" 
                                    min="0" 
                                    required>
                                <div class="invalid-feedback">Please provide a valid Still birth.</div>
                            </div>
                            
                            <div class="col-12"></div>
                            
                            <div class="col-md-2 me-2">
                                <button class="btn btn-success w-100" type="submit">Update</button>
                            </div>
                            <div class="col-md-2">
                                <a href="pnc-management.html" class="btn btn-danger w-100">Cancel</a>
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

<!-- JavaScript for dynamic fields -->
<script>
    const liveBirthInput = document.getElementById('liveBirth');
    const dynamicFields = document.getElementById('dynamicFields');

    liveBirthInput.addEventListener('input', function () {
        let count = parseInt(this.value);

        // Validate the input
        if (isNaN(count)) {
            count = 0;
            this.value = 0;
        } else if (count < 0) {
            count = 0;
            this.value = 0;
        } else if (count > 9) {
            count = 9;
            this.value = 9;
        }

        dynamicFields.innerHTML = '';

        for (let i = 1; i <= count; i++) {
            const childIdField = `
                <div class="col-md-4 mb-3">
                    <label class="form-label">Child ID ${i}</label>
                    <input type="text" class="form-control child-id" name="childId[]"
                        pattern="^[0-9]{12}$"
                        minlength="12" maxlength="12"
                        inputmode="numeric"
                        placeholder="Enter 12-digit Child ID"
                        required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    <div class="valid-feedback">Good!</div>
                    <div class="invalid-feedback">Please provide valid 12-digit Child ID.</div>
                </div>`;

            const sexField = `
                <div class="col-md-4 mb-3">
                    <label class="form-label">Sex of Baby ${i}</label>
                    <select class="form-select" name="childSex[]" required>
                        <option selected disabled value="">Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback">Please select the baby's sex.</div>
                </div>`;

            const weightField = `
                <div class="col-md-4 mb-3">
                    <label class="form-label">Weight of Baby ${i}</label>
                    <div class="input-group has-validation">
                        <input type="number" step="0.001" min="0" max="10.2"
                            class="form-control baby-weight" name="childWeight[]"
                            placeholder="e.g. 2.555" required>
                        <span class="input-group-text">kg</span>
                        <div class="invalid-feedback">Enter appropriate weight.</div>
                    </div>
                </div>`;

            dynamicFields.insertAdjacentHTML('beforeend', childIdField + sexField + weightField);
        }

        // Validate weight on blur
        const weightInputs = document.querySelectorAll('.baby-weight');
        weightInputs.forEach(input => {
            input.addEventListener('blur', () => {
                const val = input.value.trim();
                const num = parseFloat(val);
                const isValidNumber = !isNaN(num) && num <= 10.2;
                const isValidDecimals = /^\d+(\.\d{1,3})?$/.test(val);

                if (isValidNumber && isValidDecimals) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                }
            });
        });
    });
</script>

<!-- tap on top -->
<div class="go-top">
    <span class="progress-value">
        <i class="ti ti-arrow-up"></i>
    </span>
</div>

<!-- Footer Section start -->
<?php include 'footer.php'; ?>