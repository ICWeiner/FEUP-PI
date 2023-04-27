function getPaginatedData(page) {
    $.ajax({
        url: '/admin/eventsCurrent?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            let tbody = $('#CurrEventTable');
            let pagination = $('.pagination');

            //Clear tbody 
            tbody.empty();

            console.log(response);

            for (let i = 0; i < data.length ; i++) {
                let tr = $('<tr></tr>');
                let eventNameTd = $('<td></td>').html(data[i].eventname);
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>').html(data[i].requesttype);
                let requestStatusTd = $('<td></td>').html(data[i].requeststatus);
                let requestActions = $('<td></td>').html(data[i].datereviewed);

                tr.append(eventNameTd);
                tr.append(dateCreatedTd);
                tr.append(requestTypeTd);
                tr.append(requestStatusTd);
                tr.append(requestActions);
               
                tbody.append(tr);
            }
            const prev = $('<a>')
            prev.attr('href',response.prev_page_url)
            const next = $('<a>')
            next.attr('href',response.next_page_url)

            $('.pagination').append(prev);
            $('.pagination').append(next);
              

        },
        error: function(xhr) {
            alert('Error retrieving data.');
        }
    });
}

$(document).ready(function() {
    // Initialize pagination with the first page
    getPaginatedData(1);

    // Handle clicks on pagination links
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedData(page);
    });
});
