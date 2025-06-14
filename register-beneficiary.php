<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection and processing logic
require_once 'db.php';
$success_message = '';
$error_message = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate required fields first
        $required_fields = ['rch_id', 'beneficiary_name', 'husband_name', 'age', 
                          'gravida', 'para', 'register_date', 'lmp', 'street', 'city', 'pincode'];
        
        $missing_fields = [];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $missing_fields[] = $field;
            }
        }
        
        if (!empty($missing_fields)) {
            throw new Exception("Please fill in all required fields: " . implode(', ', $missing_fields));
        }

        // Validate PARA <= GRAVIDA
        if ($_POST['para'] > $_POST['gravida']) {
            throw new Exception("PARA value cannot be greater than GRAVIDA");
        }

        // Validate dates
        $register_date = date('Y-m-d', strtotime($_POST['register_date']));
        $lmp = date('Y-m-d', strtotime($_POST['lmp']));
        $edd = date('Y-m-d', strtotime($_POST['edd']));

        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $conn->prepare("
            INSERT INTO beneficiaries (
                rch_id, beneficiary_name, husband_name, age, gravida, para,
                register_date, lmp, edd, street, city, pincode, data_confirmed
            ) VALUES (
                :rch_id, :beneficiary_name, :husband_name, :age, :gravida, :para,
                :register_date, :lmp, :edd, :street, :city, :pincode, :data_confirmed
            )
        ");

        // Bind parameters
        $stmt->bindParam(':rch_id', $_POST['rch_id']);
        $stmt->bindParam(':beneficiary_name', $_POST['beneficiary_name']);
        $stmt->bindParam(':husband_name', $_POST['husband_name']);
        $stmt->bindParam(':age', $_POST['age']);
        $stmt->bindParam(':gravida', $_POST['gravida']);
        $stmt->bindParam(':para', $_POST['para']);
        $stmt->bindParam(':register_date', $register_date);
        $stmt->bindParam(':lmp', $lmp);
        $stmt->bindParam(':edd', $edd);
        $stmt->bindParam(':street', $_POST['street']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':pincode', $_POST['pincode']);
        $data_confirmed = isset($_POST['data_confirmed']) ? 1 : 0;
        $stmt->bindParam(':data_confirmed', $data_confirmed);

        // Execute the statement
        if ($stmt->execute()) {
            $success_message = "Beneficiary record has been successfully added!";
            // Clear POST array to show empty form
            $_POST = array();
            
            // Add JavaScript to clear the form
            echo '<script>document.getElementById("beneficiaryForm").reset();</script>';
        } else {
            $error_message = "Error: Failed to execute the query";
        }
        
    } catch(PDOException $e) {
        $error_message = "Database Error: " . $e->getMessage();
    } catch(Exception $e) {
        $error_message = $e->getMessage();
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
                <h4 class="main-title">REGISTER BENEFICIARY</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-cardholder f-s-16"></i>  Beneficiary
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Register Beneficiary </a>
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
                        <h5>REGISTER BENEFICIARY</h5>
                        <div>
                            <p> The Register Beneficiary feature allows user to add the beneficiary 
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>
                      <form class="app-form row g-3 needs-validation" method="POST" novalidate id="beneficiaryForm">

                                    <!-- RCH ID -->
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="form-label">RCH ID</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="rch_id"
                                               value="<?php echo isset($_POST['rch_id']) ? htmlspecialchars($_POST['rch_id']) : ''; ?>"
                                               pattern="^[0-9]{12}$" minlength="12" maxlength="12" inputmode="numeric"
                                               placeholder="Enter 12-digit RCH ID" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        <div class="valid-feedback">Good!</div>
                                        <div class="invalid-feedback">Please provide RCH ID.</div>
                                    </div>

                                    <!-- Beneficiary Name -->
                                    <div class="col-md-4">
                                        <label for="validationCustom02" class="form-label">Beneficiary Name</label>
                                        <input type="text" class="form-control" id="validationCustom02" name="beneficiary_name"
                                               value="<?php echo isset($_POST['beneficiary_name']) ? htmlspecialchars($_POST['beneficiary_name']) : ''; ?>"
                                               placeholder="Enter the Beneficiary Name" required>
                                        <div class="valid-feedback">Good!</div>
                                        <div class="invalid-feedback">Please provide Beneficiary Name.</div>
                                    </div>

                                    <!-- Husband Name -->
                                    <div class="col-md-4">
                                        <label for="validationCustom03" class="form-label">Husband Name</label>
                                        <input type="text" class="form-control" id="validationCustom03" name="husband_name"
                                               value="<?php echo isset($_POST['husband_name']) ? htmlspecialchars($_POST['husband_name']) : ''; ?>"
                                               placeholder="Enter the Husband Name" required>
                                        <div class="valid-feedback">Good!</div>
                                        <div class="invalid-feedback">Please provide Husband Name.</div>
                                    </div>

                                    <!-- Age -->
                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="validationCustom04" name="age"
                                               value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>"
                                               placeholder="Enter age" pattern="^\d{2}$" maxlength="2"
                                               inputmode="numeric" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        <div class="invalid-feedback">Please provide a valid Age.</div>
                                        <div class="valid-feedback">Good!</div>
                                    </div>

                                    <!-- Gravida -->
                                    <div class="col-md-4">
                                        <label for="gravidaInput" class="form-label">GRAVIDA</label>
                                        <input type="text" class="form-control" id="gravidaInput" name="gravida"
                                               value="<?php echo isset($_POST['gravida']) ? htmlspecialchars($_POST['gravida']) : ''; ?>"
                                               placeholder="Enter Gravida" inputmode="numeric" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, ''); validatePara();">
                                        <div class="invalid-feedback">Please provide Gravida.</div>
                                        <div class="valid-feedback">Good!</div>
                                    </div>

                                    <!-- Para -->
                                    <div class="col-md-4">
                                        <label for="paraInput" class="form-label">PARA</label>
                                        <input type="text" class="form-control" id="paraInput" name="para"
                                               value="<?php echo isset($_POST['para']) ? htmlspecialchars($_POST['para']) : ''; ?>"
                                               placeholder="Enter PARA" inputmode="numeric" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, ''); validatePara();">
                                        <div class="invalid-feedback" id="paraError">
                                            Please provide PARA (must be less than or equal to GRAVIDA).
                                        </div>
                                        <div class="valid-feedback">Good!</div>
                                    </div>

                                    <!-- Register Date -->
                                    <div class="col-md-4">
                                        <label for="registerDate" class="form-label">Register Date</label>
                                        <input type="date" class="form-control" id="registerDate" name="register_date"
                                               value="<?php echo isset($_POST['register_date']) ? htmlspecialchars($_POST['register_date']) : ''; ?>"
                                               required>
                                        <div class="invalid-feedback">Please provide a valid Register date.</div>
                                        <div class="valid-feedback">Good!</div>
                                    </div>

                                    <!-- LMP -->
                                    <div class="col-md-4">
                                        <label for="lmpDate" class="form-label">LMP</label>
                                        <input type="date" class="form-control" id="lmpDate" name="lmp"
                                               value="<?php echo isset($_POST['lmp']) ? htmlspecialchars($_POST['lmp']) : ''; ?>"
                                               required onchange="calculateEDD()">
                                        <div class="invalid-feedback">Please provide a valid LMP date.</div>
                                        <div class="valid-feedback">Good!</div>
                                    </div>

                                    <!-- EDD -->
                                    <div class="col-md-4">
                                        <label for="eddDate" class="form-label">EDD</label>
                                        <input type="date" class="form-control" id="eddDate" name="edd"
                                               value="<?php echo isset($_POST['edd']) ? htmlspecialchars($_POST['edd']) : ''; ?>"
                                               required readonly>
                                        <div class="invalid-feedback">Please provide a valid EDD date.</div>
                                        <div class="valid-feedback">Good!</div>
                                    </div>

                                    <!-- Street -->
                                    <div class="col-md-6">
                                        <label for="streetAddress" class="form-label">Street</label>
                                        <input type="text" class="form-control" id="streetAddress" name="street"
                                               value="<?php echo isset($_POST['street']) ? htmlspecialchars($_POST['street']) : ''; ?>"
                                               placeholder="Enter the street" required>
                                        <div class="invalid-feedback">Please provide a valid Street.</div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-3">
                                        <label for="citySelect" class="form-label">City</label>
                                        <select class="form-select" id="citySelect" name="city" required>
                                            <option value="" disabled <?php echo !isset($_POST['city']) ? 'selected' : ''; ?>>Choose...</option>
                                            <option value="City1" <?php echo (isset($_POST['city']) && $_POST['city'] == 'City1') ? 'selected' : ''; ?>>City 1</option>
                                            <option value="City2" <?php echo (isset($_POST['city']) && $_POST['city'] == 'City2') ? 'selected' : ''; ?>>City 2</option>
                                            <option value="City3" <?php echo (isset($_POST['city']) && $_POST['city'] == 'City3') ? 'selected' : ''; ?>>City 3</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid City.</div>
                                    </div>

                                    <!-- Pincode -->
                                    <div class="col-md-3">
                                        <label for="pincodeInput" class="form-label">Pincode</label>
                                        <input type="text" class="form-control" id="pincodeInput" name="pincode"
                                               value="<?php echo isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : ''; ?>"
                                               placeholder="Enter Pincode" pattern="^\d{6}$" minlength="6"
                                               maxlength="6" inputmode="numeric" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        <div class="invalid-feedback">Please provide a valid Pincode.</div>
                                    </div>

                                    <!-- Data Confirmation -->
                                    <div class="col-12">
                                        <div class="form-check d-flex flex-wrap gap-1">
                                            <input class="form-check-input mg-2" type="checkbox" name="data_confirmed" 
                                                   id="invalidCheck" required value="1"
                                                   <?php echo isset($_POST['data_confirmed']) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="invalidCheck">
                                                I confirm that the entered data is correct.
                                            </label>
                                            <div class="invalid-feedback">
                                                You must confirm before submitting.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit and Cancel Buttons -->
                                    <div class="col-md-2 me-2">
                                        <button class="btn btn-success w-100" type="submit">Submit</button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="listbeneficiary.php" class="btn btn-danger w-100">Cancel</a>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
            <!-- Custom Styles end -->
            
        </div>
        <script>
        function calculateEDD() {
            const lmpInput = document.getElementById('lmpDate');
            const eddInput = document.getElementById('eddDate');

            if (lmpInput.value) {
                const lmpDate = new Date(lmpInput.value);
                lmpDate.setDate(lmpDate.getDate() + 280); // Add 280 days (40 weeks)
                const edd = lmpDate.toISOString().split('T')[0];
                eddInput.value = edd;
            }
        }

        function validatePara() {
            const gravida = parseInt(document.getElementById("gravidaInput").value) || 0;
            const paraInput = document.getElementById("paraInput");
            const para = parseInt(paraInput.value) || 0;
            const feedback = document.getElementById("paraError");

            if (para > gravida) {
                paraInput.setCustomValidity("PARA must be less than or equal to GRAVIDA");
                feedback.style.display = "block";
            } else {
                paraInput.setCustomValidity("");
                feedback.style.display = "none";
            }
        }
    </script>
        <!-- Form Validation end -->

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