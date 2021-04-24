<?php
error_reporting(0);
include_once("services/MovieHubService.php");
$movieName = ($_POST['srch_movies']) ? $_POST['srch_movies'] : '';
$movieHubService = new  MovieHubService;
try {
    $moviesList = $movieHubService->findMovies($movieName);
    $srchmoviesList = json_decode($moviesList, true);
    $no_records_found = (empty($srchmoviesList)) ? true : false;
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
            <div class="row">
                <div class="col-md-12">
                    <?php if($no_records_found) { ?>
                        <div class="alert alert-danger" role="alert">
                          No movies found!
                        </div>
                    <?php } ?>
                </div>
            </div>
            <form name="instemFrm" id="instemFrm" method="post" action="searchMovies.php">
                <div class="row">
                    <div class="col-md-8">
                        <?php foreach($srchmoviesList as $val) { ?>
                            <div class="container p-3 my-3 bg-dark text-white">
                              <h1><a href="viewMovieDetail.php?name=<?php echo $val['title']; ?>"><?php echo $val['title']; ?></a></h1>
                              <p>Released on <?php echo $val['year']; ?></p>
                              <?php if(isset($val['info']['release_date'])) { ?>
                                <p>Release date <?php echo date("c", strtotime($val['info']['release_date'])); ?></p>
                            <?php } ?>
                            </div>
                        <?php } ?>
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