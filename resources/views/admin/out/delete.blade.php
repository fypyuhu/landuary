
<fieldset>
                    <legend>Remove Cart:</legend>
                    <form id="pageForm" method="POST" action="/admin/out/delete/{{$id}}" >
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Are you sure you want to remove this cart?</label>
                            <label for="item_name" class="error" id="error-item-name"></label>
                        </div>
                        <div class="row">
                            <button type="submit" class="waves-effect btn">Yes</button>
                        </div>
                    </form>
                </fieldset>
<script type="text/javascript">
    $(document).ready(function () {

        $("#pageForm").validate({

            submitHandler: function (form) {
				$('.loading').show();
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