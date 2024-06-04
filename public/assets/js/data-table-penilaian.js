$(document).ready(function () {
    $('#tableManagePenilaian').DataTable({
        dom: 'frtip',
        ordering: false,
        serverSide: true,
        processing: true,
        paging: true,
        responsive: true,
        pageLength: 20,
        ajax: {
            'url': $('#searchTablePenilaian').val(),
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
                data: 'user.no_hp',
                name: 'user.no_hp',
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
                searchable: true,
                data: 'status.certificate.no_sertifikat',
                name: 'status.certificate.no_sertifikat',
                render: function(data, type, row, meta) {
                    if (data === null) {
                        return '<p class="capitalize text-start py-2 pointer-events-none text-red-500">' + 'Sertifikat belum diterbitkan' + '</p>';
                    } else {
                        return '<p class="capitalize font-bold text-start py-2 pointer-events-none text-blue-500 dark:text-secondary">' + data + '</p>';
                    }
                }
            },
            {
                orderable: false,
                searchable: false,
                data: 'status.certificate.score',
                name: 'status.certificate.score',
                render: function(data, type, row, meta) {
                    if (data === null) {
                        return '<p class="bg-red-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + 'Belum Dinilai' + '</p>';
                    } else {
                        return '<p class="bg-green-500 px-4 uppercase mx-auto text-center py-2 pointer-events-none rounded-sm text-secondary">' + 'Sudah Dinilai' + '</p>';
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
