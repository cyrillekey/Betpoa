<?php
  session_start();
  require('../conn/conn.php');
  if($_SESSION['usernumber']!="0708073370"){
    header('location:../index.php');
  }
  $sql="SELECT * FROM admintable";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $row=$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<style>
  .row{
    background-color: #1b2431;
  }
</style>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,600" />
  <link rel="stylesheet" href="../css/das.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.selectric/1.10.1/selectric.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
  <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Betpoa</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="zmdi zmdi-widgets"></i>
                Dashboard <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-shopping-cart"></i>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-accounts"></i>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-chart"></i>
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-layers"></i>
                Integrations
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center pl-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <i class="zmdi zmdi-plus-circle-o"></i>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="zmdi zmdi-file-text"></i>
                Year-end sale
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
        <div class="card-list">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card blue">
                <div class="title">Bets Placed</div>
                <i class="zmdi zmdi-upload"></i>
                <div class="value"><?php echo $row->betsplaces ?></div>
                <div class="stat"><b>13</b>% increase</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card green">
                <div class="title">Bets Won</div>
                <i class="zmdi zmdi-upload"></i>
                <div class="value"><?php echo $row->bets_won ?></div>
                <div class="stat"><b>4</b>% increase</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card orange">
                <div class="title">Amount Paid out</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value">KES <?php echo $row->ammount_paid_out?></div>
                <div class="stat"><b>13</b>% decrease</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card red">
                <div class="title">Users</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value">KES <?php echo $row->amount_paid_in?></div>
                <div class="stat"><b>13</b>% decrease</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card green">
                <div class="title">Account balance</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value">KES <?php echo $row->account_balance?></div>
                <div class="stat"><b>13</b>% decrease</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card blue">
                <div class="title">Users</div>
                <i class="zmdi zmdi-download"></i>
                <div class="value"><?php echo $row->users_regis?> Users</div>
                <div class="stat"><b>13</b>% decrease</div>
              </div>
            </div>
          </div>
        </div>
        <div class="projects mb-4">
          <div class="projects-inner">
            <header class="projects-header">
              <div class="title">Ongoing Bets</div>
              <div class="count">| 32 Projects</div>
              <i class="zmdi zmdi-download"></i>
            </header>
            <table class="projects-table">
              <thead>
                <tr>
                  <th>Bet id</th>
                  <th>Deadline</th>
                  <th>Leader + Team</th>
                  <th>Budget</th>
                  <th>Status</th>
                  <th class="text-right">Actions</th>
                </tr>
              </thead>
              <tr>
                <td>
                  <p>New Dashboard</p>
                  <p>Google</p>
                </td>
                <td>
                  <p>17th Oct, 15</p>
                  <p class="text-danger">Overdue</p>
                </td>
                <td class="member">
                  <figure><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/584938/people_8.png" /></figure>
                  <div class="member-info">
                    <p>Myrtle Erickson</p>
                    <p>UK Design Team</p>
                  </div>
                </td>
                <td>
                  <p>$4,670</p>
                  <p>Paid</p>
                </td>
                <td class="status">
                  <span class="status-text status-orange">In progress</span>
                </td>
                <td>
                  <form class="form" action="#" method="POST">
                    <select class="action-box">
                      <option>Actions</option>
                      <option>Start project</option>
                      <option>Send for QA</option>
                      <option>Send invoice</option>
                    </select>
                  </form>
                </td>
              </tr>
              <tr class="danger-item">
                <td>
                  <p>New Dashboard</p>
                  <p>Google</p>
                </td>
                <td>
                  <p>17th Oct, 15</p>
                  <p class="text-danger">Overdue</p>
                </td>
                <td class="member">
                  <figure><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/584938/people_8.png" /></figure>
                  <div class="member-info">
                    <p>Myrtle Erickson</p>
                    <p>UK Design Team</p>
                  </div>
                </td>
                <td>
                  <p>$4,670</p>
                  <p>Paid</p>
                </td>
                <td class="status">
                  <span class="status-text status-red">Blocked</span>
                </td>
                <td>
                  <form class="form" action="#" method="POST">
                    <select class="action-box">
                      <option>Actions</option>
                      <option>Start project</option>
                      <option>Send for QA</option>
                      <option>Send invoice</option>
                    </select>
                  </form>
                </td>
              </tr>
              <tr>
                <td>
                  <p>New Dashboard</p>
                  <p>Google</p>
                </td>
                <td>
                  <p>17th Oct, 15</p>
                  <p class="text-danger">Overdue</p>
                </td>
                <td class="member">
                  <figure><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/584938/people_8.png" /></figure>
                  <div class="member-info">
                    <p>Myrtle Erickson</p>
                    <p>UK Design Team</p>
                  </div>
                </td>
                <td>
                  <p>$4,670</p>
                  <p>Paid</p>
                </td>
                <td class="status">
                  <span class="status-text status-orange">In progress</span>
                </td>
                <td>
                  <form class="form" action="#" method="POST">
                    <select class="action-box">
                      <option>Actions</option>
                      <option>Start project</option>
                      <option>Send for QA</option>
                      <option>Send invoice</option>
                    </select>
                  </form>
                </td>
              </tr>
              <tr>
                <td>
                  <p>New Dashboard</p>
                  <p>Google</p>
                </td>
                <td>
                  <p>17th Oct, 15</p>
                  <p class="text-danger">Overdue</p>
                </td>
                <td class="member">
                  <figure><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/584938/people_8.png" /></figure>
                  <div class="member-info">
                    <p>Myrtle Erickson</p>
                    <p>UK Design Team</p>
                  </div>
                </td>
                <td>
                  <p>$4,670</p>
                  <p>Paid</p>
                </td>
                <td class="status">
                  <span class="status-text status-blue">Early stages</span>
                </td>
                <td>
                  <form class="form" action="#" method="POST">
                    <select class="action-box">
                      <option>Actions</option>
                      <option>Start project</option>
                      <option>Send for QA</option>
                      <option>Send invoice</option>
                    </select>
                  </form>
                </td>
              </tr>
              <tr>
                <td>
                  <p>New Dashboard</p>
                  <p>Google</p>
                </td>
                <td>
                  <p>17th Oct, 15</p>
                  <p class="text-danger">Overdue</p>
                </td>
                <td class="member">
                  <figure><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/584938/people_8.png" /></figure>
                  <div class="member-info">
                    <p>Myrtle Erickson</p>
                    <p>UK Design Team</p>
                  </div>
                </td>
                <td>
                  <p>$4,670</p>
                  <p>Paid</p>
                </td>
                <td class="status">
                  <span class="status-text status-orange">In progress</span>
                </td>
                <td>
                  <form class="form" action="#" method="POST">
                    <select class="action-box">
                      <option>Actions</option>
                      <option>Start project</option>
                      <option>Send for QA</option>
                      <option>Send invoice</option>
                    </select>
                  </form>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="chart-data">
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="chart radar-chart dark">
                <div class="actions">
                  <button type="button" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                  </div>
                </div>
                <h3 class="title">Household Expenditure</h3>
                <p class="tagline">Yearly</p>
                <canvas height="400" id="radarChartDark"></canvas>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="chart bar-chart light">
                <div class="actions">
                  <button type="button" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                  </div>
                </div>
                <h3 class="title">Monthly revenue</h3>
                <p class="tagline">2015 (in thousands US$)</p>
                <canvas height="400" id="barChartHDark"></canvas>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="chart doughnut-chart dark">
                <div class="actions">
                  <button type="button" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                  </div>
                </div>
                <h3 class="title">Exports of Goods</h3>
                <p class="tagline">2015 (in billion US$)</p>
                <canvas height="400" id="doughnutChartDark"></canvas>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.selectric/1.10.1/jquery.selectric.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

<script src="../js/dashboard.js"></script>

</html>