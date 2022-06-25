<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- JS -->
    <link rel="stylesheet" href="/css/style.css">
    <title>Web Admin</title>
</head>

<body class="p-2">
    <!-- User profile, Charts, and Daily Summary Table Container -->
    <section class="grid-2 container-fluid">
        <div class="row">
            <div class="col p-2 bg-secondary">
                <!-- user profile -->
                <div class="d-flex">
                    <img class="me-3" style="width: 150px; height: 180px;" src="/assets/image.jpg" alt="">
                    <div>
                        <span class="d-block text-white text-uppercase">Danny Suggi Saputra</span>
                        <span class="d-block text-white ">dannysaputra3003@gmail.com</span>
                    </div>
                </div>
                <button class="mt-3 d-block btn btn-primary w-100" id="notification-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrollingNotif" aria-controls="offcanvasScrolling"></button>
                <button class="mt-3 d-block btn btn-success w-100" id="inbox-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrollingInbox" aria-controls="offcanvasScrolling"></button>
                <button class="mt-5 d-block btn btn-danger w-100 fw-bold text-uppercase" data-bs-toggle="modal" data-bs-target="#myModal" type="button">exit</button>
                <!-- offcanvas notification -->
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrollingNotif" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Notifications</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" id="notification-sidebar-content">
                    </div>
                </div>
                <!-- offcanvas inbox -->
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrollingInbox" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Inbox</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" id="inbox-sidebar-content">
                    </div>
                </div>
                <!-- modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Exit an application</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to exit an application
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="yes-exit" data-bs-dismiss="modal">Sure!</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- charts -->
            <div class="col">
                <div class="running-text-container">
                    <div class="scroll-text text-nowrap" style="color: brown; font-size:small;">Assisting Your Business From The Heart :: 03 Agustus 2018 Gathering</div>
                </div>
                <div class="border p-2 border-3 border-danger">
                    <header class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button id="column-chart-btn" class="btn btn-outline-danger active text-uppercase">Column</button>
                            <button id="pie-chart-btn" class="btn btn-outline-danger text-uppercase">Pie</button>
                        </div>
                        <span class="text-uppercase fw-bold" style="color: brown;">daily summary performance</span>
                    </header>
                    <div class="mt-3 p-2 border border-3 border-danger">
                        <div id="daily-column-chart" style="width: 100%; height: 400px"></div>
                        <div id="daily-pie-chart" style="width: 100%; height: 400px" class="d-none"></div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <div class="col">
                <span style="color: white;">Assisting Your Business</span>
                <div class="border border-3 border-danger p-2">
                    <header class="d-flex justify-content-end">
                        <span class="text-uppercase fw-bold" style="color: brown;">daily summary performance</span>
                    </header>
                    <div class="mt-3">
                        <table id="daily-table" class="display" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>DAY</th>
                                    <th>TARGET TIME (HOUR)</th>
                                    <th>WORK TIME (HOUR)</th>
                                    <th>ACHIEVEMENT (PERECENTAGE)</th>
                                    <th>OVERTIME (HOUR)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Year Summary Performance Table Container -->
    <section class="container-fluid border border-danger border-3 mt-5 p-2">
        <!-- filter -->
        <header class="px-2 pt-2">
            <form action="index.php" method="POST" class="d-flex flex-row mb-3">
                <div class="form-group me-3 d-inline">
                    <label for="start">STARTDATE</label>
                    <div class="w-100"></div>
                    <select class="date" name="start" id="start"></select>
                </div>
                <div class="form-group me-4">
                    <label for="end">ENDDATE</label>
                    <div class="w-100"></div>
                    <select class="date" name="end" id="end"></select>
                </div>
                <div class="col">
                    <button class="btn btn-danger" type="submit">Reload</button>
                </div>
                <div class="flex-row">
                    <span class="fw-bold text-uppercase" style="color: brown;">year summary performance</span>
                </div>
            </form>
        </header>
        <!-- table -->
        <table id="year-table" class="display px-2" data-start="<?php echo isset($_POST['start']) ? $_POST['start'] : 1 ?>" data-end="<?php echo isset($_POST['end']) ? $_POST['end'] : 31 ?>">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>TARGET TIME (HOUR)</th>
                    <th>WORK TIME (HOUR)</th>
                    <th>ACHIEVEMENT (PERECENTAGE)</th>
                    <th>OVERTIME (HOUR)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </section>

    <!-- Charts Container -->
    <section class="container-fluid border border-danger border-3 mt-5 p-2">
        <header class="d-flex flex-row-reverse py-2">
            <span style="font-weight: bold; color: brown;">YEAR SUMMARY PERFORMANCE</span>
        </header>
        <div class="chart grid-3 row gx-3 pb-2">
            <!-- column chart -->
            <div class="col">
                <h4 class="border border-3 border-secondary text-uppercase">Column</h4>
                <div id="year-column-chart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
            <!-- pie chart -->
            <div class="col">
                <h4 class="border border-3 border-secondary text-uppercase">Pie</h4>
                <div id="year-pie-chart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
            <!-- area chart -->
            <div class="col">
                <h4 class="border border-3 border-secondary text-uppercase">Area</h4>
                <div id="year-area-chart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
        </div>
    </section>

    <!-- Notification and Inbox Container -->
    <section class="container-fluid mt-4 mb-2 p-2">
        <div class="row gx-3">
            <!-- notification -->
            <div class="col">
                <div class="border border-danger border-3 mb-2">
                    <span class="row justify-content-md-center text-uppercase fw-bold mx-auto" style="color: brown;">Notification</span>
                </div>
                <div class="border border-danger border-3">
                    <header class="d-flex align-items-center justify-content-between">
                        <div class="m-2">
                            <input class="form-control" id="notif-search-input" type="text" placeholder="Search">
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-2 form-check">
                                <input type="checkbox" checked class="from-check-input border-danger" value="" id="danger-check">
                                <label for="flexCheckDefault" class="text-uppercase fw-bold text-danger">Danger</label>
                            </div>
                            <div class="me-2 form-check">
                                <input type="checkbox" checked class="from-check-input border-warning" value="" id="warning-check">
                                <label for="flexCheckDefault" class="text-uppercase fw-bold text-warning">Warning</label>
                            </div>
                            <div class="me-2 form-check">
                                <input type="checkbox" checked class="from-check-input border-success" value="" id="safe-check">
                                <label for="flexCheckDefault" class="text-uppercase fw-bold text-success">Safe</label>
                            </div>
                        </div>
                    </header>
                    <div id="notification-content" style="height: 400px; overflow-y: scroll;">

                    </div>
                </div>
            </div>
            <!-- inbox -->
            <div class="col">
                <div class="border border-danger border-3 mb-2">
                    <span class="row justify-content-md-center text-uppercase fw-bold mx-auto" style="color: brown;">Inbox</span>
                </div>
                <div class="border border-3 border-danger">
                    <header class="d-flex align-items-center">
                        <div class="m-2">
                            <input id="inbox-search-input" class="form-control" type="text" placeholder="Search">
                        </div>
                    </header>
                    <div id="inbox-content" style="height: 400px; overflow-y: scroll;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="d-flex flex-row p-2">
        <div class="col ms-2 mt-3">
            <p class="text-uppercase fw-bold text-white">tech mayantara asia</p>
        </div>
        <div class="flex-row me-3">
            <button class="d-block btn btn-primary rounded-circle fw-bold" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrollingNotif" aria-controls="offcanvasScrolling" id="notification-btn-foot" style="height: 50px; width: 50px;">
            </button>
        </div>
        <div class="flex-row me-3">
            <button class="d-block btn btn-success rounded-circle fw-bold" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrollingInbox" aria-controls="offcanvasScrolling" id="inbox-btn-foot" style="height: 50px; width: 50px;" id="inbox-btn-foot">
            </button>
        </div>
        <div class="flex-row me-2">
            <div id="date-wrapper" class="text-white fw-bold"></div>
            <div id="time-wrapper" class="text-white fw-bold"></div>
        </div>
    </footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/daily-performance.js"></script>
    <script src="js/year-performance.js"></script>
    <script src="js/date-picker.js"></script>
    <script src="js/notification.js"></script>
    <script src="js/inbox.js"></script>
    <script src="js/clock.js"></script>
</body>

</html>