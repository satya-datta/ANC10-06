<?php include 'header.php'; ?>

<!-- Main Section start -->
<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">PNC DETAILS</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-pnc.html" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-stack f-s-16"></i>PNC</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="pnc-management.html" class="f-s-14 f-w-500">PNC Management</a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">PNC Details</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->
    </div>

    <!-- Invoice start -->
    <div class="container invoice-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="printableArea">
                                <div class="page">
                                    <?php
                                    // Database connection
                                    try {
                                        $conn = new PDO("mysql:host=localhost;dbname=anc", "root", "root");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        
                                        // Get RCH ID from URL parameter
                                        $rchId = $_GET['id'] ?? '';
                                        
                                        // Prepare and execute the query
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
                                        
                                        if ($stmt->rowCount() > 0) {
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                            // Decode children data if it's stored as JSON
                                            $children = json_decode($row['children_data'], true) ?? [];
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <table class="table table-lg w-100 invoice-header">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="mb-3">
                                                                    <div class="mb-3">
                                                                        <img src="assets/images/logo/1.png" class="w-200" alt="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-end">
                                                                    <div class="mb-1">
                                                                        <h3 class="text-primary">POSTNATAL CARE</h3>
                                                                    </div>
                                                                    <p>RCHID - <strong><?php echo htmlspecialchars($row['rch_id']); ?></strong></p>
                                                                    <p>Beneficiary Name - <strong><?php echo htmlspecialchars($row['beneficiary_name']); ?></strong></p>
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
                                                                <h4>Delivery & Child Details</h4>
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td><strong>RCH ID</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['rch_id']); ?></td>
                                                                        <td><strong>Beneficiary Name</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['beneficiary_name']); ?></td>
                                                                        <td><strong>Delivery Date & Time</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['delivery_datetime']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Type of Delivery</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['delivery_type']); ?></td>
                                                                        <td><strong>Place of Delivery</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['delivery_place']); ?></td>
                                                                        <td><strong>Hospital Address</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['hospital_address']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Live Birth</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['live_birth_count']); ?></td>
                                                                        <td><strong>Still Birth</strong></td><td>:</td>
                                                                        <td><?php echo htmlspecialchars($row['still_birth_count']); ?></td>
                                                                        <td colspan="3"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <h4 style="margin-top: 30px;">Child Information</h4>
                                                                <?php
                                                                if (!empty($children)) {
                                                                    foreach ($children as $index => $child) {
                                                                        $childNumber = $index + 1;
                                                                ?>
                                                                        <table style="width: 100%; margin-bottom: 15px;">
                                                                            <tr>
                                                                                <td><strong>Child ID <?php echo $childNumber; ?></strong></td><td>:</td>
                                                                                <td><?php echo htmlspecialchars($child['child_id'] ?? 'N/A'); ?></td>
                                                                                <td><strong>Sex of Baby <?php echo $childNumber; ?></strong></td><td>:</td>
                                                                                <td><?php echo htmlspecialchars($child['gender'] ?? 'N/A'); ?></td>
                                                                                <td><strong>Weight of Baby <?php echo $childNumber; ?></strong></td><td>:</td>
                                                                                <td><?php echo htmlspecialchars($child['weight'] ?? 'N/A'); ?> kg</td>
                                                                            </tr>
                                                                        </table>
                                                                <?php
                                                                    }
                                                                } else {
                                                                    echo "<p>No child information available.</p>";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php
                                        } else {
                                            echo "<div class='alert alert-warning'>No PNC record found for RCH ID: " . htmlspecialchars($rchId) . "</div>";
                                        }
                                    } catch(PDOException $e) {
                                        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
                                    }
                                    ?>
                                </div> <!-- end page 1 -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice-footer float-end mb-3">
                    <button type="button" class="btn btn-primary m-1" onclick="printDiv('printableArea')">
                        <i class="ti ti-printer"></i> Print
                    </button>
                    <button type="button" class="btn btn-secondary m-1">
                        <i class="ti ti-send"></i> Send 
                    </button>
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

<!-- Footer Section start -->
<?php include 'footer.php'; ?>

<!-- JavaScript remains the same as before -->
<script>
function printDiv(divId) {
    const content = document.getElementById(divId).innerHTML;
    const originalContent = document.body.innerHTML;

    const wrappedContent = `<div id="printableArea">${content}</div>`;

    const printStyles = `
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }
                #printableArea, #printableArea * {
                    visibility: visible;
                }
                #printableArea {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                .page {
                    page-break-after: always;
                    border: 2px solid black;
                    padding: 20px;
                    margin: 0 auto 20px auto;
                    box-sizing: border-box;
                    height: 270mm;
                }
                .page:last-child {
                    page-break-after: auto;
                }
            }
        </style>
    `;

    document.body.innerHTML = printStyles + wrappedContent;
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

        const imgWidth = pdfWidth - 20;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        let position = 10;
        let heightLeft = imgHeight;

        pdf.setLineWidth(0.5);
        pdf.rect(5, 5, pdfWidth - 10, pdfHeight - 10);

        pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
        heightLeft -= (pdfHeight - 20);

        while (heightLeft > 0) {
            pdf.addPage();
            pdf.rect(5, 5, pdfWidth - 10, pdfHeight - 10);
            position = 10 - (imgHeight - heightLeft);
            pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= (pdfHeight - 20);
        }

        const now = new Date();
        const dateTimeString = now.toLocaleString();
        pdf.setFontSize(10);
        pdf.text(`Downloaded on: ${dateTimeString}`, 10, pdfHeight - 10);

        const filename = `PNC_Details_<?php echo isset($row) ? $row['rch_id'] : 'unknown'; ?>.pdf`;
        pdf.save(filename);
    }
</script>