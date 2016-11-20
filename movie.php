<?php

$movie = $_GET["film"];
$image = "moviefiles/" . $movie . "/overview.png";
$image_fresh = "images/fresh.png";
$image_rottenbig = "images/rottenbig.png";


$myfile = fopen("moviefiles/" . $movie ."/info.txt", "r") or die("Unable to open file!");
$title=explode("\n",file_get_contents("moviefiles/" . $movie ."/info.txt"));


 if($title[2] >= 60)
{
   $rate=$image_fresh;
}
else
{
    $rate=$image_rottenbig;
}

$overview=explode("\n",file_get_contents("moviefiles/" . $movie . "/overview.txt"));

$review_files=glob("moviefiles/$movie/review*.txt");


?>

<html><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title> Rancid Tomatoes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="movie.css">
    <link rel="shortcut icon" type="image/gif" href="images/rotten.gif">
</head>
<body>
<div id="banner"><img src="images/banner.png" alt="banner"></div>
<h1> <?php echo $title[0] . " "; echo $title[1]; ?> </h1>

<div id="overall">
    <div id="Overview">
        <img src=<?= $image ?> alt="overview">
        <dl class="OverViewdl">

            <?php

            for($i=0; $i<sizeof($overview); $i++)
            {

                $split=explode(":", $overview[$i]);

                echo "<dt>$split[0]</dt>";
                echo "<dd>$split[1]</dd>";

            }
            ?>

            <dd>
                <ul>
                    <li><a href="http://www.ninjaturtles.com/">The Official TMNT Site</a></li>
                    <li><a href="http://www.rottentomatoes.com/m/teenage_mutant_ninja_turtles/">RT Review</a></li>
                    <li><a href="http://www.rottentomatoes.com/">RT Home</a></li>
                    <li><a href="http://mumstudents.org/cs472/">CS472</a></li>
                </ul>
            </dd>
        </dl>
    </div>


    <div id="reviews">
        <div id="reviewsbar">
            <img id="reviewsbarimg" src="<?=$rate?>" alt="overview">
            <div id="rate"><?=$title[2]?> % </div>
        </div>

        <?php
        for($i=0; $i<sizeof($review_files); $i++)
        {
        $review = explode("\n",file_get_contents($review_files[$i]));

        ?>
        <div class="reviewcol">
            <div class="reviewquote">


                <?php  echo $review[0];

                  if($review[1]=="ROTTEN")
                {?>
                    <img class="likeimg" src="images/rotten.gif" alt="rotten">;
                 <?php }
                else { ?>
                    <img class="likeimg" src="images/fresh.gif" alt="fresh">;
                <?php  }
                 ?>
            </div>
            <div class="personalquote">
                <img class="personimg" src="images/critic.gif" alt="critic">
                <?php echo $review[2]; ?> <br>
                <?php echo $review[3]; ?>
            </div>

            <?php  }?>

        </div>
    </div>
    <div id="bottombar">
        (1-10) of 8
    </div>
</div>
<div id="w3ccheck">
    <a href="http://validator.w3.org/check/referer"><img src="images/w3c-html.png" alt="Valid HTML5"></a> <br>
    <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="images/w3c-css.png" alt="Valid CSS"></a>
</div>


</body></html>
