
<?php 
    function listAtribut($Panelcolor,$icon,$sumData,$label,$location = ''){
        echo "<div class=\"col-lg-3 col-md-6\">
            <div class=\"panel panel-$Panelcolor\">
                <div class=\"panel-heading\">
                    <div class=\"row\">
                        <div class=\"col-xs-3\">
                            <i class=\"fa fa-$icon fa-5x\"></i>
                        </div>
                        <div class=\"col-xs-9 text-right\">
                            <div class=\"huge\">$sumData</div>
                            <div>$label</div>
                        </div>
                    </div>
                </div>
                <a href=\"$location\">
                    <div class=\"panel-footer\">
                        <span class=\"pull-left\">View Details</span>
                        <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                        <div class=\"clearfix\"></div>
                    </div>
                </a>
            </div>
        </div>";
        
    }
?>

