$(function(){
    $('.product_delete-form').on('submit', function(e){
        e.preventDefault();
        if (!confirm('本当に削除しますか？')) {
            return;
        }

        const delete_form = $(this);

        $.ajax({
            url: delete_form.attr('action'),
            type: 'POST',
            data: delete_form.serialize(),
        }).done(function(response) {
            delete_form.closest('tr').remove();
        }).fail(function() {
            alert('削除に失敗しました');
        });
    });
});
