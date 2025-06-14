<?php include 'header.php'; ?>


<!-- Header Section ends -->
    <!-- Header Section end -->

        <!-- Main Section start -->
        <main>
            
                <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">TEST RECORDS</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-table f-s-16"></i> Test
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Test Records</a>
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
                        <h5>TEST RECORDS</h5>
                        <p>The Test Records feature allows users to filter the existing Test Records and Downlaod</p>
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
                                    <th>RCHID</th>
                                    <th>Beneficiary Name</th>
                                    <th>Husband Name</th>
                                    <th>Age</th>
                                    <th>Gravida</th>
                                    <th>Para</th>
                                    <th>Register date</th>
                                    <th>LMP</th>
                                    <th>EDD</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
<tr><td>833317092072</td><td>Deepika</td><td>Kiran</td><td>38</td><td>4</td><td>1</td><td>21-01-2025</td><td>30-04-2025</td><td>04-02-2026</td><td>572 Henry Mountain Suite 552, Andhra Pradesh, 44928</td></tr>
<tr><td>926998467556</td><td>Padma</td><td>Kiran</td><td>29</td><td>1</td><td>0</td><td>28-10-2024</td><td>06-12-2024</td><td>12-09-2025</td><td>20104 Austin Port Apt. 096, Andhra Pradesh, 46903</td></tr>
<tr><td>708489674626</td><td>Revathi</td><td>Chandra</td><td>31</td><td>1</td><td>0</td><td>24-10-2025</td><td>17-10-2024</td><td>24-07-2025</td><td>125 Orozco Freeway, Andhra Pradesh, 69873</td></tr>
<tr><td>535040372748</td><td>Padma</td><td>Prasad</td><td>34</td><td>1</td><td>0</td><td>21-08-2025</td><td>23-06-2024</td><td>30-03-2025</td><td>0123 Park Plains Apt. 534, Andhra Pradesh, 62162</td></tr>
<tr><td>149562546923</td><td>Divya</td><td>Manoj</td><td>22</td><td>5</td><td>3</td><td>02-12-2024</td><td>14-11-2024</td><td>21-08-2025</td><td>362 Robert Turnpike, Andhra Pradesh, 57266</td></tr>
<tr><td>668798967146</td><td>Harika</td><td>Deva</td><td>30</td><td>2</td><td>1</td><td>27-03-2024</td><td>07-10-2024</td><td>14-07-2025</td><td>11604 Miles Falls, Andhra Pradesh, 74086</td></tr>
<tr><td>141144892066</td><td>Kalpana</td><td>Naresh</td><td>33</td><td>3</td><td>1</td><td>15-08-2025</td><td>04-06-2025</td><td>08-03-2026</td><td>123 Terry Grove, Andhra Pradesh, 82737</td></tr>
<tr><td>850149108595</td><td>Yamini</td><td>Ravi</td><td>24</td><td>2</td><td>1</td><td>12-04-2025</td><td>11-01-2025</td><td>18-10-2025</td><td>9038 Nancy Curve Apt. 290, Andhra Pradesh, 84379</td></tr>
<tr><td>228739422968</td><td>Manasa</td><td>Suresh</td><td>19</td><td>1</td><td>0</td><td>20-05-2024</td><td>27-07-2024</td><td>03-05-2025</td><td>5423 Roberts Skyway, Andhra Pradesh, 28450</td></tr>
<tr><td>792782426960</td><td>Sindhu</td><td>Ajay</td><td>36</td><td>4</td><td>2</td><td>19-09-2025</td><td>10-11-2024</td><td>17-08-2025</td><td>8144 Alicia Garden, Andhra Pradesh, 15531</td></tr>
<tr><td>239161778140</td><td>Bhavani</td><td>Ganesh</td><td>21</td><td>2</td><td>1</td><td>31-10-2025</td><td>13-03-2025</td><td>18-12-2025</td><td>9788 Logan Club, Andhra Pradesh, 21518</td></tr>
<tr><td>759182128226</td><td>Jyothi</td><td>Srinivas</td><td>38</td><td>4</td><td>2</td><td>07-01-2025</td><td>14-08-2024</td><td>21-05-2025</td><td>1335 Kelsey Field Suite 654, Andhra Pradesh, 45221</td></tr>
<tr><td>279472074814</td><td>Triveni</td><td>Bharath</td><td>28</td><td>3</td><td>1</td><td>13-10-2025</td><td>21-01-2025</td><td>28-10-2025</td><td>914 Nicholas Springs, Andhra Pradesh, 68205</td></tr>
<tr><td>251703885592</td><td>Keerthi</td><td>Rajesh</td><td>32</td><td>2</td><td>1</td><td>09-07-2024</td><td>04-10-2024</td><td>11-07-2025</td><td>6220 Soto Branch Apt. 002, Andhra Pradesh, 51590</td></tr>
<tr><td>313470066680</td><td>Lakshmi</td><td>Lokesh</td><td>35</td><td>5</td><td>3</td><td>14-06-2025</td><td>06-04-2025</td><td>11-01-2026</td><td>3145 Jordan Fork Suite 738, Andhra Pradesh, 73667</td></tr>
<tr><td>605391775232</td><td>Sujatha</td><td>Mahesh</td><td>26</td><td>2</td><td>1</td><td>18-09-2024</td><td>25-07-2024</td><td>01-05-2025</td><td>7894 Edward Plaza, Andhra Pradesh, 52340</td></tr>
<tr><td>810365124571</td><td>Swapna</td><td>Ramesh</td><td>30</td><td>3</td><td>2</td><td>23-12-2024</td><td>10-10-2024</td><td>17-07-2025</td><td>4567 Market Street Apt. 231, Andhra Pradesh, 66890</td></tr>
<tr><td>729514887201</td><td>Varalakshmi</td><td>Naveen</td><td>29</td><td>1</td><td>0</td><td>05-02-2025</td><td>15-01-2025</td><td>22-10-2025</td><td>123 Willow Road, Andhra Pradesh, 74568</td></tr>
<tr><td>453162988143</td><td>Harika</td><td>Ajay</td><td>22</td><td>1</td><td>0</td><td>30-03-2025</td><td>08-05-2024</td><td>14-02-2025</td><td>9841 Pine Lane, Andhra Pradesh, 85913</td></tr>
<tr><td>987623105497</td><td>Anjali</td><td>Srinivas</td><td>28</td><td>4</td><td>2</td><td>12-11-2024</td><td>21-12-2024</td><td>28-09-2025</td><td>6783 Rose Street, Andhra Pradesh, 56921</td></tr>


                               
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