
<fieldset>
                    <legend>Remove Cart:</legend>
                    <form id="pageForm" method="POST" action="/admin/carts/delete/{{$id}}" >
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Are you sure you want to remove this Cart ?</label>
                        </div>
                        <div class="row">
                            <button type="submit" class="waves-effect btn">Save</button>
                        </div>
                    </form>
                </fieldset>
<script type="text/javascript">
    $(document).ready(function () {

        $("#pageForm").validate({

            submitHandler: function (form) {
                var options = {
                    success: showResponse
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
                }
                $(form).ajaxSubmit(options);
            }
        });
    });
</script> 