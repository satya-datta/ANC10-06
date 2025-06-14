<?php include 'header.php'; ?>

<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">VACCINE RECORDS</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> Vaccine
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Vaccine Records</a>
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
                        <h5>VACCINE RECORDS</h5>
                        <p>The Vaccine Records feature allows users to filter the existing Vaccine Records and Downlaod</p>
                    </div>
                     
                        <div class="card-body d-flex flex-wrap gap-4">
                        <div>
                            <div class="mb-1 fw">Filter 1</div>
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 fw">Filter 2</div>
                            <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </div>
                        </div>
                        <div>
                            <div class="mb-1 fw">Filter 3</div>
                            <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </div>
                        </div>

                        <div>
                            <div class="mb-1 fw">Filter 4</div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                <input type="date" class="form-control bg-secondary text-white border-0">
                                </div>
                            </div>
                        </div>


                       <div class="col-md-6 col-lg-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start flex-wrap">
                                <button type="button" class="btn btn-outline-info">
                                <i class="ti ti-search"></i> Search
                                </button>
                                <button type="button" class="btn btn-outline-warning">
                                <i class="ti ti-reset"></i> Reset
                                </button>
                                <button type="button" class="btn btn-outline-success d-flex align-items-center">
                                Download <i class="ti ti-download ms-1"></i>
                                </button>
                            </div>
                       </div>


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
                                    <th>Child ID</th>
<th>Mother Name</th>
<th>BCG</th>
<th>0 OPV</th>
<th>0 HEP-B</th>
<th>PENTA-1</th>
<th>OPV-1</th>
<th>ROTA-1</th>
<th>IPV-1</th>
<th>PCV-1</th>
<th>PENTA-2</th>
<th>OPV-2</th>
<th>ROTA-2</th>
<th>PENTA-3</th>
<th>OPV-3</th>
<th>ROTA-3</th>
<th>IPV-2</th>
<th>PCV-2</th>
<th>MR-1</th>
<th>PCV Booster</th>
<th>VIT-A 1</th>
<th>IPV Booster</th>
<th>MR-2</th>
<th>OPV Booster</th>
<th>DPT Booster</th>
<th>VIT-A 2</th>
<th>VIT-A 3</th>
<th>VIT-A 4</th>
<th>VIT-A 5</th>
<th>VIT-A 6</th>
<th>VIT-A 7</th>
<th>VIT-A 8</th>
<th>TD-5Y</th>
<th>VIT-A 9</th>
<th>TT-10Y</th>
<th>TT-16Y</th>

                                </tr>
                                </thead>
                                <tbody>
<tr>
  <td>987654321098</td>
  <td>Laxmi Bai</td>
  <td>02-01-2024</td>
  <td>02-01-2024</td>
  <td>02-01-2024</td>
  <td>16-01-2024</td>
  <td>16-01-2024</td>
  <td>16-01-2024</td>
  <td>16-01-2024</td>
  <td>16-01-2024</td>
  <td>02-02-2024</td>
  <td>02-02-2024</td>
  <td>02-02-2024</td>
  <td>16-02-2024</td>
  <td>16-02-2024</td>
  <td>16-02-2024</td>
  <td>02-03-2024</td>
  <td>02-03-2024</td>
  <td>16-03-2024</td>
  <td>16-03-2024</td>
  <td>02-04-2024</td>
  <td>02-04-2024</td>
  <td>16-04-2024</td>
  <td>16-04-2024</td>
  <td>02-05-2024</td>
  <td>16-05-2024</td>
  <td>02-06-2024</td>
  <td>02-07-2024</td>
  <td>02-08-2024</td>
  <td>02-09-2024</td>
  <td>02-10-2024</td>
  <td>02-11-2024</td>
  <td>16-11-2024</td>
  <td>02-12-2024</td>
  <td>02-01-2025</td>
  <td>02-01-2026</td>
</tr>

<tr>
  <td>234561239876</td>
  <td>Savitri Kumari</td>
  <td>03-01-2024</td>
  <td>03-01-2024</td>
  <td>03-01-2024</td>
  <td>17-01-2024</td>
  <td>17-01-2024</td>
  <td>17-01-2024</td>
  <td>17-01-2024</td>
  <td>17-01-2024</td>
  <td>03-02-2024</td>
  <td>03-02-2024</td>
  <td>03-02-2024</td>
  <td>17-02-2024</td>
  <td>17-02-2024</td>
  <td>17-02-2024</td>
  <td>03-03-2024</td>
  <td>03-03-2024</td>
  <td>17-03-2024</td>
  <td>17-03-2024</td>
  <td>03-04-2024</td>
  <td>03-04-2024</td>
  <td>17-04-2024</td>
  <td>17-04-2024</td>
  <td>03-05-2024</td>
  <td>17-05-2024</td>
  <td>03-06-2024</td>
  <td>03-07-2024</td>
  <td>03-08-2024</td>
  <td>03-09-2024</td>
  <td>03-10-2024</td>
  <td>03-11-2024</td>
  <td>17-11-2024</td>
  <td>03-12-2024</td>
  <td>03-01-2025</td>
  <td>03-01-2026</td>
</tr>

<tr>
  <td>345678902134</td>
  <td>Kavitha Rani</td>
  <td>04-01-2024</td>
  <td>04-01-2024</td>
  <td>04-01-2024</td>
  <td>18-01-2024</td>
  <td>18-01-2024</td>
  <td>18-01-2024</td>
  <td>18-01-2024</td>
  <td>18-01-2024</td>
  <td>04-02-2024</td>
  <td>04-02-2024</td>
  <td>04-02-2024</td>
  <td>18-02-2024</td>
  <td>18-02-2024</td>
  <td>18-02-2024</td>
  <td>04-03-2024</td>
  <td>04-03-2024</td>
  <td>18-03-2024</td>
  <td>18-03-2024</td>
  <td>04-04-2024</td>
  <td>04-04-2024</td>
  <td>18-04-2024</td>
  <td>18-04-2024</td>
  <td>04-05-2024</td>
  <td>18-05-2024</td>
  <td>04-06-2024</td>
  <td>04-07-2024</td>
  <td>04-08-2024</td>
  <td>04-09-2024</td>
  <td>04-10-2024</td>
  <td>04-11-2024</td>
  <td>18-11-2024</td>
  <td>04-12-2024</td>
  <td>04-01-2025</td>
  <td>04-01-2026</td>
</tr>

<tr>
  <td>456789123456</td>
  <td>Meenakshi Yadav</td>
  <td>05-01-2024</td>
  <td>05-01-2024</td>
  <td>05-01-2024</td>
  <td>19-01-2024</td>
  <td>19-01-2024</td>
  <td>19-01-2024</td>
  <td>19-01-2024</td>
  <td>19-01-2024</td>
  <td>05-02-2024</td>
  <td>05-02-2024</td>
  <td>05-02-2024</td>
  <td>19-02-2024</td>
  <td>19-02-2024</td>
  <td>19-02-2024</td>
  <td>05-03-2024</td>
  <td>05-03-2024</td>
  <td>19-03-2024</td>
  <td>19-03-2024</td>
  <td>05-04-2024</td>
  <td>05-04-2024</td>
  <td>19-04-2024</td>
  <td>19-04-2024</td>
  <td>05-05-2024</td>
  <td>19-05-2024</td>
  <td>05-06-2024</td>
  <td>05-07-2024</td>
  <td>05-08-2024</td>
  <td>05-09-2024</td>
  <td>05-10-2024</td>
  <td>05-11-2024</td>
  <td>19-11-2024</td>
  <td>05-12-2024</td>
  <td>05-01-2025</td>
  <td>05-01-2026</td>
</tr>

<tr>
  <td>567890213456</td>
  <td>Sita Kumari</td>
  <td>06-01-2024</td>
  <td>06-01-2024</td>
  <td>06-01-2024</td>
  <td>20-01-2024</td>
  <td>20-01-2024</td>
  <td>20-01-2024</td>
  <td>20-01-2024</td>
  <td>20-01-2024</td>
  <td>06-02-2024</td>
  <td>06-02-2024</td>
  <td>06-02-2024</td>
  <td>20-02-2024</td>
  <td>20-02-2024</td>
  <td>20-02-2024</td>
  <td>06-03-2024</td>
  <td>06-03-2024</td>
  <td>20-03-2024</td>
  <td>20-03-2024</td>
  <td>06-04-2024</td>
  <td>06-04-2024</td>
  <td>20-04-2024</td>
  <td>20-04-2024</td>
  <td>06-05-2024</td>
  <td>20-05-2024</td>
  <td>06-06-2024</td>
  <td>06-07-2024</td>
  <td>06-08-2024</td>
  <td>06-09-2024</td>
  <td>06-10-2024</td>
  <td>06-11-2024</td>
  <td>20-11-2024</td>
  <td>06-12-2024</td>
  <td>06-01-2025</td>
  <td>06-01-2026</td>
</tr>

                               
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