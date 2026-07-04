<?php
/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(2); // jumlah nomor halaman di kiri-kanan halaman aktif
?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>" class="d-flex justify-content-center">
    <ul class="pagination pagination-sm flex-wrap shadow-sm rounded">

        <?php if ($pager->hasPrevious()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>"
                   aria-label="<?= lang('Pager.first') ?>" title="Halaman pertama">
                    &laquo;&laquo;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>"
                   aria-label="<?= lang('Pager.previous') ?>" title="Sebelumnya">
                    &laquo;
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">&laquo;&laquo;</span>
            </li>
            <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>"
                   aria-label="<?= lang('Pager.next') ?>" title="Berikutnya">
                    &raquo;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>"
                   aria-label="<?= lang('Pager.last') ?>" title="Halaman terakhir">
                    &raquo;&raquo;
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">&raquo;</span>
            </li>
            <li class="page-item disabled">
                <span class="page-link">&raquo;&raquo;</span>
            </li>
        <?php endif ?>

    </ul>
</nav>

<style>
    /* Pager styling — selaras dengan tema brown/navy */
    .pagination .page-link {
        color: #7a5430;
        border-color: #ddd9d3;
        min-width: 38px;
        text-align: center;
        transition: all .15s ease;
    }
    .pagination .page-link:hover {
        color: #fff;
        background-color: #9c6f3e;
        border-color: #9c6f3e;
    }
    .pagination .page-item.active .page-link {
        background-color: #9c6f3e;
        border-color: #9c6f3e;
        color: #fff;
        font-weight: 600;
    }
    .pagination .page-item.disabled .page-link {
        color: #b9b4ae;
        background-color: #f7f5f2;
        border-color: #e6e2dc;
    }
    .pagination .page-link:focus {
        box-shadow: 0 0 0 .2rem rgba(156, 111, 62, .25);
    }
</style>