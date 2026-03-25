<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">

        <?php if ($pager->hasPreviousPage()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirstPageURL() ?>">&laquo;&laquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPageURL() ?>">&laquo;</a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPageURL() ?>">&raquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLastPageURL() ?>">&raquo;&raquo;</a>
            </li>
        <?php endif ?>

    </ul>
</nav>