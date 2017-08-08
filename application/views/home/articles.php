<?php // Articles page search in table articles and display results or redirect to selected article 
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
//echo $base_dir . "<br>";

include($base_dir ."include/search_functions.php");

?>
<?Php include($base_dir ."include/header.php") ?>
<body>
<?Php include($base_dir ."include/inc_searchform.php") //autocomplete search form file?>


<?php if(isset($data)) {
              $rsSearch = $data['rsSearch'];
              //print_r($rsSearch);
              //exit();
?>
<!-- ====================== Search Results ======================================================= -->
        <div class="row">
           <div class="span8">
			   <div class="well">
            <?php if(count($rsSearch) ==0) { ?>
            		<div class="row repeated_row">
					<div class="news_text col-sm-push-4">
                    	Sorry no results
                    </div>
                    </div>
            <?php } ?>
            <?php foreach($rsSearch as $rsSearch1) { 
                        $articleId = $rsSearch1['id'];
                        $articleTitle = $rsSearch1['atitle'];
                        $desc = $rsSearch1['abody'];
                        $desc = stripHtmlBody($desc)." ...";
                        ?>
                        <div class="row repeated_row">
                        <div class="news_text col-md-2">
                                <a href="/article-<?php echo($articleId)?>" ><?Php echo($articleTitle) ?></a>
                        <div> <?Php echo($desc) ?> </div>
                    </div>
                    </div>
            <?php }?>
       </div>
        </div>
        </div>
<!-- ====================== End of Search Results ======================================================= -->
<?php } ?>

<?Php include($base_dir."include/footer.php")?>
</body>
</html>