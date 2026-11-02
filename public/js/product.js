$(function() {
    $(document).on('submit', '.product_delete-form', function(e) {
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

    $('.product_search-form').on('submit', function(e) {
        e.preventDefault();

        const search_form = $(this);

        $.ajax({
            url: search_form.attr('action'),
            type: 'GET',
            data: search_form.serialize(),
        }).done(function(html) {
            $('#productTableBody').html(html);
        }).fail(function() {
            alert('検索に失敗しました');
        });
    });
});
