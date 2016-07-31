<footer>
    <div class="container footer-text">
    </div>
</footer>
<!-- //Footer Section End -->
<hr>
<div class="copyright">
    <div class="container">
        <p>
            <?php
            function auto_copyrightyear($year = 'auto'){
                if (intval($year) == date('Y')){ return intval($year); }
                elseif (intval($year) < date('Y')){ return intval($year) . ' - ' . date('Y'); }
                elseif (intval($year) > date('Y')){ return date('Y'); }
                else {return $year = date('Y');}
            };

            echo "Copyright &copy;" . auto_copyrightyear(2016) ." ; System Developed & Maintenance By YANNICK ";
            ?>
        </p>
    </div>
</div>