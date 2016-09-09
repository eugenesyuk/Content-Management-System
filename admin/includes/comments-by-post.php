<form action="" method="post">
    <div class="row bulk-gutter" id="bulkactions">
        <div class="col-sm-3 col-lg-2">
            <select name="bulk_action" id="" class="form-control bulk">
                <option value="">Bulk Actions</option>
                <option value="approve">Approve</option>
                <option value="unapprove">Unapprove</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-1">
            <button type="submit" class="btn btn-default form-control bulk" name="bulk_submit">Apply</button>
        </div>
    </div>
    <table id="comments" class="table table-striped">
        <thead>
            <tr>
                <th>
                    <input id="select-all" type="checkbox">
                </th>
                <th>Author</th>
                <th>Comment</th>
                <th>Status</th>
                <th>In response to</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php comments_by_post() ?>
        </tbody>
        <!--
                                    <tfoot>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Engine version</th>
                                            <th>CSS grade</th>
                                        </tr>
                                    </tfoot>
-->
    </table>
</form>
<script>
    jQuery(document).ready(function ($) {
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].post-checkbox, #select-all').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        , });

        $('#select-all').on('ifChecked', function (event) {
            $('.post-checkbox').each(function (event) {
                $(this).iCheck('check');
            });
        });

        $('#select-all').on('ifUnchecked', function (event) {
            $('.post-checkbox').each(function (event) {
                $(this).iCheck('uncheck');
            });
        });
    });
</script>