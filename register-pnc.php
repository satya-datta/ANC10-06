<?php 
include 'header.php';

// Database connection (assuming you have this in a config file)
require_once 'db.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $rchId = isset($_POST['rchId']) ? trim($_POST['rchId']) : '';
    $beneficiaryName = isset($_POST['beneficiaryName']) ? trim($_POST['beneficiaryName']) : '';
    $deliveryDateTime = isset($_POST['deliveryDateTime']) ? trim($_POST['deliveryDateTime']) : '';
    $deliveryType = isset($_POST['deliveryType']) ? trim($_POST['deliveryType']) : '';
    $deliveryPlace = isset($_POST['deliveryPlace']) ? trim($_POST['deliveryPlace']) : '';
    $hospitalAddress = isset($_POST['hospitalAddress']) ? trim($_POST['hospitalAddress']) : '';
    $liveBirthCount = isset($_POST['liveBirth']) ? intval($_POST['liveBirth']) : 0;
    $stillBirthCount = isset($_POST['stillBirth']) ? intval($_POST['stillBirth']) : 0;
    $confirmation = isset($_POST['confirmation']) ? true : false;
    
    // Process children data
    $childrenData = [];
    if ($liveBirthCount > 0) {
        for ($i = 1; $i <= $liveBirthCount; $i++) {
            $childId = isset($_POST["childId_$i"]) ? trim($_POST["childId_$i"]) : '';
            $sex = isset($_POST["sex_$i"]) ? trim($_POST["sex_$i"]) : '';
            $weight = isset($_POST["weight_$i"]) ? floatval($_POST["weight_$i"]) : 0;
            
            if (!empty($childId) && !empty($sex) && $weight > 0) {
                $childrenData[] = [
                    'child_id' => $childId,
                    'sex' => $sex,
                    'weight' => $weight
                ];
            }
        }
    }
    
    // Basic validation
    $errors = [];
    if (empty($rchId) || strlen($rchId) !== 12) {
        $errors[] = 'Invalid RCH ID';
    }
    if (empty($beneficiaryName)) {
        $errors[] = 'Beneficiary name is required';
    }
    if (empty($deliveryDateTime)) {
        $errors[] = 'Delivery date and time is required';
    }
    if (!in_array($deliveryType, ['NVD', 'LSCS'])) {
        $errors[] = 'Invalid delivery type';
    }
    if (!in_array($deliveryPlace, ['Government', 'Private'])) {
        $errors[] = 'Invalid delivery place';
    }
    if (empty($hospitalAddress)) {
        $errors[] = 'Hospital address is required';
    }
    if ($liveBirthCount < 0) {
        $errors[] = 'Live birth count cannot be negative';
    }
    if ($stillBirthCount < 0) {
        $errors[] = 'Still birth count cannot be negative';
    }
    if (!$confirmation) {
        $errors[] = 'You must confirm the data is correct';
    }
    
    // If no errors, insert into database
    if (empty($errors)) {
        try {
            // Prepare the statement
            $stmt = $conn->prepare("
                INSERT INTO pnc (
                    rch_id, beneficiary_name, delivery_datetime, delivery_type, 
                    delivery_place, hospital_address, live_birth_count, 
                    still_birth_count, children_data, confirmation
                ) VALUES (
                    :rch_id, :beneficiary_name, :delivery_datetime, :delivery_type, 
                    :delivery_place, :hospital_address, :live_birth_count, 
                    :still_birth_count, :children_data, :confirmation
                )
            ");
            
            // Bind parameters
            $stmt->bindParam(':rch_id', $rchId);
            $stmt->bindParam(':beneficiary_name', $beneficiaryName);
            $stmt->bindParam(':delivery_datetime', $deliveryDateTime);
            $stmt->bindParam(':delivery_type', $deliveryType);
            $stmt->bindParam(':delivery_place', $deliveryPlace);
            $stmt->bindParam(':hospital_address', $hospitalAddress);
            $stmt->bindParam(':live_birth_count', $liveBirthCount, PDO::PARAM_INT);
            $stmt->bindParam(':still_birth_count', $stillBirthCount, PDO::PARAM_INT);
            $stmt->bindParam(':children_data', json_encode($childrenData));
            $stmt->bindParam(':confirmation', $confirmation, PDO::PARAM_BOOL);
            
            // Execute the statement
            if ($stmt->execute()) {
                $success = "PNC registration successfully submitted!";
            } else {
                $errors[] = "Failed to submit PNC registration";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!-- Your existing HTML code with modifications for form handling -->

<!-- Main Section start -->
<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">REGISTER PNC</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-cardholder f-s-16"></i> PNC</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Register PNC</a>
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
                        <h5>REGISTER PNC</h5>
                        <div>
                            <p>The Register PNC feature allows user to add the PNC</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success">
                                <?php echo htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form class="app-form row g-3 needs-validation" method="POST" novalidate>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">RCH ID</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="validationCustom01" 
                                    name="rchId"
                                    value="<?php echo isset($_POST['rchId']) ? htmlspecialchars($_POST['rchId']) : ''; ?>"
                                    pattern="^[0-9]{12}$" 
                                    minlength="12" 
                                    maxlength="12" 
                                    inputmode="numeric" 
                                    placeholder="Enter 12-digit RCH ID" 
                                    required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                <div class="valid-feedback">Good!</div>
                                <div class="invalid-feedback">Please provide RCH ID.</div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Beneficiary Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="validationCustom02" 
                                    name="beneficiaryName"
                                    value="<?php echo isset($_POST['beneficiaryName']) ? htmlspecialchars($_POST['beneficiaryName']) : ''; ?>"
                                    placeholder="Enter the Beneficiary Name" 
                                    required>
                                <div class="valid-feedback">Good!</div>
                                <div class="invalid-feedback">Please provide Beneficiary Name.</div>
                            </div>

                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-info w-100">
                                    <i class="ti ti-search"></i> Search
                                </button>
                            </div>

                            <div class="col-md-4">
                                <label for="deliveryDateTime" class="form-label">Delivery Date & Time</label>
                                <input 
                                    type="datetime-local" 
                                    class="form-control" 
                                    id="deliveryDateTime" 
                                    name="deliveryDateTime"
                                    value="<?php echo isset($_POST['deliveryDateTime']) ? htmlspecialchars($_POST['deliveryDateTime']) : ''; ?>"
                                    placeholder="Enter Delivery Date & Time" 
                                    required>
                                <div class="invalid-feedback">Please provide a Delivery Date & Time.</div>
                                <div class="valid-feedback">Good!</div>
                            </div>

                            <div class="col-md-4">
                                <label for="deliveryType" class="form-label">Type of delivery</label>
                                <select class="form-select" id="deliveryType" name="deliveryType" required>
                                    <option selected disabled value="">Delivery type</option>
                                    <option value="NVD" <?php echo (isset($_POST['deliveryType']) && $_POST['deliveryType'] === 'NVD') ? 'selected' : ''; ?>>NVD</option>
                                    <option value="LSCS" <?php echo (isset($_POST['deliveryType']) && $_POST['deliveryType'] === 'LSCS') ? 'selected' : ''; ?>>LSCS</option>
                                </select>
                                <div class="invalid-feedback">Please select a delivery type.</div>
                            </div>   
                            
                            <div class="col-md-4">
                                <label for="deliveryPlace" class="form-label">Place of delivery</label>
                                <select class="form-select" id="deliveryPlace" name="deliveryPlace" required>
                                    <option selected disabled value="">Delivery place</option>
                                    <option value="Government" <?php echo (isset($_POST['deliveryPlace']) && $_POST['deliveryPlace'] === 'Government') ? 'selected' : ''; ?>>Government</option>
                                    <option value="Private" <?php echo (isset($_POST['deliveryPlace']) && $_POST['deliveryPlace'] === 'Private') ? 'selected' : ''; ?>>Private</option>
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
                                    value="<?php echo isset($_POST['hospitalAddress']) ? htmlspecialchars($_POST['hospitalAddress']) : ''; ?>"
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
                                    value="<?php echo isset($_POST['liveBirth']) ? htmlspecialchars($_POST['liveBirth']) : '0'; ?>"
                                    placeholder="Enter the number of live births"
                                    min="0" 
                                    max="9" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid live birth count (0–9).
                                </div>
                            </div>

                            <div class="row mt-3" id="dynamicFields">
                                <!-- Dynamic fields will appear here -->
                                <?php
                                if (isset($_POST['liveBirth']) && $_POST['liveBirth'] > 0) {
                                    $liveBirthCount = intval($_POST['liveBirth']);
                                    for ($i = 1; $i <= $liveBirthCount; $i++) {
                                        $childIdValue = isset($_POST["childId_$i"]) ? htmlspecialchars($_POST["childId_$i"]) : '';
                                        $sexValue = isset($_POST["sex_$i"]) ? htmlspecialchars($_POST["sex_$i"]) : '';
                                        $weightValue = isset($_POST["weight_$i"]) ? htmlspecialchars($_POST["weight_$i"]) : '';
                                        ?>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Child ID <?php echo $i; ?></label>
                                            <input 
                                                type="text" 
                                                class="form-control child-id"
                                                name="childId_<?php echo $i; ?>"
                                                value="<?php echo $childIdValue; ?>"
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
                                            <label class="form-label">Sex of Baby <?php echo $i; ?></label>
                                            <select class="form-select" name="sex_<?php echo $i; ?>" required>
                                                <option selected disabled value="">Select Sex</option>
                                                <option value="Male" <?php echo ($sexValue === 'Male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo ($sexValue === 'Female') ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                            <div class="invalid-feedback">Please select the baby's sex.</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Weight of Baby <?php echo $i; ?></label>
                                            <div class="input-group has-validation">
                                                <input 
                                                    type="number" 
                                                    step="0.001" 
                                                    min="0" 
                                                    max="10.2"
                                                    class="form-control baby-weight"
                                                    name="weight_<?php echo $i; ?>"
                                                    value="<?php echo $weightValue; ?>"
                                                    placeholder="e.g. 2.555" 
                                                    required>
                                                <span class="input-group-text">kg</span>
                                                <div class="invalid-feedback">Enter appropriate weight.</div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="stillBirth" class="form-label">Still birth</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="stillBirth" 
                                    name="stillBirth"
                                    value="<?php echo isset($_POST['stillBirth']) ? htmlspecialchars($_POST['stillBirth']) : '0'; ?>"
                                    placeholder="Enter the Still birth" 
                                    min="0" 
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid Still birth.
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check d-flex flex-wrap gap-1">
                                    <input 
                                        class="form-check-input mg-2" 
                                        type="checkbox" 
                                        id="confirmation" 
                                        name="confirmation"
                                        <?php echo (isset($_POST['confirmation'])) ? 'checked' : ''; ?>
                                        required>
                                    <label class="form-check-label" for="confirmation">
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
                                <button class="btn btn-danger w-100" type="reset">Cancel</button>
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

<!-- Your existing JavaScript code -->
<script>
  const liveBirthInput = document.getElementById('liveBirth');
  const dynamicFields = document.getElementById('dynamicFields');

  liveBirthInput.addEventListener('input', function () {
    let count = parseInt(this.value);

    // Validate the input
    if (isNaN(count) || count < 0) {
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
          <input type="text" class="form-control child-id"
            name="childId_${i}"
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
          <select class="form-select" name="sex_${i}" required>
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
              class="form-control baby-weight"
              name="weight_${i}"
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

<!-- Footer Section starts-->
<?php include 'footer.php'; ?>