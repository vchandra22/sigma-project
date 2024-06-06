$(document).ready(function () {
    $('#tableManageLaporan').DataTable({
        dom: 'frtip',
        ordering: false,
        serverSide: true,
        processing: true,
        paging: true,
        responsive: true,
        pageLength: 20,
        ajax: {
            'url': $('#searchTableLaporan').val(),
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-primary-800 text-center dark:text-secondary'
            },
            {
                orderable: false,
                searchable: true,
                render: function(data, type, row) {
                    return '<div>' + row.user.nama_lengkap + '</div>' +
                           '<div clas="font-regular">' + row.no_identitas + '</div>';
                },
                name: 'user.nama_lengkap',
                className: 'font-bold text-primary-800 dark:text-secondary',

            },
            {
                orderable: false,
                searchable: true,
                data: 'user.no_hp',
                name: 'user.no_hp',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                searchable: true,
                data: 'instansi_asal',
                name: 'instansi_asal',
                className: 'text-primary-800 dark:text-secondary',
            },
            {
                orderable: false,
                searchable: true,
                data: 'position.role',
                name: 'position.role',
                className: 'text-primary-800 dark:text-secondary',
            },
            {
                orderable: false,
                searchable: true,
                data: 'status.status',
                name: 'status.status',
                render: function(data, type, row, meta) {
                    if (data === 'diterima') {
                        return '<div class="uppercase text-start py-2 pointer-events-none rounded-sm text-green-500">' + data + '</div>';
                    } else if (data === 'selesai') {
                        return '<div class="uppercase text-start py-2 pointer-events-none rounded-sm text-blue-500">' + data + '</div>';
                    } else {
                        return data; // Return data as it is if it doesn't match any condition
                    }
                }
            },
            {
                data: 'opsi',
                name: 'opsi',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [],
        "createdRow": function(row, data, dataIndex) {
            $(row).addClass('odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-gray-200 even:dark:bg-neutral-600 dark:odd:bg-neutral-800 dark:even:bg-neutral-700');
        },
    });
    //custom format of Search boxes
    $('[type=search]').each(function () {
        $(this).attr("placeholder", "Cari...").addClass('mb-4 bg-white border border-abu-800 text-blue-500 text-md focus:ring-primary-800 focus:border-primary-500 p-4 ps-10 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-blue-500 dark:focus:ring-primary-800 dark:focus:border-accent');
    });
    $('.dt-search').each(function () {
        $(this).addClass('flex justify-start');
    });
    $('[for=dt-search-0]').each(function () {
        $(this).addClass('hidden')
    });
    $('.dt-info').each(function () {
        $(this).addClass('flex justify-center text-md text-primary-800 my-4')
    });
    $('.dt-paging').append(function () {
        $(this).addClass('flex justify-center text-md')
    });
});
