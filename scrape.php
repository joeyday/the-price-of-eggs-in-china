<?php

@require('simple_html_dom.php');

$html1 = file_get_html('http://english.agri.gov.cn/service/pi/');

$latest_a = $html1->find('div#newslist', 0)->find('ul', 0)->find('li', 0)->find('a', 0);

$html2 = file_get_html('http://english.agri.gov.cn/service/pi/' . substr($latest_a->href, 2));

// $html2 = file_get_html('http://english.agri.gov.cn/service/pi/201307/t20130722_19996.htm');

foreach ($html2->find('tr') as $tr) {
    // echo trim($tr->find('td', 0)->plaintext) . "<br />";
    if (trim($tr->find('td', 0)->plaintext) == "Egg") {
        $egg_price = trim($tr->find('td', 1)->plaintext);
        $egg_delta = trim($tr->find('td', 2)->plaintext);
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>The Price of Eggs in China</title>
<style>
    body {
        margin: 4rem auto;
        font-family: helvetica, arial, sans-serif;
        background: #333;
        color: #fff;
    }
    a {
        color: #fff;
        text-decoration: none;
    }
    a:hover {
        border-bottom: 1px solid #ccc;
    }
    h1 {
        font-size: 1rem;
        text-align: center;
    }
    div {
        text-align: center;
    }
    .egg_price {
        font-size: 6rem;
        margin: 0 auto;
    }
    .egg_delta {
        font-size: 4rem;
        margin: 0 auto;
    }
    .egg_delta .meta {
        font-size: 1rem;
        display: block;
        margin: 0 auto;
    }
    
    .footer {
        font-size: 1rem;
        margin: 6rem auto 0;
        line-height: 1.4rem;
    }
</style>
</head>
<body>
<div class="content">
<p class="egg_price">
<?php echo "&#165;" . $egg_price . "/kg"; ?>
</p>
<p class="egg_delta">
<?php echo $egg_delta; ?>% <span class="meta">since previous business day</span>
</p>
</div>
<div class="footer">
<?php echo 'Wholesale commodity price data from the<br /><a href="http://english.agri.gov.cn/service/pi/' . substr($latest_a->href, 2) . '">Ministry of Agriculture of the People’s Republic of China</a><br />retrieved on ' . strftime('%B %d, %Y'); ?>
</div>
</body>
</html>