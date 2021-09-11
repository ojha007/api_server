<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{$url}}',
            method: 'GET',
            success: function (response) {
                let data = response.data;
                let template = '<div class="table-responsive mailbox-messages">' +
                    '<table class="table table-hover table-striped"><thead>' +
                    '<td>S.NO</td>' +
                    '<td>Subject</td>' +
                    '<td>From</td>' +
                    '<td>Message</td>' +
                    '</thead>' +
                    '<tbody>';
                for (let i = 0; i < data.length; i++) {
                    console.log(data[i]);
                    let id = data[i]['id']
                    template += `<tr>
                                    <td>${i + 1}</td>
                                    <td>${data[i]['subject']}</td>
                                    <td>${data[i]['from']}</td>
                                    <td>${data[i]['message']}</td>
                                    <td class="small">${data[i]['date']}</td>
                                    <td>
                                        <button class="btn btn-xs btn-success" data-id='${data[i]["id"]}' onclick="viewMail($(this))">
                                            <i class="fa fa-eye"/>
                                        </button>
                                        </td>
                                    </tr>`
                }
                template += '</tbody><table></div>';
                $('#email').html(template);
            }, error: function (error) {
                console.log(error)
            }
        });

    });

    function viewMail($this) {
        let id = $this.data('id');
        let url = '{{url('mails/view')}}' + '/' + id;
        let modal = $("#viewMailModal");
        modal.find('.modal-body').html(`
            <div class="row">
            <div class="col-xs-12 text-center">
            <i class="fa fa-spin fa-refresh fa-2x"></i></div>
            </div>
        `)
        modal.modal('show');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                console.log(response);
                let template = `{{view('mails.view')}}`;
                modal.find('.modal-body').html(template);
            }
        })

    }
</script>

