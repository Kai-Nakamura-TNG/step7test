$(function() {
    $('#productTable').tablesorter({
        sortList: [[0, 1]],
        headers: {
            1: { sorter: false },
            6: { sorter: false },
            7: { sorter: false },
        },
    });

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
            $('#productTable').trigger('update');
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
            $('#productTable').trigger('update');
        }).fail(function() {
            alert('検索に失敗しました');
        });
    });
});
