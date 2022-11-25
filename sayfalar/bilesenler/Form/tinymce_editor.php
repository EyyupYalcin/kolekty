<?php
function tinymce_editor($parametreler)
{
    ?>
        <div class="form-group">
            <label for="egitim_hakkinda"><?= $parametreler['etiket'] ?></label>
            <textarea class="form-control" id="<?= $parametreler['id'] ?>" name="<?= $parametreler['name'] ?>"></textarea>
            <input type='file' name='<?= $parametreler['id'] ?>fileupload' id='<?= $parametreler['id'] ?>fileupload' style='display: none;'>
        </div>

        <script type="text/javascript">
        //tinyMCE.triggerSave();
        //$('#<?= $parametreler['id'] ?>').constructor.prototype.val = function(){return this[0].value}

        tinymce.init({
            selector: '#<?= $parametreler['id'] ?>',
            branding: false,
            setup: function (e) {
                e.on("change", function () {
                    tinyMCE.triggerSave();
                })
                e.on("load", function () {
                    tinymce.activeEditor.setContent(`<?= $parametreler['deger'] ?>`);
                })
            },
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste",
            ],
            language: "tr",
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            automatic_uploads: false,
            menubar: false,
            file_picker_callback: function(callback, value, meta) {
                // File type
                if (meta.filetype == "media" || meta.filetype == "image") {

                    // Trigger click on file element
                    jQuery("#<?= $parametreler['id'] ?>fileupload").trigger("click");
                    $("#<?= $parametreler['id'] ?>fileupload").unbind('change');
                    // File selection
                    jQuery("#<?= $parametreler['id'] ?>fileupload").on("change", function() {
                        var file = this.files[0];
                        var reader = new FileReader();

                        // FormData
                        var fd = new FormData();
                        var files = file;
                        fd.append("file", files);
                        fd.append('filetype', meta.filetype);

                        var filename = "";

                        // AJAX
                        jQuery.ajax({
                            url: "/API/TinyMCE_Upload",
                            type: "post",
                            data: fd,
                            contentType: false,
                            processData: false,
                            async: false,
                            success: function(response) {
                                filename = response.location;
                            }
                        });

                        reader.onload = function(e) {
                            callback(filename);
                            //callback(e.target.result);
                        }
                        reader.readAsDataURL(file);
                    });
                }

            },
        });

        
        </script>
    <?php
}