<?php

/**
 * @var \App\Kernel\Interfaces\ViewInterface $view
 * @var array<\App\Models\Movie> $movies
 * 
 */
?>

<?php $view->components('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3">Новинки</h3>
        <hr>
        <div class="movies">
            <?php foreach ($movies as $movie) { ?>
                <?php $view->components('movie', [
                    'movie' => $movie,
                    'avg' => $avg,
                    ]); ?>
            <?php } ?>
        </div>
    </div>
</main>

<?php $view->components('end'); ?>