<script>
    function databrand() {
        $('#databrand').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: 'cari databrand',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('conmaster/ambildatabrand') ?>",
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                }
            }
        });
        $('#databrand').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('conmaster/ambildataberat') ?>",
                data: {
                    brand: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#berat').html(response.data);
                        $('#berat').select2();
                    }
                },
                error: function(xhr, trhowError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    }
    $(document).ready(function() {
        databrand();
    });
</script>