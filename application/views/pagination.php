<div>
   <?php $last_page = ceil($total->total/$limit);
   ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end pagination-sm" id="pagi">


            <?php if ($total->total > 1){ ?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)" id="first" data-page="1" onclick="fetchData(this, 'pagi')">First</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)" id="prev" data-page="" onclick="fetchData(this, 'pagi')">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)" id="next" data-page="" onclick="fetchData(this, 'pagi')">Next</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page="<?php echo $last_page ?>" id="last"  onclick="fetchData(this, 'pagi')">Last</a></li>
            <?php }

            ?>


        </ul>
    </nav>
</div>