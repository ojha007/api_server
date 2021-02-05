<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{$url}}',
            method: 'GET',
            success: function (response) {
                let data = response.data;
                let template = '<div class="table-responsive mailbox-messages">' +
                    '<table class="table table-hover table-striped">' +
                    '<tbody>';
                for (let i = 0; i < data.length; i++) {
                    template += `<tr>
                                    <td>${i + 1}</td>
                                    <td>${data[i]['subject']}</td>
                                    <td>${data[i]['from_email']}</td>
                                    <td>${data[i]['from_name']}</td>
                                    <td>${data[i]['message']}</td>
                                    <td class="small">${data[i]['date']}</td>
                                    </tr>`
                }
                template += '</tbody><table></div>';
                $('#email').html(template);
                $('.overlay').addClass('hide');
            }, error: function (error) {
                console.log(error)
            }
        });
    });
</script>
