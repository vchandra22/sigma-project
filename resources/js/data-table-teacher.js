$(document).ready(function () {
    $('#tableManageTeacher').DataTable({
        dom: 'frtip',
        ordering: false,
        serverSide: true,
        processing: true,
        paging: true,
        responsive: true,
        pageLength: 20,
        ajax: {
            'url': $('#searchTableTeacher').val(),
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
                data: 'user.document.no_identitas',
                name: 'user.document.no_identitas',
                className: 'text-primary-800 dark:text-secondary'
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
                data: 'nama_pembimbing',
                name: 'nama_pembimbing',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'instansi_asal',
                name: 'instansi_asal',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'no_hp_pembimbing',
                name: 'no_hp_pembimbing',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'status.status',
                name: 'status.status',
                render: function(data, type, row, meta) {
                    if (data === 'diterima') {
                        return '<div class="text-green-500 uppercase mx-auto text-start py-2 pointer-events-none rounded-sm">' + data + '</div>';
                    } else if (data === 'ditolak') {
                        return '<div class="text-red-500 uppercase mx-auto text-start py-2 pointer-events-none rounded-sm">' + data + '</div>';
                    } else if (data === 'selesai') {
                        return '<div class="text-blue-500 uppercase mx-auto text-start py-2 pointer-events-none rounded-sm">' + data + '</div>';
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
