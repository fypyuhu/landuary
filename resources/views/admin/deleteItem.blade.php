
<fieldset>
                    <legend>Remove Item:</legend>
                    <form id="pageForm" method="POST" action="/admin/items/delete/{{$id}}" >
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Are you sure you want to remove this Item ?</label>
                            @if($isParent!=null)
                            <br><label>This is a parent Item, by removing it all sub items will be removed.</label>
                               <input  type="hidden" value="1" name="parent">
                            @endif
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