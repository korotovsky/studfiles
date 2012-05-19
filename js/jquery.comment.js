$(document).ready(function() {
    $('a.reply-link, a.reply-main-link').live('click', function() {
        var id = $(this).attr('to');
        var level = $(this).attr('level');
        var form_to = $('#form' + id); 
        var form = $('#formmain');

        form.appendTo(form_to);

        if(level > 1) {
            $('a.reply-main-link').css('display', 'block');
        } else {
            $('a.reply-main-link').css('display', 'none');
        }

        $('#comments_parent').val(id);
        $('#comments_text').css('width', 870-level*20);
        $('#comments_text').focus();

        return false;
    });

    $('div.comments-buttons a').live('click', function() {
        var element = $(this).parent('div');
        var type = $.trim($(this).attr('class'));
        var id = element.attr('class').split(' ')[1].split('-')[1];
        var buttond = $(this).parent('div').find('a.vote-down');
        var buttonu = $(this).parent('div').find('a.vote-up');

        $.ajax({
            type: "POST",
            url: '/vote/comment',
            dataType: 'json',
            data: "id=" + id + "&type=" + type,

            beforeSend: function() {
                $("body").css("cursor", "progress");
            },

            success: function(data) {
                if(data.status === "ok") {
                    var mark = $('span.comment-mark-' + id);
                    if(type === "vote-down") {
                        buttond.addClass('voted-down');
                        buttonu.addClass('mine');
                    } else if(type === "vote-up") {
                        buttond.addClass('mine');
                        buttonu.addClass('voted-up');
                    }
                    mark.html(data.votes);
                } else if(data.status === "failed") {
                    alert(data.message);
                }
                $("body").css("cursor", "auto");
            },

            error: function(xhr, text) {
                $("body").css("cursor", "auto");
                alert('Error while voting...');
            }
        });

        return false;
    });

});
