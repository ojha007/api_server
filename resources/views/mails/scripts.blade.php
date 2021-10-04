<script>

    $(document).ready(function () {
        $.ajax({
            url: '{{$url}}',
            method: 'GET',
            success: function (response) {
                let data = response.data;
                let template = `<ul class="messages text-decoration-none" style="margin: 2px">`
                for (let i = 0; i < data.length; i++) {
                    template += `<li class="message border">
                    <a href="javascript:void(0)" class="text-black" data-id='${data[i]["id"]}' onclick="viewMail($(this))"
                    <div class="header m-3 p-2">
                    <span class="from text-bold">${data[i]['from']}</span>
                     <span class="date pull-right">${data[i]['date']}</span></div>
                    <div class="title">${data[i]['subject']}</div>
                    <div class="description">${(data[i]['message']).replace('\n\g','<br/>')}</div>
                    </a>
                    </li>`
                }
                template += '</ul>';
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

