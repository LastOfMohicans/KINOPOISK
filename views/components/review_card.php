<?php

/**
 * @var \App\Models\Review $review
 * @var \App\Models\User $user
 */
?>

<div class="card">
    <div class="card-header">        
        Пользователь: <?php /** @var User $user */
        if(isset($user)) echo $user->name() ?>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p><?php echo $review['review'] ?></p>
            <footer class="blockquote-footer">Оценка <span class="badge bg-warning warn__badge"><?php echo $review['rating'] ?></span>
            <hr>
            <p><?php echo $review['created_at'] ?></p>
        </footer>
        </blockquote>
    </div>
</div>