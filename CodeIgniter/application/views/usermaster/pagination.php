

<div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end pagination-sm">
  <?php if ($page_count > 1) { ?>
                <?php if ($page_count > 2) { ?>
    <li class="page-item"><a class="page-link" href="javascript:void(0)"onclick="pagination('', 'prev')">Previous</a></li>
    <?php } ?>
                <?php for ($i = 1; $i <= $page_count; $i++) { ?>
                    <li class="page-item"><a class="page-link page-no-<?php echo $i ?>" href="javascript:void(0)" onclick="pagination(<?php echo $i ?>, '')"><?php echo $i ?></a></li>
                <?php } ?>
                <?php if ($page_count > 2) { ?>
    <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="pagination('', 'next')">Next</a></li>
  
    <?php  } ?>
            <?php  } ?></ul>
</nav>
                </div>