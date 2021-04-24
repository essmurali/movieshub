<?php
error_reporting(0);
include_once("services/MovieHubService.php");
$movieName = ($_GET['name']) ? $_GET['name'] : '';
$movieHubService = new  MovieHubService;
try {
    $moviesList = $movieHubService->findMovies($movieName);
    $srchmoviesList = json_decode($moviesList, true);
    $movieDetail = array_shift($srchmoviesList);
} catch(Exception $e) {
  echo 'Message: ' .$e->getMessage(); die;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Instem - Movie Hub</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/jquery-ui.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <form name="instemFrm" id="instemFrm" method="post" action="searchMovies.php">
                <div class="row">
                    <div class="col-md-8">
                            <div class="container p-3 my-3 bg-primary text-white">
                                <div>
                                    <h3><?php echo $movieDetail['title']; ?></h3>
                                </div>
                                <div>
                                    <img src="<?php echo $movieDetail['info']['image_url'];?>" border="0" />
                                </div>
                              <p>Released on: <?php echo $movieDetail['year']; ?></p>
                              <?php if(isset($movieDetail['info']['release_date'])) { ?>
                                <p>Release date: <?php echo date("c", strtotime($movieDetail['info']['release_date'])); ?></p>
                            <?php } ?>
                                <p>
                                    <blockquote>Directors: <?php echo implode(", ",  $movieDetail['info']['directors']); ?></blockquote>
                                </p>
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="srch_movies" id="srch_movies" placeholder="Search Movies">
                            <div class="input-group-btn">
                              <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                              </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>