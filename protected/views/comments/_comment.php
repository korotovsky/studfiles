    <div class="comment-body" style="margin-left: <?php echo comments::model()->getMargin($comment->level); ?>px">
        <?php if(($comment->votes_positive - $comment->votes_negative) > -20) { ?>
        <div class="comment-header">
            <b><?php echo !isset($comment->users->id) ? 'Анонимус' : $comment->users->username ?></b>, <?php echo Yii::app()->dateFormatter->format("dd MMMM y, HH:mm", $comment->created); ?>
        </div>
        <div class="comment-text comment">
            <?php echo $comment->text ?>
        </div>
        <p><a style="font-size: small" href="#" to="<?php echo $comment->id ?>" level="<?php echo $comment->level ?>" class="reply-link"><?php echo Yii::t('main', 'Ответить') ?></a></p>
        <?php } else { ?>
            <div class="comment-ufo"><h4><?php echo Yii::t('main', 'НЛО прилетело и оставило эту надпись здесь.') ?></h4></div>
        <?php } ?>
        <span id="form<?php echo $comment->id ?>"></span>
    </div>
    <div style="clear: both"></div>
