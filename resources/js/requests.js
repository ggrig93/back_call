$(document).ready(function () {

    checkIfAllAreChecked();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#select-all').click(function (e) {
        let table = $('#all-requests');
        $('td input:checkbox', table).prop('checked', this.checked);
    });

    $('#toggle-seen').click(function () {

        let data = {seen: [], not_seen: []};

        $("input[name='requests[]']")
            .map(function (index, value) {
                if ($(value).prop('checked')) {
                    data.seen.push($(this).val());
                } else {
                    data.not_seen.push($(this).val());
                }
                return data;

            }).get();

        //TODO: you may check with serialize if data not changed, not send an ajax

        $.ajax({
            url: '/toggle-seen',
            method: 'POST',
            data: {requests: data},
            success: function (response) {
                if (response.status === 'ok') {
                    let $alert = $('#show-alert');
                    $alert.empty();
                    $alert.append(response.message);

                    checkIfAllAreChecked();

                    setTimeout(() => {
                        $alert.empty();
                    }, 2500)
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});

function checkIfAllAreChecked() {
    let $count = $("input:checkbox:not(:checked):not('#select-all')").length;

    if ($count === 0) {
        $('#select-all').prop('checked', true);
    }else{
        $('#select-all').prop('checked', false);
    }
}
