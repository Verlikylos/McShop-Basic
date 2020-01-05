import $ from 'jquery'

const tableIds = [
    {
        tableName: 'usersTable',
        settings: {
            dom: '<"dt-wrapper"t>p',
            pageLength: 10,
        }
    }
];

const localization = {
    "processing":     "Przetwarzanie...",
    "search":         "Szukaj:",
    "lengthMenu":     "Pokaż _MENU_ pozycji",
    "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
    "infoEmpty":      "Pozycji 0 z 0 dostępnych",
    "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
    "infoPostFix":    "",
    "loadingRecords": "Wczytywanie...",
    "zeroRecords":    "Nie znaleziono pasujących pozycji",
    "emptyTable":     "Brak danych",
    "paginate": {
        "first":      "Pierwsza",
        "previous":   "Poprzednia",
        "next":       "Następna",
        "last":       "Ostatnia"
    },
    "aria": {
        "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
        "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
    }
};

$(document).ready(() => {
    tableIds.map((item, id) => {
        const tableElement = $('#' + item.tableName)

        if (tableElement.length) {
            tableElement.DataTable({
                language: localization,
                ordering: false,
                ...item.settings
            })
        }
    })
})
