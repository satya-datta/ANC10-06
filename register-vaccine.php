<?php
include 'header.php';
// Database connection (adjust credentials as needed)
$db = new mysqli('localhost', 'root', 'root', 'anc');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $child_id = $db->real_escape_string($_POST['childId']);
    $beneficiary_mother_name = $db->real_escape_string($_POST['beneficiaryMotherName']);
    
    // Prepare SQL statement
    $stmt = $db->prepare("INSERT INTO vaccines (
        child_id, beneficiary_mother_name, bcg_date, opv0_date, hep_b0_date,
        penta1_date, opv1_date, rota1_date, ipv1_date, pcv1_date,
        penta2_date, opv2_date, rota2_date, penta3_date, opv3_date,
        rota3_date, ipv2_date, pcv2_date, mr1_date, pcv_booster_date,
        vita1_date, ipv_booster_date, mr2_date, opv_booster_date, dpt_booster_date,
        vita2_date, vita3_date, vita4_date, vita5_date, vita6_date,
        vita7_date, vita8_date, td_5yr_date, vita9_date, tt_10yr_date, tt_16yr_date
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssssssssssssssssssssssssssssssssss", 
        $child_id, $beneficiary_mother_name,
        $_POST['BCG Date'], $_POST['0 OPV Date'], $_POST['0 HEP B Date'],
        $_POST['PENTA-1 Date'], $_POST['OPV-1 Date'], $_POST['ROTA Date'], $_POST['IPV-1 Date'], $_POST['PCV Date'],
        $_POST['PENTA-2 Date'], $_POST['OPV-2 Date'], $_POST['ROTA-2 Date'], $_POST['PENTA-3 Date'], $_POST['OPV-3 Date'],
        $_POST['ROTA-3 Date'], $_POST['IPV-2 Date'], $_POST['PCV-2 Date'], $_POST['MR-1 Date'], $_POST['PCV Booster Date'],
        $_POST['VIT-A 1st Dose'], $_POST['IPV Booster Date'], $_POST['MR-2 Date'], $_POST['OPV Booster Date'], $_POST['DPT Booster Date'],
        $_POST['VIT-A 2nd Dose'], $_POST['VIT-A 3rd Dose'], $_POST['VIT-A 4th Dose'], $_POST['VIT-A 5th Dose'], $_POST['VIT-A 6th Dose'],
        $_POST['VIT-A 7th Dose'], $_POST['VIT-A 8th Dose'], $_POST['TD - 5 YR'], $_POST['VIT-A 9th Dose'], $_POST['TT - 10 YR'], $_POST['TT - 16 YR']
    );
    
    // Execute statement
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Vaccine record saved successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error saving record: ' . $stmt->error . '</div>';
    }
    
    $stmt->close();
}

$db->close();
?>

<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">

        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">REGISTER VACCINE</h4>
                <ul class="app-line-breadcrumbs mb-3">[]
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-cardholder f-s-16"></i>  Vaccine
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Register Vaccine</a>
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
                        <h5>REGISTER VACCINE</h5>
                        <div>
                            <p> The Register Vaccine feature allows user to add the Vaccine 
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                       <form class="app-form row g-3 needs-validation" method="POST" novalidate>
                                                <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Child ID</label>
                                <input 
                                        type="text" 
                                        class="form-control" 
                                        id="validationCustom01" 
                                        name="childId"
                                        pattern="^[0-9]{12}$" 
                                        minlength="12" 
                                        maxlength="12" 
                                        inputmode="numeric" 
                                        placeholder="Enter 12-digit Child ID" 
                                        required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                                <div class="valid-feedback">
                                     Good!
                                </div>
                                <div class="invalid-feedback">
                                                    Please provide Child ID.
                                </div>
                            </div>
                      
    <!-- Input Field -->
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Beneficiary Mother Name</label>
      <input type="text" class="form-control" id="validationCustom02" name="beneficiaryMotherName" placeholder="Enter the Beneficiary Mother Name" required>     <div class="valid-feedback">
            Good!
        </div>
        <div class="invalid-feedback">
            Please provide Beneficiary Mother Name.
        </div>
    </div>

    <!-- Search Button (same height as input) -->
    <div class="col-md-4 d-flex align-items-end">
        <button type="button" class="btn btn-outline-info w-100">
            <i class="ti ti-search"></i> Search
        </button>
    </div>


<div class="col-md-4">
  <label for="bcg-date" class="form-label">BCG Date</label>
  <input 
    type="date" 
    class="form-control" 
    id="bcg-date" 
    name="BCG Date"
    placeholder="Enter BCG Date" 
    required>
  <div class="invalid-feedback">Please provide a valid BCG date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- OPV -->
<div class="col-md-4">
  <label for="opv-date" class="form-label">0 OPV Date</label>
  <input type="date" class="form-control" id="opv-date" name="0 OPV Date" placeholder="Enter 0 OPV Date" required>
  <div class="invalid-feedback">Please provide a valid 0 OPV date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- HEP -->
<div class="col-md-4">
  <label for="hep-date" class="form-label">0 HEP B Date</label>
  <input type="date" class="form-control" id="hep-date" name="0 HEP B Date" placeholder="Enter 0 HEP B Date" required>
  <div class="invalid-feedback">Please provide a valid 0 HEP B date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<script>
  document.getElementById('bcg-date').addEventListener('change', function () {
    const bcgDate = this.value;

    const opvDateField = document.getElementById('opv-date');
    const hepDateField = document.getElementById('hep-date');

    // Only set the value if the field is empty
    if (!opvDateField.value) {
      opvDateField.value = bcgDate;
    }
    if (!hepDateField.value) {
      hepDateField.value = bcgDate;
    }
  });
</script>

 



  
 <!-- PENTA-1 -->
<div class="col-md-4">
  <label for="penta1-date" class="form-label">PENTA-1 Date</label>
  <input type="date" class="form-control" id="penta1-date" name="PENTA-1 Date" placeholder="Enter PENTA-1 Date" required>
  <div class="invalid-feedback">Please provide a valid PENTA-1 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- OPV-1 -->
<div class="col-md-4">
  <label for="opv1-date" class="form-label">OPV-1 Date</label>
  <input type="date" class="form-control" id="opv1-date" name="OPV-1 Date" placeholder="Enter OPV-1 Date" required>
  <div class="invalid-feedback">Please provide a valid OPV-1 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- ROTA-1 -->
<div class="col-md-4">
  <label for="rota-date" class="form-label">ROTA-1 Date</label>
  <input type="date" class="form-control" id="rota-date" name="ROTA Date" placeholder="Enter ROTA-1 Date" required>
  <div class="invalid-feedback">Please provide a valid ROTA-1 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- IPV-1 -->
<div class="col-md-4">
  <label for="ipv1-date" class="form-label">IPV-1 Date</label>
  <input type="date" class="form-control" id="ipv1-date" name="IPV-1 Date" placeholder="Enter IPV-1 Date" required>
  <div class="invalid-feedback">Please provide a valid IPV-1 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- PCV-1 -->
<div class="col-md-4">
  <label for="pcv1-date" class="form-label">PCV-1 Date</label>
  <input type="date" class="form-control" id="pcv1-date" name="PCV Date" placeholder="Enter PCV-1 Date" required>
  <div class="invalid-feedback">Please provide a valid PCV-1 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- JavaScript to auto-fill dates -->
<script>
  document.getElementById('penta1-date').addEventListener('change', function () {
    const pentaDate = this.value;

    const fieldsToUpdate = ['opv1-date', 'rota-date', 'ipv1-date', 'pcv1-date'];

    fieldsToUpdate.forEach(id => {
      const field = document.getElementById(id);
      if (!field.value) {
        field.value = pentaDate;
      }
    });
  });
</script>





 <!-- PENTA-2 -->
<div class="col-md-4">
  <label for="penta2-date" class="form-label">PENTA-2 Date</label>
  <input type="date" class="form-control" id="penta2-date" name="PENTA-2 Date" placeholder="Enter PENTA-2 Date" required>
  <div class="invalid-feedback">Please provide a valid PENTA-2 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- OPV-2 -->
<div class="col-md-4">
  <label for="opv2-date" class="form-label">OPV-2 Date</label>
  <input type="date" class="form-control" id="opv2-date" name="OPV-2 Date" placeholder="Enter OPV-2 Date" required>
  <div class="invalid-feedback">Please provide a valid OPV-2 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- ROTA-2 -->
<div class="col-md-4">
  <label for="rota2-date" class="form-label">ROTA-2 Date</label>
  <input type="date" class="form-control" id="rota2-date" name="ROTA-2 Date" placeholder="Enter ROTA-2 Date" required>
  <div class="invalid-feedback">Please provide a valid ROTA-2 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- JavaScript for auto-filling -->
<script>
  document.getElementById('penta2-date').addEventListener('change', function () {
    const penta2Date = this.value;

    const relatedFields = ['opv2-date', 'rota2-date'];

    relatedFields.forEach(id => {
      const field = document.getElementById(id);
      if (!field.value) {
        field.value = penta2Date;
      }
    });
  });
</script>





 <!-- PENTA-3 -->
<div class="col-md-4">
  <label for="penta3-date" class="form-label">PENTA-3 Date</label>
  <input type="date" class="form-control" id="penta3-date" name="PENTA-3 Date" placeholder="Enter PENTA-3 Date" required>
  <div class="invalid-feedback">Please provide a valid PENTA-3 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- OPV-3 -->
<div class="col-md-4">
  <label for="opv3-date" class="form-label">OPV-3 Date</label>
  <input type="date" class="form-control" id="opv3-date" name="OPV-3 Date" placeholder="Enter OPV-3 Date" required>
  <div class="invalid-feedback">Please provide a valid OPV-3 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- ROTA-3 -->
<div class="col-md-4">
  <label for="rota3-date" class="form-label">ROTA-3 Date</label>
  <input type="date" class="form-control" id="rota3-date" name="ROTA-3 Date" placeholder="Enter ROTA-3 Date" required>
  <div class="invalid-feedback">Please provide a valid ROTA-3 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- IPV-2 -->
<div class="col-md-4">
  <label for="ipv2-date" class="form-label">IPV-2 Date</label>
  <input type="date" class="form-control" id="ipv2-date" name="IPV-2 Date" placeholder="Enter IPV-2 Date" required>
  <div class="invalid-feedback">Please provide a valid IPV-2 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- PCV-2 -->
<div class="col-md-4">
  <label for="pcv2-date" class="form-label">PCV-2 Date</label>
  <input type="date" class="form-control" id="pcv2-date" name="PCV-2 Date" placeholder="Enter PCV-2 Date" required>
  <div class="invalid-feedback">Please provide a valid PCV-2 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- JavaScript to auto-fill PENTA-3 date -->
<script>
  document.getElementById('penta3-date').addEventListener('change', function () {
    const penta3Date = this.value;

    const autoFillFields = ['opv3-date', 'rota3-date', 'ipv2-date', 'pcv2-date'];

    autoFillFields.forEach(id => {
      const field = document.getElementById(id);
      if (!field.value) {
        field.value = penta3Date;
      }
    });
  });
</script>





<!-- MR-1 -->
<div class="col-md-4">
  <label for="mr1-date" class="form-label">MR-1 Date</label>
  <input type="date" class="form-control" id="mr1-date" name="MR-1 Date" placeholder="Enter MR-1 Date" required>
  <div class="invalid-feedback">Please provide a valid MR-1 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- PCV Booster -->
<div class="col-md-4">
  <label for="pcvbooster-date" class="form-label">PCV Booster Date</label>
  <input type="date" class="form-control" id="pcvbooster-date" name="PCV Booster Date" placeholder="Enter PCV Booster Date" required>
  <div class="invalid-feedback">Please provide a valid PCV Booster date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 1st Dose -->
<div class="col-md-4">
  <label for="vita1-date" class="form-label">VIT-A 1st Dose Date</label>
  <input type="date" class="form-control" id="vita1-date" name="VIT-A 1st Dose" placeholder="Enter VIT-A 1st Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 1st Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- IPV Booster -->
<div class="col-md-4">
  <label for="ipvbooster-date" class="form-label">IPV Booster Date</label>
  <input type="date" class="form-control" id="ipvbooster-date" name="IPV Booster Date" placeholder="Enter IPV Booster Date" required>
  <div class="invalid-feedback">Please provide a valid IPV Booster date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<script>
  document.getElementById('mr1-date').addEventListener('change', function () {
    const mr1Date = this.value;

    const relatedDates = ['pcvbooster-date', 'vita1-date', 'ipvbooster-date'];

    relatedDates.forEach(id => {
      const input = document.getElementById(id);
      if (!input.value) {
        input.value = mr1Date;
      }
    });
  });
</script>




<!-- MR-2 -->
<div class="col-md-4">
  <label for="mr2-date" class="form-label">MR-2 Date</label>
  <input type="date" class="form-control" id="mr2-date" name="MR-2 Date" placeholder="Enter MR-2 Date" required>
  <div class="invalid-feedback">Please provide a valid MR-2 date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- OPV Booster -->
<div class="col-md-4">
  <label for="opvbooster-date" class="form-label">OPV Booster Date</label>
  <input type="date" class="form-control" id="opvbooster-date" name="OPV Booster Date" placeholder="Enter OPV Booster Date" required>
  <div class="invalid-feedback">Please provide a valid OPV Booster date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- DPT Booster -->
<div class="col-md-4">
  <label for="dptbooster-date" class="form-label">DPT Booster Date</label>
  <input type="date" class="form-control" id="dptbooster-date" name="DPT Booster Date" placeholder="Enter DPT Booster Date" required>
  <div class="invalid-feedback">Please provide a valid DPT Booster date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<script>
  document.getElementById('mr2-date').addEventListener('change', function () {
    const mr2Date = this.value;

    const relatedDates = ['opvbooster-date', 'dptbooster-date'];

    relatedDates.forEach(id => {
      const input = document.getElementById(id);
      if (!input.value) {
        input.value = mr2Date;
      }
    });
  });
</script>




<!-- VIT-A 2nd Dose -->
<div class="col-md-4">
  <label for="vita2-date" class="form-label">VIT-A 2nd Dose Date</label>
  <input type="date" class="form-control" id="vita2-date" name="VIT-A 2nd Dose" placeholder="Enter VIT-A 2nd Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 2nd Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 3rd Dose -->
<div class="col-md-4">
  <label for="vita3-date" class="form-label">VIT-A 3rd Dose Date</label>
  <input type="date" class="form-control" id="vita3-date" name="VIT-A 3rd Dose" placeholder="Enter VIT-A 3rd Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 3rd Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 4th Dose -->
<div class="col-md-4">
  <label for="vita4-date" class="form-label">VIT-A 4th Dose Date</label>
  <input type="date" class="form-control" id="vita4-date" name="VIT-A 4th Dose" placeholder="Enter VIT-A 4th Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 4th Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 5th Dose -->
<div class="col-md-4">
  <label for="vita5-date" class="form-label">VIT-A 5th Dose Date</label>
  <input type="date" class="form-control" id="vita5-date" name="VIT-A 5th Dose" placeholder="Enter VIT-A 5th Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 5th Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 6th Dose -->
<div class="col-md-4">
  <label for="vita6-date" class="form-label">VIT-A 6th Dose Date</label>
  <input type="date" class="form-control" id="vita6-date" name="VIT-A 6th Dose" placeholder="Enter VIT-A 6th Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 6th Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 7th Dose -->
<div class="col-md-4">
  <label for="vita7-date" class="form-label">VIT-A 7th Dose Date</label>
  <input type="date" class="form-control" id="vita7-date" name="VIT-A 7th Dose" placeholder="Enter VIT-A 7th Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 7th Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 8th Dose -->
<div class="col-md-4">
  <label for="vita8-date" class="form-label">VIT-A 8th Dose Date</label>
  <input type="date" class="form-control" id="vita8-date" name="VIT-A 8th Dose" placeholder="Enter VIT-A 8th Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 8th Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>



<!-- TD - 5 YR -->
<div class="col-md-4">
  <label for="td5yr-date" class="form-label">TD - 5 YR Date</label>
  <input type="date" class="form-control" id="td5yr-date" name="TD - 5 YR" placeholder="Enter TD - 5 YR Date" required>
  <div class="invalid-feedback">Please provide a valid TD - 5 YR date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- VIT-A 9th Dose -->
<div class="col-md-4">
  <label for="vita9-date" class="form-label">VIT-A 9th Dose Date</label>
  <input type="date" class="form-control" id="vita9-date" name="VIT-A 9th Dose" placeholder="Enter VIT-A 9th Dose Date" required>
  <div class="invalid-feedback">Please provide a valid VIT-A 9th Dose date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<script>
  document.getElementById('td5yr-date').addEventListener('change', function () {
    const tdDate = this.value;
    const vita9Input = document.getElementById('vita9-date');

    if (!vita9Input.value) {
      vita9Input.value = tdDate;
    }
  });
</script>


<!-- TT - 10 YR -->
<div class="col-md-4">
  <label for="tt10yr-date" class="form-label">TT - 10 YR Date</label>
  <input type="date" class="form-control" id="tt10yr-date" name="TT - 10 YR" placeholder="Enter TT - 10 YR Date" required>
  <div class="invalid-feedback">Please provide a valid TT - 10 YR date.</div>
  <div class="valid-feedback">Good!</div>
</div>

<!-- TT - 16 YR -->
<div class="col-md-4">
  <label for="tt16yr-date" class="form-label">TT - 16 YR Date</label>
  <input type="date" class="form-control" id="tt16yr-date" name="TT - 16 YR" placeholder="Enter TT - 16 YR Date" required>
  <div class="invalid-feedback">Please provide a valid TT - 16 YR date.</div>
  <div class="valid-feedback">Good!</div>
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
                            <button class="btn btn-danger w-100" type="button">Cancel</button>
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