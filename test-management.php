<?php include 'header.php'; ?>
<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">TEST MANAGEMENT</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="register-test.html" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> Test
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Test Management</a>
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
                        <h5>TEST MANAGEMENT</h5>
                        <p>The Test Management feature allows users to edit or delete existing beneficiaries</p>
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
                                    <th>RCHID</th>
                                    <th>Beneficiary Name</th>
                                    <th>Age</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
 <tr>
  <td>123456789001</td>
  <td>Anitha Chowdary</td>
  <td>24</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789002</td>
  <td>Renuka Murthy</td>
  <td>27</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789003</td>
  <td>Padma Babu</td>
  <td>30</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789004</td>
  <td>Bhavani Sharma</td>
  <td>22</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789005</td>
  <td>Saritha Naidu</td>
  <td>25</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789006</td>
  <td>Madhavi Yadav</td>
  <td>28</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789007</td>
  <td>Renuka Sastry</td>
  <td>23</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789008</td>
  <td>Manjula Rao</td>
  <td>31</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789009</td>
  <td>Swapna Krishna</td>
  <td>29</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789010</td>
  <td>Sridevi Rao</td>
  <td>26</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789011</td>
  <td>Sridevi Narayana</td>
  <td>24</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789012</td>
  <td>Swapna Yadav</td>
  <td>28</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789013</td>
  <td>Renuka Kumar</td>
  <td>30</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789014</td>
  <td>Anitha Sastry</td>
  <td>25</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
</tr>
<tr>
  <td>123456789015</td>
  <td>Rajeshwari Sastry</td>
  <td>32</td>
  <td>
    <a href="test-revise.html" class="btn btn-light-success icon-btn b-r-4">
      <i class="ti ti-edit text-success"></i>
    </a>
    <a href="test-details.html" class="btn btn-light-info icon-btn b-r-4">
      <i class="fa-solid fa-eye fa-fw"></i>
    </a>
  </td>
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