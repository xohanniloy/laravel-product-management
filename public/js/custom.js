$(document).ready(function () {
    const closeIcon = $('.search-box .close-icon');
    const searchInput = $('#search');
    const searchUrl = searchInput.data('url'); // Get the route URL from the data attribute

    closeIcon.hide();
    $('.loader').hide();

    searchInput.on('input', function () {
        const value = $(this).val();
        closeIcon.toggle(value !== ''); // Show close icon only if value is not empty
        performSearch(value);
    });

    function performSearch(query) {
        $.ajax({
            url: searchUrl, // Use the URL from the data attribute
            type: 'GET',
            data: { search: query },
            beforeSend: () => {
                $('.loader').show();
                closeIcon.hide(); // Hide close icon during loading
            },
            success: (data) => {
                $('tbody').html(data);
                $('.loader').hide();
                closeIcon.toggle(query !== ''); // Show close icon only if query is not empty
            },
            error: () => {
                alert('Search failed. Please try again.');
                $('.loader').hide();
            }
        });
    }

    closeIcon.on('click', function () {
        searchInput.val('');
        $(this).hide();
        performSearch('');
    });

    $('.btn-close').on('click', function () {
        $(this).parent().hide();
    });

});
