<?php
include 'db.php'; // this is your PDO-based connection

if (!isset($_GET['id'])) {
    die("No beneficiary ID provided.");
}

$id = intval($_GET['id']);

try {
    $stmt = $conn->prepare("SELECT * FROM beneficiaries WHERE id = ?");
    $stmt->execute([$id]);
    $beneficiary = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$beneficiary) {
        die("Beneficiary not found.");
    }
} catch (PDOException $e) {
    die("Error fetching beneficiary: " . $e->getMessage());
}
?>

<?php include 'header.php'; ?>


<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
       <main>
            
                <div class="container-fluid ">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">BENEFICIARY DETAILS</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="beneficiary-management.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-stack f-s-16"></i>Beneficiary
                      </span>
                        </a>
                    </li>
                     <li class="">
                        <a href="beneficiary-management.html" class="f-s-14 f-w-500">
                            Manage Beneficiary
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Beneficiary Details</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb start -->
    </div>

    <!-- Invoice start -->
    <div class="container invoice-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
  <div class="table-responsive">
    <div id="printableArea">
    <table class="table">
      <tr>
        <td>
          <table class="table table-lg w-100 invoice-header">
                   <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="mb-3">
                                                                        <div class="mb-3">
                                                                            <img src="assets/images/logo/1.png"
                                                                                class="w-200" alt="">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="text-end">
                                                                        <div class="mb-1">
                                                                            <h3 class="text-primary">ANTENATAL</h3>
                                                                        </div>
                                                                  <p>RCHID - <strong><?php echo htmlspecialchars($beneficiary['rch_id']); ?></strong></p>
<p>Antenatal EDD - <strong><?php echo htmlspecialchars($beneficiary['edd']); ?></strong></p>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
          </table>
        </td>
      </tr>

      <tr>
        <td>
          <table class="table w-100">
             <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div
                                                                        style="display: grid; grid-template-columns: max-content max-content auto; gap: 30px 20px; align-items: center; font-family: Arial, sans-serif; font-size: 16px; max-width: 700px;">
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            RCH ID</div>
                                                                        <div style="text-align: center;">:</div>
                                                                     <div> <?php echo htmlspecialchars($beneficiary['rch_id']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            Beneficiary Name</div>
                                                                        <div style="text-align: center;">:</div>
                                                                     <div> <?php echo htmlspecialchars($beneficiary['beneficiary_name']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            Husband Name</div>
                                                                        <div style="text-align: center;">:</div>
                                                               <div> <?php echo htmlspecialchars($beneficiary['husband_name']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            Age</div>
                                                                        <div style="text-align: center;">:</div>
                                                                    <div> <?php echo htmlspecialchars($beneficiary['age']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            GRAVIDA</div>
                                                                        <div style="text-align: center;">:</div>
                                                                  <div> <?php echo htmlspecialchars($beneficiary['gravida']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            PARA</div>
                                                                        <div style="text-align: center;">:</div>
                                                                <div> <?php echo htmlspecialchars($beneficiary['para']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            Register Date</div>
                                                                        <div style="text-align: center;">:</div>
                                                                     <div> <?php echo htmlspecialchars($beneficiary['register_date']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            LMP</div>
                                                                        <div style="text-align: center;">:</div>
                   <div> <?php echo htmlspecialchars($beneficiary['lmp']); ?> </div>  

                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            EDD</div>
                                                                        <div style="text-align: center;">:</div>
                                                                     <div> <?php echo htmlspecialchars($beneficiary['edd']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            Street</div>
                                                                        <div style="text-align: center;">:</div>
                                                                     <div> <?php echo htmlspecialchars($beneficiary['street']); ?> </div>
                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            City</div>
                                                                        <div style="text-align: center;">:</div>
                                                                    <div> <?php echo htmlspecialchars($beneficiary['city']); ?> </div>

                                                                        <div
                                                                            style="text-align: left; font-weight: 600;">
                                                                            Pincode</div>
                                                                        <div style="text-align: center;">:</div>
                                                                    <div> <?php echo htmlspecialchars($beneficiary['pincode']); ?> </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
          </table>
        </td>
      </tr>

    </table>
    </div>
  </div>
</div>

                </div>

                
<script>
function printDiv(divId) {
  const content = document.getElementById(divId).innerHTML;
  const originalContent = document.body.innerHTML;

  const printStyles = `
    <style>
      #printableArea {
        border: 2px solid black;
        padding: 20px;
        margin: 20px;
        box-sizing: border-box;
      }
    </style>
  `;

  document.body.innerHTML = printStyles + '<div id="printableArea">' + content + '</div>';
  window.print();
  document.body.innerHTML = originalContent;
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
  async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const element = document.getElementById("printableArea");

    const canvas = await html2canvas(element, {
      scale: 2,
      useCORS: true
    });

    const imgData = canvas.toDataURL("image/png");

    const pdf = new jsPDF('p', 'mm', 'a4');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = pdf.internal.pageSize.getHeight();

    const imgWidth = pdfWidth - 20; // 10mm margin on left & right
    const imgHeight = (canvas.height * imgWidth) / canvas.width;

    let position = 10; // Top margin
    let heightLeft = imgHeight;

    // Draw border
    pdf.setLineWidth(0.5);
    pdf.rect(5, 5, pdfWidth - 10, pdfHeight - 10); // outer border (5mm margin)

    // Add first page image
    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
    heightLeft -= (pdfHeight - 20);

    // Handle multi-page content
    while (heightLeft > 0) {
      pdf.addPage();
      pdf.rect(5, 5, pdfWidth - 10, pdfHeight - 10); // border on new page
      position = 10 - (imgHeight - heightLeft);
      pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
      heightLeft -= (pdfHeight - 20);
    }

    // Add date/time at the bottom of the last page
    const now = new Date();
    const dateTimeString = now.toLocaleString();
    pdf.setFontSize(10);
    pdf.text(`Downloaded on: ${dateTimeString}`, 10, pdfHeight - 10);

    // const filename = `${element.id}.pdf`;
      const filename = `exaple.pdf`  
    pdf.save(filename);
  }
</script>




                <div class="invoice-footer float-end mb-3">
                    <button type="button" class="btn btn-primary m-1" onclick="printDiv('printableArea')">
                        <i class="ti ti-printer"></i> Print</button>
                    <button type="button" class="btn btn-secondary m-1"><i class="ti ti-send"></i> Send </button>
                    <button type="button" class="btn btn-success m-1" onclick="downloadPDF()">
                        <i class="ti ti-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice end -->
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