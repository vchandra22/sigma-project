$(document).ready(function () {
    $('#tableManageAdmin').DataTable({
        dom: 'frtip',
        ordering: false,
        serverSide: true,
        processing: true,
        paging: true,
        responsive: true,
        pageLength: 20,
        ajax: {
            'url': $('#searchTableAdmin').val(),
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
                data: 'nama_lengkap',
                name: 'nama_lengkap',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'username',
                name: 'username',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'nip',
                name: 'nip',
                className: 'text-primary-800 text-start dark:text-secondary'
            },
            {
                orderable: false,
                data: 'offices.nama_kantor',
                name: 'offices.nama_kantor',
                className: 'text-primary-800 dark:text-secondary',
            },
            {
                orderable: false,
                data: 'email',
                name: 'email',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'no_hp',
                name: 'no_hp',
                className: 'text-primary-800 dark:text-secondary'
            },
            {
                orderable: false,
                data: 'roles.name',
                name: 'roles.name',
                render: function(data, type, row, meta) {
                    if (data === 'admin') {
                        return '<div class="bg-red-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + data + '</div>';
                    } else if (data === 'mentor') {
                        return '<div class="bg-blue-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + data + '</div>';
                    } else {
                        return data;
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
