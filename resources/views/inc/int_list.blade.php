<script>
    jQuery(document).ready(function($) {
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
               }
           });

           $.ajax({
               url: "{{ route('api.get.int') }}",
               success: function(response) {
                   var len = 0;
                   if (response != null) {
                       len = response.length;
                   }
                   if (len > 0) {
                       // Read data and create <option >
                       for (var i = 0; i < len; i++) {
                           var id = response[i];
                           var option = "<option value='" + id + "'>" + id + "</option>";
                           $(".int_jq").append(option);
                       }

                   }
               }
           });

       });
</script>