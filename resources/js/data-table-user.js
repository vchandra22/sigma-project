function convertDate(dateString) {
    // Parse the date string in the format 'Y-m-d'
    var year = parseInt(dateString.substring(0, 4));
    var month = parseInt(dateString.substring(5, 7)) - 1; // Months are zero-based in JavaScript Date object
    var day = parseInt(dateString.substring(8, 10));

    // Create a JavaScript Date object
    var date = new Date(year, month, day);

    // Format the date as 'd M Y'
    var options = { day: 'numeric', month: 'short', year: 'numeric' };
    var formattedDate = date.toLocaleDateString('id-ID', options);

    return formattedDate;
}

$(document).ready(function () {
    $('#tableManageUser').DataTable({
        dom: 'frtip',
        ordering: false,
        serverSide: true,
        processing: true,
        paging: true,
        responsive: true,
        pageLength: 20,
        ajax: {
            'url': $('#searchTableUser').val(),
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'text-primary-800 text-center dark:text-secondary',
                orderable: false,
                searchable: false
            },
            {
                orderable: false,
                searchable: true,
                data: 'user.nama_lengkap',
                name: 'user.nama_lengkap',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                searchable: true,
                data: 'user.document.no_identitas',
                name: 'user.document.no_identitas',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                searchable: true,
                data: 'user.jenis_kelamin',
                name: 'user.jenis_kelamin',
                className: 'text-primary-800 text-center dark:text-secondary',
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
                data: 'office.nama_kantor',
                name: 'office.nama_kantor',
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
                data: null, render: function(data, type, row) {
                    if (row.u_tgl_mulai && row.u_tgl_selesai) {
                        return convertDate(row.u_tgl_mulai) + '<br> - <br>' + convertDate(row.u_tgl_selesai);
                    } else {
                        return '<span class="font-normal text-xs text-abu-800">belum diatur</span>';
                    }
                },
                name: 'u_tgl_mulai',
                className: 'text-primary-800 text-center dark:text-secondary',
            },
            {
                orderable: false,
                searchable: true,
                data: null, render: function(data, type, row) {
                    if (row.e_tgl_mulai && row.e_tgl_selesai) {
                        return convertDate(row.e_tgl_mulai) + '<br> - <br>' + convertDate(row.e_tgl_selesai);
                    } else {
                        return '<span class="font-normal text-xs text-abu-800">belum diatur</span>';
                    }
                },
                name: 'e_tgl_mulai',
                className: 'text-primary-800 text-center dark:text-secondary',
            },
            {
                orderable: false,
                searchable: true,
                data: 'status.status',
                name: 'status.status',
                render: function(data, type, row, meta) {
                    if (data === 'menunggu') {
                        return '<div class="bg-yellow-300 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + data + '</div>';
                    } else if (data === 'diterima') {
                        return '<div class="bg-green-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + data + '</div>';
                    } else if (data === 'ditolak') {
                        return '<div class="bg-red-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + data + '</div>';
                    } else if (data === 'selesai') {
                        return '<div class="bg-blue-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + data + '</div>';
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
