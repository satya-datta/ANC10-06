<?php include 'header.php'; ?>

<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">

        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">TEST REVISE</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-test.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-cardholder f-s-16"></i>  Test
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Test Revise</a>
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
                        <h5>TEST REVISE</h5>
                        <div>
                            <p> The Test Revise feature allows user to update the existing test for beneficiary 
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="app-form row g-3 needs-validation" novalidate>
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
        <input disabled type="text" class="form-control" id="validationCustom02" placeholder="Enter the Beneficiary Name" required>
        <div class="valid-feedback">
            Good!
        </div>
        <div class="invalid-feedback">
            Please provide Beneficiary Name.
        </div>
    </div>

    <!-- Search Button (same height as input) -->
    <div class="col-md-4 d-flex align-items-end">
        <button type="button" class="btn btn-outline-info w-100">
            <i class="ti ti-edit"></i> Tap to update
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


<script>
  ['calcium-value', 'ifa-value', 'albandozole-value'].forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener('input', (e) => {
        let val = e.target.value;
        // Limit input length to 3 digits
        if (val.length > 3) {
          e.target.value = val.slice(0, 3);
          val = e.target.value;
        }
        // Ensure max value 999
        if (+val > 999) {
          e.target.value = '999';
        }
        // Optional: prevent negative values (if needed)
        if (+val < 0) {
          e.target.value = '0';
        }
      });
    }
  });
</script>

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

<script>
document.getElementById('tb-screening-result').addEventListener('change', function() {
    const referBox = document.getElementById('refer-box');
    const referInput = document.getElementById('tb-screening-value');
    if (this.value === 'Refer') {
        referBox.style.display = 'block';
        referInput.required = true;
    } else {
        referBox.style.display = 'none';
        referInput.required = false;
        referInput.value = ''; // Clear value when hidden
    }
});
</script>


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

<script>
  const hbFields = ['hb-1-value', 'hb-2-value', 'hb-3-value', 'hb-4-value'];

  hbFields.forEach(id => {
    const input = document.getElementById(id);

    input.addEventListener('input', (e) => {
      let val = e.target.value;

      // Allow only digits and optional single dot
      if (!/^\d*\.?\d*$/.test(val)) {
        e.target.value = val.slice(0, -1);
        return;
      }

      // Split into parts
      const [intPart, decPart] = val.split(".");

      if (intPart && intPart.length > 2) {
        e.target.value = intPart.slice(0, 2) + (decPart !== undefined ? "." + (decPart || "") : "");
        return;
      }

      if (decPart && decPart.length > 2) {
        e.target.value = intPart + "." + decPart.slice(0, 2);
        return;
      }
    });

    input.addEventListener('blur', (e) => {
      const val = parseFloat(e.target.value);
      if (!isNaN(val)) {
        if (val < 4 || val > 15.5) {
          e.target.setCustomValidity("HB must be between 4.00 and 15.50 g/dL.");
        } else {
          e.target.setCustomValidity("");
        }
      } else {
        e.target.setCustomValidity("Please enter a valid HB value.");
      }
    });
  });
</script>




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
<script>
  const scanInput = document.getElementById("fectal-scan-value");

  scanInput.addEventListener("input", (e) => {
    let val = e.target.value;

    // Remove negative signs and limit to single digit
    if (val.length > 1 || parseInt(val) < 0) {
      e.target.value = val.slice(0, 1).replace("-", "");
    }
  });

  scanInput.addEventListener("blur", (e) => {
    const val = parseInt(e.target.value);
    if (isNaN(val) || val < 0 || val > 9) {
      e.target.setCustomValidity("Enter a single-digit value between 0 and 9.");
    } else {
      e.target.setCustomValidity("");
    }
  });
</script>


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
<script>
  const ogttInput = document.getElementById("ogtt-value");

  ogttInput.addEventListener("input", function () {
    let val = this.value;

    // Remove negative signs
    if (val < 0) this.value = "";

    // Limit to 3 digits
    if (val.length > 3) {
      this.value = val.slice(0, 3);
    }
  });

  ogttInput.addEventListener("blur", function () {
    const val = parseInt(this.value);
    if (isNaN(val) || val < 0 || val > 999) {
      this.setCustomValidity("Enter a valid 3-digit OGTT value (0–999).");
    } else {
      this.setCustomValidity("");
    }
  });
</script>



<div class="col-md-4">
  <label for="test-count" class="form-label">Number of Tests Done (max 5)</label>
  <input type="number" id="test-count" name="test-count" min="1" max="5" class="form-control" placeholder="Enter number of tests" required>
</div>
<div id="test-container" class="mt-3"></div>


<script>
  const testCountInput = document.getElementById('test-count');
  const testContainer = document.getElementById('test-container');
  const testOptions = ['VDRL', 'RPR', 'TPHA', 'RDT', 'POC'];

  function createTestSelect(i, excludedOptions) {
    // Create options excluding excludedOptions completely
    let optionsHtml = `<option value="" disabled selected>Select Test</option>`;
    for (const opt of testOptions) {
      if (!excludedOptions.includes(opt)) {
        optionsHtml += `<option value="${opt}">${opt}</option>`;
      }
    }

    return `
      <label for="test-name-${i}" class="form-label">Test ${i} Name</label>
      <select id="test-name-${i}" name="test-name-${i}" class="form-select" required>
        ${optionsHtml}
      </select>
      <div class="invalid-feedback">Please select a test name.</div>
    `;
  }

  function updateTestSelects() {
    const count = parseInt(testCountInput.value) || 0;
    testContainer.innerHTML = '';

    // Track selected test names in order
    const selectedTests = [];

    for (let i = 1; i <= count; i++) {
      // Options to exclude for this select are all previously selected tests
      const excludedOptions = selectedTests.slice();

      const testDiv = document.createElement('div');
      testDiv.classList.add('row', 'mb-3');

      // Create test name select div with filtered options
      const testNameDiv = document.createElement('div');
      testNameDiv.classList.add('col-md-4');
      testNameDiv.innerHTML = createTestSelect(i, excludedOptions);

      // Test Date Input
      const testDateDiv = document.createElement('div');
      testDateDiv.classList.add('col-md-4');
      testDateDiv.innerHTML = `
        <label for="test-date-${i}" class="form-label">Test ${i} Date</label>
        <input type="date" id="test-date-${i}" name="test-date-${i}" class="form-control" required>
        <div class="invalid-feedback">Please provide a valid test date.</div>
      `;

      // Test Result Input
      const testResultDiv = document.createElement('div');
      testResultDiv.classList.add('col-md-4');
      testResultDiv.innerHTML = `
        <label for="test-result-${i}" class="form-label">Test ${i} Result</label>
        <input type="text" id="test-result-${i}" name="test-result-${i}" class="form-control" placeholder="Enter result" required>
        <div class="invalid-feedback">Please provide a test result.</div>
      `;

      testDiv.appendChild(testNameDiv);
      testDiv.appendChild(testDateDiv);
      testDiv.appendChild(testResultDiv);

      testContainer.appendChild(testDiv);

      // After adding this select, attach event listener to update selects on change
      const testNameSelect = testNameDiv.querySelector('select');
      testNameSelect.addEventListener('change', () => {
        refreshSelects();
      });

      // Initially no selection, so nothing to add to selectedTests yet
    }
  }

  function refreshSelects() {
    // Gather all selects
    const selects = testContainer.querySelectorAll('select');

    // Collect selected values in order
    const selectedValues = [];
    selects.forEach(sel => {
      if (sel.value) selectedValues.push(sel.value);
      else selectedValues.push(null);
    });

    // For each select, rebuild its options excluding selected values from earlier selects
    selects.forEach((sel, index) => {
      const currentValue = sel.value;
      const excludedOptions = selectedValues.slice(0, index).filter(v => v !== null);

      // Rebuild options HTML
      let optionsHtml = `<option value="" disabled>Select Test</option>`;
      for (const opt of testOptions) {
        // Include option only if not in excludedOptions OR is current value
        if (!excludedOptions.includes(opt) || opt === currentValue) {
          const selectedAttr = (opt === currentValue) ? 'selected' : '';
          optionsHtml += `<option value="${opt}" ${selectedAttr}>${opt}</option>`;
        }
      }

      sel.innerHTML = optionsHtml;
    });
  }

  testCountInput.addEventListener('input', () => {
    let count = parseInt(testCountInput.value) || 0;
    if (count > 5) {
      count = 5;
      testCountInput.value = 5;
    }
    updateTestSelects();
  });
</script>


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

<script>
    const abortionSelect = document.getElementById("abortion-select");
    const abortionStatusContainer = document.getElementById("abortion-status-container");
    const abortionStatus = document.getElementById("abortion-status");

    abortionSelect.addEventListener("change", () => {
        if (abortionSelect.value === "Yes") {
            abortionStatusContainer.style.display = "block";
            abortionStatus.setAttribute("required", "required");
        } else {
            abortionStatusContainer.style.display = "none";
            abortionStatus.removeAttribute("required");
            abortionStatus.value = "";
        }
    });
</script>









                        
                            





                            <div class="col-12">
                         
                            </div>
                        
                            <div class="col-md-3 me-2">
                            <button class="btn btn-success w-100" type="submit">Update</button>
                            </div>
                            <div class="col-md-2">
                            <button class="btn btn-danger w-100" type="cancel">Cancel</button>
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