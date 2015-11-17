<?php include('php/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>ResellerClub API - Domain Availability - Niralar</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
    <div class="container">
      <div class="starter-template">
        <h1>ResellerClub API - Domain Availability</h1>
        <p class="lead">Check domain names available for registration with Niralar's domain name search!</p>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="row">
                <div class="col-lg-6 centercol">
                    <div class="input-group">
                      <input type="text" name="domain" class="form-control" placeholder="Type Your Domain Name Here ..." value="<?php echo $api->domainname; ?>">
                      <span class="input-group-btn">        
                        <button type="submit" name="check" class="btn btn-default">Go!</button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </form>
    <?php
    if ($api->FormValidation())
    {
        $data = $api->DomainAvailability();
        ?>
        <div class="panel panel-default">
            <!-- Table -->
            <table class="table">
                <tbody>
                    <?php
                    foreach($api->tlds_list as $arrayitem)
                    {
                        $fulldomainname = $api->domainname . "." . $arrayitem;
                        ?>
                        <tr>
                            <td class="domainname"><?php echo $fulldomainname; ?></td>
                            <td><?php if ($data[$fulldomainname]["status"] == "available") { echo 'Available'; }
                            else { echo 'Not Available'; } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Available Domain Suggestions</div>
          <table class="table">
            <tbody>
                <?php
                foreach($data[$api->domainname] as $suggestion => $tlds_list)
                {
                    foreach($data[$api->domainname][$suggestion] as $tld => $status)
                    {
                        if ($status == "available")
                        {
                            echo '<tr>
                            <td class="domainname">'.strtolower($suggestion) . '.' . $tld.'</td>
                            <td>Available</td>
                            </tr>';
							$flag = 1;
                        }
                    }
                }
				if(!isset($flag))
				{
					echo '<tr><td>No Suggestion Avaliable</td></tr>';
				}
                ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
</div><!-- /.container -->
<footer class="footer">
      <div class="container">
        <p class="text-muted">Powered by <a href="http://www.niralar.com/">Niralar</a></p>
      </div>
    </footer>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>